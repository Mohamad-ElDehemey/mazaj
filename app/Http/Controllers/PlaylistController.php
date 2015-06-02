<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Post;
use App\Playlist;
use Auth;

class PlaylistController extends Controller {

	//


	public function getId($id){

		$posts = Post::paginate(5);
		return view('playlist')->with('posts',$posts);
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
	public function getAll(){

		$lists = false;
		$track = 1;
		if(Auth::check())
			$lists = Playlist::where('user_id','=',Auth::user()->id)->get();

		if($lists){

			return view('pls')
			        ->with('lists',$lists)
			        ->with('track',$track);

		}

		return '<p>Create a new playlist</p>';

	}


}
