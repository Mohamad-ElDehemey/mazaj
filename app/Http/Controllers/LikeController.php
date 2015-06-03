<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Like;
use Auth;
use App\Rate;

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

		if(Auth::check()){

			extract($request->all());
			$liked = Like::where('user_id','=',Auth::user()->id)->where('track_id','=',$track_id)->first();
			if(!$liked){

				$like = Like::create([

					'track_id' =>$track_id,
					'user_id' =>Auth::user()->id
					]);

				// update rates table
				$rate = Rate::where('user_id','=',Auth::user()->id)->where('track_id','=',$track_id)->first();
				if($rate){

					if(!$rate->isexplicit){

						$new_rate = $rate->rate +2;
						if($new_rate >=10){
							$new_rate =10;
						}
						$rate->rate = $new_rate;
						$rate->save();

					}

				}else{

					$rate = Rate::create([

							'user_id' 	=>Auth::user()->id,
							'track_id'  =>$track_id,
							'rate' 		=>2

						]);

				}

			}

			$likes = Like::where('track_id','=',$track_id)->get()->count();

			return $likes;
		}
		
		
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

	public function postUnlike(Request $request){


		if(Auth::check()){
			extract($request->all());
			$liked = Like::where('user_id','=',Auth::user()->id)->where('track_id','=',$track_id)->first();
			if($liked){

				$like = Like::find($liked->id);
				$like->delete();

				// update rates table
				$rate = Rate::where('user_id','=',Auth::user()->id)->where('track_id','=',$track_id)->first();
				if($rate){

					if(!$rate->isexplicit){

						$new_rate = $rate->rate -2;
						if($new_rate<=0){
							$new_rate = 0;
						}
						$rate->rate = $new_rate;
						$rate->save();

					}

				}
			}
			$likes = Like::where('track_id','=',$track_id)->get()->count();

			return $likes;
		}

	}


}
