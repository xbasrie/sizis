<?php

namespace App\Filament\Resources\KategoriPenerimaResource\Pages;

use App\Filament\Resources\KategoriPenerimaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriPenerima extends EditRecord
{
    protected static string $resource = KategoriPenerimaResource::class;

    protected static ?string $title = 'Edit Kategori Penerima';

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
