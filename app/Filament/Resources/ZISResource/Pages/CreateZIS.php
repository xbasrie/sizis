<?php

namespace App\Filament\Resources\ZISResource\Pages;

use App\Filament\Resources\ZISResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateZIS extends CreateRecord
{
    protected static string $resource = ZISResource::class;

    protected static ?string $title = 'Tambah Data ZIS';

    protected function getFormActions(): array
    {
        return [
            // Mengubah label tombol "Create" menjadi "Simpan Data"
            $this->getCreateFormAction()->label('Simpan Data'),
            
            // (Opsional) Mengubah label tombol "Create & create another"
            //$this->getCreateAndContinueFormAction()->label('Simpan & Tambah Lagi'),

            // Mengubah label tombol "Cancel" menjadi "Batal"
            $this->getCancelFormAction()->label('Batal'),
        ];
    }
}


