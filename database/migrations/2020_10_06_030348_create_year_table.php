<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year', function (Blueprint $table) {
            $table->increments('id_year');
            $table->boolean('condicion')->default(1);
        });
        DB::table('year')->insert(array('id_year'=>'2019'));
        DB::table('year')->insert(array('id_year'=>'2020'));
        DB::table('year')->insert(array('id_year'=>'2021'));
        DB::table('year')->insert(array('id_year'=>'2022'));
        DB::table('year')->insert(array('id_year'=>'2023'));
        DB::table('year')->insert(array('id_year'=>'2024'));
        DB::table('year')->insert(array('id_year'=>'2025'));
        DB::table('year')->insert(array('id_year'=>'2026'));
        DB::table('year')->insert(array('id_year'=>'2027'));
        DB::table('year')->insert(array('id_year'=>'2028'));
        DB::table('year')->insert(array('id_year'=>'2029'));
        DB::table('year')->insert(array('id_year'=>'2030'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('year');
    }
}
