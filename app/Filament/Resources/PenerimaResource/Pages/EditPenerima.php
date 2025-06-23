<?php

namespace App\Filament\Resources\PenerimaResource\Pages;

use App\Filament\Resources\PenerimaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenerima extends EditRecord
{
    protected static string $resource = PenerimaResource::class;

    protected static ?string $title = 'Edit Data Penerima';

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
