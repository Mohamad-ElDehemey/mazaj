<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Post;
class FeedController extends Controller {

	//

	public function index(){

		$posts = Post::with('user')->paginate(5);
		return View('home')->with('posts',$posts);
	}
}
