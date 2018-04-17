<?php

use Illuminate\Database\Seeder;
use App\PostUser;
class PostUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	    factory(PostUser::class, 50)->create();
    }
}
