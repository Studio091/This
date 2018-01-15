<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = [
       'text', 'user_id', 
    ];
	public function permission(){
		return $this->belongsToMany(User::class, 'user_sector', 
      'sector_id', 'user_id')->withTimestamps();
	}
	public function createSector(Sector $sector){
		$sector->save();
	}
	public function updateSector(Sector $sector,  $id){
		$last = Sector::find($id);
		$last = $sector;
		$last->save();
	}
	public function deleteSector($id){
		$sector = Sector::find($id);
		$sector->save();
	}
}
