<?php

namespace App\Filament\Resources\KategoriPenerimaResource\Pages;

use App\Filament\Resources\KategoriPenerimaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriPenerima extends EditRecord
{
    protected static string $resource = KategoriPenerimaResource::class;

    protected static ?string $title = 'Edit Kategori Penerima';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}


