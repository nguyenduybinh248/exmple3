@extends('admin.admin-layout')
@section('page_name')
    User
@endsection
@section('content')

    {{--list user--}}
    <div class="table-reponsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Adress</th>
                <th>Created at</th>
                <th>Updated at</th>
                @if(Auth::user()->isadmin == 2)
                <th>Is admin</th>
                <th>action</th>
                    @endif
            </tr>
            <tbody id="categorys">



            @foreach($users as $user)
                <tr class="tr{{ $user->id }}">
                    <td>{{ $user->id }}</td>
                    <td><a href="/admin/user/{{$user->id}}">{{ $user->username }}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->adress}}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                    @if(Auth::user()->isadmin == 2)
                    <td>
                        <form action="">
                            <input type="checkbox" class="checkbox checkflag" name="usercheck" value="check" data-id ="{{$user->id}}"
                                   @if( $user->isadmin == 1 )checked
                            @elseif($user->isadmin == 0)
                                    @endif
                            ><br>
                        </form>
                    </td>
                    <td>
                        <button class="btn btn-xs btn-danger"  data-id="{{ $user->id }}">delete</button>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
            </thead>
        </table>
    </div>


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
                    <h4>Are you sure to delete user : </h4>
                    <p id="name-delete"></p>
                    <p>If you delete this user, all of user's post will delete</p>
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

            //setup ajax
            $.ajaxSetup(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            );


            //        show modal delete
            $(document).on('click', '.btn-danger', function () {
                $('#modal-del').modal('show');
                var id = $(this).data('id');
                $.ajax({
                    type : 'get',
                    url: '{{asset("")}}admin/user/' + id +'/edit',
                    success: function (response) {
                        $('#name-delete').text(response.username);
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
                    url: '{{asset("")}}admin/user/' + id,
                    success: function(response) {
                        $('#modal-del').modal('hide');
                        toastr.success('Delete user successfully');
                        $('.tr'+id).remove();
                    }
                });

            });
//        end delete
        });

    </script>

@endsection

