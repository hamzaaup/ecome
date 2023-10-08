@extends('layouts.front')
@section('title')
Home Page || E-shop
@endsection
@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{asset('frontend/images/home-decor-1.jpg')}}" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{asset('frontend/images/home-decor-2.jpg')}}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 " src="{{asset('frontend/images/home-decor-3.jpg')}}" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev d-none" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next d-none" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>Featured Products</h2>
            <div class="owl-carousel feature-carousel owl-theme">
                @foreach ($products as $product)
                    <div class="item mt-3">
                        <div class="card">
                            <div class="image-container">
                                <img src="{{asset('assets/uploads/product/'.$product->image)}}" alt="" class="product-image">
                            </div>
                            <div class="card-body">
                                <h5>{{$product->name}}</h5>
                                <span class="float-start">{{$product->selling_price}}</span>
                                <span class="float-end"><s>{{$product->original_price}}</s></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>Trending Categories</h2>
            <div class="owl-carousel feature-carousel owl-theme">
                @foreach ($popular_category as $popular_category)
                    <div class="item mt-3">
                        <a class="remove-line" href="{{url('/view-category/'.$popular_category->slug)}}">
                            <div class="card">
                                <div class="image-container">
                                    <img src="{{asset('assets/uploads/category/'.$popular_category->image)}}" alt="" class="category-image">
                                </div>
                                <div class="card-body">
                                    <h5>{{$popular_category->name}}</h5>
                                    <p>{{$popular_category->description}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection