<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
	protected $table = 'comments';
	protected $fillable = ['user_id', 'post_id', 'content'];
	public function post() {
		return $this->hasOne('App\Post', 'id', 'post_id');
	}
	public function user() {
		return $this->hasOne('App\User', 'id', 'user_id');
	}
	public function reply()
	{
		return $this->hasMany('App\Reply');
	}

}
