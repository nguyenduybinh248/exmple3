
    $(function () {

        //validate form
        $('form').each(function () {
            $(this).validate({
                rules: {
                    name: {
                        required: true
                    }
                }
            });
        });

        //setup ajax
        $.ajaxSetup(
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }
        );
        //add new product
        $('#add-new').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '{{asset("admin/category")}}',
                data: {
                    name: $('#name').val()
                },
                success: function (response) {
                    $('#add').modal('hide');

                    toastr.success('Sản phẩm thêm thành công');

                    // append
                    $('#categorys').prepend('<tr class ="tr'+response.id+'"><td>' + response.id + '</td><td>' +  response.name + '</td><td>' + response.created_at + '</td><td> ' + response.updated_at + ' </td><td><button class="btn btn-xs btn-info"><a >show</a></button><button class="btn btn-xs btn-warning" data-id="' + response.id + '">edit</button><button class="btn btn-xs btn-danger" data-id="' + response.id + '" >delete</button></td></tr>');

                },
                error: function (error) {

                }
            })
        });
        //end add new product


        //    show modal edit
        // $(document).on('click', '.btn-warning', function () {
        //     $('#edit').modal('show');
        //     var id = $(this).data('id');
        //     $.ajax({
        //         type : 'get',
        //         url: '{{asset("")}}product/' + id,
        //         success: function (response) {
        //             $('#name_edit').val(response.name);
        //             $('#price_edit').val(response.price);
        //             $('.hidden-id-edit').text(id);
        //         }
        //     })
        // });
// //        end show modal edit
// //        save update
//         $('.modal-footer').on('click', '.edit-product', function(){
//
//             var id = $('.hidden-id-edit').text();
//             $.ajax({
//                 type: 'put',
//                 url: '{{asset("")}}product/' + id,
//                 data: {
//                     name: $('#name_edit').val(),
//                     price: $('#price_edit').val()
//
//                 },
//                 success: function (response) {
//                     $('#edit').modal('hide');
//                     toastr.success('Sửa sản phẩm thành công');
//                     $('.tr'+id).replaceWith('<tr class ="tr'+response.id+'"><td>' + response.id + '</td><td>' +  response.name + '</td><td>' + response.price + '</td><td>' + response.created_at + '</td><td> ' + response.updated_at + ' </td><td><button class="btn btn-xs btn-info" data-id="' + response.id + '">show</button><button class="btn btn-xs btn-warning" data-id="'+ response.id +'">edit</button><button class="btn btn-xs btn-danger" data-id="' + response.id + '" >delete</button></td></tr>');
//                 }
//             });
//         });
// //        end save update
//
// //        show modal delete
//         $(document).on('click', '.btn-danger', function () {
//             $('#modal-del').modal('show');
//             var id = $(this).data('id');
//             $.ajax({
//                 type : 'get',
//                 url: '{{asset("")}}product/' + id,
//                 success: function (response) {
//                     $('#name-delete').text(response.name);
//                     $('.hidden-id').text(id);
//                 }
//             });
//         });
// //        end show modal delete
//
// //        delete
//         $('.modal-footer').on('click', '.delete-del', function(){
//             var id = $('.hidden-id').text();
//             $.ajax({
//                 type: 'delete',
//                 url: '{{asset("")}}product/' + id,
//                 data: {
//                     id: id
//                 },
//                 success: function(data) {
//                     $('#modal-del').modal('hide');
//                     toastr.success('Xóa sản phẩm thành công');
//                     $('.tr'+id).remove();
//                 }
//             });
//
//         });
//        end delete
    });
