@extends('admin-master')

@section('title', 'Many to many relation')

@section('header_link')
    <link href="{{ asset('/css/listProducts.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @endsection

    
@section('content_title', 'Many to many relation ')

@section('content')

    <div class="container py-5">
        <div class="row text-center text-white mb-5">
            <div class="col-lg-7 mx-auto">
                <h5> ( belongsToMany)</h5>
                <p>Category with multiple products</p>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-8 mx-auto">

                <!-- List group-->
                <ul class="list-group shadow">

                    @foreach($datas[0] as $data )
                    <!-- list group item-->
                    <li class="list-group-item">
                        <!-- Custom content-->
                        <h5 style="background-color: darkgray;padding: 10px;">category :{{ $data->name }} </h5>
                        <hr>

                        @foreach($data->product as $product )
                        <div class="media align-items-lg-center flex-column flex-lg-row p-3">

                            <div class="media-body order-2 order-lg-1">
                                <h5 class="mt-0 font-weight-bold mb-2">{{ $product->name }}</h5>
                                <div class="d-flex align-items-center justify-content-between mt-1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($product->product_photo as $image )
                            <div class="col-md-3"> <img src="/image/{{$image->image}}" style="height: 170px; width: 140px;" alt="Generic placeholder image"></div>
                            @endforeach
                        </div>
                        <!-- End -->
                        <hr>
                        @endforeach
                        @endforeach
                    </li> <!-- End -->

                </ul> <!-- End -->
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row text-center text-white mb-5">
            <div class="col-lg-7 mx-auto">
                <p>Products with multiple Category</p>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-8 mx-auto">

                <!-- List group-->
                <ul class="list-group shadow">

                    @foreach($datas[1] as $product )
                    <!-- list group item-->
                    <li class="list-group-item">
                        <!-- Custom content-->
                        <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                            <div class="row">
                                <div class="media-body order-2 order-lg-1">
                                    <h5 class="mt-0 font-weight-bold mb-2">{{ $product->name }}</h5>
                                    <div class="d-flex align-items-center justify-content-between mt-1">
                                        <ul class="list-inline small">
                                            @foreach($product->category as $category )
                                            <li class="list-inline-item m-0">{{ $category->name }}, </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($product->product_photo as $image )
                            <div class="col-md-3"> <img src="/image/{{$image->image}}" style="height: 170px; width: 140px;" alt="Generic placeholder image"></div>
                            @endforeach
                        </div>
                        <!-- End --> 
                    </li> <!-- End -->
                    @endforeach
                </ul> <!-- End -->
            </div>
        </div>
    </div>
    @endsection