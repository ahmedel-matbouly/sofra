<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->integer('phone');
			$table->string('email');
			$table->string('text');
			$table->string('facebook_url');
			$table->string('twitter_url');
			$table->string('instagram_url');
			$table->integer('commission');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}