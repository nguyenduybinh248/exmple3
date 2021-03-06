<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Post;
use App\Category;
use App\PostTag;
use App\Tag;
Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
	Route::get('/', function (){
		return view('admin.dashboard');
	});
	Route::resource('category','CategoryController');
	Route::get('/category/{category}', 'PostController@indexcatepost');
	Route::post('/category/search', 'CategoryController@search');
	Route::resource('post','PostController');
	Route::post('/post/search', 'PostController@search');
//	Route::get('bookings.data', 'PostController@bookingData')
//		->name('bookings.data');
	Route::resource('tag','TagController');
	Route::post('/tag/search', 'TagController@search');
	Route::get('/tag/{tag}', 'PostController@indextagpost');
	Route::put('post/{post}/editflag','Postcontroller@editflag');
	Route::get('/posted','PostController@indexposted');
	Route::post('/posted/search', 'PostController@searchposted');
	Route::get('/unposted','PostController@indexunposted');
	Route::post('/unpost/search', 'PostController@searchunpost');
	Route::get('/waiting','PostController@indexwaiting');
	Route::post('/waitting/search', 'PostController@searchwait');
	Route::post('/postimg','PostController@postimg');
	Route::resource('user','UserController');
	Route::post('/user/search', 'UserController@search');
	Route::post('/adminuser/search', 'UserController@adminsearch');
	Route::post('/normaluser/search', 'UserController@normalsearch');
	Route::put('/user/change/{user}', 'UserController@change');
	Route::get('/user/{user}', 'PostController@indexuserpost');
	Route::get('/adminuser', 'UserController@adminuser');
	Route::get('/normaluser', 'UserController@nomaluser');
});
Route::post('/postimg','PostController@postimg');
Route::resource('post','PostController');
Route::get('/', 'BlogController@index');
Route::get('/category/{category}', 'BlogController@indexcate');
Route::get('/tag/{tag}', 'BlogController@indextag');
Route::get('/post/{post}', 'BlogController@indexpost');
Route::get('/user/{user}', 'BlogController@indexuser');
Route::get('/profile/{id}', 'ProfileController@index')->middleware('auth');
Route::put('/profile/{id}', 'ProfileController@update')->middleware('auth');
Route::put('/changepassword/{id}', 'ProfileController@changepassword')->middleware('auth');
Route::put('/avatar/{id}', 'ProfileController@avatar')->middleware('auth');
Route::get('/profile/{id}/edit', 'ProfileController@edit')->middleware('auth');
Route::delete('/profile/{id}', 'ProfileController@destroy')->middleware('auth');
Route::post('/comment/{id}', 'CommentController@comment')->middleware('auth');
Route::get('/comment/{id}/edit', 'CommentController@commentedit')->middleware('auth');
Route::put('/comment/{id}', 'CommentController@commentupdate')->middleware('auth');
Route::delete('/comment/{id}', 'CommentController@commentdestroy')->middleware('auth');
Route::post('/reply/{id}', 'CommentController@reply')->middleware('auth');
Route::get('/reply/{id}/edit', 'CommentController@replyedit')->middleware('auth');
Route::put('/reply/{id}', 'CommentController@replyupdate')->middleware('auth');
Route::delete('/reply/{id}', 'CommentController@replydestroy')->middleware('auth');
Route::get('/search', 'BlogController@search');
Route::get('/result', 'BlogController@indexsearch');


Route::get('/auth/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('/auth/{provide}/callback', 'SocialAuthController@handleProviderCallback');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');


