{{-- Tampilan ini untuk Laporan Internal dengan Saldo --}}
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan ZIS - {{ $tahun }}</title>
    <style> body { font-family: sans-serif; } table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #ccc; padding: 8px; } .header, .summary { margin-bottom: 20px; } .summary-table td { border: none; } </style>
</head>
<body>
    <div class="header" style="text-align: center;">
        <h2>Laporan Keuangan ZIS</h2>
        <h3>Periode: {{ $tahun }}</h3>
        <hr>
    </div>

    <div class="summary">
        <h4>Ringkasan Keuangan</h4>
        <table class="summary-table">
            <tr><td width="30%">Saldo Awal Bulan</td><td>: Rp {{ number_format($saldo_awal, 0, ',', '.') }}</td></tr>
            <tr><td>Total Pemasukan</td><td>: Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</td></tr>
            <tr><td>Total Pengeluaran</td><td>: Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</td></tr>
            <tr><td><b>Saldo Akhir Bulan</b></td><td><b>: Rp {{ number_format($saldo_akhir, 0, ',', '.') }}</b></td></tr>
        </table>
    </div>

    <h4>Rincian Pemasukan ZIS</h4>
    <table>
        <thead><tr><th>Tanggal</th><th>Donatur</th><th>Kategori</th><th>Jumlah</th></tr></thead>
        <tbody>
            @forelse($pemasukan_zis as $item)
                <tr><td>{{ $item->created_at->format('d/m/Y') }}</td><td>{{ $item->donatur->nama }}</td><td>{{ $item->kategori_zis }}</td><td>Rp {{ number_format($item->uang, 0, ',', '.') }}</td></tr>
            @empty
                <tr><td colspan="4" style="text-align: center;">Tidak ada data pemasukan.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h4 style="margin-top: 30px;">Rincian Penyaluran</h4>
    <table>
        <thead><tr><th>Tanggal</th><th>Penerima</th><th>Kategori</th><th>Jumlah</th></tr></thead>
        <tbody>
             @forelse($penyaluran as $item)
                <tr><td>{{ $item->tanggal_penyaluran }}</td><td>{{ $item->penerima->nama }}</td><td>{{ $item->kategori_zis }}</td><td>Rp {{ number_format($item->uang, 0, ',', '.') }}</td></tr>
            @empty
                <tr><td colspan="4" style="text-align: center;">Tidak ada data penyaluran.</td></tr>
            @endforelse
        </tbody>
    </table>
    <script> window.print(); </script>
</body>
</html>