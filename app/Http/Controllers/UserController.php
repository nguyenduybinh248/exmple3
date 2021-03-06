<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\PostTag;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\View;

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

	public function search(Request $request){
		$search = $request->search;
		$users = User::search($search)->get();
		$view = View::make('admin.searchuser')->with('users', $users);
		$html = $view->render();
		return response()->json([
			'html' => $html
		]);
	}

	public function adminsearch(Request $request){
		$search = $request->search;
		$users = User::search($search)->where('isadmin', 1)->orWhere('isadmin', 2)->get();
		$view = View::make('admin.searchuser')->with('users', $users);
		$html = $view->render();
		return response()->json([
			'html' => $html
		]);
	}

	public function normalsearch(Request $request){
		$search = $request->search;
		$users = User::search($search)->where('isadmin', 0)->get();
		$view = View::make('admin.searchuser')->with('users', $users);
		$html = $view->render();
		return response()->json([
			'html' => $html
		]);
	}

	public function change(Request $request, $id){
		$isadmin = $request->isadmin ;
		$arr = ['isadmin'=>$isadmin];
		User::where('id', $id)->update($arr);
		$user = User::find($id);
		return $user;
//		return response()->json([
//			'user' => $user
//		]);
	}

}
