<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;

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

			$msg = Message::where('receiver_id','=',Auth::user()->id)->orderBy('created_at', 'desc')->get();
			if($msg->count()){

				$content = $msg[0]->content;
			}
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

	// reply message
	public function postSend(Request $request){

		if(Auth::check()){

			$validator = Validator::make($request->all(),['content'=>'required']);
			if($validator->passes()){

				
				if($request->get('id')){

					$msg = Message::find($request->get('id'));
					$new_msg = Message::Create([

					'content' =>$request->get('content'),
					'sender_id' =>Auth::user()->id,
					'receiver_id' =>$msg->sender_id
				]);

				}else{


					// new msg
				}

					

			}
		}



	}



}
