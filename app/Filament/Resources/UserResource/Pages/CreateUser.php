<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Spatie\Permission\Models\Role;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Tambah User';

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

    protected function afterCreate(): void
    {
        // Ambil array ID role dari form, pastikan selalu dalam bentuk array
        $roles = (array) $this->data['roles'];

        if (!empty($roles)) {
            // Cari objek Role berdasarkan ID yang dipilih
            $role_models = Role::whereIn('id', $roles)->get();
            // Sync roles menggunakan koleksi objek Model, ini cara paling aman
            $this->record->syncRoles($role_models);
        }
    }
}
