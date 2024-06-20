<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTownshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('townships', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('city_id');
        $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        $table->unsignedBigInteger('zone_id');
        $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
        $table->string('postal_code');
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
        Schema::dropIfExists('townships');
    }
}
