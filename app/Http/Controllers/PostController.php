<?php

namespace App\Http\Controllers;


use App\Category;
use App\User;
use Illuminate\Http\Request;
//use Yajra\DataTables\Contracts\DataTable;
//use Yajra\Datatables\DataTables;
use App\Post;
use App\Tag;

use App\PostTag;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostEditRequest;
//use Illuminate\View\View;
use Illuminate\Support\Facades\View;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
	    $posts = Post::orderBy('id', 'DESC')->paginate(10);

	    return view('admin.post',[
		    'posts' => $posts,
	    ]);


    }
//	public function bookingData()
//	{
//		return DataTables::of(Post::query())->make(true);
//
//	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
	    //
	    $now = date('Y/m/d H:i:s');
	    $title = $request->title;
	    $slug = str_slug($title);
	    $description = $request->description;
	    $contents = $request->contents;
	    $category_id = $request->category_id;
	    $user_id = Auth::user()->id;
	    $file = $request->thumnails;
	    $path = 'img/' . $file;
	    $array = [
		    'title' => $title,
		    'description' => $description,
		    'content' => $contents,
		    'category_id' => $category_id,
		    'user_id' => $user_id,
		    'thumnails' => $path,
		    'slug' => $slug,
		    'flag' => 0,
	    ];
	    $post = Post::create($array);
	    $post_id = Post::where('slug', $slug)->get()[0]['id'];
	    foreach ($request->tags as $key => $value) {
		    $arr = ['name' => $value];
		    $count = Tag::where('name', $value)->count();
		    if ($count == 0) {
			    $tag = Tag::create($arr);
		    }
		    $tag_id = Tag::where('name', $value)->get()[0]['id'];
		    $arr2 = ['post_id' => $post_id, 'tag_id' => $tag_id];
		    $cata_tag = PostTag::create($arr2);

	    }

	    $created = $post->created_at->diffForHumans();
	    $updated = $post->created_at->diffForHumans();
	    return response()->json([
	    	'post'=>$post,
		    'category'=>$post->category->name,
		    'author'=>$post->user->username,
		    'created'=>$created,
		    'updated'=>$updated,

	    ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
	    $post = Post::find($id);
	    $cataname = $post->category->name;
	    $tags = $post->tags;
	    $author = $post->user->name;
	    return response()->json(['post'=>$post]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    //
	    $post = Post::find($id);
	    if ($post->user_id === Auth::user()->id or Auth::user()->isadmin === 1 or Auth::user()->isadmin === 2) {
		    $tags = $post->tags;
		    $category_id = $post->category->id;
		    return response()->json([
			    'post' => $post,
			    'category_id' => $category_id,
			    'tags' => $tags
		    ]);
	    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditRequest $request, $id)
    {
	    //
	    $post = Post::find($id);
	    if ($post->user_id === Auth::user()->id or Auth::user()->isadmin === 1 or Auth::user()->isadmin === 2) {
		    $title = $request->title;
		    $slug = str_slug($title);
		    $description = $request->description;
		    $contents = $request->contents;
		    $category_id = $request->category_id;
		    $user_id = Auth::user()->id;
		    if (isset($request->thumnails)) {
			    $path = $request->thumnails;
		    } else {
			    $path = Post::where('id', $id)->get()[0]['thumnails'];
		    }

		    $array = [
			    'title' => $title,
			    'description' => $description,
			    'content' => $contents,
			    'category_id' => $category_id,
			    'user_id' => $user_id,
			    'thumnails' => $path,
			    'slug' => $slug,
			    'flag' => 0,
		    ];
		    Post::where('id', $id)->update($array);
		    $post = Post::find($id);
		    PostTag::where('post_id', $id)->delete();
		    foreach ($request->tags as $key => $value) {
			    $arr = ['name' => $value];
			    $count = Tag::where('name', $value)->count();
			    if ($count == 0) {
				    Tag::create($arr);
			    }
			    $tag_id = Tag::where('name', $value)->get()[0]['id'];
			    $arr2 = ['post_id' => $id, 'tag_id' => $tag_id];
			    PostTag::create($arr2);

		    }
		    $created = $post->created_at->diffForHumans();
		    $updated = $post->created_at->diffForHumans();
		    return response()->json([
			    'post' => $post,
			    'category' => $post->category->name,
			    'category_id' => $post->category->id,
			    'author' => $post->user->username,
			    'created' => $created,
			    'updated' => $updated,

		    ]);

	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
	    $post = Post::find($id);
	    if ($post->user_id === Auth::user()->id or Auth::user()->isadmin === 1 or Auth::user()->isadmin === 2){
		    $despost = Post::where('id', $id)->delete();
	    }


    }

	public function editflag(Request $request, $id)
	{
		//
		$post = Post::find($id);
		$post->update($request->only('flag'));
		$count = Post::where('flag', 1)->count();
		$abc = Post::where('flag', 1)->where('id', '<', $id)->count() + 1;
		$hieu = $count - $abc;
		$page = ($hieu - ($hieu % 5))/5 +1;
		$stt = $count - $page * 5;
		if($stt === 0){
			$html = View::make('blog.blank')->render();
			return response()->json([
				'html' => $html
			]);
		}
		else {
			$post = Post::where('flag', 1)->limit(1)->offset($stt)->first();
			$view = View::make('blog.indexrender')->with('post', $post);
			$html = $view->render();
			return response()->json([
				'html' => $html
			]);
		}

	}
	public function indexposted()
	{
		//
		$posts = Post::where('flag', 1)->orderBy('id', 'DESC')->paginate(10);

		return view('admin.posted',[
			'posts' => $posts,
		]);
	}

	public function indexunposted()
	{
		//
		$posts = Post::where('flag', 2)->orderBy('id', 'DESC')->paginate(10);

		return view('admin.unposted',[
			'posts' => $posts,
		]);
	}

	public function indexwaiting()
	{
		//
		$posts = Post::where('flag', 0)->orderBy('id', 'DESC')->paginate(10);

		return view('admin.waitingpost',[
			'posts' => $posts,
		]);
	}

	public function indexcatepost($id)
	{
		//
		$posts = Post::where('category_id', $id)->orderBy('id', 'DESC')->paginate(10);
		$catename = Category::where('id', $id)->get()[0]['name'];
		$abc = ['posts'=>$posts, 'cate' => $catename];

		return view('admin.post-of-category',$abc);
	}

	public function indexuserpost($id)
	{
		//
		$posts = Post::where('user_id', $id)->orderBy('id', 'DESC')->paginate(10);
		$username = Category::where('id', $id)->get()[0]['username'];
		$abc = ['posts'=>$posts, 'username' => $username];

		return view('admin.post-of-user',$abc);
	}

	public function indextagpost($id)
	{
		//
		$tag = Tag::find($id);
		$tagname =$tag[0]['name'];
		$posts = $tag->posts;
		$posts = $posts;
		$abc = ['posts'=>$posts, 'name' => $tagname];
		return view('admin.post-of-tag',$abc);
	}

	public function postimg(Request $request){
		if ( $_FILES['thumnails']['error'] > 0 ){
			echo 'Error: ' . $_FILES['thumnails']['error'] . '<br>';
		}
		else {
			if(move_uploaded_file($_FILES['thumnails']['tmp_name'], 'img/' . $_FILES['thumnails']['name']))
			{
				return "File Uploaded Successfully";
			}
		}


	}

}
