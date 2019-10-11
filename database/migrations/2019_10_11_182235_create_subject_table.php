<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('UNP');
            $table->text('polnoe_naimenovanie');
            $table->text('socrasch_naimenovanie');
            $table->text('FIO');
            $table->text('mesto_nahozdenia');
            $table->text('pochtovyi_adres');
            $table->text('nomer_rasch_sheta');
            $table->text('naimenovanie_banka');
            $table->text('BIC');
            $table->text('razmer_ust_fonda');
            $table->text('balansovaja_stoim_aktivov');
            $table->text('objem_viruchki');
            $table->text('vidy_tovarov');
            $table->text('rezident');
            $table->text('status');
            $table->text('dominant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject');
    }
}
