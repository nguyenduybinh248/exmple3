@extends('admin.post')
@section('page_name')
    Waiting Posts
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
                url: '{{asset("")}}admin/waitting/search',
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
    </script>
@endsection
