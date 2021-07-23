<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion', function (Blueprint $table) {
            $table->increments('id_direc');
            $table->integer('id_calle')->unsigned();
            $table->integer('id_num')->unsigned();

            $table->foreign('id_calle')->references('id_calle')->on('calle');
            $table->foreign('id_num')->references('id_num')->on('numero');
        });
        DB::table('direccion')->insert(array('id_direc'=>'1','id_calle'=>'1','id_num'=>'1'));
        DB::table('direccion')->insert(array('id_direc'=>'2','id_calle'=>'1','id_num'=>'2'));
        DB::table('direccion')->insert(array('id_direc'=>'3','id_calle'=>'2','id_num'=>'1'));
        DB::table('direccion')->insert(array('id_direc'=>'4','id_calle'=>'2','id_num'=>'2'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direccion');
    }
}
