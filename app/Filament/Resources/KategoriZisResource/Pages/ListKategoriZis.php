<?php

namespace App\Filament\Resources\KategoriZisResource\Pages;

use App\Filament\Resources\KategoriZisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriZis extends ListRecords
{
    protected static string $resource = KategoriZisResource::class;

    protected static ?string $title = 'Kategori ZIS';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Kategori ZIS'),
        ];
    }
}


