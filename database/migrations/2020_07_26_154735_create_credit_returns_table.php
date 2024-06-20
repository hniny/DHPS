<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_returns', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_order_id');
            $table->foreign('customer_order_id')->references('id')->on('customer_orders')->onDelete('cascade');

            $table->unsignedBigInteger('return_reason_id');
            $table->foreign('return_reason_id')->references('id')->on('return_reasons')->onDelete('cascade');
            
            $table->json('items');
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
        Schema::dropIfExists('credit_returns');
    }
}
