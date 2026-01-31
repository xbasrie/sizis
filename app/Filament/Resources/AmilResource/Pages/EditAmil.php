<?php

namespace App\Filament\Resources\AmilResource\Pages;

use App\Filament\Resources\AmilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAmil extends EditRecord
{
    protected static string $resource = AmilResource::class;

    protected static ?string $title = 'Edit Data Amil';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}


