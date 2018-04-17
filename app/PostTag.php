<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    //
	protected $table = 'post-tag';
	protected $fillable = ['post_id', 'tag_id'];
}
