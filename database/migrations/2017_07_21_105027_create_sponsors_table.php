<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'sponsors',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('conference_id');
                $table->string('name');
                $table->string('category');
                $table->string('image');
                $table->string('bio')->nullable();
                $table->string('bio2')->nullable();
                $table->integer('order')->default(0);
                $table->integer('enabled')->default(0);
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
        //
    }
}
