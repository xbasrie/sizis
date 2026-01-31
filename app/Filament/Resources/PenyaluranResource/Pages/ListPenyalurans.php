<?php

namespace App\Filament\Resources\PenyaluranResource\Pages;

use App\Filament\Resources\PenyaluranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenyalurans extends ListRecords
{
    protected static string $resource = PenyaluranResource::class;

    protected static ?string $title = 'Data Penyaluran';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Data Penyaluran'),
        ];
    }
}


