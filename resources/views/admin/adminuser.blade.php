@extends('admin.user')
@section('page_name')
    USER
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
                url: '{{asset("")}}admin/adminuser/search',
                data:{
                    search: search
                },
                success: function (response) {
                    if (response.html !== ''){
                        $('tbody').html(response.html);
                    }
                    else {
                        $('tbody').html("<h3>Don't have any content like this</h3>");
                    }

                }
            })

        });
        $(document).on('click','.checkflag', function () {
            var id = $(this).data('id');
            if ($('#check'+id).is( ":checked" )){
                $.ajax({
                    type: 'put',
                    url : '{{asset("")}}admin/user/change/' + id,
                    data:{
                        isadmin: 1
                    },
                    success: function (response) {
                        toastr.success(response.username + '  became admin');
                    }
                })
            }
            else {
                $.ajax({
                    type: 'put',
                    url : '{{asset("")}}admin/user/change/' + id,
                    data:{
                        isadmin: 0
                    },
                    success: function (response) {
                        toastr.success(response.username + "  is'nt admin anymore");
                        $('.tr'+id).remove();
                    }
                })
            }
        });

    </script>
@endsection