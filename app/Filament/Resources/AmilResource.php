<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Amil;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AmilResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AmilResource\RelationManagers;

class AmilResource extends Resource
{
    protected static ?string $model = Amil::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Data Master';

    protected static ?string $navigationLabel = 'Data Amil';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_amil')->required(),
                        TextInput::make('notlp_amil')->label('No. Tlp'),
                        Select::make('jenis_kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ]),
                        TextInput::make('alamat')->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_amil')
                    ->label('Nama Amil')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('jenis_kelamin')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('notlp_amil')
                    ->label('No. Tlp')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('alamat')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListAmils::route('/'),
            'create' => Pages\CreateAmil::route('/create'),
            'edit' => Pages\EditAmil::route('/{record}/edit'),
        ];
    }    
}
