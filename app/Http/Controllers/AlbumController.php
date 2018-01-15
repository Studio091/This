<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\Photo;


class AlbumController extends Controller
{	
	//albums
	
    public function indexAlbum(){
		$album = Album::all();
		$option = true;
		return view('cms.album.index', compact('album','option'));
	}
	public function editAlbum($id){
		$option = false;
		$edit = Album::find($id);
		$album = Album::all();
		return view('cms.album.index', compact('album', 'option', 'edit'));
	}
	public function updateAlbum(Request $request, $id){
		$album = new Album;
		$album->updateA(new Album(request(['title','text'])), $id);	
	}
	public function deleteAlbum($id){
		$album = Album::find($id)->delete();
	}
	
	//Photos
	public function indexPhoto($id){
		$album = Album::find($id);
		return view('cms.album.photo.index', compact('album'));
	}
	public function createPhoto(Request $request, $id){
		$photo = new Photo;
		$name = $photo->photo($request->file('image'), 'photos');
		$photo->createPhoto($request->text, $name, $id);
			
	}
	public function deletePhoto(Request $request, $id){
		
	}
}

