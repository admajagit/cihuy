<?php

namespace App\Http\Controllers;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        // Ambil semua data kendaraan
        $kendaraans = Kendaraan::all();

        // Kirim data kendaraan ke view
        return view('home', compact('kendaraans'));
    }
}
