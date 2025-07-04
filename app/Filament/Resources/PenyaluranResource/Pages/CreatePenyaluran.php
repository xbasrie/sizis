<?php

namespace App\Filament\Resources\PenyaluranResource\Pages;

use App\Filament\Resources\PenyaluranResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenyaluran extends CreateRecord
{
    protected static string $resource = PenyaluranResource::class;

    protected static ?string $title = 'Tambah Data Penyaluran';

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
