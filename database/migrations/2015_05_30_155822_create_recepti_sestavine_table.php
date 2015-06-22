<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceptiSestavineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('receptiSestavine', function(Blueprint $table){
            $table->primary(['recept_id', 'sestavina_id']);
            $table->integer('recept_id')->unsigned();
            $table->foreign('recept_id')->references('id')->on('recepti');
            $table->integer('sestavina_id')->unsigned();
            $table->foreign('sestavina_id')->references('id')->on('sestavine');
            $table->double('kolicina');
            $table->string('enota');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('receptiSestavine');
	}

}
