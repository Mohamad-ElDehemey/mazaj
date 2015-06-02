<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Rate;
use Auth;
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

	public function postExplicit(Request $request){

		extract($request->all());
		$user_id 	= Auth::user()->id;
		$track_id 	= $item;
		$value		=$rate;

		$rate = Rate::where('user_id','=',$user_id)->where('track_id','=',$track_id)->first();
		if($rate){

			$rate->rate = $value;
			$rate->isexplicit = true;
			$rate->save();

		}else{

			$rate =  Rate::create([

			'rate'			=> $value,
			'isexplicit'	=>true,
			'user_id' 		=>Auth::user()->id,
			'track_id'		=>$track_id

			]);
		}

		
	} 

	



}
