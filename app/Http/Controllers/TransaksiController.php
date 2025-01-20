<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Transaksi;


class TransaksiController extends Controller
{
    public function create($kendaraan_id)
    {
        $kendaraan = Kendaraan::findOrFail($kendaraan_id); // Ambil data kendaraan berdasarkan ID
        return view('transaksi', compact('kendaraan'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'lokasi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'durasi' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
        ]);

        // Hitung tanggal berakhir otomatis
        $tanggal_berakhir = date('Y-m-d', strtotime($request->tanggal_mulai . " + {$request->durasi} days"));

        Transaksi::create([
            'kendaraan_id' => $request->kendaraan_id,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'durasi' => $request->durasi,
            'tanggal_berakhir' => $tanggal_berakhir,
            'total_harga' => $request->total_harga,
            'status_pembayaran' => 'pending',
        ]);

        return redirect()->route('kendaraanku.index')->with('success', 'Transaksi berhasil dibuat.');
    }
}
