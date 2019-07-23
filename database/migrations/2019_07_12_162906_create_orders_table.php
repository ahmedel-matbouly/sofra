<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('add_notes');
			$table->decimal('total', 8,2);
			$table->decimal('delivery_fee');
			$table->enum('state', array(''));
			$table->integer('client_id')->unsigned();
			$table->integer('resturant_id')->unsigned();
			$table->decimal('commission', 8,2);
			$table->integer('payment_id')->unsigned();
			$table->decimal('net', 8,2);
			$table->string('address');
			$table->decimal('cost', 8,2);
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}