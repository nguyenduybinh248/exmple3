<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
	public function comment(Request $request, $id){
		$arr = [
			'post_id'=>$id,
			'user_id'=>$request->user_id,
			'content'=>$request->contents
		];
			$comment = Comment::create($arr);
		$view = View::make('blog.rendercomment')->with('comment', $comment);
		$html = $view->render();
		return response()->json([
			'html' => $html
		]);
	}
	public function commentedit($id){
		$comment = Comment::find($id);
		if($comment->user_id === Auth::user()->id) {
			$user_id = Auth::user()->id;
			if ($comment->user_id === Auth::user()->id) {
				return response()->json([
					'comment' => $comment,
					'user_id' => $user_id,
				]);
			}
		}
	}

	public function commentupdate(Request $request, $id){
		$comment = Comment::find($id);
		if($comment->user_id === Auth::user()->id) {
			$arr = ['content' => $request->contents];
			Comment::where('id', $id)->update($arr);
			$comment = Comment::find($id);
			return $comment;
		}
	}

	public function commentdestroy($id){
		$comment = Comment::find($id);
		if($comment->user_id === Auth::user()->id or Auth::user()->id === 1 or Auth::user()->id === 2) {
			Comment::where('id', $id)->delete();
		}
	}

	public function reply(Request $request, $id){
		$arr = [
			'comment_id'=>$id,
			'user_id'=>$request->user_id,
			'content'=>$request->contents
		];
		$reply = Reply::create($arr);
		$view = View::make('blog.renderreply')->with('reply', $reply);
		$html = $view->render();
		return response()->json([
			'html' => $html
		]);
	}

	public function replyedit($id){
		$reply = Reply::find($id);
		if($reply->user_id === Auth::user()->id) {
			$user_id = Auth::user()->id;
			if ($reply->user_id === Auth::user()->id) {
				return response()->json([
					'reply' => $reply,
					'user_id' => $user_id,
				]);
			}
		}
	}

	public function replyupdate(Request $request, $id){
		$reply = Reply::find($id);
		if($reply->user_id === Auth::user()->id) {
			$arr = ['content' => $request->contents];
			Reply::where('id', $id)->update($arr);
			$reply = Reply::find($id);
			return $reply;
		}
	}

	public function replydestroy($id){
		$reply = Reply::find($id);
		if($reply->user_id === Auth::user()->id or Auth::user()->id === 1 or Auth::user()->id === 2) {
			Reply::where('id', $id)->delete();
		}
	}
}
