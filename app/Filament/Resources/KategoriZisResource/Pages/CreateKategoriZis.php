<?php

namespace App\Filament\Resources\KategoriZisResource\Pages;

use App\Filament\Resources\KategoriZisResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriZis extends CreateRecord
{
    protected static string $resource = KategoriZisResource::class;

    protected static ?string $title = 'Tambah Kategori ZIS';

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
