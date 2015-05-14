<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Message extends Model {

	//

	protected $fillable = ['sender_id','receiver_id','content'];

	public function sender(){

		return $this->belongsTo('App\User','sender_id');
	}

	

}
