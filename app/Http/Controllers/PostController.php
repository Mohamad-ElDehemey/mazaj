<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\Rate;

class PostController extends Controller {

	//
	/**
	* creates new post
	* chengae post status into 1
	*
	* @param int track_id
	*
	* @return string posted
	*/

	public function postPost(Request $req){


		extract($req->all());
		if(Auth::check()){

			$present = Post::where('user_id','=',Auth::user()->id)->where('track_id','=',$track_id)->first();
			if($present){

				$present->status = 1;
				$present->save();
			}else{


				$post = Post::create([

						'user_id' 	=>Auth::user()->id,
						'track_id'	=>$track->id

					]);
			}

			$rate = Rate::where('user_id','=',Auth::user()->id)->where('track_id','=',$track_id)->first();
			if($rate){

				if(!$rate->isexplicit){

					if($rate->shared < 3){

						$shared = $rate->shared + 1;
						$new_rate = $rate->rate + 2;
						if($new_rate >= 10)
							$new_rate = 10;

						$rate->shared = $shared;
						$rate->rate = $new_rate;
						$rate->save();

					}
					
				}

			}else{

				$rate = Rate::create([

						'user_id' 	=> Auth::user()->id,
						'track_id'	=>$track_id,
						'isexplicit' =>false,
						'rate'		=>1,
						'shared'	=>1,
						'isexplicit' =>false
					]);
			}
		}
		
		
	}

	/**
	* creates new post
	* chengae post status into 0
	*
	* @param int track_id
	*
	* @return string unposted
	*/

	public function postUnpost(Request $req){

		extract($req->all());
		if(Auth::check()){

			$present = Post::where('user_id','=',Auth::user()->id)->where('track_id','=',$track_id)->first();
			if($present){

				$present->status = false;
				$present->save();
			}

			$rate = Rate::where('user_id','=',Auth::user()->id)->where('track_id','=',$track_id)->first();
			if($rate){

				if(!$rate->isexplicit){

					$new_rate = $rate->rate - 2;
					$shared = $rate->shared -1;
					if($new_rate<=0)
						$new_rate=0;

					$rate->shared = $shared;
					$rate->rate = $new_rate;
					$rate->save();
				}
			}
		}
	}

}
