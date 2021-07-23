<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertresidenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certresidencia', function (Blueprint $table) {
            $table->increments('id_cert');
            $table->integer('id_tipocert')->unsigned();
            $table->integer('id_socio')->unsigned();
            $table->string('rut', 20)->unique();
            $table->string('nombre', 80);
            $table->string('asunto', 80);

            $table->foreign('id_tipocert')->references('id_tipocert')->on('tipocert');
            $table->foreign('id_socio')->references('id_socio')->on('socio');
        });

        DB::table('certresidencia')->insert(array('id_cert'=>'1','id_tipocert'=>'1','id_socio'=>'1','rut'=>'111','nombre'=>'A A A A','asunto'=>'aaa'));
        DB::table('certresidencia')->insert(array('id_cert'=>'2','id_tipocert'=>'2','id_socio'=>'1','rut'=>'333','nombre'=>'C C A A','asunto'=>'ccc'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certresidencia');
    }
}
