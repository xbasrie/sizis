<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\ZIS;
use Carbon\Carbon;

class PenerimaanBulananChart extends BarChartWidget
{
    protected static ?string $heading = 'Penerimaan ZIS 12 Bulan Terakhir';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $date = $month->format('Y-m');

            $penerimaan = ZIS::where('created_at', 'like', $date . '%')->sum('uang');

            $labels[] = $month->format('M Y');
            $data[] = $penerimaan;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Donasi Diterima',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgb(54, 162, 235)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Tipe grafik adalah 'bar'
    }
}
