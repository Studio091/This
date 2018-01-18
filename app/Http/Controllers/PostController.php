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
		$category = Category::latest()->get();
		$option = true;
		return view('cms.category.index', compact('category','option'));
	}
	public function indexPost(){
		$post = Post::latest()->get();
		$category = Category::latest()->get();
		$option = true;
		return view('cms.category.post.index', compact('post','category', 'option'));
	}
	public function Post(){
		$post = Post::latest()->get();
		$category = Category::latest()->get();
		$option = true;
		return view('cms.category.post.create', compact('post','category', 'option'));
	}
	public function editPost($id){
		//the test is here 
		
			$edit = Post::find($id);
			if(is_null($edit)){
				session()->flash('warning', 'Erro 404');
				return Redirect::to('/cms/publish/');
			}
			$post = Post::all();
			$category = Category::all();
			$option = false;
			return view('cms.category.post.create', compact('post','category', 'option', 'edit'));
		
		
	}
	public function editCategory($id){
		
			$edit = Category::find($id);
			if(is_null($edit)){
				session()->flash('warning', 'Erro 404');
				return Redirect::to('/cms/category/');
			}
			$category = Category::all();
			$option = false;
			return view('cms.category.index', compact('category', 'edit', 'option'));
	
	}
	public function createCategory(Request $request){
		try{
			$category = new Category;
			$category->createCategory(new Category(request(['title', 'text'])));
			$request->session()->flash('success', 'Record successfully added!');
			return Redirect::to('/cms/category');
		}catch(\Exception $e){
			$request->session()->flash('warning', 'Record not added!');
			return Redirect::to('/cms/category');
		}
	
	}
	public function createPost(Request $request){
		try{
			$post = new Post; 
			$photo = new Photo;
			if(!is_null($request->file('image'))){
				$name[0] = $photo->photo($request->file('image'), 'post');
			}else{
				$name[0] = "default.jpg";
			}
			$post = $post->createPost(new Post(request(['text', 'title', 'visible'])), $name[0], $request->category);
			$request->session()->flash('success', 'Post successfully added! Read here "<a href="'.$post->id.'" class="alert-link">'.$post->title.'</a>"');
			return Redirect::to('/cms/publish');
		}catch(\Exception $e){
			$request->session()->flash('warning', 'Record not added!');
			return Redirect::to('/cms/publish');
		}
			
		
	}
	public function updateCategory(Request $request, $id){
		try{
			$category = new Category;
			$category->updateCategory(new Category(request(['title','text'])), $id);
			$request->session()->flash('success', 'Record successfully updated!');
			return Redirect::to('/cms/category/'.$id);
		}catch(\Exception $e){
			$request->session()->flash('warning', 'Record not added! ');
			return Redirect::to('/cms/category/'.$id);
		}
			
		
	}
	
	public function updatePost(Request $request, $id){
		try{
			$post = new Post; 
			$photo = new Photo;
			if(!is_null($request->file('image'))){
				$name[0] = $photo->photo($request->file('image'), 'post');
			}else{
				$name[0] = "default.jpg";
			}
			$post->updatePost(new Post(request(['text', 'title', 'visible'])), $name[0], $request->category, $id);
			$request->session()->flash('success', 'Post successfully added! Read here "<a href="'.$post->id.'" class="alert-link">'.$post->title.'</a>"');
			return Redirect::to('/cms/publish'.$id);
		}catch(\Exception $e){
			$request->session()->flash('warning', 'Record not added! ');
			return Redirect::to('/cms/publish/'.$id);
		}
		
		
	}
	public function deleteCategory($id){
		try{
			$category = new Category;
			$category->deleteCategory($id);
			session()->flash('success', 'Category deleted successfully');
			return Redirect::to('/cms/category');
		}catch(\Exception $e){
			$request->session()->flash('warning', 'Record not added! erro');
			return Redirect::to('/cms/category');
		}
			
		
	}
	public function deletePost($id){
		try{
			$post = new Post;
			$post->deletePost($id);
			session()->flash('success', 'Post deleted successfully');
			return Redirect::to('/cms/publish');
		}catch(\Exception $e){
			$request->session()->flash('warning', 'Record not added! erro');
			return Redirect::to('/cms/publish');
		}
			
	}
}