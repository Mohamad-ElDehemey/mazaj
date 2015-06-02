<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model {

	//

	protected $fillable =['title','name','user_id','cover'];

	public function like(){

		return $this->hasMany('App\Like');
	}

	public function tag(){

		return $this->belongsToMany('App\Tag','track_tag');
	}

	public function user(){

		return $this->belongsTo('App\User');
	}

	public function playlists(){

		return $this->hasMany('App\Playlist');
	}

}
