<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_tamanho_pizza')->unsigned()->nullable(false);
            $table->integer('fk_sabor_pizza')->unsigned()->nullable(false);
            $table->string('codigo',6)->nullable(false);
            $table->enum('situacao',['Montagem','Adicionais','Finalizado']);
            $table->integer('status')->nullable(false)->default('1');
            $table->timestamps();
        });

        Schema::create('pedido_personalizacao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_pedido')->unsigned()->nullable(false);
            $table->integer('fk_personalizacao')->unsigned()->nullable(false);
            $table->integer('status')->nullable(false)->default('1');
            $table->timestamps();
        });

        Schema::table('pedido', function($table) {
            $table->foreign('fk_tamanho_pizza')->references('id')->on('pizza_tamanho')->onDelete('restrict');
            $table->foreign('fk_sabor_pizza')->references('id')->on('pizza_sabor')->onDelete('restrict');
        });
        Schema::table('pedido_personalizacao', function($table) {
            $table->foreign('fk_pedido')->references('id')->on('pedido')->onDelete('cascade');
            $table->foreign('fk_personalizacao')->references('id')->on('pizza_personalizacao')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
