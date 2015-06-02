<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model {

	//

	protected $fillable = ['rate','isexplicit','user_id','track_id','played','shared','inlists'];

}
