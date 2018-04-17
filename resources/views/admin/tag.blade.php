@extends('admin.admin-layout')
@section('page_name')
    Tag
@endsection
@section('content')

    {{--list tag--}}
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



            @foreach($tags as $tag)
                <tr class="tr{{ $tag->id }}">
                    <td>{{ $tag->id }}</td>
                    <td><a href="/admin/tag/{{$tag->id}}">{{ $tag->name }}</a></td>
                    <td>{{ $tag->created_at->diffForHumans() }}</td>
                    <td>{{ $tag->updated_at->diffForHumans() }}</td>
                    <td>
                        <a href="/admin/tag/{{$tag->id}}" class="btn btn-xs btn-info">show</a>

                        <button class="btn btn-xs btn-warning"  data-id="{{ $tag->id }}">edit</button>
                        <button class="btn btn-xs btn-danger"  data-id="{{ $tag->id }}">delete</button>

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
                    <form id="edit-tag" role="form" method="post">
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
                    <h4>Are you sure to delete tag : </h4>
                    <p id="name-delete"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary delete-del">Yes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{ $tags->links() }}
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

            //    show modal edit
            $(document).on('click', '.btn-warning', function () {
                $('#edit').modal('show');
                var id = $(this).data('id');
                $.ajax({
                    type : 'get',
                    url: '{{asset("")}}/admin/tag/' + id + '/edit',
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
                    url: '{{asset("")}}/admin/tag/' + id,
                    data: {
                        name: $('#name_edit').val()
                    },
                    success: function (response) {
                        $('#edit').modal('hide');
                        toastr.success('Edit category successfully');
                        $('.tr'+id).replaceWith('<tr class ="tr'+response.id+'"><td>' + response.id + '</td><td><a href="tag/' + response.id + '">' +  response.name + '</a></td><td>' + response.created_at + '</td><td> ' + response.updated_at + ' </td><td><button class="btn btn-xs btn-info"><a href="/admin/tag/' + response.id + '" >show</a></button>&nbsp;<button class="btn btn-xs btn-warning" data-id="' + response.id + '">edit</button>&nbsp;<button class="btn btn-xs btn-danger" data-id="' + response.id + '" >delete</button></td></tr>');
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
                    url: '{{asset("")}}admin/tag/' + id +'/edit',
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
                    url: '{{asset("")}}admin/tag/' + id,
                    success: function(response) {
                        $('#modal-del').modal('hide');
                        console.log(response.error);
                        toastr.success('Delete tag successfully');
                        $('.tr'+id).remove();
                    }
                });

            });
//        end delete
        });

    </script>

@endsection

