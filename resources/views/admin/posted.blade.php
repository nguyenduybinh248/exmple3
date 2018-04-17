@extends('admin.post')
@section('page_name')
    Posted
    @endsection
@section('link')
    {{ $posts->links() }}
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
                            flag: 2
                        },
                        success: function (response) {
                            toastr.success('Unposted');
                            $('.tr'+id).remove();
                        }
                    });
            });
        });
    </script>
@endsection