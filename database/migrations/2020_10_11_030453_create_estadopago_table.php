<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadopagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadopago', function (Blueprint $table) {
            $table->increments('id_estpag');
            $table->integer('id_direc')->unsigned();
            $table->integer('id_year')->unsigned();
            $table->boolean('ene')->default(0);
            $table->boolean('feb')->default(0);
            $table->boolean('mar')->default(0);
            $table->boolean('abr')->default(0);
            $table->boolean('may')->default(0);
            $table->boolean('jun')->default(0);
            $table->boolean('jul')->default(0);
            $table->boolean('ago')->default(0);
            $table->boolean('sep')->default(0);
            $table->boolean('oct')->default(0);
            $table->boolean('nov')->default(0);
            $table->boolean('dic')->default(0);

            $table->boolean('estadopago')->default(0);

            $table->foreign('id_direc')->references('id_direc')->on('direccion');
            $table->foreign('id_year')->references('id_year')->on('year');
        });
        DB::table('estadopago')->insert(array('id_estpag'=>'1','id_direc'=>'1','id_year'=>'2019'));
        DB::table('estadopago')->insert(array('id_estpag'=>'2','id_direc'=>'2','id_year'=>'2019'));
        DB::table('estadopago')->insert(array('id_estpag'=>'3','id_direc'=>'1','id_year'=>'2020'));
        DB::table('estadopago')->insert(array('id_estpag'=>'4','id_direc'=>'2','id_year'=>'2020'));
        DB::table('estadopago')->insert(array('id_estpag'=>'5','id_direc'=>'1','id_year'=>'2021','ene'=>'1','feb'=>'1','mar'=>'1','estadopago'=>'1'));
        DB::table('estadopago')->insert(array('id_estpag'=>'6','id_direc'=>'2','id_year'=>'2021','ene'=>'1','feb'=>'1','mar'=>'1','estadopago'=>'1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estadopago');
    }
}
