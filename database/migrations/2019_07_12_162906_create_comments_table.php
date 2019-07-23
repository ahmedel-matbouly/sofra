<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('text');
			$table->integer('clients_id')->unsigned();
			$table->integer('resturant_id')->unsigned();
			$table->enum('rating', array(''));
		});
	}

	public function down()
	{
		Schema::drop('comments');
	}
}