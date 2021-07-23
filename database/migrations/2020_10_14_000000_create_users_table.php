<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');
            $table->integer('id_socio')->unsigned();
            $table->foreign('id_socio')->references('id_socio')->on('socio')->onDelete('cascade');

            $table->integer('id_perm')->unsigned();
            $table->foreign('id_perm')->references('id_perm')->on('permiso');

            $table->string('rut', 20)->unique();
            $table->string('password');

            $table->boolean('solicitud')->default(0);

            $table->rememberToken();
            //$table->timestamps();
        });
        DB::table('users')->insert(array(
            'id_user'=>'1',
            'id_socio'=>'1',
            'id_perm'=>'2',
            'rut'=>'11877XXX-X',
            'password'=>'$2y$10$hVsqzbCtI9wfZ8a0.BA4tu3omOD/fkH62Imk3oO/z9JzrwhZwglk2',
            'solicitud'=>'0',
            'remember_token'=>'NULL'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
