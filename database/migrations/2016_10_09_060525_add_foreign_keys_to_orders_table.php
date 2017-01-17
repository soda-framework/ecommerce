<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('shipping_address_id', 'FK_orders_customer_addresses')->references('id')->on('customer_addresses')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('billing_address_id', 'FK_orders_customer_addresses_2')->references('id')->on('customer_addresses')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('customer_id', 'FK_orders_customers')->references('id')->on('customers')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('shipping_method_id', 'FK_orders_store_shipping_methods')->references('id')->on('store_shipping_methods')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('store_id', 'FK_orders_stores')->references('id')->on('stores')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('FK_orders_customer_addresses');
            $table->dropForeign('FK_orders_customer_addresses_2');
            $table->dropForeign('FK_orders_customers');
            $table->dropForeign('FK_orders_store_shipping_methods');
            $table->dropForeign('FK_orders_stores');
        });
    }
}
