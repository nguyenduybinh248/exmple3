<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Post;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	    factory(Category::class, 5)->create();

    }
}
