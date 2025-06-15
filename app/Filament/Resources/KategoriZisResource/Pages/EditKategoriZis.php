<?php

namespace App\Filament\Resources\KategoriZisResource\Pages;

use App\Filament\Resources\KategoriZisResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriZis extends EditRecord
{
    protected static string $resource = KategoriZisResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
