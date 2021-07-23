<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calle', function (Blueprint $table) {
            $table->increments('id_calle');
            $table->string('calle', 60);
        });
        DB::table('calle')->insert(array('id_calle'=>'1','calle'=>'Pasaje Cerro Adasme'));
        DB::table('calle')->insert(array('id_calle'=>'2','calle'=>'Pasaje Cerro Rinconada'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calle');
    }
}
