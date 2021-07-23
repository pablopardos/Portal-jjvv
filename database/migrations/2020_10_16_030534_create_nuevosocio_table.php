<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNuevosocioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nuevosocio', function (Blueprint $table) {
            $table->increments('id_nuevo');
            $table->integer('id_direc')->unsigned();
            $table->string('rut', 20)->unique();
            $table->string('password', 20);
            $table->string('nom_p', 50)->nullable();
            $table->string('nom_s', 50)->nullable();
            $table->string('ap_p', 50)->nullable();
            $table->string('ap_s', 50)->nullable();
            $table->string('prof', 60)->nullable();
            $table->string('email', 80)->nullable();
            $table->string('telefono', 80)->nullable();
            $table->integer('edad', 0)->nullable();

            $table->foreign('id_direc')->references('id_direc')->on('direccion');
        });
        DB::table('nuevosocio')->insert(array('id_nuevo'=>'1','id_direc'=>'1','rut'=>'999','password'=>'999','nom_p'=>'Z','nom_s'=>'Z','ap_p'=>'Z','ap_s'=>'Z','prof'=>'zzz','email'=>'zzz@gg.com','telefono'=>'999999999','edad'=>'30'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nuevosocio');
    }
}
