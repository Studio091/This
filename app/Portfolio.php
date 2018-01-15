<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title', 'text', 'user_id',
    ];
	public function user(){
		return $this->belongsTo(User::class);
	}
	public function work(){
		return $this->hasMany(Work::class);
	}
	public function createPortfolio(Portfolio $portfolio){
		$portfolio->user_id = auth()->user()->id;
		$portfolio->save();
	}
	public function updatePortfolio(Portfolio $post, $id){
		$aux = Portfolio::find($id);
		$aux->title = $post->test($post->title, $aux->title);
		$aux->text = $post->test($post->text, $aux->text);
		$aux->save();
	}
	public function deletePortfolio($id){
		$work = new Work;
		$portfolio = Portfolio::find($id);
		foreach($portfolio->work as $w){
			$work = Work::find($w->id);
			$work->portfolio_id = 1;
			$work->save();
		}
		$portfolio->delete();
	}
	public function test($new, $old){
		if(is_null($new)){
			return($old);
		}else{
			return($new);
		}
	}
}
