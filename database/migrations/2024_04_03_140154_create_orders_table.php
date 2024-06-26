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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_member');
            $table->integer('invoice');
            $table->integer('grand_total')->nullable();
            $table->string('nama_barang')->nullable(); // Menambah kolom untuk nama barang di tabel orders
            $table->timestamps();
        });

        Schema::create('orders_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_produk');
            $table->integer('jumlah');
            $table->integer('total');
            $table->string('nama_barang')->nullable(); // Menambah kolom untuk nama barang di tabel orders_details
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_details');
        Schema::dropIfExists('orders');
    }
};
