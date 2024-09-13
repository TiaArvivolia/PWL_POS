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
        Schema::create('t_penjualan', function (Blueprint $table) {
            $table->id('penjualan_id');
            $table->unsignedBigInteger('user_id')->index(); // indexing untuk ForeignKey
            $table->string('pembeli', 50);
            $table->string('penjualan_kode', 20)->unique(); // unique untuk memastikan tidak ada penjualan kode yang sama
            $table->datetime('penjualan_tanggal');
            $table->timestamps();

            // Mendefinisikan Foreign Key pada kolom kategori_id mengacu pada kolom id di table m_kategori
            $table->foreign('user_id')->references('user_id')->on('m_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan');
    }
};