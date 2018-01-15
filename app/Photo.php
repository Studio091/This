<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Photo extends Model
{
    protected $fillable = [
        'image', 'text', 'user_id', 'album_id',
    ];
	public function user(){
		return $this->belongsTo(User::class, 'user_id');
	}
	public function album(){
		return $this->belongsTo(Album::class, 'album_id');
	}
	public function createPhoto($text, $image, $id){
		$cont = 0; $album = Album::find($id);
	
		if(strlen($image[0]) >= 1){
			while(count($image) != $cont){
				$photo =  new Photo;
				$photo->image = $image[$cont];
				$photo->user_id = auth()->user()->id;
				$photo->text = $text;
				$album->photo()->save($photo);
				$cont++;
			}
			
		}else{
			return false;
		}	
	}
	public function deletePhoto(Photo $photo){
		$photo->deleteImage($photo->image, 'photos');
		$photo->delete();
	}
	public function photo($files, $path){
		$cont = 0; $name[0] = ""; $path = public_path(). '/albuns/'.$path;

		if (!empty($files)) {
			foreach ($files as $file) {
				$extension = $file->getClientOriginalExtension();
				$filename = str_random(12) . ".{$extension}";
				$upload_success = $file->move($path, $filename);
				$name[$cont] = $filename;
				$cont++;
	}}
		return $name;
			
	}
	public function deleteImage($image, $album){
		$path = public_path().'/albuns/'.$album.'/'.$image;
		File::delete($path);
		
		return true;
	}
	
}
