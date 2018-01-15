<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'text', 'user_id',
    ];
	public function user(){
		return $this->belongsTo(User::class);
	}
	public function post(){
		return $this->belongsToMany(Post::class, 'category_post', 
      'post_id', 'category_id')->withTimestamps();
	}
	public static function selectCategory($id){
		$test = Category::find($id);
		if(is_null($test)){
			return false;
		}else{
			return true;
		}
	}
	public function createCategory(Category $category){
		$category->user_id = auth()->user()->id;
		$category->save();
	}
	public function updateCategory(Category $category, $id){
		$c = Category::find($id);
		$c->title = $category->title;
		$c->text = $category->text;
		$c->save();
	}
	public function deleteCategory($id){
		$category = Category::find($id);
		$post = new Post;
		
		foreach($category->Post as $c){
			if($c->pivot->post_id > 0){
				$post = Post::find($c->pivot->post_id);
				$post->category()->attach(1);
			}
		}
		$category->post()->detach();
		
		$category->delete();
		
	}
	
}
