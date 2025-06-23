<?php

namespace App\Filament\Resources\ZISResource\Pages;

use App\Filament\Resources\ZISResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZIS extends EditRecord
{
    protected static string $resource = ZISResource::class;

    protected static ?string $title = 'Edit Data ZIS';

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
