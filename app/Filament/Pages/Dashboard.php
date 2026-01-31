<?php

namespace App\Filament\Pages;

// 1. UBAH INI: Kita meng-extend class Dashboard bawaan, bukan Page
// Kita memberinya nama alias 'BaseDashboard' agar tidak bentrok
use Filament\Pages\Dashboard as BaseDashboard;

use App\Filament\Widgets\StatsOverviewWidget;
use App\Filament\Widgets\PenerimaanBulananChart;
use App\Filament\Widgets\KomposisiKategoriChart;

// 2. UBAH INI: extends BaseDashboard, bukan Page
class Dashboard extends BaseDashboard
{
    /**
     * HAPUS PROPERTI DI BAWAH INI KARENA TIDAK DIPERLUKAN LAGI.
     * Halaman Dashboard tidak memerlukan file view terpisah, karena
     * isinya akan dibuat otomatis dari widget.
     *
     * protected static ?string $navigationIcon = 'heroicon-o-document-text';
     * protected static string $view = 'filament.pages.dashboard';
     */


    // Method ini tetap sama
    public function getColumns(): int
    {
        return 2;
    }

    // Method ini juga tetap sama
    public function getWidgets(): array
    {
        return [
            StatsOverviewWidget::class,
            PenerimaanBulananChart::class,
            KomposisiKategoriChart::class,
        ];
    }
}