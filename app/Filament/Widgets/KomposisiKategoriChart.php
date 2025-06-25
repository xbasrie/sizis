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
            ->join('kategori_zis', 'z_i_s.kategori_zis_id', '=', 'kategori_zis.id') // 1. JOIN tabel
            ->groupBy('kategori_zis.kategori') // 2. Group by nama kategori dari tabel join
            ->select('kategori_zis.kategori', DB::raw('count(*) as total')) // 3. Select nama kategori
            ->pluck('total', 'kategori'); // 4. Pluck hasilnya

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
