<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	public function category(){
		return $this->hasMany(Category::class);
	}
	public function post(){
		return $this->hasMany(Post::class);
	}
	public function album(){
		return $this->hasMany(Album::class);
	}
	public function photo(){
		return $this->hasMany(Photo::class);
	}
	public function portfolio(){
		return $this->hasMany(Portfolio::class);
	}
	
	public function work(){
		return $this->belongsToMany(Work::class, 'user_work', 
      'work_id', 'user_id')->withTimestamps();
	}
	public function profile(){
		return $this->hasOne(Profile::class);
	}
	public function createUser(User $user){
		$user->password =  bcrypt($user->password);
		$user->save();
	}
	public function updateUser(User $user, $id){
		$edit = User::find($id);
		$edit = $user;
		$edit->save();
	}
	public function deleteUser(User $user){
		$photo = new Photo;
		$album = new Album;
		$port = new Portfolio;
		$category = new Category;
		$post = new Post;
		$work = new Work;
		$profile = new Profile;
		
		foreach($user->photo as $p){
			$photo = Photo::find($p->id);
			$photo->user_id = 10;
			$photo->save();
		}
		foreach($user->album as $p){
			$album = Album::find($p->id);
			$album->user_id = 10;
			$album->save();
		}
		foreach($user->portfolio as $p){
			$port = Portfolio::find($p->id);
			$port->user_id = 10;
			$port->save();
		}
			
		foreach($user->category as $p){
			$category = Category::find($p->id);
			$category->user_id = 10;
			$category->save();
		}
		foreach($user->post as $p){
			$post = Post::find($p->id);
			$post->user_id = 10;
			$post->save();
		}
		
		$photo->deleteImage($user->profile->image, "profile");
		$user->delete();
	}
}
