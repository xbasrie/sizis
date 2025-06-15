<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Donatur;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DonaturResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DonaturResource\RelationManagers;

class DonaturResource extends Resource
{
    protected static ?string $model = Donatur::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Database';

    protected static ?string $navigationLabel = 'Data Donatur';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama')->required(),
                        TextInput::make('alamat')->required(),
                        TextInput::make('notlp')->required(),
                        Select::make('jenis_donatur')
                            ->options([
                                'PRIBADI' => 'PRIBADI',
                                'INSTANSI' => 'INSTANSI'
                            ])->required(),
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
                TextColumn::make('notlp')
                    ->searchable()
                    ->sortable()
                    ->label('No. Tlp'),
                TextColumn::make('jenis_donatur')
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
            'index' => Pages\ListDonaturs::route('/'),
            'create' => Pages\CreateDonatur::route('/create'),
            'edit' => Pages\EditDonatur::route('/{record}/edit'),
        ];
    }    
}
