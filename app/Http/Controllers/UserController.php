<?php namespace App\Http\Controllers;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Hash;

class UserController extends Controller {

	// REGISTERATION
	public function postNew(Request $request){

		$validator = Validator::make($request->all(), [

            'username' 	=> 'required|min:3|unique:users',
            'email'		=> 'required|email|unique:users',
            'password'	=>'required'
            
        ]);

        if($validator->fails()){

        	$messages = array('error'=>'true');
        	$messages['username'] = $validator->errors()->first('username');
        	$messages['email'] = $validator->errors()->first('email');
        	$messages['password'] = $validator->errors()->first('password');

        	return json_encode($messages);
        }else{

        	$data = [

    		'username' 	=> $request->get('username'),
            'email'		=> $request->get('email'),
            'password'	=> Hash::make($request->get('password'))

        	];

        	$user = User::Create($data);
        	Auth::loginUsingId($user->id);
        	return json_encode(array('error'=>'false'));
        }
	}

	// LOGIN
	public function postLogin(Request $request){

		$validator = Validator::make($request->all(),[

				'email' 	=>'required|email',
				'password'	=>'required'
			]);
		$messages = array('error'=>'true');
		if($validator->fails()){

			$messages['email']=$validator->errors()->first('email');
			$messages['password']=$validator->errors()->first('password');

			
		
		}else{

			//check email
			$user = User::where('email','=',$request->get('email'))->first();
			if(!$user){

				$messages['email'] ='That email is not found at all! You can register a new account.';

			}else{

				if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]))
			        {
			           $messages['error'] ='false';
			        }else{

			        	$messages['password'] = 'Check your password again!';
			        }
			}
		}
		return json_encode($messages);
	}

	public function getLogout(){
		Auth::logout();
		return redirect('/');
	}

}
