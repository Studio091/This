<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $fillable = [
        'image', 'text', 'user_id', 'visible', 'title', 'category'
    ];
	public function user(){
		return $this->belongsTo(User::class);
	}
	public function category(){
		return $this->belongsToMany(Category::class, 'category_post', 
      'post_id', 'category_id')->withTimestamps();
	}
	public static function selectPost($id){
		$test = Post::find($id);
		if(is_null($test)){
			return false;
		}else{
			return true;
		}
	}
	public function createPost(Post $post, $name, $category){
		$post->image = $name[0];
		$post->user_id = auth()->user()->id;
		$post->save();
		$post->all()->last();
		$post->relation($post, $category);
		return $post;
		
	}
	public function updatePost(Post $post, $name, $category, $id){
		$aux = Post::find($id);
		$aux->image = $name[0];
		$aux->title = $post->test($post->title, $aux->title);
		$aux->text = $post->test($post->text, $aux->text);
		$aux->image = $post->test($post->image, $aux->image);
		$aux->visible = $post->test($post->visible, $aux->visible);
		
		$aux->save();
		$aux->relation($aux, $category);
		return $post;
	}
	public function deletePost($id){
		$post = Post::find($id);
		$photo = new Photo;
		$photo->deleteImage($post->image, "post");
		$post->delete();
	}
	
	public function relation(Post $post, $category){
	$cont=0; 
		//here I delete all before relations 
		foreach($post->category as $p){
			if($p->pivot->category_id > 0){
				$post->category()->detach();
			}
		}
		if(count($category) == null)
			$post->category()->attach(1);
		else
		while(count($category)!=$cont){
			$post->category()->attach($category[$cont]);
			$cont++;
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
