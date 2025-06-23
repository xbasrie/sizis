<?php

namespace App\Filament\Resources\RekeningResource\Pages;

use App\Filament\Resources\RekeningResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRekenings extends ListRecords
{
    protected static string $resource = RekeningResource::class;

    protected static ?string $title = 'Data Rekening';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Rekening'),
        ];
    }
}
