<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('default_shipping_address_id', 'FK_customers_customer_addresses')->references('id')->on('customer_addresses')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('default_billing_address_id', 'FK_customers_customer_addresses_2')->references('id')->on('customer_addresses')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('store_id', 'FK_customers_stores')->references('id')->on('stores')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign('FK_customers_customer_addresses');
            $table->dropForeign('FK_customers_customer_addresses_2');
            $table->dropForeign('FK_customers_stores');
        });
    }
}
