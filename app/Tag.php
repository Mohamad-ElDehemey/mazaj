<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	//

	protected $fillable = ['name'];

	public function post(){

		return $this->belongsToMany('App\Track','track_tag');
	}

	public function getId($id){

		return $id;
	}

}
