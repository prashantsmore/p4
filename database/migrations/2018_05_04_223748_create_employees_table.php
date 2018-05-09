<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
			
			$table->string('identification');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('address_line_1');
			$table->string('address_line_2')->nullable();
			$table->string('city');
			$table->string('state');
			$table->string('zip_code');
			$table->string('telephone_number');
			$table->integer('age');
			$table->string('sex');
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
