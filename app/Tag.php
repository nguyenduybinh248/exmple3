<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Tag extends Model
{
	//
	use Searchable;
	protected $table = 'tags';
	protected $fillable= ['name'];
	public function posts() {
		return $this->belongsToMany('App\Post','post-tag','tag_id','post_id');
	}
}
