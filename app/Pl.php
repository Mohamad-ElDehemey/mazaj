<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pl extends Model {

	//

	protected $table = 'playlist_track';

	protected $fillable = ['track_id','playlist_id'];
}
