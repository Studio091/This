<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Photo;

class PostController extends Controller
{
    //
	public function indexCategory(){
		$category = Category::all();
		$option = true;
		return view('cms.category.index', compact('category','option'));
	}
	public function indexPost(){
		$post = Post::all();
		$category = Category::all();
		$option = true;
		return view('cms.category.post.index', compact('post','category', 'option'));
	}
	public function editPost($id){
		//the test is here 
		$edit = Post::selectPost($id);
		if($edit){
		$edit = Post::find($id);
		$post = Post::all();
		$category = Category::all();
		$option = false;
		return view('cms.category.post.index', compact('post','category', 'option', 'edit'));
		}else{
		 return redirect()->back();
		}
	}
	public function editCategory($id){
		$edit = Category::selectCategory($id);
		if($edit){
		$category = Category::all();
		$option = false;
		return view('cms.category.index', compact('category', 'edit', 'option'));
		}else{
		 return redirect()->back();
		}
	}
	public function createCategory(Request $request){
		$category = new Category;
		$category->createCategory(new Category(request(['title', 'text'])));
	}
	public function createPost(Request $request){
		$post = new Post; 
		$photo = new Photo;
		$name[0] = $photo->photo($request->file('image'), 'post');
		$post->createPost(new Post(request(['text', 'title', 'visible'])), $name[0], $request->category);
	}
	public function updateCategory(Request $request, $id){
		$edit = Category::selectCategory($id);
		if($edit){
		$category = new Category;
		$category->updateCategory(new Category(request(['title','text'])), $id);
		}else{
		 return redirect()->back();
		}
	}
	
	public function updatePost(Request $request, $id){
		$edit = Post::selectPost($id);
		if($edit){
		$post = new Post; 
		$photo = new Photo;
		$name[0] = $photo->photo($request->file('image'), 'post');
		$post->updatePost(new Post(request(['text', 'title', 'visible'])), $name[0], $request->category, $id);
			}else{
		 return redirect()->back();
		}
	}
	public function deleteCategory($id){
		$edit = Category::selectCategory($id);
		if($edit){
		$category = new Category;
		$category->deleteCategory($id);
		}else{
		 return redirect()->back();
		}
	}
	public function deletePost($id){
		$edit = Post::selectPost($id);
		if($edit){
		$post = new Post;
		$post->deletePost($id);
		}else{
		 return redirect()->back();
		}
	}
}