<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Penyaluran;
use App\Models\KategoriZis;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenyaluranResource\Pages;
use App\Filament\Resources\PenyaluranResource\RelationManagers;

class PenyaluranResource extends Resource
{
    protected static ?string $model = Penyaluran::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'Penyaluran';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('penerima_id')
                            ->relationship('penerima', 'nama')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('nama')
                                    ->required(),

                                TextInput::make('alamat')
                                    ->required(),

                                TextInput::make('notlp')
                                    ->required()
                                    ->label('No. Tlp'),

                                Select::make('kategori_penerima_id')
                                    ->required()
                                    ->label('Kategori Penerima')
                                    ->relationship('kategoriPenerima', 'kategori'),
                            ]),

                        DatePicker::make('tanggal_penyaluran')
                            ->required()
                            ->default(now()),
                            
                        Select::make('kategori_zis_id')
                            ->label('Kategori & Jenis Penyaluran')
                            //->relationship('kategoriZis', 'display_name') // Gunakan relasi dan accessor baru
                            ->options(
                                // Kita akan membuat daftar pilihan secara manual di sini
                                KategoriZis::all()->mapWithKeys(function ($item) {
                                    // Kunci array adalah ID, nilainya adalah teks gabungan
                                    // Ini adalah tempat di mana accessor 'display_name' Anda bekerja di level PHP
                                    return [$item->id => $item->kategori . ' - ' . $item->jenis];
                                })
                            )
                            //->searchable(['kategori', 'jenis'])
                            ->preload()
                            ->required(),

                        TextInput::make('uang')
                            ->numeric()
                            ->prefix('Rp'),

                        TextInput::make('beras')
                            ->numeric()
                            ->suffix('Kg'),

                        Textarea::make('keterangan')
                            ->columnSpanFull(),

                        Select::make('amil_id')
                            ->relationship('amil', 'nama_amil')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal_penyaluran')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('penerima.nama')
                    ->label('Nama Penerima')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('uang')
                    ->prefix('Rp.')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('beras')
                    ->suffix('Kg')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('kategoriZis.display_name')
                    ->label('Kategori'),
                TextColumn::make('amil.nama_amil')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('keterangan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListPenyalurans::route('/'),
            'create' => Pages\CreatePenyaluran::route('/create'),
            'edit' => Pages\EditPenyaluran::route('/{record}/edit'),
        ];
    }    
}
