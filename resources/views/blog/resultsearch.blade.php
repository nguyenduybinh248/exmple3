@foreach($posts as $post)<li style="height: 100px"><div class="col-xs-3" id="post_image{{$post->id}}">
<img src="{{asset('').$post->thumnails}}" style="height: 100px">
</div><div class="col-xs-pull-9"><span class="date" id="date{{$post->id}}">{{$post->created_at->diffForHumans()}}</span><h3 id="title{{$post->id}}"><a href="{{asset('').'post/'.$post->id}}" style="color: #95bcdc;">{{$post->title}}</a></h3><div id="post_by{{$post->id}}" class="post-by">Post By <a href="{{asset('').'user/'.$post->user->id}}">{{$post->user->username}}</a></div><div class="extra-info"><span class="comments">{{$post->comment->count()}} <i class="icon-bubble2"></i></span></div></div><div class="clearfix"></div></li><br>@endforeach