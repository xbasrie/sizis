<?php

namespace App\Filament\Resources\KategoriPenerimaResource\Pages;

use App\Filament\Resources\KategoriPenerimaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriPenerima extends CreateRecord
{
    protected static string $resource = KategoriPenerimaResource::class;

    protected static ?string $title = 'Tambah Kategori Penerima';

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
