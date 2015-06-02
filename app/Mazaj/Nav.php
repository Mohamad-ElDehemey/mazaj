<?php

namespace Mazaj;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use App\User;
use Auth;
use App\Follow;

class Nav {

	/**
	* @param int id
	* @return string avatar
	*/
   
   public function avatar($id,$size=40){

   	$avatar = '';

	$user = User::find($id);
	if($user){

		$email = $user->email;
		$avatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $avatar ) . "&s=" . $size;

	}
		
	return $avatar;
   }

   public function followers($id){

   	$followers = Follow::where('followed_id','=',$id)->get();
   	return $followers;
   }




}