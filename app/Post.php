<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model {

	//

	protected $fillable =['user_id','track_id'];

	public function user(){

		return $this->belongsTo('App\User');
	}

	public function track(){

		return $this->belongsTo('App\Track');

	}

	

	

}
