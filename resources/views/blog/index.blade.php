@extends('blog.blog-layout')
@section('content')
    <div id="blog_content">
    @foreach($posts as $post)

        <!-- ARTICLE 1 -->
        <article id="article{{$post->id}}">
            <div class="post-image" id="post_image{{$post->id}}">
                <img src="{{asset('').$post->thumnails}}" alt="post image 1">
                <div class="category"><a href="{{asset('').'category/'.$post->category->id}}">{{$post->category->name}}</a></div>
            </div>
            <div class="post-text">
                <span class="date" id="date{{$post->id}}">{{$post->created_at}}</span>
                @auth
                @if($post->user->id === Auth::user()->id or Auth::user()->isadmin === 2 or Auth::user()->isadmin === 1)
                <div class="dropdown category pull-right">
                    <a class=" btn-light dropdown-toggle" data-toggle="dropdown" style="text-decoration: none">...
                    </a>
                    <ul class="dropdown-menu">
                        @if($post->user->id === Auth::user()->id)
                        <li><a class="edit" data-id="{{$post->id}}">Edit this post</a></li>
                        @endif
                        <li><a class="delete" data-id="{{$post->id}}">Delete this post</a></li>
                            @if(Auth::user()->isadmin === 2 or Auth::user()->isadmin === 1)
                        <li><a class="unpost" data-id="{{$post->id}}">Unpost this post</a></li>
                            @endif
                    </ul>
                </div>
                @endif
                @endauth
                <h2 id="title{{$post->id}}"><a href="{{asset('').'post/'.$post->id}}">{{$post->title}}</a></h2>
                <p class="text" id="text{{$post->id}}">{{$post->description}}
                    <a href="{{asset('').'post/'.$post->id}}"><i class="icon-arrow-right2"></i></a></p>
            </div>
            <div class="post-info">
                <div id="post_by{{$post->id}}" class="post-by">Post By <a href="{{asset('').'user/'.$post->user->id}}">{{$post->user->username}}</a></div>
                <div class="extra-info">
                    <span class="comments">{{$post->comment->count()}} <i class="icon-bubble2"></i></span>
                </div>
                <div class="clearfix"></div>
            </div>
        </article>
    @endforeach
    </div>


    {{--modal edit--}}

    <div class="modal fade" id="postedit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title">Edit post</h4>
                </div>
                <form method="post" role="form" id="edit-post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group" id="edit-title">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title" id="title-edit" >
                        </div>
                        <input type="hidden" class="hidden-id-edit">
                        <div class="form-group" id="edit-description">
                            <label for="">Description</label>
                            <input type="text" class="form-control" name="description" id="description-edit" >
                        </div>
                        <div class="form-group" id="edit-contents">
                            <label for="">Content</label>
                            <textarea name="contents" id="contents-edit"></textarea>
                        </div>
                        <div class="portlet light bordered" id="edit-category">
                            <div class="portlet-title">
                                <div class="caption">
                                    <label for="">Category</label>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <select class="form-control" name="category_id" id="category-edit">
                                    @foreach($categorys as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="edit-thumnails">
                            <label for="">Thumnails</label><br>
                            <input type="hidden" id="file-edit">
                            <img src="" height="150px" width="auto" id="thumnails-edit" />
                            <input type="file" class="form-control" name="thumnails" id="img-edit"  onchange="readdURL(this);">
                        </div>

                        <div class="form-group" id="edit-tags">
                            <label for="">Tag</label><br>
                            <select multiple name="tags[]" id="tags-edit" data-role="tagsinput"></select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    {{--modal delete--}}
    <div class="modal fade" id="modal-del">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">DELETE</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="hidden-id">
                    <h4>Are you sure to delete post  : </h4>
                    <p id="name-delete"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary delete-del">Yes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{--modal unpost--}}
    <div class="modal fade" id="modal-unpost">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Unpost</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden-unpost">
                    <h4>Are you sure to unpost this post  : </h4>
                    <p id="name-unpost"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary unpostflag">Yes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    {{--script--}}
    {{--script--}}
    {{--script--}}
    {{--script--}}
    {{--script--}}
    <script type="text/javascript">
        //setup ajax
        $.ajaxSetup(
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        );

        //ck editor
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.

        //close modal
        $('.modal').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
            $('.modalclose').remove();


        });


        //show image when choose file
        function readdURL(input) {
            if (input.files && input.files[0]) {
                console.log(input.files[0]['name']);
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#thumnails-edit')
                        .attr('src', e.target.result)
                        .height(150)
                        .width('auto')
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        @auth
        //show modal edit
        $(document).on('click', '.edit', function () {
            $('#postedit').modal('show');
            var id = $(this).data('id');
            $('.hidden-id-edit').val(id);
            // function remove_selected(){
            //     $("select option").removeAttr('selected');
            // }
            $.ajax({
                type : 'get',
                url: '{{asset("")}}post/' + id + '/edit',
                success: function (response) {
                    $('#title-edit').val(response.post.title);
                    $('#description-edit').val(response.post.description);
                    $('#contents-edit').val(response.post.content);
                    $('#file-edit').val(response.post.thumnails);
                    // remove_selected();
                    $('select option[value="' + response.post.category_id + '"]').prop({defaultSelected: true});
                    $('#thumnails-edit').attr('src', '{{asset('')}}' +response.post.thumnails);
                    $('#filename').val(response.post.thumnails);
                    $('#tags-edit').tagsinput('removeAll');
                    $.each(response.tags, function(key, value){
                        var tag = response.tags[key];
                        var tagname = tag['name'];
                        $('#tags-edit').tagsinput('add', tag['name']);
                    });
                }
            });
        });
        //    end show edit

        //update post
        $('#edit-post').on('submit', function (e) {
            if($('#img-edit')[0].files[0]){
                var filename = $('#img-edit')[0].files[0]['name'];
                var filepath = 'img/' + filename;
            }
            else {
                var filepath = $('#file-edit').val();
            }
            var id = $('.hidden-id-edit').val();
            e.preventDefault();
            var formdata = new FormData($("#edit-post")[0]);

            $.ajax({
                type:'post',
                url:'{{asset("postimg")}}',
                data:formdata,
                cache:false,
                dataType:'text',
                // async:false,
                processData: false,
                contentType: false,
                success:function(response){
                    console.log(response);
                }
            });

            $.ajax({
                type: 'put',
                url: '{{asset("")}}post/' + id,
                data: {
                    title: $('#title-edit').val(),
                    description: $('#description-edit').val(),
                    contents: $('#contents-edit').val(),
                    category_id: $('#category-edit').val(),
                    thumnails: filepath,
                    tags: $('#tags-edit').val()
                },
                success: function (response) {
                    $('#postedit').modal('hide');

                    toastr.success('Update posts successfully');

                    // append
                    $('#post_image'+ response.post.id).replaceWith('<div class="post-image" id="post_image'+ response.post.id +'"><img src="{{asset('')}}'+ response.post.thumnails +'" alt="post image 1"><div class="category"><a href="{{asset('')}}category/'+ response.category_id +'">'+ response.category +'</a></div></div>');
                    $('#date'+ response.post.id).replaceWith('<span class="date" id="date'+ response.post.id +'">'+ response.created +'</span>');
                    $('#title'+ response.post.id).replaceWith('<h2 id="title'+ response.post.id +'"><a href="{{asset('')}}post/'+ response.post.id +'">'+ response.post.title +'</a></h2>');
                    $('#text'+ response.post.id).replaceWith('<p class="text" id="text'+ response.post.id +'">'+ response.post.description +'<a href="{{asset('')}}post/'+ response.post.id +'"><i class="icon-arrow-right2"></i></a></p>');
                },
                error: function (xhr, status, errorThrown) {
                    var err = xhr.responseJSON.errors;
                    console.log(err);
                    $('#edit-title').append('<p style="color: crimson">'+ err['title'][0] +'</p>');
                    $('#edit-description').append('<p style="color: crimson">'+ err['description'][0] +'</p>');
                    $('#edit-contents').append('<p style="color: crimson">'+ err['contents'][0] +'</p>');
                    $('#edit-thumnails').append('<p style="color: crimson">'+ err['thumnails'][0] +'</p>');
                    $('#edit-tags').append('<p style="color: crimson">'+ err['tags'][0] +'</p>');

                }
            });
        });
        //end update post

        //        show modal delete
        $(document).on('click', '.delete', function () {
            $('#modal-del').modal('show');
            var id = $(this).data('id');
            $.ajax({
                type : 'get',
                url: '{{asset("")}}post/' + id +'/edit',
                success: function (response) {
                    $('#name-delete').text(response.title);
                    $('.hidden-id').text(id);
                }
            });
        });
        //        end show modal delete

        //        delete
        $('.modal-footer').on('click', '.delete-del', function(){
            var id = $('.hidden-id').text();
            $.ajax({
                type: 'delete',
                url: '{{asset("")}}post/' + id,
                // data: {
                //     id: id
                // },
                success: function(response) {
                    $('#modal-del').modal('hide');
                    toastr.success('Delete post successfully');
                    $('#article'+ response.post.id).remove();
                }
            });

        });
        //        end delete
@if(Auth::user()->isadmin === 1 or Auth::user()->isadmin === 2)
        //    unpost
        $(document).on('click', '.unpost', function () {
            $('#modal-unpost').modal('show');
            var id = $(this).data('id');
            $.ajax({
                type : 'get',
                url: '{{asset("")}}post/' + id +'/edit',
                success: function (response) {
                    $('#name-unpost').text(response.post.title);
                    $('#hidden-unpost').val(id);
                }
            });
        });


        $('.modal-footer').on('click', '.unpostflag', function(){
            var id = $('#hidden-unpost').val();
            $.ajax({
                type: 'put',
                url: '{{asset("")}}admin/post/' + id +'/editflag',
                data: {
                    flag: 2
                },
                success: function (response) {
                    $('#modal-unpost').modal('hide');
                    toastr.success('Unposted');
                    $('#article'+ id).remove();
                    // console.log(response.html);
                    $('#blog_content').append(response.html);
                    {{--if (response.post){--}}
                        {{--$('#post_image'+ id).replaceWith('<div class="post-image" id="post_image'+ response.post.id +'"><img src="{{asset('')}}'+ response.post.thumnails +'" alt="post image 1"><div class="category"><a href="{{asset('')}}category/'+ response.category_id +'">'+ response.category +'</a></div></div>');--}}
                        {{--$('#date'+ id).replaceWith('<span class="date" id="date'+ response.post.id +'">'+ response.created +'</span>');--}}
                        {{--$('#title'+ id).replaceWith('<h2 id="title'+ response.post.id +'"><a href="{{asset('')}}post/'+ response.post.id +'">'+ response.post.title +'</a></h2>');--}}
                        {{--$('#text'+ id).replaceWith('<p class="text" id="text'+ response.post.id +'">'+ response.post.description +'<a href="{{asset('')}}post/'+ response.post.id +'"><i class="icon-arrow-right2"></i></a></p>');--}}
                    {{--}--}}
                    {{--else {--}}
                        {{--$('#article'+ response.id).remove();--}}
                    {{--}--}}
                }
            });

        });
        //        end unpost
@endif
        @endauth
    </script>
@endsection
@section('link')
{{$posts->links()}}
@endsection
