<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id')->unsigned()->index('FK_cart_items_stores');
			$table->string('visitor_id');
			$table->string('visitor_type');
			$table->integer('store_product_id')->unsigned()->index('FK_cart_items_store_products');
			$table->integer('quantity')->unsigned();
			$table->decimal('unit_price', 6, 4);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cart_items');
	}

}
