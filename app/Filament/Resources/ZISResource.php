<?php

namespace App\Filament\Resources;

use App\Models\ZIS;
use Filament\Forms;
use Filament\Tables;
use App\Models\KategoriZis;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\EditAction; 
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction; 
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteAction; 
use App\Filament\Resources\ZISResource\Pages;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;

class ZISResource extends Resource
{
    protected static ?string $model = ZIS::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'ZIS';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
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

                Section::make()->schema([
                    Select::make('kategori_zis_id')
                        ->label('Kategori & Jenis ZIS')
                        ->options(
                            KategoriZis::all()->mapWithKeys(function ($item) {
                                return [$item->id => $item->display_name];
                            })
                        )
                        ->searchable()
                        ->preload()
                        ->required(),
                    
                    TextInput::make('jiwa')->numeric(),
                    TextInput::make('uang')->numeric()->prefix('Rp'),
                    Select::make('rekening_id')
                        ->label('Rekening Tujuan')
                        ->relationship('rekening', 'bank') 
                        ->helperText('Pilih jika pembayaran melalui transfer bank.')
                        ->required(),
                    Select::make('amil_id')
                        ->label('Amil yang Bertugas')
                        ->relationship('amil', 'nama_amil')
                        ->searchable()
                        ->required()
                        ->preload(),
                    Textarea::make('keterangan')->columnSpanFull(),
                    FileUpload::make('bukti_transfer')
                        ->label('Bukti Transfer')
                        ->image()
                        ->disk('public')
                        ->directory('bukti_transfer')
                        ->visibility('public')
                        ->columnSpanFull()
                        ->disabled(), // Disabled primarily for View context via Resource form, or make it enabled if Editing is allowed. Let's keep it simple.
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->searchable()
                    ->date('d/m/Y')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama')
                    ->label('Nama Donatur')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('uang')
                    ->prefix('Rp ')
                    ->formatStateUsing(function ($state) {
                        return number_format($state, 0, ',', '.');
                    })
                    ->sortable(),
                
                TextColumn::make('rekening.bank')
                    ->label('Pembayaran')    
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('kategoriZis.kategori')
                    ->label('Kategori/Jenis')
                    ->description(fn (ZIS $record) => $record->kategoriZis?->jenis)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('amil.nama_amil')
                    ->label('Amil')
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // ...
            ])
            ->actions([
                ViewAction::make()
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->modalHeading('Detail Transaksi ZIS')
                    ->mutateRecordDataUsing(function (Model $record): array {
                        $data = $record->toArray();
                        $data['nama_donatur_display'] = $record->donatur?->nama;
                        $data['notlp_display'] = $record->donatur?->notlp;
                        $data['alamat_display'] = $record->donatur?->alamat;
                        $data['nama_amil_display'] = $record->amil?->nama_amil;
                        $data['rekening_display'] = $record->rekening?->display_name; 
                        $data['kategori_zis_display'] = $record->kategoriZis?->display_name;
                        return $data;
                    })
                    ->form([
                        TextInput::make('nama_donatur_display')->label('Nama Donatur')->disabled(),
                        TextInput::make('notlp_display')->label('No. Tlp')->disabled(),
                        TextInput::make('alamat_display')->label('Alamat')->disabled(),
                        TextInput::make('rekening_display')->label('Rekening Tujuan')->disabled(),
                        TextInput::make('nama_amil_display')->label('Amil Bertugas')->disabled(),
                        TextInput::make('kategori_zis_display')->label('Kategori/Jenis ZIS')->disabled(),
                        
                        TextInput::make('uang')->prefix('Rp ')->disabled(),
                        TextInput::make('beras')->suffix(' Kg')->disabled(),
                        TextInput::make('jiwa')->disabled(),
                        TextInput::make('keterangan')->disabled(),
                        DateTimePicker::make('created_at')->label('Tanggal Transaksi')->disabled()->displayFormat('d-m-Y H:i'),
                        TextInput::make('keterangan')->disabled(),
                        DateTimePicker::make('created_at')->label('Tanggal Transaksi')->disabled()->displayFormat('d-m-Y H:i'),
                        FileUpload::make('bukti_transfer')
                            ->label('Bukti Transfer')
                            ->image()
                            ->disk('public')
                            ->disabled()
                            ->columnSpanFull(), 
                    ]),

                Action::make('confirm')
                     ->label('Konfirmasi')
                     ->icon('heroicon-o-check-circle')
                     ->color('success')
                     ->requiresConfirmation()
                     ->visible(fn (ZIS $record) => $record->payment_status === 'pending')
                     ->action(function (ZIS $record) {
                         $record->update(['payment_status' => 'success']);
                         
                         // Update Campaign Funds
                         if ($record->campaign_id) {
                             $campaign = \App\Models\Campaign::find($record->campaign_id);
                             if ($campaign) {
                                 $campaign->increment('dana_terkumpul', $record->uang);
                             }
                         }

                         Notification::make()
                             ->title('Donasi berhasil dikonfirmasi')
                             ->success()
                             ->send();
                     }),
                
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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


