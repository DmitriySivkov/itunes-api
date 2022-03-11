<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('kind');
            $table->string('collection_name');
            $table->string('track_name');
            $table->string('collection_price');
            $table->string('track_price');
            $table->string('primary_genre_name');
            $table->string('track_count');
            $table->string('track_number');
            $table->string('release_date');
            $table->foreignId('band_id');
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
        Schema::dropIfExists('songs');
    }
}
