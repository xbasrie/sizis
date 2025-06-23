<?php

namespace App\Filament\Resources\DonaturResource\Pages;

use App\Filament\Resources\DonaturResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDonatur extends EditRecord
{
    protected static string $resource = DonaturResource::class;

    protected static ?string $title = 'Edit Data Donatur';

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
