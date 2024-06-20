<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');

            $table->string('office_number');
            $table->string('mobile_number');
            $table->string('componay_name');
            $table->string('trading_name');
            $table->date('company_registration_date');
            $table->string('company_registration_no');
            $table->text('office_address');
            $table->text('delivery_address');
            $table->string('preferred_bank');
            $table->integer('payment_method');
            $table->string('applicant_id');
            $table->string('company_ref_id');
            $table->integer('team_member_id')->nullable()->default(NULL);
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
        Schema::dropIfExists('customers');
    }
}
