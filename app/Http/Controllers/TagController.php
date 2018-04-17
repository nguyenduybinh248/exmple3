<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\PostTag;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public $tag;
	public function __construct()
	{
		$this->tag = new Tag();
	}
    public function index()
    {
        //
	    $tags = Tag::orderBy('id', 'DESC')->paginate(10);

	    return view('admin.tag',[
		    'tags' => $tags
	    ]);
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
    public function store(Request $request)
    {
        //
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
	    return $tag = Tag::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
	    $tag = Tag::find($id);
	    $tag->update($request->only('name'));
	    $tag->created = $tag->created_at->diffForHumans();
	    $tag->updated = $tag->updated_at->diffForHumans();
	    return $tag;

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
	    $destag = Tag::where('id', $id)->delete();
    }
}
