<div class="attachment reply{{$reply->id}}">@auth @if($reply->user->id === Auth::user()->id or Auth::user()->isadmin === 2 or Auth::user()->isadmin === 1)<div class="dropdown category pull-right"><a class=" btn-light dropdown-toggle" data-toggle="dropdown" style="text-decoration: none">...</a><ul class="dropdown-menu">@if($reply->user->id === Auth::user()->id)<li><a class="edit_reply" data-id="{{$reply->id}}">Edit this reply</a></li>@endif<li><a class="delete_reply" data-id="{{$reply->id}}">Delete this reply</a></li></ul></div>@endif @endauth<img src="{{asset('').$reply->user->avatar}}" class="img-circle" width="40px" height="40px"><h4><a href="#" class="name">{{$reply->user->username}}</a></h4><small class="text-muted" id="time_reply{{$reply->id}}"> {{$reply->created_at->diffForHumans()}}</small><p class="filename"><span class="reply_content{{$reply->id}}">{{$reply->content}}</span></p><br></div>
