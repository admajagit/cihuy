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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id');
            $table->string('lokasi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->enum('payment', ['BRI', 'BCA','BANK','BANK JAGO']);
            $table->string('no_rekening')->nullable();
            $table->enum('status_pembayaran', ['pending', 'paid'])->default('pending');
            $table->decimal('total_pembayaran',15, 2);
            $table->timestamps();

            // menghubungkan column kendaraan_id  foreign key ke column id di table kendaraan
            $table->foreign('kendaraan_id')
                ->references('id')
                ->on('kendaraans')
                ->onDelete('cascade'); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
