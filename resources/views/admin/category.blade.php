@extends('admin.admin-layout')
@section('page_name')
    CATEGORY
@endsection
@section('content')


{{--modal add category--}}
<button type="button" class="btn btn-xs btn-info btn-lg" data-toggle="modal" data-target="#add-cate">Add new category</button>

<!-- Modal  -->
<div class="modal fade" id="add-cate" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ADD CATEGORY</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" role="form" id="add-new">
                    @csrf
                    <div class="form-group" id="name-add">
                        <label for="">Category name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="name">
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
    {{--list category--}}
    <div class="table-reponsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>action</th>
            </tr>
            <tbody id="categorys">



            @foreach($categorys as $category)
                <tr class="tr{{ $category->id }}">
                    <td>{{ $category->id }}</td>
                    <td><a href="/admin/category/{{$category->id}}">{!! $category->name !!}</a></td>
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                    <td>{{ $category->updated_at->diffForHumans() }}</td>
                    <td>
                        <a href="/admin/category/{{$category->id}}" class="btn btn-xs btn-info">show</a>

                        <button class="btn btn-xs btn-warning"  data-id="{{ $category->id }}">edit</button>
                        <button class="btn btn-xs btn-danger"  data-id="{{ $category->id }}">delete</button>

                    </td>
                </tr>
            @endforeach
            </tbody>
            </thead>
        </table>
    </div>


    {{--modal edit--}}
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Edit category</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-product" role="form" method="post">
                        <input type="hidden" class="hidden-id-edit">
                        <div class="form-group" id="name-edit">
                            <label for="">name</label>
                            <input type="text" class="form-control" name="name" id="name_edit">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary edit-product">Save</button>
                        </div>
                    </form>
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
                    <h4>Are you sure to delete category : </h4>
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
        $(function () {

            //validate form
            // $('form').each(function () {
            //     $(this).validate({
            //         rules: {
            //             name: {
            //                 required: true
            //             }
            //         }
            //     });
            // });

            //setup ajax
            $.ajaxSetup(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            );

            //add new category
            $('#add-new').on('submit', function (e) {

                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '{{asset("admin/category")}}',
                    data: {
                        name: $('#name').val()
                    },
                    success: function (response) {
                        $('#add-cate').modal('hide');

                        toastr.success('Add category successfully');

                        // append
                        $('#categorys').prepend('<tr class ="tr'+response.id+'"><td>' + response.id + '</td><td><a href="category/' + response.id + '">' +  response.name + '</a></td><td>' + response.created + '</td><td> ' + response.updated + ' </td><td><button class="btn btn-xs btn-info"><a href="/admin/category/' + response.id + '" >show</a></button> <button class="btn btn-xs btn-warning" data-id="' + response.id + '">edit</button> <button class="btn btn-xs btn-danger" data-id="' + response.id + '" >delete</button></td></tr>');

                    },
                    error: function (xhr, status, errorThrown) {
                        var err = xhr.responseJSON.errors;
                        $('#name-add').append('<p style="color: crimson">'+ err['name'][0] +'</p>');

                    }
                })
            });
        //    end add category

            //    show modal edit
            $(document).on('click', '.btn-warning', function () {
                $('#edit').modal('show');
                var id = $(this).data('id');
                $.ajax({
                    type : 'get',
                    url: '{{asset("")}}/admin/category/' + id + '/edit',
                    success: function (response) {
                        $('#name_edit').val(response.name);
                        $('.hidden-id-edit').text(id);
                    }
                })
            });
//        end show modal edit
//        save update
            $('.modal-footer').on('click', '.edit-product', function(){

                var id = $('.hidden-id-edit').text();
                $.ajax({
                    type: 'put',
                    url: '{{asset("")}}/admin/category/' + id,
                    data: {
                        name: $('#name_edit').val()
                    },
                    success: function (response) {
                        $('#edit').modal('hide');
                        toastr.success('Edit category successfully');
                        $('.tr'+id).replaceWith('<tr class ="tr'+response.id+'"><td>' + response.id + '</td><td><a href="category/' + response.id + '">' +  response.name + '</a></td><td>' + response.created + '</td><td> ' + response.updated + ' </td><td><button class="btn btn-xs btn-info"><a href="/admin/category/' + response.id + '" >show</a></button>&nbsp;<button class="btn btn-xs btn-warning" data-id="' + response.id + '">edit</button>&nbsp;<button class="btn btn-xs btn-danger" data-id="' + response.id + '" >delete</button></td></tr>');
                    },
                    error: function (xhr, status, errorThrown) {
                        var err = xhr.responseJSON.errors;
                        $('#name-edit').append('<p style="color: crimson">'+ err['name'][0] +'</p>');

                    }
                });
            });
//        end save update

            //        show modal delete
            $(document).on('click', '.btn-danger', function () {
                $('#modal-del').modal('show');
                var id = $(this).data('id');
                $.ajax({
                    type : 'get',
                    url: '{{asset("")}}admin/category/' + id +'/edit',
                    success: function (response) {
                        $('#name-delete').text(response.name);
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
                    url: '{{asset("")}}admin/category/' + id,
                    // data: {
                    //     id: id
                    // },
                    success: function(response) {
                        $('#modal-del').modal('hide');
                        console.log(response.error);
                        if (response.error == true)
                            toastr.error('Please delete all posts of this category before delete');
                        else {toastr.success('Delete category successfully');
                        $('.tr'+id).remove();}
                    }
                });

            });
//        end delete
        });

    </script>

@endsection

