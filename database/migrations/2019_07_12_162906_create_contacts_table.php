<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('text');
			$table->string('name');
			$table->string('email');
			$table->integer('phone');
			$table->string('content');
			$table->string('type');
			$table->string('contactable_type');
			$table->integer('contactable_id');
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}