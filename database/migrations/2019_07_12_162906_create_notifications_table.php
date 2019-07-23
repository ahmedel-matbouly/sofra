<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('title');
			$table->text('body');
			$table->string('notificationable_type');
			$table->integer('notificationable_id');
			$table->integer('order_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}