<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('description');
			$table->integer('price');
			$table->time('time');
			$table->string('img');
			$table->integer('resturant_id')->unsigned();
			$table->boolean('disable');
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}