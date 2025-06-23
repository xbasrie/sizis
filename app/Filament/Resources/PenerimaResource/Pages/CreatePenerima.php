<?php

namespace App\Filament\Resources\PenerimaResource\Pages;

use App\Filament\Resources\PenerimaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenerima extends CreateRecord
{
    protected static string $resource = PenerimaResource::class;

    protected static ?string $title = 'Tambah Data Penerima';

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
