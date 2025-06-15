<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice ZIS - {{ $record->id }}</title>
    <style>
        /* CSS sederhana untuk tampilan cetak */
        body { font-family: sans-serif; margin: 40px; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 50px; text-align: center; font-size: 0.8em; }
    </style>
</head>
<body>

    <div class="header">
        <h1>BUKTI PENERIMAAN ZIS</h1>
        <h2>LAZISMU UNIT LAYANAN WAGE</h2>
        <hr>
    </div>

    <div class="content">
        <p>Telah diterima dana ZIS dari:</p>
        <table>
            <tr>
                <th style="width: 30%;">Nama Donatur</th>
                <td>{{ $record->donatur->nama ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $record->donatur->alamat ?? 'N/A' }}</td>
            </tr>
             <tr>
                <th>Tanggal Transaksi</th>
                <td>{{ $record->created_at->format('d F Y H:i') }}</td>
            </tr>
        </table>

        <h3 style="margin-top: 30px;">Dengan Rincian Sebagai Berikut:</h3>
        <table>
            <tr>
                <th style="width: 30%;">Kategori</th>
                <td>{{ $record->kategori_zis }}</td>
            </tr>
             <tr>
                <th>Jenis</th>
                <td>{{ $record->jenis_zis }}</td>
            </tr>
            @if($record->uang)
            <tr>
                <th>Jumlah Uang</th>
                <td>Rp {{ number_format($record->uang, 0, ',', '.') }}</td>
            </tr>
            @endif
            @if($record->beras)
            <tr>
                <th>Jumlah Beras</th>
                <td>{{ $record->beras }} Kg</td>
            </tr>
             @endif
             @if($record->jiwa)
            <tr>
                <th>Jumlah Jiwa</th>
                <td>{{ $record->jiwa }} Jiwa</td>
            </tr>
            @endif
             <tr>
                <th>Keterangan</th>
                <td>{{ $record->keterangan }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Terima kasih atas kepercayaan Anda. Semoga Allah SWT menerima amal ibadah kita. Aamiin.</p>
    </div>

    <script>
        // Otomatis membuka dialog print saat halaman dimuat
        window.print();
    </script>

</body>
</html>