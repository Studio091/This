<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Photo;

class PostController extends Controller
{
    //
	public function __construct()
    {
        $this->middleware('auth');
    }

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
		try{
			$edit = Post::find($id);
			if(is_null($edit))return Redirect::to('/cms/publish/');
			$post = Post::all();
			$category = Category::all();
			$option = false;
			return view('cms.category.post.index', compact('post','category', 'option', 'edit'));
		}catch(\Exception $e){
			return Redirect::to('/cms/publish/')->with('msg', ' Sorry something went worng. Please try again.');
		}	
		
	}
	public function editCategory($id){
		try{
			$edit = Category::find($id);
			if(is_null($edit))return Redirect::to('/cms/category/');
			$category = Category::all();
			$option = false;
			return view('cms.category.index', compact('category', 'edit', 'option'));
		}catch(\Exception $e){
			return Redirect::to('/cms/category/')->with('msg', ' Sorry something went worng. Please try again.');
		}
			
	
	}
	public function createCategory(Request $request){
		try{
			$category = new Category;
			$category->createCategory(new Category(request(['title', 'text'])));
			return Redirect::to('/cms/category');
		}catch(\Exception $e){
			return Redirect::to('/cms/category')->with('msg', ' Sorry something went worng. Please try again.');
		}
	
	}
	public function createPost(Request $request){
		try{
			$post = new Post; 
			$photo = new Photo;
			$name[0] = $photo->photo($request->file('image'), 'post');
			$post->createPost(new Post(request(['text', 'title', 'visible'])), $name[0], $request->category);
			return Redirect::to('/cms/publish');
		}catch(\Exception $e){
			return Redirect::to('/cms/publish')->with('msg', ' Sorry something went worng. Please try again.');
		}
			
		
	}
	public function updateCategory(Request $request, $id){
		try{
			$category = new Category;
			$category->updateCategory(new Category(request(['title','text'])), $id);
			return Redirect::to('/cms/category/'.$id);
		}catch(\Exception $e){
			return Redirect::to('/cms/category/'.$id)->with('msg', ' Sorry something went worng. Please try again.');
		}
			
		
	}
	
	public function updatePost(Request $request, $id){
		try{
			$post = new Post; 
			$photo = new Photo;
			$name[0] = $photo->photo($request->file('image'), 'post');
			$post->updatePost(new Post(request(['text', 'title', 'visible'])), $name[0], $request->category, $id);
			return Redirect::to('/cms/publish'.$id);
		}catch(\Exception $e){
			return Redirect::to('/cms/publish/'.$id)->with('msg', ' Sorry something went worng. Please try again.');
		}
		
		
	}
	public function deleteCategory($id){
		try{
			$category = new Category;
			$category->deleteCategory($id);
			return Redirect::to('/cms/category');
		}catch(\Exception $e){
			return Redirect::to('/cms/category')->with('msg', ' Sorry something went worng. Please try again.');
		}
			
		
	}
	public function deletePost($id){
		try{
			$post = new Post;
			$post->deletePost($id);
			return Redirect::to('/cms/publish');
		}catch(\Exception $e){
			return Redirect::to('/cms/publish')->with('msg', ' Sorry something went worng. Please try again.');
		}
			
	}
}