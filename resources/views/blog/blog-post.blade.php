@extends('blog.blog-layout')
@section('content')

    <article>
        <div class="post-image">
            <img src="{{asset('').$post->thumnails}}" alt="post image 1">
            <div class="category"><a href="{{asset('').'category/'.$post->category->id}}">{{$post->category->name}}</a></div>
        </div>
        <div class="post-text">
            <span class="date">{{$post->created_at}}</span>
            <h2>{{$post->title}}</h2>
        </div>
        <div class="post-text text-content">
            {{$post->description}}
        </div>
        <div class="post-text text-content">
            <div class="text">

                    {{$post->content}}

                <div class="clearfix"></div>
            </div>
        </div>



        <!-- AUTHOR POST -->
        <div class="author-post-container">
            <div class="author-post">
                <div class="author-info">
                    POSTED BY:
                    <span class="author-name">{{$post->user->username}}</span>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>

        <div class="post-text text-content">
            <div class="text">
                <h4>TAG :</h4>
                @foreach($post->tags as $tag)
                    <a class="btn btn-info" href="{{asset('').'tag/' .$tag->id}}">{{$tag->name}}</a>
                @endforeach

                <div class="clearfix"></div>
            </div>
        </div>

        @auth()
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <h3 class="box-title">Comment</h3>
            </div>
            <div class="slimScrollDiv" style="position: relative;  width: auto; height: auto; "><div class="box-body chat" id="chat-box" style=" width: auto; ">
                    <!-- chat item -->
                    @foreach($comments as $comment)
                        <div class="item" id="comment{{$comment->id}}">
                            @auth
                                @if($comment->user_id === Auth::user()->id or Auth::user()->isadmin === 2 or Auth::user()->isadmin === 1)
                                    <div class="dropdown category pull-right">
                                        <a class=" btn-light dropdown-toggle" data-toggle="dropdown" style="text-decoration: none">...
                                        </a>
                                        <ul class="dropdown-menu">
                                            @if($comment->user_id === Auth::user()->id)
                                                <li><a class="edit" data-id="{{$comment->id}}">Edit this comment</a></li>
                                            @endif
                                            <li><a class="delete" data-id="{{$comment->id}}">Delete this comment</a></li>
                                        </ul>
                                    </div>
                                @endif
                            @endauth
                            <img src="{{asset('').$comment->user->avatar}}">

                            <p class="message">
                                <a href="#" class="name">
                                    {{$comment->user->username}}
                                </a>
                                <small class="text-muted "> {{$comment->created_at->diffForHumans()}}</small><br>
                                {{$comment->content}}
                                <br><a class="replies"  data-id="{{$comment->id}}">reply</a>
                            </p>

                            @foreach($comment->reply as $reply)
                                <div class="attachment">
                                    @auth
                                        @if($reply->user_id === Auth::user()->id or Auth::user()->isadmin === 2 or Auth::user()->isadmin === 1)
                                            <div class="dropdown category pull-right">
                                                <a class=" btn-light dropdown-toggle" data-toggle="dropdown" style="text-decoration: none">...
                                                </a>
                                                <ul class="dropdown-menu">
                                                    @if($reply->user_id === Auth::user()->id)
                                                        <li><a class="edit" data-id="{{$reply->id}}">Edit this reply</a></li>
                                                    @endif
                                                    <li><a class="delete" data-id="{{$reply->id}}">Delete this reply</a></li>
                                                </ul>
                                            </div>
                                        @endif
                                    @endauth
                                    <img src="{{asset('').$reply->user->avatar}}" class="img-circle" width="40px" height="40px">
                                    <h4><a href="#" class="name">

                                            {{$reply->user->username}}
                                        </a></h4>
                                        <small class="text-muted"> {{$reply->created_at->diffForHumans()}}</small>
                                    <p class="filename">
                                        {{$reply->content}}
                                    </p><br>
                                </div>
                                    @endforeach
                                </div>
                        <div>
                            <textarea  class="reply" name="comment" rows="1" id="reply{{$comment->id}}" placeholder="Write a reply..." style="display: none;" data-id="{{$comment->id}}" data-user="{{Auth::user()->id}}"></textarea>
                        </div>

                                <!-- /.attachment -->

                        <!-- /.item -->
                    @endforeach
                </div>
                <div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 63px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 187.126px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
            <!-- /.chat -->
            <div class="box-footer">
                <img src="{{asset('') . Auth::user()->avatar}}" class="img-circle" width="40px" height="40px"> <a href="#" class="name" style="font-weight: 600;">{{Auth::user()->username}}</a>
                <textarea class="comment" name="comment" rows="1" placeholder="Write a comment..." data-id="{{$post->id}}" data-user="{{Auth::user()->id}}"></textarea>
            </div>
        @else
            <div>
                <h3><a href="{{asset('/login')}}">Please login to see comments</a></h3>
            </div>
        @endauth

    </article>



    <!-- NAVIGATION -->
    <div class="navigation">
        @if($linkprev === 0)

        @else
        <a href="{{asset('').$linkprev}}" class="prev"><i class="icon-arrow-left8"></i> Previous Posts</a>
        @endif
        @if($linknext === 0)

            @else
        <a href="{{asset('').$linknext}}" class="next">Next Posts <i class="icon-arrow-right8"></i></a>
            @endif
        <div class="clearfix"></div>
    </div>
@auth()
    <script type="text/javascript">
        {{--show reply--}}

            $('#chat-box').on('click','.replies',function () {
            var id = $(this).data('id');
                $('#reply'+ id).css('display','block');
            });


        //setup ajax
        $.ajaxSetup(
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        );

        //comment
        $(document).ready(function() {
            $('.comment').keyup(function(e) {
                if(e.keyCode == 13 && !e.shiftKey){
                    var comment = $('textarea.comment').val().trim();
                    if(comment == "")
                    {

                    }
                    else
                    {
                        var id = $(this).data('id');
                        var user_id = $(this).data('user');
                        $('.comment').val("");
                        $.ajax({
                            type: 'post',
                            url: '{{asset("")}}/comment/' +id,
                            data:{
                                contents: comment,
                                user_id: user_id
                            },
                            success: function (response) {
                                // toastr.success('Edit category successfully');
                                $('#chat-box').append('<div class="item" id="comment'+ response.comment.id +'"><img src="{{asset('')}}'+ response.user.avatar +'"><p class="message"><a href="#" class="name"><small class="text-muted pull-right">'+ response.comment.created+'</small>'+  response.user.username +'</a>'+ response.comment.content +'<br><a class="replies" data-id="'+ response.comment.id + '">reply</a></p></div><div><textarea  class="reply" name="comment" rows="1" id="reply'+ response.comment.id +'" placeholder="Write a reply..." style="display: none;" data-id="'+ response.comment.id +'" data-user="'+ response.user.id +'"></textarea></div>')
                            }
                        });
                    }

                }
            });
        });


    //    reply
        $('#chat-box').on('keyup','.reply', function(e){
            var id = $(this).data('id');

            if(e.keyCode == 13 && !e.shiftKey) {
                var reply = $('textarea#reply' + id).val().trim();
                if (reply == "") {

                }
                else {
                    var user_id = $(this).data('user');
                    $('#reply' + id).val("");
                    $.ajax({
                        type: 'post',
                        url: '{{asset("")}}reply/' + id,
                        data:{
                            user_id: user_id,
                            contents: reply
                        },
                        success: function (response) {
                            $('#comment'+id).append('<div class="attachment"><img src="{{asset('')}}'+ response.user.avatar +'" class="img-circle" width="40px" height="40px"><h4><a href="#" class="name"><small class="text-muted pull-right">'+ response.created +'</small>'+ response.user.username +'</a></h4><p class="filename">'+ response.reply.content +'</p><br></div>');
                        }
                    })

                }
            }
            });



    </script>
@endauth
    @endsection
