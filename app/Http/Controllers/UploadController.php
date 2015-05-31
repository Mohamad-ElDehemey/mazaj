<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Mazaj\Nav;


use Input;
use Validator;
use Redirect;
use App\Track;
use App\Post;

class UploadController extends Controller {

	//

	public function getIndex(){

		if(Auth::check()){

			
			return view('upload');


		}else{

			return redirect('/');
		}

		
	}

	public function postIndex(Request $request){

		if(Auth::check()){

			
		//validation
		$validation = Validator::make($request->all(),[

				'title'	=>'required|max:250',
				'track'	=>'required|mimes:mpga',
				'cover'	=>'mimes:jpeg,bmp,png'
			]);

		if($validation->passes()){


			$cover='';


			$random_name = rand(11111,99999);

			$check_name = Track::where('name','=',$random_name)->first();
			while($check_name){

				$random_name = rand(11111,99999);
			}
			$dest = 'storage/tracks';
			$ext  =Input::file('track')->getClientOriginalExtension();

			$file_name = $random_name.'.'.$ext;
			if(Input::file('track')->move($dest,$file_name)){

				

				if($request->hasFile('cover')){
					$dest = 'storage/pics';
					$ext  =Input::file('cover')->getClientOriginalExtension();
					Input::file('cover')->move($dest,$random_name.'.'.$ext);
					$cover = $random_name.'.'.$ext;
				}
				


				$title =$request->get('title');
				$name = $random_name;
				$user_id = Auth::user()->id;

				// update tracks table
				$track = Track::create([

						'title'		=>$title,
						'name' 		=>$name,
						'user_id'	=>Auth::user()->id,
						'cover'		=>$cover
						
					]);

				//update tags table

				// update posts table
				$post = Post::create([

						'user_id' 	=>Auth::user()->id,
						'track_id'	=>$track->id

					]);


				return Redirect('/');
			}
		}else{

			dd($validation);
		}
		}
	}

	public function postCover(Request $request){

		dd($request->all());
	}

}
