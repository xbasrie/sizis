<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Penerima;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PenerimaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenerimaResource\RelationManagers;

class PenerimaResource extends Resource
{
    protected static ?string $model = Penerima::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Data Master';

    protected static ?string $navigationLabel = 'Data Penerima';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama')->required()->label('Nama'),
                        TextInput::make('alamat')->required()->label('Alamat'),
                        TextInput::make('notlp')->required()->label('No. Tlp'),
                        Select::make('kategori_penerima_id')
                            ->label('Kategori Penerima') // Label yang akan tampil di form
                            ->relationship('kategoriPenerima','kategori')
                            ->searchable() // Membuat dropdown bisa dicari
                            ->preload()    // Memuat opsi di awal jika datanya tidak terlalu banyak
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('alamat')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('notlp')->label('No. Tlp')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kategoriPenerima.kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListPenerimas::route('/'),
            'create' => Pages\CreatePenerima::route('/create'),
            'edit' => Pages\EditPenerima::route('/{record}/edit'),
        ];
    }    
}
