<?php

namespace App\Filament\Resources;

use App\Models\ZIS;
use Filament\Forms;
use Filament\Tables;
use App\Models\KategoriZis;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\EditAction; 
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction; 
use Filament\Support\Actions\Modal\Actions\Action as extraModalAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteAction; 
use App\Filament\Resources\ZISResource\Pages;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ZISResource\RelationManagers;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\Filter;

class ZISResource extends Resource
{
    protected static ?string $model = ZIS::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'ZIS';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Card untuk data donatur (sudah sesuai permintaan Anda)
                Card::make()->schema([
                    Select::make('donatur_id')
                        ->label('Nama Donatur')
                        ->relationship('donatur', 'nama')
                        ->searchable()->preload()->reactive()
                        ->createOptionForm([
                            TextInput::make('nama')->required(),
                            TextInput::make('alamat')->required(),
                            TextInput::make('notlp')->label('No. Telepon')->required(),
                            Select::make('jenis_donatur')
                            ->options([
                                'PRIBADI' => 'PRIBADI',
                                'INSTANSI' => 'INSTANSI'
                            ])->required(),
                        ]),
                ])->columns(1),

                // Card untuk detail transaksi ZIS
                Card::make()->schema([
                    // LANGKAH 2.1: Dropdown Kategori ZIS
                    Select::make('kategori_zis')
                        ->label('Kategori ZIS')
                        ->options(
                            // Mengambil nilai unik dari kolom 'kategori'
                            KategoriZis::query()->distinct()->pluck('kategori', 'kategori')
                        )
                        ->reactive() // PENTING: Membuatnya reaktif
                        ->required(),

                    // LANGKAH 2.2: Dropdown Jenis ZIS (Dependent)
                    Select::make('jenis_zis')
                        ->label('Jenis ZIS')
                        ->options(function (callable $get) {
                            // $get('kategori_zis') akan mengambil nilai yang sedang dipilih
                            $kategori = $get('kategori_zis');
                            if (!$kategori) {
                                // Jika belum ada kategori yang dipilih, dropdown jenis akan kosong
                                return [];
                            }
                            // Ambil jenis yang sesuai dengan kategori yang dipilih
                            return KategoriZis::query()
                                    ->where('kategori', $kategori)
                                    ->pluck('jenis', 'jenis');
                        })
                        ->required(),
                    
                    // ... sisa field ZIS lainnya
                    TextInput::make('jiwa')->numeric(),
                    TextInput::make('beras')->numeric()->suffix('Kg'),
                    TextInput::make('uang')->numeric()->prefix('Rp'),
                    Select::make('rekening_id')
                        ->label('Rekening Tujuan')
                        ->relationship('rekening', 'bank') // 'atas_nama' atau 'no_rekening'
                        ->helperText('Pilih jika pembayaran melalui transfer bank.'),
                    Select::make('amil_id')
                        ->label('Amil yang Bertugas')
                        ->relationship('amil', 'nama_amil') // 'amil' adalah nama relasi, 'nama_amil' adalah kolom yg ditampilkan
                        ->searchable()
                        ->required()
                        ->preload(),
                    Textarea::make('keterangan')->columnSpanFull(),

                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // BAGIAN 1: Mengatur kolom-kolom utama yang akan tampil di tabel
            ->columns([
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('donatur.nama') // Mengambil nama dari relasi 'donatur'
                    ->label('Nama Donatur')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('beras')
                    ->suffix(' Kg')
                    ->sortable(),

                TextColumn::make('uang')
                    ->prefix('Rp ')
                    ->formatStateUsing(function ($state) {
                        // Format angka dengan pemisah ribuan titik
                        return number_format($state, 0, ',', '.');
                    })
                    ->sortable(),
                
                TextColumn::make('rekening.bank')
                ->label('Pembayaran')    
                ->searchable()
                    ->sortable(),
                    
                
                TextColumn::make('kategori_zis')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis_zis')
                    ->label('jenis')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('amil.nama_amil')
                    ->label('Amil')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                // ...
            ])
            // BAGIAN 2: Menambahkan tombol-tombol aksi untuk setiap baris
            ->actions([
                ViewAction::make() // Nama defaultnya adalah 'view', bukan 'detail'
                    ->label('') // Anda bisa ubah labelnya
                    ->color('gray')
                    ->mutateRecordDataUsing(function (Model $record) {
                        // Fungsi ini akan berjalan sebelum modal ditampilkan
                        $data = $record->toArray();

                        // Cek apakah relasi donatur ada, lalu gabungkan datanya
                        if ($record->donatur) {
                            $data['donatur.nama'] = $record->donatur->nama;
                            $data['donatur.alamat'] = $record->donatur->alamat;
                            $data['donatur.tlp'] = $record->donatur->tlp;
                        }

                        return $data;
                    })
                    ->form([
                        // Sekarang, field-field ini akan terisi dengan benar
                        TextInput::make('donatur.nama')->label('Nama Donatur')->disabled(),
                        TextInput::make('donatur.alamat')->label('Alamat')->disabled(),
                        TextInput::make('donatur.notlp')->label('No. Telepon')->disabled(),
                        TextInput::make('kategori_zis')->disabled(),
                        TextInput::make('jenis_zis')->disabled(),
                        TextInput::make('jiwa')->disabled(),
                        TextInput::make('beras')->suffix(' Kg')->disabled(),
                        TextInput::make('uang')->prefix('Rp ')->disabled(),
                        TextInput::make('rekening.bank')->label('Pembayaran')->disabled(),
                        TextInput::make('amil.nama_amil')->label('Amil')->disabled(),
                        TextInput::make('keterangan')->disabled(),
                        DateTimePicker::make('created_at')->label('Tanggal Transaksi')->disabled()->displayFormat('d-m-Y H:i'),
                    ]),

                EditAction::make()
                    ->label(''),
                Action::make('cetak_invoice')
                    ->label('')
                    ->icon('heroicon-o-printer')
                    ->color('gray')
                    ->url(fn (ZIS $record): string => route('zis.invoice', $record))
                    ->extraAttributes(['target' => '_blank']),
                DeleteAction::make()
                    ->label(''),
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public static function getEloquentQuery(): EloquentBuilder
    {
        return parent::getEloquentQuery()->with(['donatur', 'rekening', 'amil']);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListZIS::route('/'),
            'create' => Pages\CreateZIS::route('/create'),
            'edit' => Pages\EditZIS::route('/{record}/edit'),
        ];
    }    
}
