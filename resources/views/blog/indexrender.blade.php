<article id="article{{$post->id}}"><div class="post-image" id="post_image{{$post->id}}"><img src="{{asset('').$post->thumnails}}" alt="post image 1"><div class="category"><a href="{{asset('').'category/'.$post->category->id}}">{{$post->category->name}}</a></div></div><div class="post-text"><span class="date" id="date{{$post->id}}">{{$post->created_at}}</span>@auth<div class="dropdown category pull-right"><a class=" btn-light dropdown-toggle" data-toggle="dropdown" style="text-decoration: none">...</a><ul class="dropdown-menu">@if($post->user->id === Auth::user()->id)<li><a class="edit" data-id="{{$post->id}}">Edit this post</a></li>@endif<li><a class="delete" data-id="{{$post->id}}">Delete this post</a></li>@if(Auth::user()->isadmin === 2 or Auth::user()->isadmin === 1)<li><a class="unpost" data-id="{{$post->id}}">Unpost this post</a></li>@endif</ul></div>@endauth<h2 id="title{{$post->id}}"><a href="{{asset('').'post/'.$post->id}}">{{$post->title}}</a></h2><p class="text" id="text{{$post->id}}">{{$post->description}}<a href="{{asset('').'post/'.$post->id}}"><i class="icon-arrow-right2"></i></a></p></div><div class="post-info"><div id="post_by{{$post->id}}" class="post-by">Post By <a href="{{asset('').'user/'.$post->user->id}}">{{$post->user->username}}</a></div><div class="extra-info"><span class="comments">{{$post->comment->count()}} <i class="icon-bubble2"></i></span></div><div class="clearfix"></div></div></article>