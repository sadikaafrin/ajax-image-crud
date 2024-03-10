<script src="{{asset('/')}}js/bootstrap.bundle.min.js"></script>
{{--<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>--}}
<script src="{{asset('/')}}js/jquery-3.7.1.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function () {
    $(document).on('click','.add_product', function (e) {
        e.preventDefault();
        let name = $('#name').val();
        let price = $('#price').val();
        let image = $('#image')[0].files[0];

        let formData = new FormData();
        formData.append('name', name);
        formData.append('price', price);
        formData.append('image', image);

        $.ajax({
            url: "{{ route('add.product') }}",
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status == 'success') {
                    $('#addModal').modal('hide');
                    $('#addProductForm')[0].reset();
                    $('.table').load(location.href + ' .table');
                    toastr.success("Product added successfully", "Success");
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $('#errMsgContainer').append('<span class="text-danger">' + value + '</span><br>');
                });
            }
        });
    });



    //    Product show
    $(document).on('click', '.update_product_form', function () {
    let id = $(this).data('id');
    let name = $(this).data('name');
    let price = $(this).data('price');
    let image = $(this).data('image');
    // console.log(image);

    $('#up_id').val(id);
    $('#up_name').val(name);
    $('#up_price').val(price);



    $('#current_image').attr("src", "{{ asset('uploads/') }}/" + image);
    // $('#current_image').attr("src", image);
    $('#updateModal').modal('show');

});

// function edit(id){
//             let url = "{{  route('edit', ':id')}}";
//             url = url.replace(':id', id);
//             $.ajax({
//                 url: url,
//                 type: "GET",
//                 success: function(res) {
//                      $('#current_image').attr("src", "{{ asset('uploads/') }}/" + image);
//                     $('#updateModal').modal('show');
//                     // $('.up_image').html('<img src="{{asset('uploads/')}}/'+res.image+'" alt="image" id="up_image" width="80px">');
//                     $('#up_id').val(res.id);
//                     $('#up_name').val(res.name);
//                     $('#up_price').val(res.price);
//                 },
//                 error: function(err) {

//                 }
//             });
//         }


     //    Update Product
    $(document).on('click','.update_product', function (e) {
    e.preventDefault();
    let up_id = $('#up_id').val();
    let up_name = $('#up_name').val();
    let up_price = $('#up_price').val();
    let up_image = $('#up_image')[0].files[0];

    let formData = new FormData();
    formData.append('id', up_id);
    formData.append('name', up_name);
    formData.append('price', up_price);
    formData.append('image', up_image);

    $.ajax({
        url:"{{route('update.product')}}",
        method:'post',
        data:formData,
        contentType: false,
        processData: false,
        success:function (res) {
            if(res.status=='success'){
                $('#updateModal').modal('hide');
                $('#updateProductForm')[0].reset();
                $('.table').load(location.href+' .table');
                Command: toastr["success"]("Product update", "success")

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        },
        error:function (err) {
            let error = err.responseJSON;
            $.each(error.errors,function (index, value) {
                $('#errMsgContainer').append('<span class="text-danger">' + value + '</span><br>');
            });
        }
    });
});



        //    Delete Product
        $(document).on('click','.delete_product', function (e) {
            e.preventDefault();
            let product_id = $(this).data('id');
            if(confirm('Are you sure to delete this ?')){
                $.ajax({
                    url:"{{route('delete.product')}}",
                    method:'post',
                    data:{product_id:product_id},
                    success:function (res) {
                        if(res.status=='success'){
                            $('.table').load(location.href+' .table');
                            Command: toastr["success"]("Product Deleted", "success")

                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                        }
                    }
                });
            }

        });


       //   pagination
            //       $(document).on('click', '.pagination a', function (e) {
            //     e.preventDefault();
            //     let page2 = $(this).attr('href').split('page=')[1];
            //     loadProducts(page2);
            // });

            // function loadProducts(page2) {
            //     $.ajax({
            //         url: "{{ route('pagination.paginate-data') }}",
            //         data: { page: page2 },
            //         success: function (data) {
            //             $('.table-data').html(data);
            //         },
            //         error: function (xhr) {
            //             console.log(xhr.responseText);
            //         }
            //     });
            // }

    //        Search Product
        $(document).on('keyup', function (e) {
            e.preventDefault();
            let search_string = $('#search').val();
            $.ajax({
                url:"{{route('search.product')}}",
                method:"GET",
                data:{search_string:search_string},
                success:function (res) {
                    $('.table-data').html(res);
                    if(res.status=='nothing_found'){
                        $('.table-data').html('<span class="text-danger">'+'Nothing Found'+'</span>');
                    }
                }
            });
        })
    });
</script>
