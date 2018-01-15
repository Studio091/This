<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'title', 'text','image', 'portfolio_id'
    ];
	
	public function user(){
		return $this->belongsToMany(Category::class, 'user_work', 
      'work_id', 'user_id')->withTimestamps();
	}
	
	public function porfolio(){
		return $this->belongsTo(Portfolio::class);
	}
	public function createWork(Work $work, $name, $user){
		$work->image = $name[0];
		$work->save();
		$work->all()->last();
		$work->relation($work, $user);
	}
	public function updateWork(Work $work, $name, $user, $id){
		$aux = Work::find($id);
		$aux->image = $name[0];
		$aux->title = $work->test($work->title, $aux->title);
		$aux->text = $work->test($work->text, $aux->text);
		$aux->image = $work->test($work->image, $aux->image);
		$aux->visible = $work->test($work->visible, $aux->visible);
		$aux->portfolio_id = $work->test($work->portfolio_id, $aux->portfolio_id);
		
		$aux->save();
		$aux->relation($aux, $user);
	}
	
	public function relation(Work $work, $user){
		
		$cont=0; 

		//here I delete all before relations 
		foreach($work->user as $p){
			if($p->pivot->user_id > 0){
				$work->user()->detach();
			}
		}
		
		if(empty($user)){
			$work->user()->attach(1);
		}else{
		while(count($user)!=$cont){
			$work->user()->attach($user[$cont]);
			$cont++;
			}
		}
	}
		
	public function deleteWork($id){
		$post = Work::find($id);
		
		$post->delete();
	}
	public function test($new, $old){
		if(is_null($new)){
			return($old);
		}else{
			return($new);
		}
	}

	
}
