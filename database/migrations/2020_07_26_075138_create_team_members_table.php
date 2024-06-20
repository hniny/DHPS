<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('home_number');
            $table->string('mobile_number');
            $table->text('residential_address');
            $table->text('postal_address');
            $table->string('application_id')->nullable();
            $table->string('employee_info')->nullable();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('user_id');
            $table->date('date_of_employee');
            $table->string('emp_id_no');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_members');
    }
}
