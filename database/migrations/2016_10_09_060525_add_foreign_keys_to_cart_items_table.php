<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign('store_product_id', 'FK_cart_items_store_products')->references('id')->on('store_products')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('store_id', 'FK_cart_items_stores')->references('id')->on('stores')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign('FK_cart_items_store_products');
            $table->dropForeign('FK_cart_items_stores');
        });
    }
}
