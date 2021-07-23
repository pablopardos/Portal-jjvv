<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipopublicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipopublicacion', function (Blueprint $table) {
            $table->increments('id_tipopub');
            $table->string('tipo', 20);
        });
        DB::table('tipopublicacion')->insert(array('id_tipopub'=>'1','tipo'=>'Beneficio municipal'));
        DB::table('tipopublicacion')->insert(array('id_tipopub'=>'2','tipo'=>'Proyecto de JJ.VV.'));
        DB::table('tipopublicacion')->insert(array('id_tipopub'=>'3','tipo'=>'Cuotas sociales'));
        DB::table('tipopublicacion')->insert(array('id_tipopub'=>'4','tipo'=>'Citación asamblea'));
        DB::table('tipopublicacion')->insert(array('id_tipopub'=>'5','tipo'=>'Urgencia'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipopublicacion');
    }
}
