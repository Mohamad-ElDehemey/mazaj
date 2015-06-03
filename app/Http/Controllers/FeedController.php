<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Track;
use App\Follow;
class FeedController extends Controller {

	//

	public function index(){

		$friends = false;
		if(Auth::check())
		$friends = Follow::where('follower_id','=',Auth::user()->id)->get();

		$posts ='';

		if($friends && $friends->count()){

			$posts = Post::with('user')->whereIn('user_id',function($q){

				$q->select('followed_id')
				  ->from('follows')
				  ->where('follower_id','=',Auth::user()->id);

			})
			->orWhere('user_id','=',Auth::user()->id)
			->orderBy('created_at','DESC')
			->paginate(9);
			
			


		}else{

			// GENERIC LATEST FEED
			$posts = Post::with('user')
			->orderBy('created_at','DESC')
			->paginate(9);
			
		}

		return View('home')->with('posts',$posts);

		
	}
}
