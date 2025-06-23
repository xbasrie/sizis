<?php

namespace App\Filament\Resources\KategoriPenerimaResource\Pages;

use App\Filament\Resources\KategoriPenerimaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriPenerimas extends ListRecords
{
    protected static string $resource = KategoriPenerimaResource::class;

    protected static ?string $title = 'Kategori Penerima';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Kategori Penerima'),
        ];
    }
}
