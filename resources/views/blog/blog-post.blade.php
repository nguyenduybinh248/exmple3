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
                                @if($comment->user->id === Auth::user()->id or Auth::user()->isadmin === 2 or Auth::user()->isadmin === 1)
                                    <div class="dropdown category pull-right">
                                        <a class=" btn-light dropdown-toggle" data-toggle="dropdown" style="text-decoration: none">...
                                        </a>
                                        <ul class="dropdown-menu">
                                            @if($comment->user->id === Auth::user()->id)
                                                <li><a class="edit_comment" data-id="{{$comment->id}}">Edit this comment</a></li>
                                            @endif
                                            <li><a class="delete_comment" data-id="{{$comment->id}}">Delete this comment</a></li>
                                        </ul>
                                    </div>
                                @endif
                            @endauth
                            <img src="{{asset('').$comment->user->avatar}}">

                            <p class="message">
                                <a href="#" class="name">
                                    {{$comment->user->username}}
                                </a>
                                <small class="text-muted" id="time_comment{{$comment->id}}"> {{$comment->created_at->diffForHumans()}}</small><br>
                                <span class="comment_content{{$comment->id}}">{{$comment->content}}</span>
                                <br><a class="replies" id="press_comment{{$comment->id}}"  data-id="{{$comment->id}}">reply</a>
                            </p>

                            @foreach($comment->reply as $reply)
                                <div class="attachment reply{{$reply->id}}">
                                    @auth
                                        @if($reply->user->id === Auth::user()->id or Auth::user()->isadmin === 2 or Auth::user()->isadmin === 1)
                                            <div class="dropdown category pull-right">
                                                <a class=" btn-light dropdown-toggle" data-toggle="dropdown" style="text-decoration: none">...
                                                </a>
                                                <ul class="dropdown-menu">
                                                    @if($reply->user->id === Auth::user()->id)
                                                        <li><a class="edit_reply" data-id="{{$reply->id}}">Edit this reply</a></li>
                                                    @endif
                                                    <li><a class="delete_reply" data-id="{{$reply->id}}">Delete this reply</a></li>
                                                </ul>
                                            </div>
                                        @endif
                                    @endauth
                                    <img src="{{asset('').$reply->user->avatar}}" class="img-circle" width="40px" height="40px">
                                    <h4><a href="#" class="name">

                                            {{$reply->user->username}}
                                        </a></h4>
                                        <small class="text-muted" id="time_reply{{$reply->id}}"> {{$reply->created_at->diffForHumans()}}</small>
                                    <p class="filename">
                                        <span class="reply_content{{$reply->id}}">{{$reply->content}}</span>
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
    {{--modal delete--}}
    <div class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_delete">
                    <h3>Are you sure to delete this <span id="type_delete" ></span></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete-del">Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{--script=============================--}}
    {{--script=============================--}}
    {{--script=============================--}}
    {{--script=============================--}}
    {{--script=============================--}}
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
                                $('#chat-box').append(response.html);
                            }
                        });
                    }

                }
                if(e.keyCode === 27){
                    $('textarea.comment').val('');
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
                            $('#comment'+id).append(response.html);
                        }
                    })

                }
            }
            });
    //    show edit
        $(document).on('click', '.edit_comment', function () {
            // $('#edit').modal('show');
            var id = $(this).data('id');
            // $('#hidden_edit').text(id);
            $.ajax({
                type: 'get',
                url: '{{asset("")}}/comment/' + id + '/edit',
                success: function (response) {
                    // $('#content_edit').text(response.content)
                    $('#time_comment'+id).css('display', 'none');
                    $('.comment_content' + id).replaceWith('<textarea id="edit_comment'+ response.comment.id +'" class="comment_edit textareaedit" name="comment" rows="1"  data-id="'+ response.comment.id +'" data-user="'+ response.user_id +'">'+ response.comment.content +'</textarea>');
                    $('#press_comment'+ id).replaceWith('<p class="escapetxt">Press ESC to escape</p>');
                }
            });
        });

        //update
        $(document).ready(function() {
            $('#chat-box').on('keyup','.comment_edit', function(e){
                if(e.keyCode == 13 && !e.shiftKey){
                    var comment = $('textarea.comment_edit').val().trim();
                    if(comment == "")
                    {

                    }
                    else
                    {
                        var id = $(this).data('id');
                        $('.comment_edit').val("");
                        $.ajax({
                            type: 'put',
                            url: '{{asset("")}}/comment/' +id,
                            data:{
                                contents: comment
                            },
                            success: function (response) {
                                // toastr.success('Edit category successfully');
                                $('#time_comment'+ response.id).css('display', 'block');
                                $('#edit_comment'+ response.id).replaceWith('<span class="comment_content'+ response.id +'">'+ response.content +'</span>');
                                $('.escapetxt').replaceWith('<br><a class="replies" id="press_comment'+ response.id +'"  data-id="'+ response.id +'">reply</a>');

                            }
                        });
                    }

                }
                if(e.keyCode == 27){
                    var id = $(this).data('id');
                    $.ajax({
                        type: 'get',
                        url: '{{asset("")}}/comment/' + id + '/edit',
                        success: function (response) {
                            // toastr.success('Edit category successfully');
                            $('#time_comment'+ response.comment.id).css('display', 'block');
                            $('#edit_comment'+ response.comment.id).replaceWith('<span class="comment_content'+ response.comment.id +'">'+ response.comment.content +'</span>');
                            $('.escapetxt').replaceWith('<br><a class="replies" id="press_comment'+ response.comment.id +'"  data-id="'+ response.comment.id +'">reply</a>');

                        }
                    });
                }
            });
        });

    //  show  delete
        $(document).on('click', '.delete_comment', function () {
            $('#delete').modal('show');
            var id = $(this).data('id');
            $('#hidden_delete').text(id);
            $('#type_delete').append('comment');
        });

    //    delete
        $('.modal-footer').on('click', '.delete-del', function(){
            var id = $('#hidden_delete').text();
            $.ajax({
                type: 'delete',
                url: '{{asset("")}}comment/' + id,
                success: function(response) {
                    $('#delete').modal('hide');
                    toastr.success('Delete comment successfully');
                    $('#comment'+ id).remove();
                }
            });
        });


    //    reply=================reply
    //    reply=================reply
    //    reply=================reply
        //    show edit
        $(document).on('click', '.edit_reply', function () {
            var id = $(this).data('id');
            $.ajax({
                type: 'get',
                url: '{{asset("")}}/reply/' + id + '/edit',
                success: function (response) {
                    $('#time_reply'+id).css('display', 'none');
                    $('.reply_content' + id).replaceWith('<textarea id="edit_reply'+ response.reply.id +'" class="reply_edit textareaedit" name="reply" rows="1"  data-id="'+ response.reply.id +'" data-user="'+ response.user_id +'">'+ response.reply.content +'</textarea>');
                    $('.reply'+ response.reply.id).append('<p class="press_exit_reply">Press esc to escape</p>')

                }
            });
        });

        //update
        $(document).ready(function() {
            $('#chat-box').on('keyup','.reply_edit', function(e){
                if(e.keyCode == 13 && !e.shiftKey){
                    var reply = $('textarea.reply_edit').val().trim();
                    if(reply == "")
                    {

                    }
                    else
                    {
                        var id = $(this).data('id');
                        $('.reply_edit').val("");
                        $.ajax({
                            type: 'put',
                            url: '{{asset("")}}/reply/' +id,
                            data:{
                                contents: reply
                            },
                            success: function (response) {
                                $('#time_reply'+ response.id).css('display', 'block');
                                $('#edit_reply'+ response.id).replaceWith('<span class="reply_content'+ response.id +'">'+ response.content +'</span>');
                                $('.press_exit_reply').remove();

                            }
                        });
                    }

                }
                if(e.keyCode == 27){
                    var id = $(this).data('id');
                    $.ajax({
                        type: 'get',
                        url: '{{asset("")}}/reply/' + id + '/edit',
                        success: function (response) {
                            $('#time_reply'+ response.reply.id).css('display', 'block');
                            $('#edit_reply'+ response.reply.id).replaceWith('<span class="reply_content'+ response.reply.id +'">'+ response.reply.content +'</span>');
                            $('.press_exit_reply').remove();

                        }
                    });
                }
            });
        });

        //  show  delete
        $(document).on('click', '.delete_reply', function () {
            $('#delete').modal('show');
            var id = $(this).data('id');
            $('#hidden_delete').text(id);
            $('#type_delete').append('reply');
        });

        //    delete
        $('.modal-footer').on('click', '.delete-del', function(){
            var id = $('#hidden_delete').text();
            $.ajax({
                type: 'delete',
                url: '{{asset("")}}reply/' + id,
                success: function(response) {
                    $('#delete').modal('hide');
                    toastr.success('Delete reply successfully');
                    $('.reply'+ id).remove();
                }
            });
        });

    </script>
@endauth
    @endsection
