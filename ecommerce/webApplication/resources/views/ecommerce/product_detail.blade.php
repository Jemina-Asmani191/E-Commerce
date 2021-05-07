@extends('ecommerce.layouts.master')
@section('title','Product_detail')
@section('content')

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Product Details</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/products')}}">Product</a></li>
                        <li class="breadcrumb-item active">{{$productDetails->name}} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

            @if(Session::has('flash_message_error'))
                <div class="alert alert-sm alert-danger alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
            @endif
            @if(Session::has('flash_message_success'))
                <div class="alert alert-sm alert-success alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
            @endif

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"> <img class="d-block w-100" src="{{asset('/uploads/products/'.$productDetails->image)}}" alt="First slide"> </div>
                            <!-- <div class="carousel-item"> <img class="d-block w-100" src="{{asset('/uploads/products/'.$productDetails->image)}}" alt="Second slide"> </div>
                            <div class="carousel-item"> <img class="d-block w-100" src="{{asset('/uploads/products/'.$productDetails->image)}}" alt="Third slide"> </div> -->
                        </div>
                        
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <form name="addtocart" enctype="multipart/form-data" method="post" action="{{url('/add_to_cart')}}">{{csrf_field()}}
                        <div class="single-product-details">
                            <input type="hidden" value="{{$productDetails->id}}" name="product_id">
                            <input type="hidden" value="{{$productDetails->name}}" name="product_name">
                            <input type="hidden" value="{{$productDetails->code}}" name="product_code">
                            <input type="hidden" value="{{$productDetails->color}}" name="product_color">
                            <input type="hidden" value="{{$productDetails->price}}" name="price" id="price">
                            <h2>{{$productDetails->name}}</h2>
                            <h5 id="getPrice">Rs. {{$productDetails->price}}</h5>
                                <p>
                                    <h4>Short Description:</h4>
                                    <p>{{$productDetails->description}}</p>
                                    <ul>
                                        <li>
                                            <div class="form-group size-st">
                                                <label class="size-label">Size</label>
                                                <select id="selSize" name="size" class="selectpicker show-tick form-control">
                                        <option value="0">Size</option>
                                        @foreach($productDetails->attributes as $sizes)
                                            <option value="{{$productDetails->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
                                        @endforeach
                                    </select>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group quantity-box">
                                                <label class="control-label">Quantity</label>
                                                <input class="form-control" name="quantity" value="1" min="1" max="20" type="number">
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="price-box-bar">
                                        <div class="cart-and-bay-btn">
                                            <button class="btn hvr-hover" data-fancybox-close="" type="submit" style="color:white;">Add to cart</button>
                                        </div>
                                    </div>

                                    
                                        {{-- <form action="{{url('/addtowishlist')}}"> {{csrf_field()}}
                                            <input type="text" value="{{$productDetails->id}}" name="pro_id">                                            
                                            <button class="btn hvr-hover" data-fancybox-close="" type="submit" style="color:white;">Add to Wishlist</button>
                                        </form> --}}
                                    

                                    {{-- <div class="add-to-btn">--}}
                                        {{-- <div class="add-comp">
                                            <form action="{{url('/addtowishlist')}}"> {{csrf_field()}}
                                                <input type="text" value="{{$productDetails->id}}" name="pro_id">
                                                <button type="submit" style="color:white" class="btn hvr-hover">Add to wishlist</button>
                                            </form>
                                            {{-- <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to Compare</a>
                                        </div> --}}
                                        {{--<div class="share-bar">
                                            <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                            <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                            <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                            <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                            <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                        </div>
                                    </div> --}}
                        </div>
                    </form>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
                        @foreach($featuredProducts as $featuredProduct)
                            <div class="item">
                                <div class="products-single fix">
                                    <div class="box-img-hover">
                                        <img src="{{asset('/uploads/products/'.$featuredProduct->image)}}" class="img-fluid" alt="Image">
                                        <div class="mask-icon">
                                            <ul>
                                                <li><a href="{{url('/products/'.$featuredProduct->id)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                            </ul>
                                            <!-- <a class="cart" href="#">Add to Cart</a> -->
                                        </div>
                                    </div>
                                    <div class="why-text">
                                        <h4 style="font-weight:bold;font-size:18px">{{$featuredProduct->name}}</h4>
                                        <h5 style="color:red;font-weight:500;font-size:16px">Rs. {{$featuredProduct->price}}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-01.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-02.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-03.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-04.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-05.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-06.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-07.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-08.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-09.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{asset('front_assets/images/instagram-img-05.jpg')}}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Feed  -->

@endsection