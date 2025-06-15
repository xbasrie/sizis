<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ZIS;
use App\Models\Penyaluran;
use Illuminate\Http\Request;

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

    public function laporanTahunan(Request $request, $tipe)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        $date = Carbon::createFromDate($tahun, 1);

        // Data Transaksi
        $pemasukan_zis = ZIS::whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->get();
        $penyaluran = Penyaluran::whereYear('tanggal_penyaluran', $tahun)
            //->whereMonth('tanggal_penyaluran', $bulan)
            ->get();
        $total_pemasukan = $pemasukan_zis->sum('uang');
        $total_pengeluaran = $penyaluran->sum('uang');

        $data = [
            'pemasukan_zis' => $pemasukan_zis,
            'penyaluran' => $penyaluran,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            //'bulan_nama' => $date->format('F'),
            'tahun' => $tahun
        ];

        // Logika untuk Laporan Internal (dengan Saldo)
        if ($tipe == 'internal') {
            $saldo_awal = ZIS::where('created_at', '<', $date->startOfMonth())->sum('uang') - Penyaluran::where('tanggal_penyaluran', '<', $date->startOfMonth())->sum('uang');
            $data['saldo_awal'] = $saldo_awal;
            $data['saldo_akhir'] = $saldo_awal + $total_pemasukan - $total_pengeluaran;
            return view('laporan.tahunan-internal', $data);
        }

        // Logika untuk Laporan Donatur (tanpa Saldo)
        // return view('laporan.bulanan-donatur', $data);
    }
}
