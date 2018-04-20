<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Post;
use App\PostTag;
use App\Tag;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
	    $categorys = Category::orderBy('id','desc')->get();
	    View::share(compact('categorys'));

	    $posts = Post::orderBy('id','desc')->get();
	    View::share(compact('posts'));

	    $tags = Tag::orderBy('id','desc')->get();
	    View::share(compact('tags'));

	    $users = User::orderBy('id','desc')->get();
	    View::share(compact('users'));

	    $catecount = Category::count();

	    $postedcount = Post::where('flag', 1)->count();
	    $unpostedcount = Post::where('flag', 2)->count();
	    $waitingpostedcount = Post::where('flag', 0)->count();

	    $tagcount = Tag::count();

	    $admincount = User::where('isadmin', 1)->count() + 1 ;
	    $usercount = User::where('isadmin', 0)->count();
	    $viewposts = Post::where('flag', 1)->orderBy('view', 'DESC')->paginate(4);
	    $dateposts = Post::where('flag', 1)->orderBy('created_at', 'DESC')->paginate(4);
	    $tagposts = Tag::orderBy('created_at', 'DESC')->paginate(15);

	    View::share([
	    	'catecount'=>$catecount,
	    	'postedcount'=>$postedcount,
	    	'unpostedcount'=>$unpostedcount,
	    	'waitingpostedcount'=>$waitingpostedcount,
	    	'tagcount'=>$tagcount,
	    	'admincount'=>$admincount,
	    	'usercount'=>$usercount,
	    	'viewposts'=>$viewposts,
	    	'dateposts'=>$dateposts,
	    	'tagposts'=>$tagposts,
	    ]);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
