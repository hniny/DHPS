<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatConsigmentsHasExtraUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('consigemts_has_extra_user', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('consigment_id');
        $table->foreign('consigment_id')->references('id')->on('consigments')->onDelete('cascade');
        $table->unsignedBigInteger('extra_user_id');
        $table->foreign('extra_user_id')->references('id')->on('extra_users')->onDelete('cascade');
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
        //
    }
}
