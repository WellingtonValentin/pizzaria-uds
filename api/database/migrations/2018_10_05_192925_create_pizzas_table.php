<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePizzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizza_tamanho', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao',45)->nullable(false);
            $table->double('valor',10,2)->nullable(false)->default('0.00');
            $table->time('tempo_adicional')->nullable(false)->default('00:00:00');
            $table->integer('status')->nullable(false)->default('1');
            $table->timestamps();
        });
        Schema::create('pizza_sabor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao',45)->nullable(false);
            $table->time('tempo_adicional')->nullable(false)->default('00:00:00');
            $table->integer('status')->nullable(false)->default('1');
            $table->timestamps();
        });
        Schema::create('pizza_personalizacao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao',45)->nullable(false);
            $table->double('valor',10,2)->nullable(false)->default('0.00');
            $table->time('tempo_adicional')->nullable(false)->default('00:00:00');
            $table->integer('status')->nullable(false)->default('1');
            $table->timestamps();
        });

        DB::table('pizza_tamanho')->insert(
            array(
                array(
                    'descricao' => 'Pequena',
                    'valor' => 20.00,
                    'tempo_adicional' => '00:15:00'
                ),
                array(
                    'descricao' => 'Média',
                    'valor' => 30.00,
                    'tempo_adicional' => '00:20:00'
                ),
                array(
                    'descricao' => 'Grande',
                    'valor' => 40.00,
                    'tempo_adicional' => '00:25:00'
                )
            )
        );

        DB::table('pizza_sabor')->insert(
            array(
                array(
                    'descricao' => 'Calabresa',
                    'tempo_adicional' => '00:00:00'
                ),
                array(
                    'descricao' => 'Marguerita',
                    'tempo_adicional' => '00:00:00'
                ),
                array(
                    'descricao' => 'Portuguesa',
                    'tempo_adicional' => '00:05:00'
                )
            )
        );

        DB::table('pizza_personalizacao')->insert(
            array(
                array(
                    'descricao' => 'Extra Bacon',
                    'valor' => 3.00,
                    'tempo_adicional' => '00:00:00'
                ),
                array(
                    'descricao' => 'Sem Cebola',
                    'valor' => 0.00,
                    'tempo_adicional' => '00:00:00'
                ),
                array(
                    'descricao' => 'Borda Recheada',
                    'valor' => 5.00,
                    'tempo_adicional' => '00:05:00'
                )
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizza_tamanho');
        Schema::dropIfExists('pizza_sabor');
        Schema::dropIfExists('pizza_personalizacao');
    }
}
