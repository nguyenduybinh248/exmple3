<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Category extends Model
{
    //
	use Searchable;
	protected $table = 'categorys';
	protected $fillable = ['name'];
}
