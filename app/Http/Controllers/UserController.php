<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Permission;
use App\Profile;
use App\Sector;
use App\Photo;

class UserController extends Controller
{
    //
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
		$user = User::all();
		$option = false;
		$edit = User::find($id);
		return view('cms.user.index', compact('user', 'option', 'edit'));
	}
	public function createUser(Request $request){
		$user = new User;
		$user->createUser(new User(request(['name', 'email', 'password'])));
	}
	public function updateUser(Request $request, $id){
		$user = new User;
		$user->updateUser(new User(request(['name', 'email', 'password'])),$id);
	}
	public function deleteUser($id){
		$user = User::find($id);
		$user->deleteUser($user);
	}
	public function createProfile(Request $request){
		$profile = new Profile;
		$photo = new Photo;
		$name[0] = $photo->photo($request->file('image'), 'profile');
		$profile->createProfile(new Profile(request(['text', 'twitter', 'facebook', 'instagram', 'phrase'])), $name[0]);
	}
	
}
