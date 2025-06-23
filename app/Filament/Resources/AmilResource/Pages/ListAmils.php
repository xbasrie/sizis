<?php

namespace App\Filament\Resources\AmilResource\Pages;

use App\Filament\Resources\AmilResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAmils extends ListRecords
{
    protected static string $resource = AmilResource::class;

    protected static ?string $title = 'Data Amil';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Amil'),
        ];
    }
}
