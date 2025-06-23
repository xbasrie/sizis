<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan Tahunan - {{ $tahun }}</title>
    {{-- Style CSS bisa menggunakan yang sudah dipercantik sebelumnya --}}
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 10px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #999; padding: 5px; text-align: left; }
        th { background-color: #e9ecef; font-weight: bold; text-align: center; }
        tfoot td { font-weight: bold; background-color: #e9ecef; }
        .text-right { text-align: right; }
        .kop-surat h1 { font-size: 18px; }
        .kop-surat h2 { font-size: 16px; }
        /* Tambahkan style lain dari template "cantik" Anda jika perlu */
    </style>
</head>
<body>
    <div class="container">
        {{-- KOP SURAT (sama seperti sebelumnya) --}}
        <header class="report-header"> ... </header>

        <main>
            <div class="report-title">
                <h3>LAPORAN KEUANGAN TAHUNAN</h3>
                <p>Periode Tahun {{ $tahun }}</p>
            </div>

            {{-- ======================== --}}
            {{-- TABEL PIVOT PEMASUKAN --}}
            {{-- ======================== --}}
            <h4>Rekapitulasi Pemasukan ZIS</h4>
            <table>
                <thead>
                    <tr>
                        <th>Kategori</th>
                        @foreach($nama_bulan as $bulan)
                            <th>{{ substr($bulan, 0, 3) }}</th>
                        @endforeach
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemasukan_pivot as $kategori => $bulanan)
                        <tr>
                            <td>{{ $kategori }}</td>
                            @php $total_per_kategori = 0; @endphp
                            @foreach($bulanan as $jumlah)
                                <td class="text-right">{{ $jumlah > 0 ? number_format($jumlah, 0, ',', '.') : '-' }}</td>
                                @php $total_per_kategori += $jumlah; @endphp
                            @endforeach
                            <td class="text-right" style="font-weight: bold;">{{ number_format($total_per_kategori, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="14" style="text-align:center;">Tidak ada data pemasukan.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td><b>TOTAL PER BULAN</b></td>
                        @foreach($total_pemasukan_per_bulan as $total)
                            <td class="text-right"><b>{{ number_format($total, 0, ',', '.') }}</b></td>
                        @endforeach
                        <td class="text-right"><b>{{ number_format($total_pemasukan_setahun, 0, ',', '.') }}</b></td>
                    </tr>
                </tfoot>
            </table>

            {{-- ========================= --}}
            {{-- TABEL PIVOT PENYALURAN --}}
            {{-- ========================= --}}
            <h4>Rekapitulasi Penyaluran</h4>
             <table>
                <thead>
                    <tr>
                        <th>Kategori</th>
                        @foreach($nama_bulan as $bulan)
                            <th>{{ substr($bulan, 0, 3) }}</th>
                        @endforeach
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penyaluran_pivot as $kategori => $bulanan)
                        <tr>
                            <td>{{ $kategori }}</td>
                            @php $total_per_kategori = 0; @endphp
                            @foreach($bulanan as $jumlah)
                                <td class="text-right">{{ $jumlah > 0 ? number_format($jumlah, 0, ',', '.') : '-' }}</td>
                                @php $total_per_kategori += $jumlah; @endphp
                            @endforeach
                            <td class="text-right" style="font-weight: bold;">{{ number_format($total_per_kategori, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="14" style="text-align:center;">Tidak ada data penyaluran.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td><b>TOTAL PER BULAN</b></td>
                        @foreach($total_penyaluran_per_bulan as $total)
                            <td class="text-right"><b>{{ number_format($total, 0, ',', '.') }}</b></td>
                        @endforeach
                        <td class="text-right"><b>{{ number_format($total_pengeluaran_setahun, 0, ',', '.') }}</b></td>
                    </tr>
                </tfoot>
            </table>

            {{-- Ringkasan Saldo Akhir dan Blok Tanda Tangan (sama seperti sebelumnya) --}}
            <div class="summary-block"> ... </div>
            <div class="signature-block"> ... </div>
        </main>
    </div>
    <script> window.print(); </script>
</body>
</html>