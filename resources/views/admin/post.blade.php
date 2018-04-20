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
                    <form method="post" role="form" id="add-new" enctype="multipart/form-data">

                        <div class="form-group" id="add-title">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="title" id="title">
                        </div>
                        <div class="form-group" id="add-description">
                            <label for="">Description</label>
                            <input type="text" class="form-control" name="description"  placeholder="description" id="description">
                        </div>
                        <div class="form-group" id="add-content">
                            <label for="">Content</label>
                            <textarea  class="form-control" name="contents" placeholder="content" id="content"></textarea>
                        </div>
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <label for="">Category</label>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <select class="form-control" name="category_id" id="category_id">
                                     @foreach ($categorys as $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="add-thumnails">
                            <label for="">Thumnails</label>
                            <input type="file" class="form-control" name="thumnails" id="thumnails" onchange="readURL(this);">
                            <img class="blah" src="#" style="display: none;" />

                        </div>
                        <div class="form-group" id="add-tags">
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
    {{--search form--}}

    <div class="input-group pull-right search_field">
        <input type="text" id="search_content" class="form-control fa-search search_content" placeholder="Search...">
    </div>

    {{--table list--}}
    <div class="table-reponsive">
        <table class="table table-hover" >
            <thead>
            <tr>
                <td class="stl-column color-column">Thumnails</td>
                <td class="stl-column color-column">Title</td>
                <td class="stl-column color-column">Author</td>
                <td class="stl-column color-column">Category</td>
                <td class="stl-column color-column">Created at</td>
                <td class="stl-column color-column">Updated at</td>
                <td class="stl-column color-column">Posted</td>
                <td class="stl-column color-column">Not post</td>
                <td class="stl-column color-column">Action</td>
            </tr>
            <tbody id="posts">



            @foreach($posts as $post)
                <tr class="tr{{ $post->id }}  "  data-id="{{$post->id}}">
                    <td class="stl-column"><img src="{{asset('')}}{{ $post->thumnails }}" width="50px" height="50px" /></td>
                    <td class="stl-column">{{ $post->title }}</td>
                    <td class="stl-column">{{$post->user->username}}</td>
                    <td class="stl-column">{{$post->category->name}}</td>
                    <td class="stl-column">{{ $post->created_at->diffForHumans() }}</td>
                    <td class="stl-column">{{ $post->updated_at->diffForHumans() }}</td>
                    <td class="stl-column">
                        <label class="radio-inline checkflag">
                            <input type="radio" name="check{{$post->id}}" value="1"
                                       @if($post->flag === 1)
                                       checked
                                        @endif
                            >
                        </label>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="check{{$post->id}}" value="2"
                                       @if($post->flag === 2)
                                       checked
                                        @endif
                            >
                        </label>
                    </td>
                    <td class="stl-column">
                        <button class="btn btn-xs btn-info" data-id="{{ $post->id }}" >show</button>
                        <button class="btn btn-xs btn-warning"  data-id="{{ $post->id }}">edit</button>
                        <button class="btn btn-xs btn-danger"  data-id="{{ $post->id }}">delete</button>

                    </td>
                </tr>
            @endforeach
            </tbody>
            </thead>
        </table>
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
@section('link')
    <span class="paginate">{{ $posts->links() }}</span>
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
                console.log(input.files[0]['name']);
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


        //add post
        $('#add-new').on('submit', function (e) {
            if($('#thumnails')[0].files[0]){
                var filename = $('#thumnails')[0].files[0]['name'];
            }
            e.preventDefault();
            var formdata = new FormData($("#add-new")[0]);
            $.ajax({
                type:'post',
                url:'{{asset("admin/postimg")}}',
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
                type: 'post',
                url: '{{asset("admin/post")}}',
                data: {
                    title: $('#title').val(),
                    description: $('#description').val(),
                    contents: $('#content').val(),
                    category_id: $('#category_id').val(),
                    thumnails: filename,
                    tags: $('#tags').val()
                },
                success: function (response) {
                    $('#post-edit').modal('hide');

                    toastr.success('Add posts successfully');

                    // append
                    $('#posts').prepend('<tr class ="tr'+response.post.id+' checkflag" data-id="'+ response.post.id +'"><td class="stl-column"><img src="{{asset('')}}'+ response.post.thumnails +'" width="50px" height="50px" /></td><td class="stl-column">'+ response.post.title +'</td><td class="stl-column">'+ response.author +'</td><td class="stl-column">'+ response.category +'</td><td class="stl-column">'+ response.created +'</td><td class="stl-column">'+ response.updated +'</td><td class="stl-column"><label class="radio-inline"><input type="radio" name="check'+response.post.id+'" value="1" ></label></td><td><label class="radio-inline"><input type="radio" name="check'+response.post.id+'" value="2" ></label></td><td class="stl-column"><button class="btn btn-xs btn-info" data-id="'+response.post.id+'" >show</button><button class="btn btn-xs btn-warning"  data-id="'+response.post.id+'">edit</button><button class="btn btn-xs btn-danger"  data-id="'+response.post.id+'">delete</button> </td></tr>');

                },
                error: function (xhr, status, errorThrown) {
                    var err = xhr.responseJSON.errors;
                    console.log(err);
                    $('#add-title').append('<p style="color: crimson">'+ err['title'][0] +'</p>');
                    $('#add-description').append('<p style="color: crimson">'+ err['description'][0] +'</p>');
                    $('#add-content').append('<p style="color: crimson">'+ err['contents'][0] +'</p>');
                    $('#add-thumnails').append('<p style="color: crimson">'+ err['thumnails'][0] +'</p>');
                    $('#add-tags').append('<p style="color: crimson">'+ err['tags'][0] +'</p>');

                }
            });
        });
        //end add post


        //show modal edit
        $(document).on('click', '.btn-warning', function () {
            $('#postedit').modal('show');
            var id = $(this).data('id');
            $('.hidden-id-edit').val(id);
            // function remove_selected(){
            //     $("select option").removeAttr('selected');
            // }
            $.ajax({
                type : 'get',
                url: '{{asset("")}}/admin/post/' + id + '/edit',
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

        //end show edit


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
                url:'{{asset("admin/postimg")}}',
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
                url: '{{asset("")}}/admin/post/' + id,
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
                    $('.tr'+ response.post.id).replaceWith('<tr class ="tr'+response.post.id+' checkflag" data-id="'+ response.post.id +'"><td class="stl-column"><img src="{{asset('')}}'+ response.post.thumnails +'" width="50px" height="50px" /></td><td class="stl-column">'+ response.post.title +'</td><td class="stl-column">'+ response.author +'</td><td class="stl-column">'+ response.category +'</td><td class="stl-column">'+ response.created +'</td><td class="stl-column">'+ response.updated +'</td><td class="stl-column"><label class="radio-inline"><input type="radio" name="check'+response.post.id+'" value="1" ></label></td><td><label class="radio-inline"><input type="radio" name="check'+response.post.id+'" value="2" ></label></td><td class="stl-column"><button class="btn btn-xs btn-info" data-id="'+response.post.id+'" >show</button>&nbsp;<button class="btn btn-xs btn-warning"  data-id="'+response.post.id+'">edit</button>&nbsp;<button class="btn btn-xs btn-danger"  data-id="'+response.post.id+'">delete</button> </td></tr>');

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
                    $('#thumnailimg').attr('src', '{{asset('')}}' + post.thumnails);
                    console.log(post.thumnails);
                    if (post.flag == 1){
                        $('#flagShow').val('Posted');
                    }
                    else if(post.flag == 2){
                        $('#flagShow').val('Unposted')
                    }
                    else {
                        $('#flagShow').val('Waiting');
                    }
                    $('#tagsShow').tagsinput('removeAll');
                    $.each(tags, function(key, value){
                        var tag = tags[key];
                            var tagname = tag['name'];
                            $('#tagsShow').tagsinput('add', tag['name']);
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


        //datatable
        {{--$(function() {--}}
            {{--$('#posts-table').DataTable({--}}
                {{--processing: true,--}}
                {{--serverSide: true,--}}
                {{--responsive: true,--}}
                {{--ajax: '{!! route('bookings.data') !!}',--}}
                {{--columns: [--}}
                    {{--{ data: 'id', name: 'id' },--}}
                    {{--{ data: 'thumnails', name: 'thumnails', "render": function(data, type, row) {--}}
                            {{--return '<img src="http://duybinh.pro/'+data+'" style="height:100px;width:100px;" />';--}}
                        {{--} },--}}
                    {{--{ data: 'title', name: 'title' },--}}
                    {{--{ data: 'description', name: 'description' },--}}
                    {{--{ data: 'content', name: 'content' },--}}
                    {{--{ data: 'category_id', name: 'category_id' },--}}
                    {{--{ data: 'created_at', name: 'created_at' },--}}
                    {{--{ data: 'updated_at', name: 'updated_at' },--}}
                    {{--{ data: 'flag', name: 'flag' }--}}
                {{--]--}}
            {{--});--}}
        {{--});--}}



    </script>

@endsection
@section('script2')
<script type="text/javascript">
    //search
    $('.search_field').on('keyup','.search_content', function(e){
        if (e.keyCode == 27) {
            $('input.search_content').val("");
        }
        var search = $('input.search_content').val();
        $.ajax({
            type: 'post',
            url: '{{asset("")}}admin/post/search',
            data:{
                search: search
            },
            success: function (response) {
                if (response.html !== ''){
                    $('tbody').html(response.html);
                    $('.paginate').remove();
                }
                else {
                    $('tbody').html("<h3>Don't have any content like this</h3>");
                    $('.paginate').remove();
                }

            }
        })

    });

    // post and unpost

    $(document).on('click', '.checkflag',  function () {
            var id = $(this).data('id');
            var flagcheck = $('input[name^=check'+id+']:checked').val();
            if(flagcheck == 1){
                $.ajax({
                    type : 'put',
                    url: '{{asset("")}}admin/post/' + id +'/editflag',
                    data: {
                        flag: 1
                    },
                    success: function (response) {
                        toastr.success('Posted');
                    }
                });
            }
            else {
                $.ajax({
                    type : 'put',
                    url: '{{asset("")}}admin/post/' + id +'/editflag',
                    data: {
                        flag: 2
                    },
                    success: function (response) {
                        toastr.success('Unposted');
                    }
                });
            }

        });


</script>
@endsection
