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
            $table->string('collectionName');
            $table->string('trackName');
            $table->decimal('collectionPrice');
            $table->decimal('trackPrice');
            $table->string('primaryGenreName');
            $table->string('trackCount');
            $table->integer('trackNumber');
            $table->datetime('releaseDate');
            $table->timestamps();

            $table->unique(['collectionName', 'releaseDate', 'trackName']);
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
