<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        .moblist_prf{ width:100%; padding:0;}

        .moblist_prf li{floath:left; list-style:none; display:inline;}
    </style>
    <title>Profile</title>
</head>
<body>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-xs-12 ">
            @if(isset($user->avatar))
                <img class="img-circle" src="{{asset('')}}/{{$user->avatar}}" width="200px" height="200px">
                @elseif($user->gender == 1)
            <img alt="User Pic" src="{{asset('')}}img/avatar-man-no-text-grey.jpg" class="img-circle" width="200px" height="auto">
                @else
                <img alt="User Pic" src="{{asset('')}}img/woman.jpg" class="img-circle" width="200px" height="auto">
            @endif
                <h3>{{$user->username}} (<span>
                        @if($user->isadmin === 1 or $user->isadmin === 2)
                        admin
                        @else
                        user
                        @endif
                        </span>)</h3>
            @if(Auth::user()->id === $user->id)
            <div class="text-right" style="padding-bottom:10px;">
                <ul class="moblist_prf">
                    <li><button class="btn btn-warning btn-sm" type="button" data-id="{{$user->id}}" >Edit Your Profile</button></li>
                    <li><button class="btn btn-info btn-sm" type="button" data-id="{{$user->id}}" >Edit Your Profile Picture</button></li>
                    <li><button class="btn btn-danger btn-sm" type="button" data-id="{{$user->id}}" id="btn_change">Change Password</button></li>
                    <li><a
                                @if(Auth::user()->isadmin === 2)
                                href="{{asset('/admin')}}"
                                        @elseif(Auth::user()->isadmin === 1)
                                        href="{{asset('/admin')}}"
                                        @else
                                href="{{asset('/')}}"
                                        @endif
                                class="btn btn-success btn-sm" type="button" >Home</a></li>
                </ul>
            </div>
                @elseif(Auth::user()->isadmin === 2)
                    <div class="text-right" style="padding-bottom:10px;">
                        <ul class="moblist_prf">
                            @if($user->id ===2)
                                @else
                            <li><button id="delete_user" class="btn btn-danger btn-sm" type="button" data-id="{{$user->id}}" >Delete this user</button></li>
                            @endif
                            <li><a
                                        @if(Auth::user()->isadmin === 2)
                                        href="{{asset('/admin')}}"
                                        @elseif(Auth::user()->isadmin === 1)
                                        href="{{asset('/admin')}}"
                                        @else
                                        href="{{asset('/')}}"
                                        @endif
                                        class="btn btn-success btn-sm" type="button" >Home</a></li>
                        </ul>
                    </div>
                @endif

        </div>
        <table class="table table-bordered">
            <tbody>

            <tr>
                <td>First Name</td>
                <td id="first_name1">{{$user->first_name}}</td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td id="last_name1">{{$user->last_name}}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td id="email1">{{$user->email}}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td id="gender1">
                    @if($user->gender === 1)Male
                        @elseif($user->gender === 0) Female
                        @endif
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td id="address1">{{$user->address}}</td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td id="phone1"> {{$user->phone}}</td>
            </tr>
            </tbody>
        </table>
        @if(Auth::user()->id === $user->id)
        {{--modal edit--}}
        <div class="modal fade" id="edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit profile</h4>
                    </div>
                    <form id="edit_profile">
                    <div class="modal-body">
                        <input type="hidden" id="hidden_edit">
                        <div class="form-group" id="add-title">
                            <label for="">First name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="first_name" id="first_name">
                        </div>
                        <div class="form-group" id="add-title">
                            <label for="">Last name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="last_name" id="last_name">
                        </div>
                        <div class="form-group" id="add-title">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="email" id="email">
                        </div>
                        <div class="form-group" id="add-title">
                            <label for="">Gender</label>
                            <select name="gender" id="gender">
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                            </select>
                        </div>
                        <div class="form-group" id="add-title">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="address" id="address">
                        </div>
                        <div class="form-group" id="add-title">
                            <label for="">Phone</label>
                            <input type="number" class="form-control" name="phone" placeholder="phone" id="phone">
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


        {{--modal change password--}}
        <div class="modal fade" id="password">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Change password</h4>
                    </div>
                    <form id="change-password">
                    <div class="modal-body">
                        <input type="hidden" id="hidden_password">

                        <div class="form-group">
                            <label for="">Old password</label>
                            <input type="password" class="form-control" name="old_password" placeholder="old_password" id="old_password">
                        </div>
                        <div class="form-group">
                            <label for="">New password</label>
                            <input type="password" class="form-control" name="new_password" placeholder="new_password" id="new_password">
                        </div>
                        <div class="form-group">
                            <label for="">Cofirm new password</label>
                            <input type="password" class="form-control" name="new_password1" placeholder="new_password" id="new_password1">
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

            {{--modal profile picture--}}
            <div class="modal fade" id="avatar">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <form enctype="multipart/form-data" id="change_avatar">
                        <div class="modal-body">
                            <input type="hidden" id="hidden_img">
                            <div class="form-group">
                                <label for="">Select your profile picture</label>
                                <input type="file" class="form-control" name="thumnails" id="image" onchange="readURL(this);">
                                <img class="blah" src="#" style="display: none;" />
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
        @endif

        @if(Auth::user()->isadmin === 2)
            @if($user->id === 2)
            @else
                <div class="modal fade" id="delete">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="del">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                </button>
                                <h4 class="modal-title">Detete user</h4>
                            </div>
                            <div class="modal-body">
                                <h3>Do you want to delete user :  <span>{{$user->username}}</span></h3>
                                <input id="delete_id" type="hidden" value="{{$user->id}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            @endif
        @endif
    </div>
</div>
@auth()

{{--script--}}
<script type="text/javascript">

    {{--setup ajax--}}

    $.ajaxSetup(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }
    );

    //show image when choose
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
    @if(Auth::user()->id === $user->id )
    //show edit profile
    $(document).on('click', '.btn-warning', function () {
        $('#edit').modal('show');
        var id = $(this).data('id');
        $.ajax({
            type : 'get',
            url: '{{asset("")}}/profile/' + id + '/edit',
            success: function (response) {
                $('#email').val(response.email);
                $('#phone').val(response.phone);
                $('#address').val(response.address);
                $('#first_name').val(response.first_name);
                $('#last_name').val(response.last_name);
                $('#hidden_edit').val(response.id);
                $('select option[value="' + response.gender + '"]').prop({defaultSelected: true});

            }
        });

    });
//    update profile
    $('#edit_profile').on('submit', function (e) {
        e.preventDefault();
        var id = $('#hidden_edit').val();
        $.ajax({
            type: 'put',
            url: '{{asset("")}}/profile/' + id,
            data: {
                'first_name': $('#first_name').val(),
                'last_name': $('#last_name').val(),
                'email': $('#email').val(),
                'address': $('#address').val(),
                'phone': $('#phone').val(),
                'gender': $('#gender').val()
            },
            success: function (response) {
                $('#edit').modal('hide');
                toastr.success('Update profile successfully');
                $('#first_name1').replaceWith('<td id="first_name1">' + response.first_name + '</td>');
                $('#last_name1').replaceWith('<td id="last_name1">' + response.last_name + '</td>');
                $('#email1').replaceWith('<td id="email1">' + response.email + '</td>');
                $('#phone1').replaceWith('<td id="phone1">' + response.phone + '</td>');
                $('#address1').replaceWith('<td id="address1">' + response.address + '</td>');
                if(response.gender === 1){
                    $('#gender').replaceWith('<td id="address1">Male</td>');
                }
                 else if (response.gender === 0){
                    $('#gender').replaceWith('<td id="address1">Female</td>');
                }

            },
            error: function (xhr, status, errorThrown) {

            }
        });
    });

//    show change password
$(document).on('click', '#btn_change', function () {
   $('#password').modal('show');
   var id = $(this).data('id');
   $('#hidden_password').val(id);
});
$('#change-password').on('submit',  function(e){
    e.preventDefault();
    var id = $('#hidden_password').val();
    console.log(id);
   $.ajax({
      type: 'put',
      url: '{{asset("")}}/changepassword/' +id,
       data:{
          'old_password': $('#old_password').val(),
          'new_password': $('#new_password').val(),
          'new_password1': $('#new_password1').val()
       },
       success: function(response) {
           $('#password').modal('hide');
           toastr.success('Change password successfully');
       }
   });
});

//show modal avatar
    $(document).on('click', '.btn-info', function () {
        $('#avatar').modal('show');
        var id = $(this).data('id');
        $('#hidden_img').val(id);
    });

//    change avatar
    $('#change_avatar').on('submit', function (e) {
        var filename = $('#image')[0].files[0]['name'];
        var filepath = 'img/' + filename;
        var id = $('#hidden_img').val();
        e.preventDefault();
        var formdata = new FormData($("#change_avatar")[0]);
        $.ajax({
            type:'post',
            url:'{{asset("admin/postimg")}}',
            data:formdata,
            cache:false,
            dataType:'text',
            processData: false,
            contentType: false,
            success:function(response){
                console.log(response);
            }
        });
        $.ajax({
           type: 'put',
           url: '{{asset("")}}/avatar/' + id,
            data: {
                'avatar': filepath
            },
            success: function (response) {
                $('#avatar').modal('hide');
                toastr.success('Change profile picture successfully');
                $('.img-circle').attr('src', '{{asset("")}}' + response.avatar);
            }

        });
    });
    @endif
    @if(Auth::user()->isadmin === 2 && $user->id != 2)
    $(document).on('click', '#delete_user', function () {
        $('#delete').modal('show');
    });
    $('#del').on('submit', function (e) {
        e.preventDefault();
        var id = $('#delete_id').val();
        $.ajax({
           type: 'delete',
           url:  '{{asset("")}}profile/' +id,
            success: function (response) {
                $('#delete').modal('hide');
                window.history.back();
                toastr.success('Delete user successfully');
            }
        });
    });

        @endif
</script>

@endauth

</body>
</html>