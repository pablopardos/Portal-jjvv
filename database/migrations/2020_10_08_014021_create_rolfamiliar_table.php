<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolfamiliarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolfamiliar', function (Blueprint $table) {
            $table->increments('id_rolfam');
            $table->string('descrip', 20)->nullable();
        });
        DB::table('rolfamiliar')->insert(array('id_rolfam'=>'1','descrip'=>'SIN DEFINIR'));
        DB::table('rolfamiliar')->insert(array('id_rolfam'=>'2','descrip'=>'Jefe(a) de Hogar'));
        DB::table('rolfamiliar')->insert(array('id_rolfam'=>'3','descrip'=>'Hijo(a)'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rolfamiliar');
    }
}
