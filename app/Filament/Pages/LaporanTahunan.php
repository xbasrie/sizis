<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class LaporanTahunan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-tahunan';

    protected static ?string $navigationGroup = 'Laporan';
}
