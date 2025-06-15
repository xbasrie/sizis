<?php

namespace App\Filament\Resources\KategoriZisResource\Pages;

use App\Filament\Resources\KategoriZisResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriZis extends ListRecords
{
    protected static string $resource = KategoriZisResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
