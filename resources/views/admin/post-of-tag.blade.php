@extends('admin.admin-layout')
@section('page_name')
    Post
@endsection
@section('content')

    {{--modal add post--}}
    <button type="button" class="btn btn-xs btn-primary btn-lg" data-toggle="modal" data-target="#add-post">Add new post</button>

    <!-- Modal  -->
    <div class="modal fade bd-example-modal-lg" id="add-post" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ADD POST</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post" role="form" id="add-new" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" >
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="title">
                        </div>
                        <div class="form-group" >
                            <label for="">Description</label>
                            <input type="text" class="form-control" name="description"  placeholder="description">
                        </div>
                        <div class="form-group" >
                            <label for="">Content</label>
                            <textarea  class="form-control" name="contents" placeholder="content"></textarea>
                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <label for="">Category</label>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <select class="form-control" name="category_id">
                                    @foreach ($categorys as $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="">Thumnails</label>
                            <input type="file" class="form-control" name="thumnails" id="thumnails" onchange="readURL(this);">
                            <img class="blah" src="#" style="display: none;" />

                        </div>
                        <div class="form-group" >
                            <label for="">Tag</label><br>
                            <select multiple name="tags[]" id="tags" data-role="tagsinput"  ></select>

                        </div>

                        <button type="submit" class="btn btn-primary">ADD</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    {{--table list--}}
    <div class="table-reponsive">
        <table class="table table-hover" >
            <thead>
            <tr>
                <td class="stl-column color-column">Thumnails</td>
                <td class="stl-column color-column">Title</td>
                <td class="stl-column color-column">Author</td>
                <td class="stl-column color-column">Description</td>
                <td class="stl-column color-column">Category</td>
                <td class="stl-column color-column">Created at</td>
                <td class="stl-column color-column">Updated at</td>
                <td class="stl-column color-column">Posted</td>
                <td class="stl-column color-column">Action</td>
            </tr>
            <tbody id="categorys">



            @foreach($posts as $post)
                <tr class="tr{{ $post->id }}">
                    <td class="stl-column"><img src="{{asset('')}}{{ $post->thumnails }}" width="50px" height="50px" /></td>
                    <td class="stl-column">{{ $post->title }}</td>
                    <td class="stl-column">{{$post->user->username}}</td>
                    <td class="stl-column">{{ $post->description }}</td>
                    <td class="stl-column">{{$post->category->name}}</td>
                    <td class="stl-column">{{ $post->created_at->diffForHumans() }}</td>
                    <td class="stl-column">{{ $post->updated_at->diffForHumans() }}</td>
                    <td class="stl-column">
                        <form action="">
                            <input type="checkbox" class="checkbox checkflag" name="postcheck" value="check" data-id ="{{$post->id}}"
                                   @if( $post->flag == 1 )checked
                            @elseif($post->flag == 0)
                                    @endif
                            ><br>
                        </form>
                    </td>
                    <td class="stl-column">
                        <button class="btn btn-xs btn-info" data-id="{{ $post->id }}" >show</button>
                        <button class="btn btn-xs btn-warning"  data-id="{{ $post->id }}" data-toggle="modal" data-target="#post-edit{{ $post->id }}">edit</button>
                        <button class="btn btn-xs btn-danger"  data-id="{{ $post->id }}">delete</button>

                    </td>
                </tr>

                {{--modal edit--}}

                <div class="modal fade" id="post-edit{{ $post->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                </button>
                                <h4 class="modal-title">Edit post</h4>
                            </div>
                            <form action="{{asset('admin/post'). '/' . $post->id}}" method="post" role="form" id="add-new" enctype="multipart/form-data">
                                <div class="modal-body">

                                    @method('PUT')
                                    @csrf
                                    <div class="form-group" >
                                        <label for="">Title</label>
                                        <input type="text" class="form-control" name="title" value="{{$post->title}}">
                                    </div>
                                    <div class="form-group" >
                                        <label for="">Description</label>
                                        <input type="text" class="form-control" name="description"  value="{{$post->description}}">
                                    </div>
                                    <div class="form-group" >
                                        <label for="">Content</label>
                                        <textarea name="contents">{{$post->content}}</textarea>
                                    </div>
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <label for="">Category</label>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <select class="form-control" name="category_id">
                                                @foreach ($categorys as $category)
                                                    @if($post->category_id == $category->id)
                                                        <option value="{{$category->id}}" checked>{{$category->name}}</option>

                                                    @else
                                                        <option value="{{$category->id}}" >{{$category->name}}</option>

                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" >
                                        <label for="">Thumnails</label><br>
                                        <img src="{{asset($post->thumnails)}}" height="150px" width="auto" />
                                        <input type="file" class="form-control" name="thumnails"  onchange="readURL(this);">
                                        <img class="blah" src="#" style="display: none;" />

                                    </div>

                                    <div class="form-group" >
                                        <label for="">Tag</label><br>
                                        <select multiple name="tags[]" id="tags" data-role="tagsinput"  >
                                            @foreach($post->tags as $tag)
                                                <option value="{{$tag->name}}">{{$tag->name}}</option>

                                            @endforeach

                                        </select>

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

            @endforeach
            </tbody>
            </thead>
        </table>
    </div>

    {{--modal show content--}}
    <div class="modal fade bd-example-modal-lg" id="show">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="Post">Post</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group" >
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" id="titleShow" readonly >
                    </div>
                    <div class="form-group" >
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description"  id="descriptionShow" readonly >
                    </div>
                    <div class="form-group" >
                        <label for="">Content</label>
                        <div  name="contents" id="contentShow" ></div>
                    </div>
                    <div class="form-group" >
                        <label for="">Author</label>
                        <input type="text" class="form-control" name="author"  id="authorShow" readonly >
                    </div>
                    <div class="form-group" >
                        <label for="">Category</label>
                        <input type="text" class="form-control" name="author"  id="categoryShow" readonly >
                    </div>
                    <div class="form-group" >
                        <label for="">Thumnails</label><br>
                        <img src="" id="thumnailimg" height="150px" width="auto" />
                    </div>
                    <div class="form-group" >
                        <label for="">Tag</label><br>
                        <select multiple name="tags[]" id="tagsShow" data-role="tagsinput" disabled="disabled" ></select>
                    </div>
                    <div class="form-group" >
                        <label for="">Created at</label>
                        <input type="text" class="form-control" name="created_at"  id="created_atShow" readonly>
                    </div>
                    <div class="form-group" >
                        <label for="">Updated at</label>
                        <input type="text" class="form-control" name="updated_at"  id="updated_atShow" readonly>
                    </div>
                    <div class="form-group" >
                        <label for="">Status</label><br>
                        <input type="text" class="form-control" id="flagShow" readonly >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
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

@endsection
@section('script')
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.blah')
                        .attr('src', e.target.result)
                        .height(150)
                        .width('auto')
                        .css('display','block');

                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // post and unpost
        $('.checkflag').each(function () {
            $(this).change(function () {
                if(this.checked){
                    var id = $(this).data('id');
                    $.ajax({
                        type : 'put',
                        url: '{{asset("")}}admin/post/' + id +'/editflag',
                        data: {
                            flag: 1
                        },
                        success: function (response) {
                            toastr.success('Post this content successfully');
                        }
                    });
                }
                else {
                    var id = $(this).data('id');
                    $.ajax({
                        type : 'put',
                        url: '{{asset("")}}admin/post/' + id +'/editflag',
                        data: {
                            flag: 0
                        },
                        success: function (response) {
                            toastr.success('Unposted');
                        }
                    });
                }
            });
        });

        //show post
        $(document).on('click', '.btn-info', function () {
            $('#show').modal('show');
            var id = $(this).data('id');
            $.ajax({
                type : 'get',
                url: '{{asset("")}}admin/post/' + id,
                success: function (response) {
                    var post = response.post;
                    var tags = post.tags;
                    $('#titleShow').val(post.title);
                    $('#descriptionShow').val(post.description);
                    $('#authorShow').val(post.user.username);
                    $('#categoryShow').val(post.category.name);
                    $('#created_atShow').val(post.created_at);
                    $('#updated_atShow').val(post.updated_at);
                    $('#contentShow').append('<div class="modalclose">' + post.content + '</div>');
                    $('#thumnailimg').attr('src', 'http://duybinh.pro/' + post.thumnails);
                    console.log(post.thumnails);
                    if (post.flag == 1){
                        $('#flagShow').val('Đã đăng');
                    }
                    else {
                        $('#flagShow').val('Chưa đăng');
                    }
                    $.each(tags, function(key, value){
                        var tag = tags[key];
                        var tagname = tag['name'];
                        $('#tagsShow').append('<option disabled="disabled" class="modalclose" selected value="'+ tagname +'">' + tagname + '</option>');
                        // $('#tagsShow').val( tagname );
                        $('.bootstrap-tagsinput').prepend('<span class="tag label label-info modalclose">' + tagname + '<span data-role="remove"></span></span>');
                    });
                }
            })
        });

        //        show modal delete
        $(document).on('click', '.btn-danger', function () {
            $('#modal-del').modal('show');
            var id = $(this).data('id');
            $.ajax({
                type : 'get',
                url: '{{asset("")}}admin/post/' + id +'/edit',
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
                url: '{{asset("")}}admin/post/' + id,
                // data: {
                //     id: id
                // },
                success: function(response) {
                    $('#modal-del').modal('hide');
                    console.log(response.error);


                    toastr.success('Delete post successfully');
                    $('.tr'+id).remove();
                }
            });

        });
        //        end delete


    </script>

@endsection

