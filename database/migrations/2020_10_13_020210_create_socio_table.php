<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socio', function (Blueprint $table) {
            $table->increments('id_socio');
            $table->integer('id_direc')->unsigned();
            $table->integer('id_ecivil')->unsigned();
            $table->integer('id_rolfam')->unsigned();
            $table->integer('num_socio')->unique();
            $table->string('nom_p', 50)->nullable();
            $table->string('nom_s', 50)->nullable();
            $table->string('ap_p', 50)->nullable();
            $table->string('ap_s', 50)->nullable();
            $table->string('prof', 60)->nullable();
            $table->string('email', 80)->nullable();
            $table->string('telefono', 80)->nullable();
            $table->integer('edad', 0)->nullable();

            $table->foreign('id_direc')->references('id_direc')->on('direccion');
            $table->foreign('id_ecivil')->references('id_ecivil')->on('ecivil');
            $table->foreign('id_rolfam')->references('id_rolfam')->on('rolfamiliar');

            $table->timestamps();
        });
        DB::table('socio')
        ->insert(array(
            'id_socio'=>'1',
            'id_direc'=>'1',
            'id_ecivil'=>'3',
            'id_rolfam'=>'2',
            'num_socio'=>'1',
            'nom_p'=>'Pamela',
            'nom_s'=>'Ana',
            'ap_p'=>'Soto',
            'ap_s'=>'Zuñiga',
            'prof'=>'Ingeniero Comercial',
            'email'=>'pasz@gg.com',
            'telefono'=>'911111111',
            'edad'=>'50'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socio');
    }
}
