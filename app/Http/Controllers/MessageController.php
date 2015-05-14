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

	public function getFirstmsg(){

		$msg = array('sender'=>'');

		$message = Message::where('receiver_id','=',Auth::user()->id)->get()->sortByDesc('created_at')->first();
		if($message){

			$sender = User::find($message->sender_id);
			$email =$sender->email;
			$size = 150;
			$avatar = '';

			$msg['sender'] 	=$sender->username;
			$msg['avatar']  ="http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $avatar ) . "&s=" . $size;
			$msg['content'] =$message->content;
			$msg['time']	=date('d-F-Y',strtotime($message->created_at));
			$msg['id']		=$message->id;
			
		}

		return json_encode($msg);
	}


	// mark as read
	public function postMarkread($id){


	}

	// read a message
	public function getReadmsg($id){

		return 'Msg from Folan';
	}



}
