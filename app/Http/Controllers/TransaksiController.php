<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    // Menampilkan form transaksi berdasarkan kendaraan
    public function create($kendaraan_id)
{
    // Ambil data kendaraan spesifik berdasarkan ID
    $kendaraan = Kendaraan::findOrFail($kendaraan_id);
    $kendaraans = Kendaraan::all(); // Tetap mengambil semua untuk dropdown jika diperlukan
    
    return view('transaksi', compact('kendaraans', 'kendaraan', 'kendaraan_id'));
}

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'lokasi' => 'required|max:255',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'payment' => 'required|in:BRI,BCA,BANK,BANK JAGO',
            'no_rekening' => 'nullable|max:255',
            'status_pembayaran' => 'required|in:pending,paid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Hitung total pembayaran berdasarkan kendaraan dan durasi sewa
        $kendaraan = Kendaraan::find($request->kendaraan_id);
        $durasi = (new \DateTime($request->tanggal_mulai))->diff(new \DateTime($request->tanggal_berakhir))->days;
        $total_pembayaran = $kendaraan->harga_sewa * $durasi;

        // Simpan data transaksi
        Transaksi::create([
            'kendaraan_id' => $request->kendaraan_id,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'payment' => $request->payment,
            'no_rekening' => $request->no_rekening,
            'status_pembayaran' => $request->status_pembayaran,
            'total_pembayaran' => $total_pembayaran,
        ]);

        return redirect()->route('kendaraanku.index')->with('success', 'Transaksi berhasil dibuat!');
    }

}
