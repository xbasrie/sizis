<x-filament::page>
    @php
        // Ambil filter dari URL, jika tidak ada gunakan bulan & tahun sekarang
        $bulan = request('bulan', date('m'));
        $tahun = request('tahun', date('Y'));

        // Query data untuk ditampilkan di halaman ini
        $pemasukan_zis = \App\Models\ZIS::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();
        $penyaluran = \App\Models\Penyaluran::whereYear('tanggal_penyaluran', $tahun)->whereMonth('tanggal_penyaluran', $bulan)->get();
    @endphp

    {{-- FORM UNTUK FILTER --}}
    <form method="GET" class="mb-4 p-4 border rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Filter Bulan --}}
            <div>
                <label for="bulan" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Bulan</label>
                <select name="bulan" id="bulan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                    @endfor
                </select>
            </div>
            {{-- Filter Tahun --}}
            <div>
                <label for="tahun" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tahun</label>
                <select name="tahun" id="tahun" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600">
                     @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            {{-- Tombol Filter --}}
            <div class="self-end">
                <button type="submit" class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700">Tampilkan</button>
            </div>
        </div>
    </form>
    
    {{-- TOMBOL-TOMBOL CETAK --}}
    <div class="flex gap-2 mb-4">
        <a href="{{ route('laporan.bulanan', ['tipe' => 'internal', 'bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank" class="filament-button ... bg-primary-600 ...">
            Cetak Laporan Bulanan (Internal)
        </a>
         <a href="{{ route('laporan.bulanan', ['tipe' => 'donatur', 'bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank" class="filament-button ... bg-gray-600 ...">
            Cetak Laporan untuk Donatur
        </a>
    </div>

    {{-- TABEL DATA --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold mb-2"></h3>
            {{-- Tabel untuk Penerimaan --}}
        </div>
        <div>
             <h3 class="text-lg font-semibold mb-2"></h3>
             {{-- Tabel untuk Penyaluran --}}
        </div>
    </div>
</x-filament::page>