<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_member');
            $table->unsignedBigInteger('id_barang');
            $table->integer('jumlah');
            $table->decimal('total', 8, 2);
            $table->boolean('is_checkout');
            $table->timestamps();

            $table->foreign('id_member')->references('id')->on('members');
            $table->foreign('id_barang')->references('id')->on('products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
