<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTallaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_talla', function (Blueprint $table) {
            $table->bigIncrements('idProTalla');

            $table->unsignedBigInteger('idTalla');
            $table->foreign('idTalla')->references('idTalla')->on('tallas')->onDelete('cascade');
            $table->unsignedBigInteger('idProduc');
            $table->foreign('idProduc')->references('idProducto')->on('producto')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_talla');
    }
}
