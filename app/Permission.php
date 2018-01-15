<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'user_id', 'sector', 'responsible'
    ];
	public function user(){
		return $this->belongsTo(User::class);
	}
	public function permission(){
		return $this->belongsTo(User::class);
	}
}
