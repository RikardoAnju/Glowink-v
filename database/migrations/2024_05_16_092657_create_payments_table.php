<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_order')->unique()->nullable()->default(null);
            $table->string('nama_member')->default('');
            $table->string('nama_barang')->default(''); // Tambahkan kolom nama_barang
            $table->decimal('total', 15, 2); // Menggunakan decimal untuk representasi uang
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('detail_alamat');
            $table->string('email');
            $table->string('status')->default('pending');
            $table->string('checkout_link')->default('');
            $table->string('payment_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
