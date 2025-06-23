<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan ZIS - {{ $bulan_nama }} {{ $tahun }}</title>
    
    {{-- BAGIAN 2: MENAMBAHKAN STYLING DENGAN CSS --}}
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .report-header {
            display: flex;
            align-items: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .logo {
            width: 120px;
            height: 90px;
            margin-right: 20px;
        }
        .kop-surat {
            text-align: center;
            flex-grow: 1;
        }
        .kop-surat h1, .kop-surat h2 {
            margin: 0;
        }
        .kop-surat p {
            margin: 5px 0 0;
        }
        .report-title {
            text-align: center;
            margin-bottom: 25px;
            text-decoration: underline;
            font-weight: bold;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #777;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .summary-table {
            width: 50%;
            border: none;
        }
        .summary-table td {
            border: none;
        }
        .text-right {
            text-align: right;
        }
        .signature-block {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .signature {
            text-align: center;
            width: 250px;
        }
        .signature .name {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }

        /* CSS KHUSUS UNTUK PRINT */
        @media print {
            body { -webkit-print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    @php
        // Mengubah logo menjadi Base64 agar pasti muncul saat di-print/pdf
        try {
            $logoPath = public_path('images/logo.png'); // Ganti dengan nama file logo Anda
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoSrc = 'data:image/' . pathinfo($logoPath, PATHINFO_EXTENSION) . ';base64,' . $logoData;
        } catch (\Exception $e) {
            $logoSrc = ''; // Biarkan kosong jika logo tidak ditemukan
        }
    @endphp

    <div class="container">
        {{-- BAGIAN 1: STRUKTUR HTML BARU --}}

        <header class="report-header">
            @if($logoSrc)
                <img src="{{ $logoSrc }}" alt="Logo" class="logo">
            @endif
            <div class="kop-surat">
                <h1>LEMBAGA ZAKAT INFAQ DAN SHODAQOH MUHAMMADIYAH</h1>
                <h2>UNIT LAYANAN WAGE</h2>
                <p>Jl Taruna VIII A Kav 266 B Wage, Taman, Sidoarjo | Telp: 0858-8888-1725</p>
            </div>
        </header>

        <main>
            <div class="report-title">LAPORAN KEUANGAN PERIODE {{ $bulan_nama }} {{ $tahun }}</div>


            <h4>Rincian Pemasukan ZIS</h4>
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Tanggal</th>
                        <th>Keterangan</th>
                        <th width="25%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemasukan_zis as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                            <td>Penerimaan dari: {{ $item->donatur->nama }} ({{ $item->kategori_zis }} - {{ $item->jenis_zis }})</td>
                            <td class="text-right">Rp {{ number_format($item->uang, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="text-align: center;">Tidak ada data pemasukan.</td></tr>
                    @endforelse
                    <tr>
                        <td colspan="3" style="text-align: right; font-weight: bold;">TOTAL PEMASUKAN</td>
                        <td class="text-right" style="font-weight: bold;">Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <h4>Rincian Penyaluran</h4>
            <table>
                 <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Tanggal</th>
                        <th>Keterangan</th>
                        <th width="25%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                     @forelse($penyaluran as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_penyaluran)->format('d F Y') }}</td>
                            <td>Penyaluran kepada: {{ $item->penerima->nama }} ({{ $item->kategori_penyaluran }} - {{ $item->jenis_penyaluran }})</td>
                            <td class="text-right">Rp {{ number_format($item->uang, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="text-align: center;">Tidak ada data penyaluran.</td></tr>
                    @endforelse
                    <tr>
                        <td colspan="3" style="text-align: right; font-weight: bold;">TOTAL PENGELUARAN</td>
                        <td class="text-right" style="font-weight: bold;">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
            
            <table class="summary-table">
                <tr><td><b>Saldo Awal Bulan</b></td><td>: Rp {{ number_format($saldo_awal, 0, ',', '.') }}</td></tr>
                <tr><td><b>Total Pemasukan</b></td><td>: Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</td></tr>
                <tr><td><b>Total Pengeluaran</b></td><td>: Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</td></tr>
                <tr><td><b>SALDO AKHIR BULAN</b></td><td><b>: Rp {{ number_format($saldo_akhir, 0, ',', '.') }}</b></td></tr>
            </table>


            <div class="signature-block">
                <div class="signature">
                    <p>Mengetahui,</p>
                    <p>Ketua Lazismu</p>
                    <div class="name">(______________________)</div>
                </div>
                <div class="signature">
                    <p>Surabaya, {{ date('d F Y') }}</p>
                    <p>Dibuat oleh,</p>
                    <div class="name">( {{ auth()->user()->name }} )</div>
                </div>
            </div>

        </main>
    </div>

    {{-- Script untuk otomatis membuka dialog print --}}
    <script>
        window.print();
    </script>
</body>
</html>