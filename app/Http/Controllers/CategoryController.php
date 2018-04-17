<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\PostTag;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public $category;
	public function __construct()
	{
		$this->category = new Category();
	}

    public function index()
    {
        //
	    return view('admin.category');
    }

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
    public function store(CategoryRequest $request)
    {
	    $category = Category::create($request->only('name'));
	    $category->created = $category->created_at->diffForHumans();
	    $category->updated = $category->updated_at->diffForHumans();

	    return $category;
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
//	    $cate_name = Category::select('name')->where('id', $id)->get();
//	    $cate_names = json_decode($cate_name, true);
//	    $arrcate = ['name' => $cate_names[0]['name']];
//	    return view('admin.post-of-category', $arrcate);

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
	    return $category = Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        //
	    $category = Category::find($id);
	    $category->update($request->only('name'));
	    $category->created = $category->created_at->diffForHumans();
	    $category->updated = $category->updated_at->diffForHumans();
	    return $category;
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
	    $count_post = Post::where('category_id', $id)->count();
	    if($count_post == 0){
		    $category = Category::find($id)->delete();
//		    $reponse = ['error'=> 0];

	    }
	    else{
		    return response()->json(['error' => true]);
	      }
    }
}
