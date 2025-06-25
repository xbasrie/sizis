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
                    Select::make('kategori_zis_id')
                        ->label('Kategori & Jenis ZIS')
                        ->options(
                            // Kita akan membuat daftar pilihan secara manual di sini
                            KategoriZis::all()->mapWithKeys(function ($item) {
                                // Kunci array adalah ID, nilainya adalah teks gabungan dari accessor
                                // Kita panggil accessor 'display_name' di sini, di level PHP
                                return [$item->id => $item->display_name];
                            })
                        )
                        ->searchable()
                        ->preload()
                        ->required(),
                    
                    // ... sisa field ZIS lainnya
                    TextInput::make('jiwa')->numeric(),
                    TextInput::make('beras')->numeric()->suffix('Kg'),
                    TextInput::make('uang')->numeric()->prefix('Rp'),
                    Select::make('rekening_id')
                        ->label('Rekening Tujuan')
                        ->relationship('rekening', 'bank') // 'atas_nama' atau 'no_rekening'
                        ->helperText('Pilih jika pembayaran melalui transfer bank.')
                        ->required(),
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
                    
                TextColumn::make('kategoriZis.display_name')
                    ->label('Kategori/Jenis')
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
                // di dalam ->actions([...])

            ViewAction::make()
                // Anda bisa memberi label 'Detail' atau biarkan kosong agar hanya ikon
                ->label('')
                ->icon('heroicon-o-eye')
                ->color('gray')
                ->modalHeading('Detail Transaksi ZIS')
                // Method ini akan "memetakan" data relasi ke nama field yang sederhana
                ->mutateRecordDataUsing(function (Model $record): array {
                    $data = $record->toArray();

                    // Ambil data dari relasi yang sudah di-load dan masukkan ke array
                    // Tanda '?' adalah null-safe operator untuk mencegah error jika relasi kosong
                    $data['nama_donatur_display'] = $record->donatur?->nama;
                    $data['notlp_display'] = $record->donatur?->notlp;
                    $data['alamat_display'] = $record->donatur?->alamat;
                    $data['nama_amil_display'] = $record->amil?->nama_amil;
                    
                    // Menggunakan accessor yang sudah kita buat di model Rekening
                    $data['rekening_display'] = $record->rekening?->display_name; 

                    // Menggunakan accessor yang sudah kita buat di model KategoriZis
                    $data['kategori_zis_display'] = $record->kategoriZis?->display_name;

                    return $data;
                })
                ->form([
                    // Sekarang, 'make()' merujuk ke key yang kita buat di atas
                    TextInput::make('nama_donatur_display')->label('Nama Donatur')->disabled(),
                    TextInput::make('notlp_display')->label('No. Tlp')->disabled(),
                    TextInput::make('alamat_display')->label('Alamat')->disabled(),
                    TextInput::make('rekening_display')->label('Rekening Tujuan')->disabled(),
                    TextInput::make('nama_amil_display')->label('Amil Bertugas')->disabled(),
                    TextInput::make('kategori_zis_display')->label('Kategori/Jenis ZIS')->disabled(),
                    
                    // Field dari tabel z_i_s itu sendiri bisa dipanggil langsung
                    TextInput::make('uang')->prefix('Rp ')->disabled(),
                    TextInput::make('beras')->suffix(' Kg')->disabled(),
                    TextInput::make('jiwa')->disabled(),
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
        return parent::getEloquentQuery()->with(['donatur', 'rekening', 'amil','kategoriZis']);
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
