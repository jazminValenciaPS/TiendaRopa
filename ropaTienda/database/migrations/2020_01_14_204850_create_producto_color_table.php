<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_color', function (Blueprint $table) {
            $table->bigIncrements('idProColor');

            $table->unsignedBigInteger('idColor');
            $table->foreign('idColor')->references('idColor')->on('colores')->onDelete('cascade');
            $table->unsignedBigInteger('idProduc');
            $table->foreign('idProduc')->references('idProducto')->on('producto')->onDelete('cascade');

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
        Schema::dropIfExists('producto_color');
    }
}
