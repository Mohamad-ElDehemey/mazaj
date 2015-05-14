<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
class FeedController extends Controller {

	//

	public function index(){

		$avatar = '';
		if(Auth::check()){

		$email = Auth::user()->email;
		$size = 40;
		$avatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $avatar ) . "&s=" . $size;
		}

		return View('home')
					->with('avatar',$avatar);
	}
}
