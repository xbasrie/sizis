<?php

namespace App\Filament\Resources\PenerimaResource\Pages;

use App\Filament\Resources\PenerimaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenerimas extends ListRecords
{
    protected static string $resource = PenerimaResource::class;

    protected static ?string $title = 'Data Penerima';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Penerima'),
        ];
    }
}
