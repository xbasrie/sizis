<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\ZIS;
use App\Models\Penyaluran;
use App\Models\Donatur;
use App\Models\Penerima;

class StatsOverviewWidget extends BaseWidget
{
    protected function getCards(): array
    {
        $totalDonasi = ZIS::query()->sum('uang');
        $totalPenyaluran = Penyaluran::query()->sum('uang');
        $jumlahDonatur = Donatur::query()->count();
        $jumlahPenerima = Penerima::query()->count();

        return [
            Card::make('Total Donasi Terkumpul', 'Rp ' . number_format($totalDonasi, 0, ',', '.'))
                ->description('Semua donasi uang yang diterima')
                //->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color('success'),

            Card::make('Total Dana Tersalurkan', 'Rp ' . number_format($totalPenyaluran, 0, ',', '.'))
                ->description('Semua dana yang sudah disalurkan')
                //->descriptionIcon('heroicon-o-arrow-trending-down')
                ->color('danger'),

            Card::make('Jumlah Donatur', $jumlahDonatur)
                ->description('Total donatur yang terdaftar')
                //->descriptionIcon('heroicon-o-users')
                ->color('primary'),

            Card::make('Jumlah Penerima Manfaat', $jumlahPenerima)
                ->description('Total penerima manfaat terdaftar')
                //->descriptionIcon('heroicon-o-user-group')
                ->color('primary'),
        ];
    }
}
