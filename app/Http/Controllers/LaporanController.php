<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query();

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('created_at', '>=', $request->tanggal_awal);
        }

        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }

        if ($request->filled('jenis')) {
            $query->where('jenis_transaksi', $request->jenis);
        }

        $laporan = $query->latest()->get();

        $online = Laporan::where('jenis_transaksi', 'Online')->count();

        $kasir = Laporan::where('jenis_transaksi', 'Kasir')->count();

        $hariIni = Laporan::whereDate('created_at', Carbon::today())->count();

        $pendapatan = Laporan::sum('total_bayar');

        return view('laporan.index', compact(
            'laporan',
            'online',
            'kasir',
            'hariIni',
            'pendapatan'
        ));
    }

    public function dashboard()
    {
        return view('laporan.dashboard');
    }

    public function statistik()
    {
        $totalTransaksi = Transaksi::count();
        $totalOnline = Transaksi::where('jenis_transaksi', 'Online')->count();
        $totalKasir = Transaksi::where('jenis_transaksi', 'Kasir')->count();
        $pendapatanHariIni = Transaksi::whereDate('created_at', Carbon::today())
            ->sum('total_bayar');
        $pendapatanBulanIni = Transaksi::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_bayar');
        $produkTerjual = Pesanan::sum('jumlah');
        $stokMenipis = Produk::where('stok', '<=', 5)->count();
        $produkTerlaris = Pesanan::selectRaw('nama_barang, SUM(jumlah) as total')
            ->groupBy('nama_barang')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('laporan.statistik', compact(
            'totalTransaksi',
            'totalOnline',
            'totalKasir',
            'pendapatanHariIni',
            'pendapatanBulanIni',
            'produkTerjual',
            'stokMenipis',
            'produkTerlaris'
        ));
    }

    public function transaksi(Request $request)
    {
        $query = Transaksi::query();
        // Filter tanggal
        if($request->tanggal_awal){
            $query->whereDate(
                'created_at',
                '>=',
                $request->tanggal_awal
            );
        }
        if($request->tanggal_akhir){
            $query->whereDate(
                'created_at',
                '<=',
                $request->tanggal_akhir
            );
        }
        // Filter jenis transaksi
        if($request->jenis){
            $query->where(
                'jenis_transaksi',
                $request->jenis
            );
        }
        // Filter metode pembayaran
        if($request->metode){
            $query->where(
                'metode_pembayaran',
                $request->metode
            );
        }
        // Pencarian kode transaksi
        if($request->keyword){
            $query->where(
                'kode_transaksi',
                'like',
                "%".$request->keyword."%"
            );
        }
        $transaksi = $query
                        ->latest()
                        ->paginate(10);
        return view(
            'laporan.transaksi',
            compact('transaksi')
        );
    }

    public function show($id)
    {
        $transaksi = Transaksi::with([
            'pesanan.details.produk',
            'pesanan.pelanggan'
        ])->findOrFail($id);

        return view(
            'laporan.show',
            compact('transaksi')
        );
        return view('laporan.show', compact('transaksi'));
    }

    public function pesanan(Request $request)
    {
        $query = Pesanan::with([
            'pelanggan',
            'details.produk'
        ]);
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->tanggal_awal) {
            $query->whereDate('created_at', '>=', $request->tanggal_awal);
        }
        if ($request->tanggal_akhir) {
            $query->whereDate('created_at', '<=', $request->tanggal_akhir);
        }
        if ($request->keyword) {
            $query->where('nama_penerima', 'like', '%' . $request->keyword . '%');
        }
        $pesanan = $query->latest()->paginate(10);
        $totalPesanan = Pesanan::count();
        $menunggu = Pesanan::where('status', 'Menunggu Pembayaran')->count();
        $diproses = Pesanan::where('status', 'Diproses')->count();
        $dikirim = Pesanan::where('status', 'Dikirim')->count();
        $selesai = Pesanan::where('status', 'Selesai')->count();
        return view('laporan.pesanan', compact(
            'pesanan',
            'totalPesanan',
            'menunggu',
            'diproses',
            'dikirim',
            'selesai'
        ));
    }

    public function pendapatan()
    {
        $transaksi = Transaksi::where('status','Lunas')
                        ->latest()
                        ->paginate(10);

        return view(
            'laporan.pendapatan',
            compact('transaksi')
        );
    }

    public function grafik()
    {
        // Pendapatan per bulan
        $penjualanBulanan = Transaksi::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('SUM(total_bayar) as total')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Jumlah transaksi Online
        $online = Transaksi::where('jenis_transaksi','Online')->count();

        // Jumlah transaksi Kasir
        $kasir = Transaksi::where('jenis_transaksi','Kasir')->count();

        // Top 5 produk terlaris
        $produkTerlaris = DB::table('pesanan_details')
            ->join('produks','produks.id','=','pesanan_details.produk_id')
            ->select(
                'produks.nama_baju',
                DB::raw('SUM(pesanan_details.jumlah) as total')
            )
            ->groupBy('produks.nama_baju')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('laporan.grafik', compact(
            'penjualanBulanan',
            'online',
            'kasir',
            'produkTerlaris'
        ));
    }

    // public function cetak($id)
    // {
    //     $laporan = Laporan::with([
    //         'pesanan',
    //         'pesanan.details.produk'
    //     ])->findOrFail($id);

    //     return view('laporan.cetak', compact('laporan'));
    // }

    public function cetak()
    {
        return view('laporan.cetak');
    }

    public function preview(Request $request)
    {
        $jenis = $request->jenis;
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;
        if($jenis=="transaksi"){
            $data = Pesanan::whereDate('created_at', '>=', $tanggalAwal)
                ->whereDate('created_at', '<=', $tanggalAkhir)
                ->get();
        }elseif($jenis=="pesanan"){
            $data = Pesanan::whereBetween('created_at',[
                $tanggalAwal,
                $tanggalAkhir
            ])->get();
        }elseif($jenis=="pendapatan"){
            $data = Transaksi::whereBetween('created_at',[
                $tanggalAwal,
                $tanggalAkhir
            ])
            ->where('status','Lunas')
            ->get();
        }else{
            $data = collect();
        }
        return view('laporan.preview',compact(
            'data',
            'jenis',
            'tanggalAwal',
            'tanggalAkhir'
        ));
    }

    public function pdf(Request $request)
    {
        $jenis = $request->jenis;
        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        if ($jenis == "transaksi") {

            $data = Transaksi::whereBetween('created_at', [
                $tanggalAwal,
                $tanggalAkhir
            ])->get();

        } elseif ($jenis == "pesanan") {

            $data = Pesanan::whereBetween('created_at', [
                $tanggalAwal,
                $tanggalAkhir
            ])->get();

        } elseif ($jenis == "pendapatan") {

            $data = Transaksi::whereBetween('created_at', [
                $tanggalAwal,
                $tanggalAkhir
            ])
            ->where('status', 'Lunas')
            ->get();

        } else {

            $data = collect();

        }

        $totalData = $data->count();

        $grandTotal = $data->sum(function ($item) {

            return $item->total_bayar ?? $item->total_harga;

        });

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'data',
            'jenis',
            'tanggalAwal',
            'tanggalAkhir',
            'totalData',
            'grandTotal'
        ));

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Laporan_'.$jenis.'.pdf');
    }

}