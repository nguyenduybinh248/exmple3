<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Reply;
use Illuminate\Http\Request;

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
			$comment->created = $comment->created_at->diffForHumans();
			$user = $comment->user;
		return response()->json([
			'comment'=>$comment,
			'user'=>$user
		]);
	}

	public function reply(Request $request, $id){
		$arr = [
			'comment_id'=>$id,
			'user_id'=>$request->user_id,
			'content'=>$request->contents
		];
		$reply = Reply::create($arr);
		$reply->created = $reply->created_at->diffForHumans();
		$user = $reply->user;
		return response()->json([
			'reply'=>$reply,
			'user'=>$user
		]);
	}
}
