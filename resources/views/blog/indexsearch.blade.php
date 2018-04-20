@extends('blog.blog-layout')
@section('content')
    @if(isset($posts))
    @foreach($posts as $post)

        <div class="col-xs-3" id="post_image{{$post->id}}">
            <img src="{{asset('').$post->thumnails}}" alt="post image 1">
        </div>
        <div class="col-xs-pull-9">
            <span class="date" id="date{{$post->id}}">{{$post->created_at->diffForHumans()}}</span>
            <h4 id="title{{$post->id}}"><a href="{{asset('').'post/'.$post->id}}">{{$post->title}}</a></h4>
            <div id="post_by{{$post->id}}" class="post-by">Post By <a href="{{asset('').'user/'.$post->user->id}}">{{$post->user->username}}</a></div>
            <div class="extra-info">
                <span class="comments">{{$post->comment->count()}} <i class="icon-bubble2"></i></span>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
        <br>
        <br>
    @endforeach
        @else
        <h3><a href="{{asset('/')}}">Don't have any content. BACK</a></h3>
    @endif
@endsection