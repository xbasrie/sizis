<?php

namespace App\Filament\Resources\PenyaluranResource\Pages;

use App\Filament\Resources\PenyaluranResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenyalurans extends ListRecords
{
    protected static string $resource = PenyaluranResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
