<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan Tahunan - {{ $tahun }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            color: #1f2937;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.5;
        }

        .container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
            background: white;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #ff7300;
        }

        .logo img {
            height: 72px;
            width: auto;
        }

        .company-info {
            text-align: right;
        }

        .company-name {
            font-weight: 700;
            font-size: 16px;
            color: #ff7300;
            text-transform: uppercase;
        }

        .company-address {
            font-size: 10px;
            color: #6b7280;
        }

        .report-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .report-title h1 {
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0;
            color: #111827;
        }

        .report-title p {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 12px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #374151;
            margin-top: 25px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: #f9fafb;
            color: #374151;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 10px;
            padding: 10px;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        td {
            padding: 10px;
            border: 1px solid #e5e7eb;
            color: #111827;
            vertical-align: top;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: 700; }
        .text-gray { color: #6b7280; }

        .summary-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
            width: 60%;
            margin-left: auto;
        }

        .summary-table {
            width: 100%;
            border: none;
            margin-bottom: 0;
        }

        .summary-table td {
            border: none;
            padding: 5px 0;
            font-size: 12px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
            page-break-inside: avoid;
        }

        .signature-box {
            width: 200px;
            text-align: center;
        }

        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #374151;
            padding-top: 5px;
            font-weight: 600;
        }
        
        @media print {
            body { padding: 0; margin: 0; }
            .container { max-width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('assets/images/logo-lazismu-WAGE-.png') }}" alt="Lazismu Logo">
            </div>
            <div class="company-info">
                <div class="company-name">Lazismu Unit Layanan Wage</div>
                <div class="company-address">
                    Gedung Pusat Dakwah Muhammadiyah<br>
                    Jl. Menteng Raya No.62, Jakarta Pusat<br>
                    Telp: 021-3150400 | Email: info@lazismu.org
                </div>
            </div>
        </div>

        <div class="report-title">
            <h1>Laporan Keuangan Tahunan</h1>
            <p>Periode Tahun {{ $tahun }}</p>
        </div>

        <div class="summary-box" style="width: 100%;">
            <div class="section-title" style="margin-top: 0;">Ringkasan Keuangan</div>
            <table class="summary-table">
                <tr><td width="20%">Saldo Awal Tahun</td><td width="5%">:</td><td class="text-right">Rp {{ number_format($saldo_awal_tahun, 0, ',', '.') }}</td></tr>
                <tr><td>Total Pemasukan</td><td>:</td><td class="text-right">Rp {{ number_format($total_pemasukan_setahun, 0, ',', '.') }}</td></tr>
                <tr><td>Total Pengeluaran</td><td>:</td><td class="text-right">Rp {{ number_format($total_pengeluaran_setahun, 0, ',', '.') }}</td></tr>
                <tr style="border-top: 1px solid #ddd;">
                    <td class="font-bold" style="padding-top: 5px;">Saldo Akhir Tahun</td>
                    <td style="padding-top: 5px;">:</td>
                    <td class="text-right font-bold" style="padding-top: 5px;">Rp {{ number_format($saldo_akhir_tahun, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="section-title">I. Rincian Pemasukan per Kategori</div>
        <table>
            <thead>
                <tr>
                    <th>Kategori ZIS</th>
                    <th width="35%" class="text-right">Jumlah Terkumpul</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pemasukan_per_kategori as $item)
                    <tr>
                        <td>{{ $item->nama_kategori ?? 'Lainnya' }}</td>
                        <td class="text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="text-center">Tidak ada data.</td></tr>
                @endforelse
                <tr style="background-color: #ffffcc;">
                    <td class="text-right font-bold">TOTAL PEMASUKAN</td>
                    <td class="text-right font-bold">Rp {{ number_format($total_pemasukan_setahun, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">II. Rincian Penyaluran per Kategori</div>
        <table>
            <thead>
                <tr>
                    <th>Kategori Penyaluran</th>
                    <th width="35%" class="text-right">Jumlah Tersalurkan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penyaluran_per_kategori as $item)
                    <tr>
                        <td>{{ $item->nama_kategori ?? 'Lainnya' }}</td>
                        <td class="text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="text-center">Tidak ada data.</td></tr>
                @endforelse
                <tr style="background-color: #ffffcc;">
                    <td class="text-right font-bold">TOTAL PENGELUARAN</td>
                    <td class="text-right font-bold">Rp {{ number_format($total_pengeluaran_setahun, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">III. Rekapitulasi Pembukuan Bulanan</div>
        <table>
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th>Bulan</th>
                    <th width="30%" class="text-right">Pemasukan</th>
                    <th width="30%" class="text-right">Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_bulanan as $data)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $data['bulan'] }}</td>
                        <td class="text-right">Rp {{ number_format($data['pemasukan'], 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="signature-section">
            <div class="signature-box">
                <p>Mengetahui,<br>Ketua Lazismu</p>
                <div class="signature-line">(______________________)</div>
            </div>
            <div class="signature-box">
                <p>Surabaya, {{ date('d F Y') }}<br>Dibuat oleh,</p>
                <div class="signature-line">{{ auth()->user()->name }}</div>
            </div>
        </div>
    </div>
    <script> window.print(); </script>
</body>
</html>