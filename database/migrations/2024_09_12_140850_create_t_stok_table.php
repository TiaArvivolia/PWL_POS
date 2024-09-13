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
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id('stok_id');
            $table->unsignedBigInteger('supplier_id')->index(); // indexing untuk ForeignKey
            $table->unsignedBigInteger('barang_id')->index(); // indexing untuk ForeignKey
            $table->unsignedBigInteger('user_id')->index(); // indexing untuk ForeignKey
            $table->datetime('stok_tanggal');
            $table->integer('stok_jumlah');
            $table->timestamps();

            // Mendefinisikan Foreign Key pada kolom supplier_id, barang_id, dan user_id
            $table->foreign('supplier_id')->references('supplier_id')->on('m_supplier')->onDelete('cascade');
            $table->foreign('barang_id')->references('barang_id')->on('m_barang')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('m_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_stok');
    }
};