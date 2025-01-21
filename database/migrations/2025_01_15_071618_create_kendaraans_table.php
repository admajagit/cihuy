<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_mobil');
            $table->string('nomor_plat');
            $table->string('tahun_pembuatan');
            $table->enum('status_ketersediaan', ['tersedia', 'tidak tersedia'])->default('tersedia');
            $table->decimal('harga_sewa', 15, 2); 
            $table->integer('durasi');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
