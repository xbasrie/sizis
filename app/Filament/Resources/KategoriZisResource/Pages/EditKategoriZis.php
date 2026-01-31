<?php

namespace App\Filament\Resources\KategoriZisResource\Pages;

use App\Filament\Resources\KategoriZisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriZis extends EditRecord
{
    protected static string $resource = KategoriZisResource::class;

    protected static ?string $title = 'Edit Kategori ZIS';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}


