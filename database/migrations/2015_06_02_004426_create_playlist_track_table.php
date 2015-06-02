<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistTrackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('playlist_track', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('playlist_id')->unsigned()->index();
            $table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('cascade');
            
			$table->integer('track_id')->unsigned()->index();
            $table->foreign('track_id')->references('id')->on('tracks')->onDelete('cascade');

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
		Schema::table('playlist_track', function(Blueprint $table)
		{
			//
		});
	}

}
