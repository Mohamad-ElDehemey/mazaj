<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Track;
class SearchController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($term)
	{
		//

		$posts = Track::with('user')->whereRaw(

			"MATCH(title) AGAINST(? IN BOOLEAN MODE)",
			array($term)

		)->orderBy('created_at','DESC')->paginate(9);

		return view('search')
		->with('posts',$posts)
		->with('term',$term);
	}


}
