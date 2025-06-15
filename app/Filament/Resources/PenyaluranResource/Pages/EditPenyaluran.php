<?php

namespace App\Filament\Resources\PenyaluranResource\Pages;

use App\Filament\Resources\PenyaluranResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenyaluran extends EditRecord
{
    protected static string $resource = PenyaluranResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
