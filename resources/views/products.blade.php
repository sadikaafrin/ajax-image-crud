<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ajax Crud</title>
    <link href="{{asset('/')}}css/bootstrap.min.css" rel="stylesheet">
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2">

            </div>
                <div class="col-md-8">
                    <h3 class="my-5 text-center">Laravel 9 Ajax Crud</h3>
                    <a href="" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#addModal">Add Product</a>
                    <input type="text" name="search" id="search" class="mb-3 form-control" placeholder="Search Here">
                    <div class="table-data">
                        <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th>Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                <tr>
                                    {{-- <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td> --}}
                                   <th>{{$loop->iteration}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>
                                        <img src="{{ asset('/') }}/uploads/{{$product->image }}" alt="" height="100px" width="100px">
                                    {{-- {{  $product->image }} --}}
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-success
                                            update_product_form"
                                           data-bs-toggle="modal"
                                           data-bs-target="#updateModal"
                                           data-id="{{$product->id}}"
                                           data-name="{{$product->name}}"
                                           data-price="{{$product->price}}"
                                           data-image="{{$product->image}}"
                                        >
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href=""
                                           class="btn btn-danger delete_product"
                                           data-id="{{$product->id}}"
                                        >
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        {{-- {{ $products->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
   @include('add_product_modal')
    @include('update_add_product_modal')
   @include('product_js')
    {!! Toastr::message() !!}
</body>
</html>
