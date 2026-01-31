<?php

namespace App\Filament\Resources\PenerimaResource\Pages;

use App\Filament\Resources\PenerimaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenerimas extends ListRecords
{
    protected static string $resource = PenerimaResource::class;

    protected static ?string $title = 'Data Penerima';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Penerima'),
        ];
    }
}


