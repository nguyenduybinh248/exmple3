@extends('admin.post')
@section('page_name')
    Waiting Posts
@endsection
@section('script2')
    <script type="text/javascript">

        // post and unpost
        $('.checkflag').each(function () {
            $(this).change(function () {
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
                            $('.tr'+id).remove();
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
                            $('.tr'+id).remove();
                        }
                    });
                }

            });
        });
    </script>
@endsection
