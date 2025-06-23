<?php

namespace App\Filament\Resources\AmilResource\Pages;

use App\Filament\Resources\AmilResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAmil extends CreateRecord
{
    protected static string $resource = AmilResource::class;

    protected static ?string $title = 'Tambah Data Amil';

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
