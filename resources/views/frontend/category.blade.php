@extends('layouts.front')
@section('title')
Home Page || E-shop
@endsection
@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>All Categories</h2>
                @foreach ($active_category as $active_category)
                        <div class="col-md-3 mt-3">
                            <a class="remove-line" href="{{url('/view-category/'.$active_category->slug)}}">
                                <div class="card">
                                    <div class="image-container">
                                        <img src="{{asset('assets/uploads/category/'.$active_category->image)}}" alt="" class="category-image">
                                    </div>
                                    <div class="card-body">
                                        <h5>{{$active_category->name}}</h5>
                                        <span class="float-start">{{$active_category->description}}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                @endforeach
        </div>
    </div>
</div>
@endsection