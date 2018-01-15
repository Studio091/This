<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
       'text', 'user_id', 'image', 'twitter', 'facebook', 'instagram', 'phrase'
    ];
	public function user(){
		return $this->belongsTo(User::class);
	}
	public function work(){
		return $this->belongsToMany(Work::class, 'profile_work', 
      'profile_id', 'work_id')->withTimestamps();
	}
	public function createProfile(Profile $profile, $name){
		if(is_null($profile->twitter)){
			$profile->twitter = 1;
		}
		if(is_null($profile->facebook)){
			$profile->facebook= 1;
		}
		if(is_null($profile->instagram)){
			$profile->instagram = 1;
			
		}
		if(is_null(auth()->user()->profile)){
		$profile->user_id = auth()->user()->id;
		$profile->image = $name[0];
		$profile->save();
		}else{
		$aux = auth()->user()->profile;
		$aux->image = $name[0];
		$aux->text = $profile->test($profile->text, $aux->text);
		$aux->image = $profile->test($profile->image, $aux->image);
		$aux->twitter = $profile->test($profile->twitter, $aux->twitter);
		$aux->facebook = $profile->test($profile->facebook, $aux->facebook);
		$aux->instagram = $profile->test($profile->instagram, $aux->instagram);
		$aux->phrase = $profile->test($profile->phrase, $aux->phrase);
		$aux->save();
		}
	}
	public function test($new, $old){
		if(is_null($new)){
			return($old);
		}else{
			return($new);
		}
	}
}
