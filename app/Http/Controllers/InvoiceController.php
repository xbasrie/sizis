<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ZIS;
use App\Models\Penyaluran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function printZisInvoice(ZIS $record)
    {
        // Berkat Route Model Binding, Laravel otomatis mencari data ZIS berdasarkan ID dari URL.
        // Kita hanya perlu mengirimkan data $record ke sebuah view.
        return view('invoices.zis', compact('record'));
    }

    public function laporanBulanan(Request $request, $tipe)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        $date = Carbon::createFromDate($tahun, $bulan, 1);

        // Data Transaksi
        $pemasukan_zis = ZIS::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();
        $penyaluran = Penyaluran::whereYear('tanggal_penyaluran', $tahun)->whereMonth('tanggal_penyaluran', $bulan)->get();
        $total_pemasukan = $pemasukan_zis->sum('uang');
        $total_pengeluaran = $penyaluran->sum('uang');

        $data = [
            'pemasukan_zis' => $pemasukan_zis,
            'penyaluran' => $penyaluran,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'bulan_nama' => $date->format('F'),
            'tahun' => $tahun
        ];

        // Logika untuk Laporan Internal (dengan Saldo)
        if ($tipe == 'internal') {
            $saldo_awal = ZIS::where('created_at', '<', $date->startOfMonth())->sum('uang') - Penyaluran::where('tanggal_penyaluran', '<', $date->startOfMonth())->sum('uang');
            $data['saldo_awal'] = $saldo_awal;
            $data['saldo_akhir'] = $saldo_awal + $total_pemasukan - $total_pengeluaran;
            return view('laporan.bulanan-internal', $data);
        }

        // Logika untuk Laporan Donatur (tanpa Saldo)
        return view('laporan.bulanan-donatur', $data);
    }

    public function laporanTahunan(Request $request)
{
    $tahun = $request->input('tahun', date('Y'));
    $nama_bulan = collect(range(1, 12))->map(fn ($m) => Carbon::create()->month($m)->translatedFormat('F'))->all();

    // --- LOGIKA BARU UNTUK MEMBUAT PIVOT TABLE ---

    // 1. Ambil semua data transaksi untuk tahun ini
    $pemasukan_raw = ZIS::query()
        ->whereYear('created_at', $tahun)
        ->select('kategori_zis', DB::raw('MONTH(created_at) as bulan'), DB::raw('SUM(uang) as total'))
        ->groupBy('kategori_zis', 'bulan')
        ->get();

    $penyaluran_raw = Penyaluran::query()
        ->join('kategori_zis', 'penyalurans.kategori_zis_id', '=', 'kategori_zis.id')
        ->whereYear('penyalurans.tanggal_penyaluran', $tahun)
        ->select('kategori_zis.kategori as kategori_penyaluran', DB::raw('MONTH(tanggal_penyaluran) as bulan'), DB::raw('SUM(penyalurans.uang) as total'))
        ->groupBy('kategori_penyaluran', 'bulan')
        ->get();

    // 2. Proses data mentah menjadi struktur PIVOT
    $pemasukan_pivot = [];
    $penyaluran_pivot = [];
    $total_pemasukan_per_bulan = array_fill(1, 12, 0);
    $total_penyaluran_per_bulan = array_fill(1, 12, 0);

    // Proses Pemasukan
    foreach ($pemasukan_raw as $item) {
        if (!isset($pemasukan_pivot[$item->kategori_zis])) {
            $pemasukan_pivot[$item->kategori_zis] = array_fill(1, 12, 0);
        }
        $pemasukan_pivot[$item->kategori_zis][$item->bulan] = $item->total;
        $total_pemasukan_per_bulan[$item->bulan] += $item->total;
    }

    // Proses Penyaluran
    foreach ($penyaluran_raw as $item) {
        if (!isset($penyaluran_pivot[$item->kategori_penyaluran])) {
            $penyaluran_pivot[$item->kategori_penyaluran] = array_fill(1, 12, 0);
        }
        $penyaluran_pivot[$item->kategori_penyaluran][$item->bulan] = $item->total;
        $total_penyaluran_per_bulan[$item->bulan] += $item->total;
    }
    
    // 3. Hitung total keseluruhan untuk ringkasan
    $total_pemasukan_setahun = array_sum($total_pemasukan_per_bulan);
    $total_pengeluaran_setahun = array_sum($total_penyaluran_per_bulan);
    
    $pemasukan_sebelum = ZIS::whereYear('created_at', '<', $tahun)->sum('uang');
    $pengeluaran_sebelum = Penyaluran::whereYear('tanggal_penyaluran', '<', $tahun)->sum('uang');
    $saldo_awal_tahun = $pemasukan_sebelum - $pengeluaran_sebelum;
    $saldo_akhir_tahun = $saldo_awal_tahun + $total_pemasukan_setahun - $total_pengeluaran_setahun;
    
    return view('laporan.tahunan-internal', compact(
        'tahun', 'nama_bulan',
        'pemasukan_pivot', 'penyaluran_pivot',
        'total_pemasukan_per_bulan', 'total_penyaluran_per_bulan',
        'total_pemasukan_setahun', 'total_pengeluaran_setahun',
        'saldo_awal_tahun', 'saldo_akhir_tahun'
    ));
}
}
