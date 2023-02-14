<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_facturas', function (Blueprint $table) {
            $table->id('id_productos_factura');
            $table->integer('total_producto');
            $table->integer('cantidad');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id_cliente')->on('clientes');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id_producto')->on('productos');
            $table->unsignedBigInteger('factura_id');
            $table->foreign('factura_id')->references('id_factura')->on('facturas');
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
        Schema::dropIfExists('productos_facturas');
    }
}
