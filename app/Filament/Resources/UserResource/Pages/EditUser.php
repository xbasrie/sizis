<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Spatie\Permission\Models\Role;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Edit User';

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Logikanya sama persis dengan afterCreate
        $roles = (array) $this->data['roles'];

        if (!empty($roles)) {
            $role_models = Role::whereIn('id', $roles)->get();
            $this->record->syncRoles($role_models);
        } else {
            // Jika tidak ada role yang dipilih, hapus semua role dari user ini
            $this->record->syncRoles([]);
        }
    }
}
