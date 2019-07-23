<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('offers', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('payment_id')->references('id')->on('payments')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('resturants', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('resturants', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->foreign('clients_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('regions', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->foreign('resturant_id')->references('id')->on('resturants')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('offers', function(Blueprint $table) {
			$table->dropForeign('offers_resturant_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_client_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_resturant_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_payment_id_foreign');
		});
		Schema::table('resturants', function(Blueprint $table) {
			$table->dropForeign('resturants_city_id_foreign');
		});
		Schema::table('resturants', function(Blueprint $table) {
			$table->dropForeign('resturants_category_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_resturant_id_foreign');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->dropForeign('clients_city_id_foreign');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->dropForeign('comments_clients_id_foreign');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->dropForeign('comments_resturant_id_foreign');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->dropForeign('notifications_order_id_foreign');
		});
		Schema::table('regions', function(Blueprint $table) {
			$table->dropForeign('regions_city_id_foreign');
		});
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->dropForeign('category_resturant_category_id_foreign');
		});
		Schema::table('category_resturant', function(Blueprint $table) {
			$table->dropForeign('category_resturant_resturant_id_foreign');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->dropForeign('order_product_product_id_foreign');
		});
		Schema::table('order_product', function(Blueprint $table) {
			$table->dropForeign('order_product_order_id_foreign');
		});
	}
}