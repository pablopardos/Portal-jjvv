<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumeroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('numero', function (Blueprint $table) {
            $table->increments('id_num');
            $table->integer('num');
        });
        DB::table('numero')->insert(array('id_num'=>'1','num'=>'654'));
        DB::table('numero')->insert(array('id_num'=>'2','num'=>'652'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('numero');
    }
}
