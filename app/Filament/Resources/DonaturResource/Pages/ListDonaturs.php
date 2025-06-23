<?php

namespace App\Filament\Resources\DonaturResource\Pages;

use App\Filament\Resources\DonaturResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonaturs extends ListRecords
{
    protected static string $resource = DonaturResource::class;

    protected static ?string $title = 'Data Donatur';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Donatur'),
        ];
    }
}
