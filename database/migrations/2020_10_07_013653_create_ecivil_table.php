<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcivilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecivil', function (Blueprint $table) {
            $table->increments('id_ecivil');
            $table->string('descrip', 20)->nullable();
        });
        DB::table('ecivil')->insert(array('id_ecivil'=>'1','descrip'=>'SIN DEFINIR'));
        DB::table('ecivil')->insert(array('id_ecivil'=>'2','descrip'=>'Soltedo(a)'));
        DB::table('ecivil')->insert(array('id_ecivil'=>'3','descrip'=>'Casado(a)'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecivil');
    }
}
