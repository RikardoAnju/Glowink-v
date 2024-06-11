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
            $table->string('id_order');
            $table->string('id_produk');
            $table->string('nama_member')->default(''); // Memberikan nilai default kosong
            $table->double('total');
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
