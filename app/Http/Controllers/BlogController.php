<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Comment;
use App\Reply;
use App\PostTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BlogController extends Controller
{
    //
	public function index()
	{
		//
		$posts = Post::where('flag', 1)->orderBy('id', 'DESC')->paginate(5);
		return view('blog.index',[
			'posts' => $posts,
		]);
	}

	public function indextag($id)
	{
		//
		$tag = Tag::find($id);
		$posts = $tag->posts()->where('flag', 1)->paginate(5);
//		$dateposts = Post::where('flag', 1)->orderBy('created_at', 'DESC')->paginate(5);
		return view('blog.blog-tag',[
			'posts' => $posts,
		]);
	}

	public function indexcate($id)
	{
		//
		$posts = Post::where('category_id', $id)->where('flag', 1)->paginate(5);
		return view('blog.blog-category',[
			'posts' => $posts,
		]);
	}

	public function indexuser($id)
	{
		//

		$posts = Post::where('user_id', $id)->where('flag', 1)->paginate(5);
		return view('blog.blog-user',[
			'posts' => $posts,
		]);
	}

	public function indexpost($id)
	{
		//
		$post = Post::find($id);
		if ($post->flag === 1 or $post->user->id === Auth::user()->id or Auth::user()->id === 1 or Auth::user()->id === 2 ){
			$view = Post::where('id',$id)->get()[0]['view'];
			$view = $view + 1;
			Post::where('id',$id)->update(['view'=>$view]);
			$post = Post::find($id);
			$previous = Post::where('id', '<', $id)->max('id');
			$next = Post::where('id', '>', $id)->min('id');
			$comments = $post->comment;
			$max_id = Post::max('id');
			$min_id = Post::min('id');
			if ($id == $max_id){
				$linkprev = 'post/'.$previous;
				$linknext = 0;
			}
			elseif ($id == $min_id){
				$linknext = 'post/'.$next;
				$linkprev = 0;
			}
			else{
				$linkprev = 'post/'.$previous;
				$linknext = 'post/'.$next;
			}
			return view('blog.blog-post',[
				'post' => $post,
				'linknext'=>$linknext,
				'linkprev'=>$linkprev,
				'comments'=>$comments,
			]);
		}
	}

	public function search(Request $request){
		$search = $request->search;
		$match = Post::search($search)->get()->pluck('id');
		$match2 = Post::whereIn('id', $match)->orWhereHas('user', function ($query) use($search){
			$query->where('username', 'like', '%'.$search.'%');
		})->orWhereHas('category', function ($q) use($search){
			$q->where('name', 'like', '%'.$search.'%');
		})->get()->pluck('id');
		$posts = Post::whereIn('id', $match2)->where('flag', 1)->paginate(5);
		$view = View::make('blog.resultsearch')->with('posts', $posts);
		$html = $view->render();
		return response()->json([
			'html' => $html
		]);
	}

	public function indexsearch(Request $request){
		if($request->has('search')){
			$search = $request->search;
			$match = Post::search($search)->get()->pluck('id');
			$match2 = Post::whereIn('id', $match)->orWhereHas('user', function ($query) use($search){
				$query->where('username', 'like', '%'.$search.'%');
			})->orWhereHas('category', function ($q) use($search){
				$q->where('name', 'like', '%'.$search.'%');
			})->get()->pluck('id');
			$posts = Post::whereIn('id', $match2)->where('flag', 1)->get();
			return view('blog.indexsearch',compact('posts'));
		}
		else{
			return redirect()->back();
		}
	}
}
