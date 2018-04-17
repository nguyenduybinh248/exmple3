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

    <title>test</title>
</head>
<body>
<form id="change-password" action="{{asset('')}}/change/{{Auth::user()->id}}" method="post">
@csrf
    {{--@method('PUT')--}}

        <div class="form-group">
            <label for="">Old password</label>
            <input type="text" class="form-control" name="old_password" placeholder="old_password" id="old_password">
        </div>
        <div class="form-group">
            <label for="">New password</label>
            <input type="text" class="form-control" name="new_password" placeholder="new_password" id="new_password">
        </div>
        <div class="form-group">
            <label for="">Cofirm new password</label>
            <input type="text" class="form-control" name="new_password1" placeholder="new_password" id="new_password1">
        </div>


        <button type="submit" class="btn btn-primary">Save changes</button>

</form>

</body>
</html>