<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampaignResource\Pages;
use App\Models\Campaign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use App\Models\KategoriZis;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationGroup = 'Penggalangan Dana';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Campaign')
                    ->schema([
                        TextInput::make('judul')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Campaign::class, 'slug', ignoreRecord: true),
                            
                        Select::make('kategori_zis_id')
                            ->label('Kategori ZIS')
                            ->options(KategoriZis::all()->mapWithKeys(function ($item) {
                                return [$item->id => $item->display_name];
                            }))
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('target_dana')
                            ->prefix('Rp')
                            ->required()
                            ->numeric()
                            ->minValue(0),

                        TextInput::make('midtrans_payment_link')
                            ->label('Manual Payment Link (Optional)')
                            ->url()
                            ->helperText('Jika diisi, donatur akan diarahkan ke link ini. Jika kosong, sistem otomatis menggunakan Midtrans Snap (Popup).'),

                        RichEditor::make('deskripsi')
                            ->required()
                            ->columnSpan(2),
                        
                        FileUpload::make('foto')
                            ->image()
                            ->directory('campaigns')
                            ->columnSpan(2),

                        Toggle::make('status')
                            ->required()
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->square(),
                
                TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                TextColumn::make('target_dana')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('dana_terkumpul')
                    ->money('IDR')
                    ->sortable()
                    ->label('Terkumpul'),

                ToggleColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}
