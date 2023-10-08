@extends('layouts.front')
@section('title', "$active_category->name || E-shop")
@section('content')
<div class="row " style="background-color: orange;">
    <div class="col-md-3 offset-md-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item ol-item mt-3"><a class="remove-line" href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item ol-item mt-3"><a class="remove-line" href="{{route('category-page')}}">Category</a></li>
                <li class="breadcrumb-item ol-item mt-3 active" aria-current="page">{{$active_category->name}}</li>
            </ol>
        </nav>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-10  offset-md-1 mt-3 ">
                <h2>{{$active_category->name}}</h2>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4  align-items-center ">
                                <img src="{{asset('assets/uploads/product/'.$product->image)}}" alt="" class="img-fluid ">
                            </div>
                            <div class="col-md-8">
                                <h2 class="card-title">{{$product->name}}
                                    @if($product->trending == '1')
                                        <label class="badge bg-warning float-end mb-0" style="font-size: 16px;">Trending</label>
                                    @endif
                                </h2>
                                <hr>
                                <label class="fw-bold"><strong>Selling Price:</strong> {{$product->selling_price}}</label>&nbsp;&nbsp;
                                <label class="me-0"><strong>Original Price:</strong> <s>{{$product->original_price}}</s></label>
                                <div class="mt-3">
                                        <p>{!! $product->small_description!!}</p>
                                </div>
                                <hr>
                                @if($product->status == '1')
                                    <label class="badge bg-success mb-0" style="font-size: 12px;">In Stock</label>
                                @else 
                                    <label class="badge bg-danger mb-0" style="font-size: 12px;">Out Of Stock</label>
                                @endif
                                <div class="row mt-2">
                                    <div class="col-md-3">
                                        <input type="hidden" value="{{$product->id}}" class="product_id">
                                        <label for="quantity">Quantity</label>
                                        <div class="input-group text-center mb-3">
                                            <span class="input-group-text decrement">-</span>
                                            <input type="text" class="form-control text-center qty-input" name="quantity" value="1"/>
                                            <span class="input-group-text increment">+</span>
                                        </div>               
                                    </div>
                                    <div class="col-md-8">
                                        <br>
                                        <!-- Add more product details as needed -->
                                        <button class="btn btn-success me-3 float-start">Add to Wishlist <i class="fa fa-heart"></i></button>
                                        <button class="btn btn-primary me-3 float-start addToCartBtn">Add to Cart <i class="fa fa-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if ($product->description)
                            <div class="mt-3">
                                <h2>Description</h2>
                                <div id="description">
                                    <p>{!! nl2br(e($product->description)) !!}</p>
                                    <!-- Add more paragraphs as needed -->
                                </div>
                                <button id="read-more-btn" class="btn btn-link d-none">Read More</button>
                                <button id="read-less-btn" class="btn btn-link d-none">Read Less</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection