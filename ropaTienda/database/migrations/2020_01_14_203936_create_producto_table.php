<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->bigIncrements('idProducto');  
            
            $table->unsignedBigInteger('idImg');
            $table->foreign('idImg')->references('idImagen')->on('imagenes')->onDelete('cascade');
            $table->unsignedBigInteger('idSubcat');
            $table->foreign('idSubcat')->references('idSubCategorias')->on('sub_categorias')->onDelete('cascade');
            $table->unsignedBigInteger('idColor');
            $table->foreign('idColor')->references('idColor')->on('colores')->onDelete('cascade');
            $table->unsignedBigInteger('idTalla');
            $table->foreign('idTalla')->references('idTalla')->on('tallas')->onDelete('cascade');
           
           
            $table->string('Nombre', 250);
            $table->string('Descripcion', 256)->nullable;
            $table->double('Precio');
            $table->integer('Existencia');
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
        Schema::dropIfExists('producto');
    }
}
