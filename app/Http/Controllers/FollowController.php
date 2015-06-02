<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Follow;
use Auth;

class FollowController extends Controller {

	public function postFollow(Request $request){

		if(Auth::user()){

			$follower_id = Auth::user()->id;
			$followed_id = $request->get('followed_id');

			$follows = Follow::where('follower_id','=',$follower_id)->where('followed_id','=',$followed_id)->first();
			if(!$follows){

				$follow = Follow::create([

						'follower_id' =>$follower_id,
						'followed_id' =>$followed_id
					]);
			}
		}
	}

	public function postUnfollow(Request $request){

		if(Auth::user()){

			$follower_id = Auth::user()->id;
			$followed_id = $request->get('followed_id');

			$follows = Follow::where('follower_id','=',$follower_id)->where('followed_id','=',$followed_id)->first();
			if($follows){

				$follow = Follow::find($follows->id);
				$follow->delete();

			}

		}
		
	}

}
