<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('video');
            $table->string('cast');
            $table->string('country');
            $table->string('duration');
            $table->float('rating');
            $table->string('year');
            $table->string('type');
            $table->integer('season_id')->unsigned();
            $table->boolean('featured');
            $table->boolean('staff_picks');
            $table->boolean('trending');
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
        Schema::drop('videos');
    }
}
