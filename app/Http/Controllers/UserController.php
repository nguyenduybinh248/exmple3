<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\PostTag;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public $user;
	public function __construct()
	{
		$this->user = new User();
	}

	public function index()
	{
		//
		return view('admin.user');
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
		$user = User::create($request->only('name'));
		$user->created = $user->created_at->diffForHumans();
		$user->updated = $user->updated_at->diffForHumans();

		return $user;
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
		return $user = User::find($id);
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
		$user = Category::find($id);
		$user->update($request->only('name'));
		$user->created = $user->created_at->diffForHumans();
		$user->updated = $user->updated_at->diffForHumans();
		return $user;
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
		$desuser = User::where('id', $id)->delete();
	}

	public function adminuser()
	{
		//
		$users = User::where('isadmin', 1)->orderBy('id', 'DESC')->paginate(10);

		return view('admin.adminuser',[
			'users' => $users,
		]);
	}

	public function nomaluser()
	{
		//
		$users = User::where('isadmin', 0)->orderBy('id', 'DESC')->paginate(10);

		return view('admin.normaluser',[
			'users' => $users,
		]);
	}

}
