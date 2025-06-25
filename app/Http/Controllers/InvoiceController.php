<?php

namespace App\Http\Controllers;

use App\Models\Penyaluran;
use App\Models\ZIS;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Menampilkan halaman cetak untuk satu transaksi ZIS.
     */
    public function printZisInvoice(ZIS $record)
    {
        $record->load(['donatur', 'kategoriZis', 'amil', 'rekening']);
        return view('invoices.zis', compact('record'));
    }

    /**
     * Menangani logika untuk Laporan Bulanan (sudah diperbaiki).
     */
    public function laporanBulanan(Request $request, $tipe)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = "2025";
        $date = Carbon::createFromDate($tahun, $bulan, 1);

        // DIUBAH: Menambahkan with() untuk eager load relasi kategori
        $pemasukan_zis = ZIS::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->with(['donatur', 'kategoriZis'])
            ->get();

        // DIUBAH: Menambahkan with() untuk eager load relasi kategori
        $penyaluran = Penyaluran::whereYear('tanggal_penyaluran', $tahun)
            ->whereMonth('tanggal_penyaluran', $bulan)
            ->with(['penerima', 'kategoriZis', 'amil'])
            ->get();
        
        $total_pemasukan = $pemasukan_zis->sum('uang');
        $total_pengeluaran = $penyaluran->sum('uang');

        $data = [
            'pemasukan_zis' => $pemasukan_zis,
            'penyaluran' => $penyaluran,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'bulan_nama' => $date->translatedFormat('F'),
            'tahun' => $tahun
        ];

        if ($tipe == 'internal') {
            $pemasukan_sebelum = ZIS::where('created_at', '<', $date->startOfMonth())->sum('uang');
            $pengeluaran_sebelum = Penyaluran::where('tanggal_penyaluran', '<', $date->startOfMonth())->sum('uang');
            $data['saldo_awal'] = $pemasukan_sebelum - $pengeluaran_sebelum;
            $data['saldo_akhir'] = $data['saldo_awal'] + $total_pemasukan - $total_pengeluaran;
            return view('laporan.bulanan-internal', $data);
        }

        return view('laporan.bulanan-donatur', $data);
    }

    /**
     * Menangani logika untuk Laporan Tahunan (sudah diperbaiki).
     */
    public function laporanTahunan(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        
        // --- TAMBAHKAN BARIS INI UNTUK MEMBUAT DAFTAR NAMA BULAN ---
        $nama_bulan = collect(range(1, 12))->map(fn ($m) => \Carbon\Carbon::create()->month($m)->translatedFormat('F'))->all();

        // --- Logika lain yang sudah ada sebelumnya ---
        $pemasukan_sebelum = \App\Models\ZIS::whereYear('created_at', '<', $tahun)->sum('uang');
        $pengeluaran_sebelum = \App\Models\Penyaluran::whereYear('tanggal_penyaluran', '<', $tahun)->sum('uang');
        $saldo_awal_tahun = $pemasukan_sebelum - $pengeluaran_sebelum;

        $total_pemasukan_setahun = \App\Models\ZIS::whereYear('created_at', $tahun)->sum('uang');
        $total_pengeluaran_setahun = \App\Models\Penyaluran::whereYear('tanggal_penyaluran', $tahun)->sum('uang');
        $saldo_akhir_tahun = $saldo_awal_tahun + $total_pemasukan_setahun - $total_pengeluaran_setahun;
        
        $data_bulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pemasukan = \App\Models\ZIS::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->sum('uang');
            $pengeluaran = \App\Models\Penyaluran::whereYear('tanggal_penyaluran', $tahun)->whereMonth('tanggal_penyaluran', $i)->sum('uang');
            $data_bulanan[] = [
                'bulan' => $nama_bulan[$i-1], // Menggunakan nama bulan dari variabel baru
                'pemasukan' => $pemasukan,
                'pengeluaran' => $pengeluaran,
            ];
        }

        $pemasukan_per_kategori = \App\Models\ZIS::query()
            ->join('kategori_zis', 'z_i_s.kategori_zis_id', '=', 'kategori_zis.id')
            ->whereYear('z_i_s.created_at', $tahun)
            ->groupBy('kategori_zis.kategori')
            ->select('kategori_zis.kategori as nama_kategori', DB::raw('sum(z_i_s.uang) as total'))
            ->get();

        $penyaluran_per_kategori = \App\Models\Penyaluran::query()
            ->join('kategori_zis', 'penyalurans.kategori_zis_id', '=', 'kategori_zis.id')
            ->whereYear('penyalurans.tanggal_penyaluran', $tahun)
            ->groupBy('kategori_zis.kategori')
            ->select('kategori_zis.kategori as nama_kategori', DB::raw('sum(penyalurans.uang) as total'))
            ->get();
        
        // --- UBAH BAGIAN COMPACT() UNTUK MENYERTAKAN VARIABEL BARU ---
        return view('laporan.tahunan-internal', compact(
            'tahun', 'nama_bulan', // <-- $nama_bulan sekarang dikirim ke view
            'data_bulanan', 'saldo_awal_tahun', 'saldo_akhir_tahun', 
            'total_pemasukan_setahun', 'total_pengeluaran_setahun',
            'pemasukan_per_kategori',
            'penyaluran_per_kategori'
        ));
    }
}