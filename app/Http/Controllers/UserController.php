<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\User;
use App\Permission;
use App\Profile;
use App\Sector;
use App\Photo;

class UserController extends Controller
{
    //
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function indexProfile(){
		$user = auth()->user();
		return view('cms.user.profile.index', compact('user'));
	}
	public function indexUser(){
		$user = User::all();
		$option = true;
		return view('cms.user.index', compact('user', 'option'));
	}
	public function editUser($id){
		try{
			$user = User::all();
			$option = false;
			$edit = User::find($id);
			if(is_null($edit))return Redirect::to('/cms/user/');
			return view('cms.user.index', compact('user', 'option', 'edit'));
		}catch(\Exception $e){
			return Redirect::to('/cms/')->with('msg', ' Sorry something went worng. Please try again.');
		}	
	}
	public function createUser(Request $request){
		$request->validate([
			'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
		]);
		try{
			$user = new User;
			$user->createUser(new User(request(['name', 'email', 'password'])));
			return Redirect::to('/cms/user/');
			
		}catch(\Exception $e){
			
			return Redirect::to('/cms/user/')->with('msg', ' Sorry something went worng. Please try again.');
		}	
	}
	public function updateUser(Request $request, $id){
		$request->validate([
			'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
		]);
		try{
			$user = new User;
			$user->updateUser(new User(request(['name', 'email', 'password'])),$id);
			return Redirect::to('/cms/user/'.$id);
		}catch(\Exception $e){
			return Redirect::to('/cms/user/'.$id)->with('msg', ' Sorry something went worng. Please try again.');
		}	
	}
	public function deleteUser($id){
		try{
			$user = User::find($id);
			$user->deleteUser($user);
			return Redirect::to('/cms/user/');
		}catch(\Exception $e){
			return Redirect::to('/cms/user/'.$id)->with('msg', ' Sorry something went worng. Please try again.');
		}
	}
	public function createProfile(Request $request){
		try{
			$profile = new Profile;
			$photo = new Photo;
			$name[0] = $photo->photo($request->file('image'), 'profile');
			$profile->createProfile(new Profile(request(['text', 'twitter', 'facebook', 'instagram', 'phrase'])), $name[0]);
			return Redirect::to('/cms/profile/');
		}catch(\Exception $e){
			return Redirect::to('/cms/profile/')->with('msg', ' Sorry something went worng. Please try again.');
		}
	}
	
}
