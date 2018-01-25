<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'medias',
            function (Blueprint $table) {
                $table->increments('id');

                // Personal Data
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email');
                $table->string('title')->nullable();
                $table->integer('age_group')->nullable();
                $table->string('nationality')->nullable();
                $table->string('country_of_residence')->nullable();
                $table->string('phone_mobile')->nullable();
                $table->string('job_title')->nullable();
                $table->string('industry')->nullable();
                $table->integer('photo')->default(0);
                $table->boolean('visa_check')->default(false);
                $table->boolean('confirm_photo_notice')->default(false);

                // Organization Data
                $table->string('organisation')->nullable();
                $table->string('designation')->nullable();
                $table->string('address1')->nullable();
                $table->string('address2')->nullable();
                $table->string('city')->nullable();
                $table->string('country')->nullable();
                $table->string('po_box')->nullable();
                $table->string('phone_company')->nullable();
                $table->string('website')->nullable();
                $table->string('twitter')->nullable();

                $table->integer('article1')->default(0);
                $table->integer('article2')->default(0);
                $table->integer('article3')->default(0);

                $table->string('link1')->nullable();
                $table->string('link2')->nullable();
                $table->string('link3')->nullable();

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
        Schema::dropIfExists('medias');
    }
}
