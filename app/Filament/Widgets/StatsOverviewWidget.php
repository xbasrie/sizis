<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\ZIS;
use App\Models\Penyaluran;
use App\Models\Donatur;
use App\Models\Penerima;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalDonasi = ZIS::query()->sum('uang');
        $totalPenyaluran = Penyaluran::query()->sum('uang');
        $jumlahDonatur = Donatur::query()->count();
        $jumlahPenerima = Penerima::query()->count();

        return [
            Stat::make('Total Donasi Terkumpul', 'Rp ' . number_format($totalDonasi, 0, ',', '.'))
                ->description('Semua donasi uang yang diterima')
                ->color('success'),

            Stat::make('Total Dana Tersalurkan', 'Rp ' . number_format($totalPenyaluran, 0, ',', '.'))
                ->description('Semua dana yang sudah disalurkan')
                ->color('danger'),

            Stat::make('Jumlah Donatur', $jumlahDonatur)
                ->description('Total donatur yang terdaftar')
                ->color('primary'),

            Stat::make('Jumlah Penerima Manfaat', $jumlahPenerima)
                ->description('Total penerima manfaat terdaftar')
                ->color('primary'),
        ];
    }
}
