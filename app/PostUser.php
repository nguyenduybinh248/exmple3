<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostUser extends Model
{
    //
	protected $table = 'post-user';
	protected $fillable = ['post_id', 'user_id'];
}
