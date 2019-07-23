<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('img');
			$table->string('name');
			$table->string('text');
			$table->integer('resturant_id')->unsigned();
			$table->datetime('end_at');
			$table->datetime('start_at');
			$table->decimal('price', 8,2);
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}