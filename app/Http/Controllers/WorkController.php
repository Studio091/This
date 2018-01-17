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
		try{
			$user = User::all();
			$category =  Portfolio::all();
			$work = Work::all();
			$edit = Work::find($id);
			if(is_null($edit))return Redirect::to('/cms/work/');
			$option = false;
			return view('cms.portfolio.work.index', compact('user', 'option','category', 'edit', 'work'));
		}catch(\Exception $e){
			return Redirect::to('/cms/')->with('msg', ' Sorry something went worng. Please try again.');
		}	
		
	}
	public function indexPortfolio(){
		$post = Work::all();
		$category = Portfolio::all();
		$option = true;
		return view('cms.portfolio.index',compact('post','category', 'option'));
	}
	public function editPortfolio($id){
		try{
			$post = Work::all();
			$edit = Portfolio::find($id);
			if(is_null($edit))return Redirect::to('/cms/portfolio/');
			$category = Portfolio::all();
			$option = false;
			return view('cms.portfolio.index', compact('post','category', 'option', 'edit'));
		}catch(\Exception $e){
			return Redirect::to('/cms/')->with('msg', ' Sorry something went worng. Please try again.');
		}	
		
	}
	public function createPortfolio(Request $request){
		try{
			$portfolio = new Portfolio;
			$portfolio->createPortfolio(new Portfolio(request(['title', 'text'])));
			return Redirect::to('/cms/portfolio/');
		}catch(\Exception $e){
			return Redirect::to('/cms/portfolio/')->with('msg', ' Sorry something went worng. Please try again.');
		}	
	}
	public function updatePortfolio(Request $request, $id){
		try{
			$portfolio = new Portfolio;
			$portfolio->updatePortfolio(new Portfolio(request(['title','text'])), $id);
			return Redirect::to('/cms/portfolio/'.$id);
		}catch(\Exception $e){
			return Redirect::to('/cms/portfolio/'.$id)->with('msg', ' Sorry something went worng. Please try again.');
		}
	}
	public function deletePortfolio($id){
		try{
			$portfolio = new Portfolio;
			$portfolio->deletePortfolio($id);
			return Redirect::to('/cms/portfolio/');
		}catch(\Exception $e){
			return Redirect::to('/cms/portfolio/')->with('msg', ' Sorry something went worng. Please try again.');
		}
	}
	public function createWork(Request $request){
		try{
			$work = new Work; 
			$photo = new Photo;
			$author[] = $request->author;
			$name[0] = $photo->photo($request->file('image'), 'portfolio');
			$work->createWork(new Work(request(['text', 'title', 'visible', 'portfolio_id'])), $name[0], $author);
			return Redirect::to('/cms/work/');
		}catch(\Exception $e){
			return Redirect::to('/cms/work/')->with('msg', ' Sorry something went worng. Please try again.');
		}
	}
	public function updateWork(Request $request, $id){
		try{
			$work = new Work;
			$photo = new Photo;
			$author[] = $request->author;
			$name[0] = $photo->photo($request->file('image'), 'portfolio');
			$work->updateWork(new Work(request(['text', 'title', 'visible', 'portfolio_id'])), $name[0], $author, $id);
			return Redirect::to('/cms/work/'.$id);
		}catch(\Exception $e){
			return Redirect::to('/cms/work/'.$id)->with('msg', ' Sorry something went worng. Please try again.');
		}
	}
	public function deleteWork($id){
		try{
			$work = new Work;
			$work->deleteWork($id);
			return Redirect::to('/cms/work/');
		}catch(\Exception $e){
			return Redirect::to('/cms/work/')->with('msg', ' Sorry something went worng. Please try again.');
		}
	}
}
