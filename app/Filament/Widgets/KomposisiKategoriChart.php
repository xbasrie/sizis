<?php

namespace App\Filament\Widgets;

use Filament\Widgets\PieChartWidget;
use App\Models\ZIS;
use Illuminate\Support\Facades\DB;

class KomposisiKategoriChart extends PieChartWidget
{
    protected static ?string $heading = 'Komposisi Kategori ZIS';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = ZIS::query()
            ->groupBy('kategori_zis')
            ->select('kategori_zis', DB::raw('count(*) as total'))
            ->pluck('total', 'kategori_zis');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56'],
                ],
            ],
            'labels' => $data->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie'; // Tipe grafik adalah 'pie' atau 'doughnut'
    }
}
