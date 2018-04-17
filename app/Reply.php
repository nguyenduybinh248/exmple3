<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
	protected $table = 'replies';
	protected $fillable = ['comment_id', 'content','user_id'];
	public function comment() {
		return $this->hasOne('App\Comment', 'id', 'comment_id');
	}
	public function user() {
		return $this->hasOne('App\User', 'id', 'user_id');
	}
}
