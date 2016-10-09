<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id')->unsigned()->index('FK_store_products_stores');
			$table->integer('product_id')->unsigned()->index('FK_store_products_products');
			$table->integer('status')->unsigned()->default(1);
			$table->decimal('price', 6, 4)->unsigned();
			$table->decimal('sale_price', 6, 4)->unsigned()->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('store_products');
	}

}
