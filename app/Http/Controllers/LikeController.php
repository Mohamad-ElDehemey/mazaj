<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LikeController extends Controller {

	//

	/**
	* @param int user_id
	* @param int track_id
	*
	* check if not liked
	* updates likes table
	*
	* @return int total_likes
	*/
	public function postLike(Request $request){

		
	}


	/**
	* @param int user_id
	* @param int track_id
	*
	* check if liked
	* updates likes table
	*
	* @return int total_likes
	*/

	public function postUnlike(){



	}


}
