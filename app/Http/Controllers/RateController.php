<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RateController extends Controller {

	//

	/**
	* @param int track_id
	* @param int user_id
	*
	* checks if user can add a [play] rate increment
	* if yes , ++ rate
	* max repeats [3]
	* @return 
	*/
	public function postPlay(){


	}


	

	/**
	* @param int track_id
	* @param int user_id
	* @param explicit rate
	*
	* updates rate to the new explicit rate
	*
	* @return
	*/

	public function postExplicit(){


	} 



}
