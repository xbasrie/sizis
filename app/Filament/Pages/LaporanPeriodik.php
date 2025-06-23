<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class LaporanPeriodik extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-periodik';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 13;
}
