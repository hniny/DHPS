<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypesToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_type_id')->default(0);
            $table->foreign('customer_type_id')->references('id')->on('customer_types')->onDelete('cascade');
            $table->unsignedBigInteger('outlet_type_id')->default(0);
            $table->foreign('outlet_type_id')->references('id')->on('outlet_types')->onDelete('cascade');
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
            $table->dropColumn('customer_type_id');
            $table->dropColumn('outlet_type_id');
        });
    }
}
