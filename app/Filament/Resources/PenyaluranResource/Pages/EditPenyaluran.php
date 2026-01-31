<?php

namespace App\Filament\Resources\PenyaluranResource\Pages;

use App\Filament\Resources\PenyaluranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenyaluran extends EditRecord
{
    protected static string $resource = PenyaluranResource::class;

    protected static ?string $title = 'Edit Data Penyaluran';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}


