@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h1>ADD Product</h1>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn bg-gradient-primary mb-0" href="{{url('products')}}"><i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('store-product')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-12  mb-3 input-group-dynamic">
                            <label for="cat_id" class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="category_id">
                                <option value="">Select</option>
                                @foreach($Category as $Category)
                                    <option value="{{$Category->id}}">{{$Category->name}}</option>
                                @endforeach
                            </select>  
                        </div>
                        <div class="col-md-6">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" id="name">
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <textarea class="form-control" rows="3" placeholder="Small Description..." name="small_description" id="small_description" required></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <textarea class="form-control" rows="3" placeholder="Description..." name="description" id="description" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <label for="original_price" class="form-label">Original Price</label>
                                <input type="number" class="form-control" name="original_price" id="original_price" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <label for="selling_price" class="form-label">Selling Price</label>
                                <input type="number" class="form-control" name="selling_price" id="selling_price" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <label for="tax" class="form-label">Tax</label>
                                <input type="number" class="form-control" name="tax" id="tax" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity" id="quantity" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" id="meta_title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <label for="meta_keyword" class="form-label">Meta keyword</label>
                                <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <textarea class="form-control" rows="3" name="meta_description" placeholder="Description..." id="meta_description" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" name="status" id="status">
                            <label class="custom-control-label" for="status">Status</label>
                        </div>
                        <div class="col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" name="trending" id="trending">
                            <label class="custom-control-label" for="trending">Trending</label>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group  mb-3 input-group-dynamic">
                                <input type="file" name="image" id="image" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn bg-gradient-primary mb-0"><i class="material-icons text-sm">check</i>&nbsp;&nbsp;Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
