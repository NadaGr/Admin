<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaniersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paniers', function (Blueprint $table) {
            $table->id();  
            $table->String('nom_service');
            $table->text('description');
            $table->float('prix');
            $table->integer('nb_points');
            $table->bigInteger('categorie_id')->unsigned()->index();
            $table->String('image');
            $table->bigInteger('service_id')->unsigned()->index();
            $table->bigInteger('client_id')->unsigned()->index();
            $table->dateTime('date_res');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paniers');
    }
}
