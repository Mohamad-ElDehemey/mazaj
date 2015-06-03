<?php

namespace Mazaj;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use App\User;
use Auth;
use App\Follow;
use App\Playlist;
use App\Track;
use App\Pl;
use URL;

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

   public function pl_cover($id){
	   	$cover = URL::to('/').'/storage/pics/def.png';
	   	$track = Pl::where('playlist_id','=',$id)->first();

	   	if($track){

	   	$track = Track::find($track->track_id);
	   	$cover = URL::to('/').'/storage/pics/'.$track->cover;
	   	}

	   	return $cover;


   }


}