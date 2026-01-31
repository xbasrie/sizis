<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\ZIS;
use Illuminate\Support\Facades\DB;

class KomposisiKategoriChart extends ChartWidget
{
    protected static ?string $heading = 'Komposisi Kategori ZIS';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = ZIS::query()
            ->join('kategori_zis', 'z_i_s.kategori_zis_id', '=', 'kategori_zis.id') 
            ->groupBy('kategori_zis.kategori') 
            ->select('kategori_zis.kategori', DB::raw('count(*) as total')) 
            ->pluck('total', 'kategori'); 

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
        return 'pie'; 
    }
}
