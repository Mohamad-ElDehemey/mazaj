<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class TagController extends Controller {

	
	public function getId($id){

		$posts = Tag::find($id)->post;
		return view('tag')->with('posts',$posts)->with('tag',Tag::find($id));
	}

}
