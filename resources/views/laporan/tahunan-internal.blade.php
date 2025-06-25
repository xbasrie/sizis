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
        .summary-block { border: 1px solid #ccc; padding: 15px; margin-bottom: 25px; background-color: #f8f9fa; border-radius: 5px; }
        .summary-table { width: 100%; border: none; margin: 0; }
        .summary-table td { border: none; padding: 4px 0; font-weight: bold; }
        /* Tambahkan style lain dari template "cantik" Anda jika perlu */
    </style>
</head>
<body>
    <div class="container">
        {{-- KOP SURAT (diasumsikan sudah benar) --}}
        {{-- <header class="report-header"> ... </header> --}}

        <main>
            <div class="report-title">
                <h3>LAPORAN KEUANGAN TAHUNAN</h3>
                <p>Periode Tahun {{ $tahun }}</p>
            </div>

            {{-- BLOK RINGKASAN SALDO --}}
            <div class="summary-block">
                <h4>Ringkasan Keuangan Tahun {{ $tahun }}</h4>
                <table class="summary-table">
                    <tr><td width="40%">Saldo Awal Tahun</td><td width="5%">:</td><td>Rp {{ number_format($saldo_awal_tahun, 0, ',', '.') }}</td></tr>
                    <tr><td>Total Pemasukan Setahun</td><td>:</td><td>Rp {{ number_format($total_pemasukan_setahun, 0, ',', '.') }}</td></tr>
                    <tr><td>Total Pengeluaran Setahun</td><td>:</td><td>Rp {{ number_format($total_pengeluaran_setahun, 0, ',', '.') }}</td></tr>
                    <tr><td><b>Saldo Akhir Tahun</b></td><td><b>:</b></td><td><b>Rp {{ number_format($saldo_akhir_tahun, 0, ',', '.') }}</b></td></tr>
                </table>
            </div>

            {{-- RINCIAN PEMASUKAN PER KATEGORI --}}
            <h4>Rincian Pemasukan Berdasarkan Kategori</h4>
            <table>
                <thead>
                    <tr>
                        <th>Kategori ZIS</th>
                        <th width="35%">Jumlah Terkumpul</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Diperbaiki: Menggunakan variabel $pemasukan_per_kategori --}}
                    @forelse($pemasukan_per_kategori as $item)
                        <tr>
                            {{-- Diperbaiki: Menggunakan nama kolom 'nama_kategori' dari query --}}
                            <td>{{ $item->nama_kategori ?? 'Lainnya' }}</td>
                            <td class="text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" style="text-align: center;">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td style="text-align: right;"><b>TOTAL PEMASUKAN</b></td>
                        <td class="text-right"><b>Rp {{ number_format($total_pemasukan_setahun, 0, ',', '.') }}</b></td>
                    </tr>
                </tfoot>
            </table>

            {{-- RINCIAN PENYALURAN PER KATEGORI --}}
            <h4>Rincian Penyaluran Berdasarkan Kategori</h4>
            <table>
                <thead>
                    <tr>
                        <th>Kategori Penyaluran</th>
                        <th width="35%">Jumlah Tersalurkan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Diperbaiki: Menggunakan variabel $penyaluran_per_kategori --}}
                    @forelse($penyaluran_per_kategori as $item)
                        <tr>
                            {{-- Diperbaiki: Menggunakan nama kolom 'nama_kategori' dari query --}}
                            <td>{{ $item->nama_kategori ?? 'Lainnya' }}</td>
                            <td class="text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" style="text-align: center;">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                     <tr>
                        <td style="text-align: right;"><b>TOTAL PENGELUARAN</b></td>
                        <td class="text-right"><b>Rp {{ number_format($total_pengeluaran_setahun, 0, ',', '.') }}</b></td>
                    </tr>
                </tfoot>
            </table>

            {{-- REKAPITULASI PER BULAN --}}
            <h4 style="margin-top: 30px;">Rekapitulasi per Bulan</h4>
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Bulan</th>
                        <th width="30%">Total Pemasukan</th>
                        <th width="30%">Total Pengeluaran</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Diperbaiki: Menggunakan variabel $data_bulanan --}}
                    @foreach($data_bulanan as $data)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $data['bulan'] }}</td>
                            <td class="text-right">Rp {{ number_format($data['pemasukan'], 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{-- BLOK TANDA TANGAN (sama seperti sebelumnya) --}}
            {{-- <div class="signature-block"> ... </div> --}}
        </main>
    </div>
    <script> window.print(); </script>
</body>
</html>