<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 10);
            $table->string('email');
            $table->string('phone');
            $table->string('password', 100);
            $table->integer('store_id')->unsigned()->nullable()->index('FK_customers_stores');
            $table->integer('default_shipping_address_id')->unsigned()->nullable()->index('FK_customers_customer_addresses');
            $table->integer('default_billing_address_id')->unsigned()->nullable()->index('FK_customers_customer_addresses_2');
            $table->string('remember_token', 60);
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
        Schema::drop('customers');
    }
}
