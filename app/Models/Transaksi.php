<?php

namespace App\Models;

use App\Models\Kendaraan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    //izinkan kendaraan_id menemapilkan list kendaraan  
    protected $fillable = ['kendaraan_id'];
    
    //izinkan column kendaraan_id mengakses semua data di kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
}
