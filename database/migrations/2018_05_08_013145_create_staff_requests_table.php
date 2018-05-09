<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('staff_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('request_id');
			$table->string('skill_required');
			$table->date('start_date');
			$table->date('end_date');
			$table->string('employee_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_requests');
    }
}
