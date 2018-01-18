<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Work;
use App\Portfolio;
use App\Photo;
use App\User;

class WorkController extends Controller
{
    //
	public function indexWork(){
		$user = User::all();
		$work = Work::latest()->get();
		$category =  Portfolio::all();
		$option = true;
		return view('cms.portfolio.work.index', compact('user', 'option','category','work'));
	}
	public function editWork($id){
		
		$user = User::all();
		$category =  Portfolio::all();
		$work = Work::all();
		$edit = Work::find($id);
		if(is_null($edit)){
				session()->flash('warning', 'Erro 404');
				return Redirect::to('/cms/work/');
		}
		$option = false;
		return view('cms.portfolio.work.index', compact('user', 'option','category', 'edit', 'work'));	

	}
	public function createWork(Request $request){
		try{
			$work = new Work; 
			$photo = new Photo;
			$author[] = $request->author;
			$name[0] = $photo->photo($request->file('image'), 'portfolio');
			$post = $work->createWork(new Work(request(['text', 'title', 'visible', 'portfolio_id'])), $name[0], $author);
			$request->session()->flash('success', 'Work successfully added! Read here "<a href="/cms/view/'.$post->id.'" class="alert-link">'.$post->title.'</a>"');
			return Redirect::to('/cms/work/');
		}catch(\Exception $e){
			$request->session()->flash('warning', 'Record not added!');
			return Redirect::to('/cms/work/');
		}
	}
	public function updateWork(Request $request, $id){
		try{
			$work = new Work;
			$photo = new Photo;
			$author[] = $request->author;
			$name[0] = $photo->photo($request->file('image'), 'portfolio');
			$post = $work->updateWork(new Work(request(['text', 'title', 'visible', 'portfolio_id'])), $name[0], $author, $id);
			$request->session()->flash('success', 'Work successfully added! Read here "<a href="/cms/view/'.$post->id.'" class="alert-link">'.$post->title.'</a>"');
			return Redirect::to('/cms/work/'.$id);
		}catch(\Exception $e){
			$request->session()->flash('warning', 'Record not added!');
			return Redirect::to('/cms/work/'.$id);
		}
	}
	public function deleteWork($id){
		try{
			$work = new Work;
			$work->deleteWork($id);
			session()->flash('success', 'Work deleted successfully');
			return Redirect::to('/cms/work/');
		}catch(\Exception $e){
			session()->flash('warning', 'Record not deleted! erro'. $e->getMessage());
			return Redirect::to('/cms/work/');
		}
	}
	
	
	//Portfolio
	public function indexPortfolio(){
		$post = Work::all();
		$category = Portfolio::all();
		$option = true;
		return view('cms.portfolio.index',compact('post','category', 'option'));
	}
	
	public function editPortfolio($id){
		
		$post = Work::all();
		$edit = Portfolio::find($id);
		if(is_null($edit)){
			session()->flash('warning', 'Erro 404');
			return Redirect::to('/cms/portfolio/');
		}
		$category = Portfolio::all();
		$option = false;
		return view('cms.portfolio.index', compact('post','category', 'option', 'edit'));
			
		
	}
	public function createPortfolio(Request $request){
		try{
			$portfolio = new Portfolio;
			$portfolio->createPortfolio(new Portfolio(request(['title', 'text'])));
			$request->session()->flash('success', 'Record successfully added!');
			return Redirect::to('/cms/portfolio/');
		}catch(\Exception $e){
			$request->session()->flash('warning', 'Record not added!');
			return Redirect::to('/cms/portfolio/');
		}	
	}
	public function updatePortfolio(Request $request, $id){
		try{
			$portfolio = new Portfolio;
			$portfolio->updatePortfolio(new Portfolio(request(['title','text'])), $id);
			$request->session()->flash('success', 'Record successfully updated!');
			return Redirect::to('/cms/portfolio/'.$id);
		}catch(\Exception $e){
			$request->session()->flash('warning', 'Record not added! '. $e->getMessage());
			return Redirect::to('/cms/portfolio/'.$id);
		}
	}
	public function deletePortfolio($id){
		try{
			$portfolio = new Portfolio;
			$portfolio->deletePortfolio($id);
			session()->flash('success', 'Record successfully deleted!');
			return Redirect::to('/cms/portfolio/');
		}catch(\Exception $e){
			session()->flash('warning', 'Record not added! erro'. $e->getMessage());
			return Redirect::to('/cms/portfolio/');
		}
	}
	
}
