<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Auth;
use App\User;

class MessageController extends Controller {

	//

	public function getMsgcount(){

		if(Auth::check()){
			$messages = Message::where('receiver_id','=',Auth::user()->id)->where('new','=',true)->get();
			return $messages->count();
		}

		return 0;
		
	}

	// load messages

	public function getMsgs(){

		if(Auth::check()){

		$msgs = Message::with(['sender'])->where('receiver_id','=',Auth::user()->id)->get()->sortByDesc('created_at');
		return View('msgs')->with('msgs',$msgs);

		}

		

	}

	// read a message
	public function getReadmsg($id=0){

		$content = '';
		if(Auth::check()){

		if(!$id){

			$content = Message::where('receiver_id','=',Auth::check())->get()->sortByDesc('created_at')->first();
			if($content->new){

				$content->new = false;
				$content->save();
			}
			$content = $content->content;
		}
		else{

			$content = Message::where('id','=',$id)->first();
			if($content){

				if($content->receiver_id == Auth::user()->id){

					if($content->new){

						$content->new = false;
						$content->save();

					}
					$content = $content->content;

				}

			}

		}
		

		}
		return $content;
	}



}
