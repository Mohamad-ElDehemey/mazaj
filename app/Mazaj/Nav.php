<?php

namespace Mazaj;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use App\User;
use Auth;

class Nav {

	/**
	* @param int id
	* @return string avatar
	*/
   
   public function avatar($id){

   	$avatar = '';
		if(Auth::check()){

			$user = User::find($id);
			if($user){

				$email = $user->email;
				$size = 40;
				$avatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $avatar ) . "&s=" . $size;
			
			}
		}
	return $avatar;
   }




}