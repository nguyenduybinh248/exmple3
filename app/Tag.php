<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	//
	protected $table = 'tags';
	protected $fillable= ['name'];
	public function posts() {
		return $this->belongsToMany('App\Post','post-tag','tag_id','post_id');
	}
}
