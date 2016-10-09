<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('customer_id')->unsigned()->nullable()->index('FK_orders_customers');
			$table->integer('store_id')->unsigned()->nullable()->index('FK_orders_stores');
			$table->integer('shipping_address_id')->unsigned()->nullable()->index('FK_orders_customer_addresses');
			$table->integer('billing_address_id')->unsigned()->nullable()->index('FK_orders_customer_addresses_2');
			$table->integer('shipping_method_id')->unsigned()->nullable()->index('FK_orders_store_shipping_methods');
			$table->decimal('total', 6, 4);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
