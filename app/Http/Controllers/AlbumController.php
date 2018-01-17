<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Album;
use App\Photo;


class AlbumController extends Controller
{	
	//albums
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexAlbum(){
		$album = Album::all();
		$option = true;
		return view('cms.album.index', compact('album','option'));
	}
	public function editAlbum($id){
		try{
			$option = false;
			$edit = Album::find($id);
			if(is_null($edit))return Redirect::to('/cms/album/');
			$album = Album::all();
			return view('cms.album.index', compact('album', 'option', 'edit'));
		}catch(\Exception $e){
			return Redirect::to('/cms/')->with('msg', ' Sorry something went worng. Please try again.');
		}
	}
	public function updateAlbum(Request $request, $id){
		try{
			$album = new Album;
			$album->updateA(new Album(request(['title','text'])), $id);	
			return Redirect::to('/cms/album/');
		}catch(\Exception $e){
			return Redirect::to('/cms/')->with('msg', ' Sorry something went worng. Please try again.');
		}
	}
	public function deleteAlbum($id){
		try{
			$album = new Album;
			$album->deleteAlbum($id);
			return Redirect::to('/cms/album/');
		}catch(\Exception $e){
			return Redirect::to('/cms/')->with('msg', ' Sorry something went worng. Please try again.');
		}
	}
	
	//Photos
	public function indexPhoto($id){
		
			$album = Album::find($id);
			if(is_null($album))return Redirect::to('/cms/album/')->with('msg', ' Sorry something went worng. Please try again.');
			return view('cms.album.photo.index', compact('album'));
		
	}
	public function createPhoto(Request $request, $id){
		try{
			$photo = new Photo;
			$name = $photo->photo($request->file('image'), 'photos');
			$photo->createPhoto($request->text, $name, $id);
			return Redirect::to('/cms/album/'.$id);
		}catch(\Exception $e){
			return Redirect::to('/cms/album')->with('msg', ' Sorry something went worng. Please try again.');
		}
			
	}
	public function deletePhoto(Request $request, $id){
		
	}
}

