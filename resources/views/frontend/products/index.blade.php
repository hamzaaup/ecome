@extends('layouts.front')
@section('title', "$active_category->name || E-shop")
@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>{{$active_category->name}}</h2>
                @foreach ($products as $product)
                    <div class="col-md-3 mt-3">
                        <a class="remove-line" href="{{url('/view-category/'.$active_category->slug.'/'.$product->slug)}}">
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
                        </a>
                    </div>
                @endforeach
        </div>
    </div>
</div>

@endsection