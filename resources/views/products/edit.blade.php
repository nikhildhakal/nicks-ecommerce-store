@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header">Add New Product</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form" action="{{ route('products.update' , ['id' => $product->id ] ) }}" method="post" enctype="multipart/form-data">

                      {{ csrf_field() }}

                      {{ method_field('PUT') }}

                      <div class="form-group">

                          <label class="control-label">Product Name:</label>
                          <input type="text" name="name" value="{{ $product->name }}" class="form-control">

                      </div>

                      <div class="form-group">

                          <label class="control-label">Price:</label>
                          <input type="number" name="price" value="{{ $product->price }}" class="form-control">

                      </div>
                      <div class="form-group">

                          <label class="control-label">Image:</label>
                          <input type="file" name="image" value="" class="form-control">

                      </div>
                      <div class="form-group">

                          <label class="control-label">Description</label>
                          <textarea name="description" rows="10" cols="80" class="form-control">{{ $product->description }}</textarea>

                      </div>

                      <button type="submit" class="btn btn-success btn-block">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
