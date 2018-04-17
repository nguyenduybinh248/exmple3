@extends('admin.post')
@section('page_name')
    Unposted
@endsection
@section('script2')
    <script type="text/javascript">

        // post and unpost
        $('.checkflag').each(function () {
            $(this).change(function () {
                var id = $(this).data('id');
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
            });
        });
    </script>
@endsection
