<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrdersHasOrderRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_orders_has_order_requests', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_order_id');
            $table->foreign('customer_order_id')->references('id')->on('customer_orders')->onDelete('cascade');


            $table->unsignedBigInteger('order_request_id');
            $table->foreign('order_request_id')->references('id')->on('order_requests')->onDelete('cascade');
            
            $table->softDeletes();
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
        Schema::dropIfExists('customer_orders_has_order_requests');
    }
}
