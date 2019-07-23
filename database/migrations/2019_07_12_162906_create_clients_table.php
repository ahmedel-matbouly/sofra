<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('phone');
			$table->integer('city_id')->unsigned();
			$table->integer('password');
			$table->string('email');
			$table->tinyInteger('activated');
			$table->integer('api_token');
			$table->string('address');
			$table->string('img');
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}