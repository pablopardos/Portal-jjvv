<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permiso', function (Blueprint $table) {
            $table->increments('id_perm');
            $table->string('tipo', 20);
            $table->string('descrip', 80)->nullable();
        });
        DB::table('permiso')->insert(array('id_perm'=>'1','tipo'=>'Socio','descrip'=>'Socio de la JJ.VV.'));
        DB::table('permiso')->insert(array('id_perm'=>'2','tipo'=>'Presidente','descrip'=>'Administrador 1'));
        DB::table('permiso')->insert(array('id_perm'=>'3','tipo'=>'Tesorero','descrip'=>'Administrador 2'));
        DB::table('permiso')->insert(array('id_perm'=>'4','tipo'=>'Secretario','descrip'=>'Administrador 3'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permiso');
    }
}
