<?php

namespace App\Models;

use App\Models\Kendaraan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    // Semua kolom diizinkan untuk diisi
    protected $guarded = [];
    
    //izinkan column kendaraan_id mengakses semua data di kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public static function boot()
    {
        parent::boot();

        // Event yang terjadi saat membuat transaksi
        static::creating(function ($transaksi) {
            // Ambil kendaraan terkait berdasarkan kendaraan_id
            $kendaraan = Kendaraan::find($transaksi->kendaraan_id);
            
            // Jika kendaraan ditemukan, set nilai no_rekening dengan harga_sewa
            if ($kendaraan) {
                $transaksi->total_pembayaran= $kendaraan->harga_sewa;
            }
        });
    }
}
