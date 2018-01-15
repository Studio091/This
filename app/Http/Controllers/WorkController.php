<?php

namespace App\Http\Controllers;

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
		$option = false;
		return view('cms.portfolio.work.index', compact('user', 'option','category', 'edit', 'work'));
	}
	public function indexPortfolio(){
		$post = Work::all();
		$category = Portfolio::all();
		$option = true;
		return view('cms.portfolio.index',compact('post','category', 'option'));
	}
	public function editPortfolio($id){
		$post = Work::all();
		$edit = Portfolio::find($id);
		$category = Portfolio::all();
		$option = false;
		return view('cms.portfolio.index', compact('post','category', 'option', 'edit'));
	}
	public function createPortfolio(Request $request){
		$portfolio = new Portfolio;
		$portfolio->createPortfolio(new Portfolio(request(['title', 'text'])));
	}
	public function updatePortfolio(Request $request, $id){
		$portfolio = new Portfolio;
		$portfolio->updatePortfolio(new Portfolio(request(['title','text'])), $id);
	}
	public function deletePortfolio($id){
		$portfolio = new Portfolio;
		$portfolio->deletePortfolio($id);
	}
	public function createWork(Request $request){
		$work = new Work; 
		$photo = new Photo;
		$author[] = $request->author;
		$name[0] = $photo->photo($request->file('image'), 'portfolio');
		$work->createWork(new Work(request(['text', 'title', 'visible', 'portfolio_id'])), $name[0], $author);
	}
	public function updateWork(Request $request, $id){
		$work = new Work;
		$photo = new Photo;
		$author[] = $request->author;
		$name[0] = $photo->photo($request->file('image'), 'portfolio');
		$work->updateWork(new Work(request(['text', 'title', 'visible', 'portfolio_id'])), $name[0], $author, $id);
	}
	public function deleteWork($id){
		$work = new Work;
		$work->deleteWork($id);
	}
}
