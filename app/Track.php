<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model {

	//

	protected $fillable =['title','name','user_id','cover'];

	public function like(){

		return $this->hasMany('App\Like');
	}

}
