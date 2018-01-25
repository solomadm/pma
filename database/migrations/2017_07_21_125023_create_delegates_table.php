<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelegatesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'delegates',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('conference_id');
                $table->string('email');
                $table->string('password');

                //PROFILE FIELDS
                $table->string('title')->nullable();
                $table->string('first_name');
                $table->string('last_name');
                $table->integer('age_group')->nullable();
                $table->string('nationality')->nullable();
                $table->string('address1')->nullable();
                $table->string('address2')->nullable();
                $table->string('postcode')->nullable();
                $table->string('city')->nullable();
                $table->string('country');
                $table->string('job_title')->nullable();
                $table->string('organisation')->nullable();
                $table->string('phone_mobile')->nullable();
                $table->string('phone_company')->nullable();
                $table->string('industry')->nullable();
                $table->integer('photo')->default(0);
                $table->integer('visa_check')->default(0);
                $table->integer('photography_check')->default(0);

                //STATUS
                $table->integer('confirmed')->default(0);
                $table->integer('enabled')->default(0);

                $table->string('uic')->nullable();
                $table->rememberToken();
                $table->timestamps();

                $table->unique(['conference_id', 'uic']);
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
        //
    }
}
