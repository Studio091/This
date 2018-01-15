<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
     protected $fillable = [
        'title', 'text', 'user_id'
    ];
	public function user(){
		return $this->belongsTo(User::class);
	}
	public function photo(){
		return $this->hasMany(Photo::class);
	}
	public function addA(Album $album){
		$album->user_id = auth()->user()->id;
		$album->save();
		
	}
	public function updateA(Album $album, $id){
		$a = Album::find($id);
		
		$a->title = $album->title;
		$a->text = $album->text;
		if($a->save())true;
		
	}

	public function deleteAlbum($id){
		$album = Album::find($id);
		$photo = new Photo;
		
		foreach($album->photo  as $p){
			$photo = Photo::find($p->id);
			$photo->album_id = 1;
			$photo->save();
		}
		$album->delete();
	}
}
