<?php

namespace App\Filament\Resources\ZISResource\Pages;

use App\Filament\Resources\ZISResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZIS extends ListRecords
{
    protected static string $resource = ZISResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
