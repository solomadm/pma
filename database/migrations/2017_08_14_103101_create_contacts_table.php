<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'contacts',
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('first_name');
                $table->string('last_name');
                $table->string('email');
                $table->string('nature_of_enquiry');
                $table->string('job_title');
                $table->string('company');
                $table->string('industry')->nullable();
                $table->string('countries_operate')->nullable();
                $table->string('country')->nullable();
                $table->string('website')->nullable();
                $table->text('comments')->nullable();

                $table->timestamps();
            }
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
