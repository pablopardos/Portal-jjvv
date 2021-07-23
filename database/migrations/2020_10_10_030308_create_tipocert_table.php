<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipocertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipocert', function (Blueprint $table) {
            $table->increments('id_tipocert');
            $table->string('tipo', 20);
        });
        DB::table('tipocert')->insert(array('id_tipocert'=>'1','tipo'=>'Propio'));
        DB::table('tipocert')->insert(array('id_tipocert'=>'2','tipo'=>'Familiar'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipocert');
    }
}
