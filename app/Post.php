<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
//use Nicolaslopezj\Searchable\SearchableTrait;
class Post extends Model
{
    //
	use Searchable;
	protected $table = 'posts';//optional
	protected $fillable = ['title', 'description', 'content', 'thumnails', 'category_id', 'flag', 'slug', 'user_id'];
	public function category() {
		return $this->hasOne('App\Category', 'id', 'category_id');
	}
	public function user() {
		return $this->hasOne('App\User', 'id', 'user_id');
	}
	public function tags() {
		return $this->belongsToMany('App\Tag','post-tag','post_id','tag_id');
	}
	public function comment()
	{
		return $this->hasMany('App\Comment');
	}
	public function reply()
	{
		return $this->hasMany('App\Reply');
	}


//
//	public function tags() {
//		return $this->belongsToMany('App\Tag','post_tags','post_id','tag_id');
//	}
}
