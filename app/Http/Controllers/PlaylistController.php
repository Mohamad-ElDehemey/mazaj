<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Post;
use App\Playlist;
use Auth;
use App\Pl;
use App\Rate;

class PlaylistController extends Controller {

	//


	public function getId($id){

		$posts = Post::with('user')->whereIn('track_id',function ($q) use($id){

			$q->select('track_id')->from('playlist_track')->where('playlist_id','=',$id)->get();

		})->orderBy('created_at','DESC')->paginate(9);
		
		$playlist = Playlist::find($id);
		return view('playlist')
		->with('posts',$posts)
		->with('playlist',$playlist);
	}



	public function postCreate(Request $request){

		extract($request->all());

		if(Auth::check()){


			$playlist = Playlist::create([

			'user_id' 	=>Auth::user()->id,
			'name'		=>$name

			]);

			return view('playlistrow')->with('list',$playlist);

		}
		
	}

	// for adding to pl
	public function postAll(Request $req){

		extract($req->all());
		$lists = false;
		$track = $track_id;
		if(Auth::check())
			$lists = Playlist::with('tracks')->where('user_id','=',Auth::user()->id)->get();
	
		if($lists){

			return view('pls')
			        ->with('lists',$lists)
			        ->with('id',$track);

		}

		return '<p>Create a new playlist</p>';

	}



	public function postAdd(Request $req){

		extract($req->all());
		$present = Pl::where('track_id','=',$track_id)->where('playlist_id','=',$list_id)->first();
		if(!$present){

			$add_track = Pl::create([

				'track_id' => $track_id,
				'playlist_id' =>$list_id
				]);
		}

		$rate = Rate::where('user_id','=',Auth::user()->id)->where('track_id','=',$track_id)->first();
		if($rate){

			if(!$rate->isexplicit){

				if($rate->inlists < 3){

					$inlists = $rate->inlists +1;
					$rate->inlists = $inlists;
					$new_rate = $rate->rate + 1;
					if($new_rate >= 10)
						$new_rate = 10;
					$rate->rate = $new_rate;
					$rate->save();

				}

			}

		}else{

			$rate = Rate::create([

					'user_id' 	=>Auth::user()->id,
					'track_id'  =>$track_id,
					'rate' 		=>1,
					'isexplicit' =>false
				]);
		}
	}

	public function postRemove(Request $req){

		extract($req->all());
		$present = Pl::where('track_id','=',$track_id)->where('playlist_id','=',$list_id)->first();
		if($present){

			$remove_track = Pl::find($present->id);
			$remove_track->delete();
		}
		$rate = Rate::where('user_id','=',Auth::user()->id)->where('track_id','=',$track_id)->first();
		if($rate){

			if(!$rate->isexplicit){

				$rate->inlists = $rate->inlists -1 ;
				$new_rate = $rate->rate - 1;
				if($new_rate <= 10)
						$new_rate = 0;
				$rate->rate = $new_rate;
					$rate->save();
			}
		}
	}

}
