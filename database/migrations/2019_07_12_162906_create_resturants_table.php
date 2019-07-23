<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResturantsTable extends Migration {

	public function up()
	{
		Schema::create('resturants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->integer('city_id')->unsigned();
			$table->string('email');
			$table->integer('password');
			$table->integer('category_id')->unsigned();
			$table->decimal('minimal_demand', 8,2);
			$table->decimal('delivery_fee', 8,2);
			$table->integer('phone');
			$table->string('whatsapp_url');
			$table->string('pin_code');
			$table->string('img');
			$table->tinyInteger('activated');
			$table->integer('api_token');
			$table->enum('availability', array(''));
		});
	}

	public function down()
	{
		Schema::drop('resturants');
	}
}