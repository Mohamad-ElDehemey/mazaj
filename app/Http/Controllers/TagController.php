<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Track;
use App\Tag;

class TagController extends Controller {

	
	public function getId($id){

		$posts = Track::whereIn('id',function($q)use($id){

			$q->select('track_id')->from('track_tag')->where('tag_id','=',$id)->get();

		})->orderBy('created_at','DESC')->paginate(9);

		return view('tag')->with('posts',$posts)->with('tag',Tag::find($id));

}
}
