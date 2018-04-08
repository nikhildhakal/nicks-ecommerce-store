@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header">Products <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right">+ Add New</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">

                      <thead>

                        <tr>
                          <th>Name</th>
                          <th>Price</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>

                      </thead>

                      <tbody>

                        @foreach($products as $product)
                          <tr>

                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>

                            <td>

                              <a href="{{ route('products.edit', ["id" => $product->id ] ) }}" class="btn btn-info btn-sm">Edit</a>

                            </td>

                            <td>

                              <form class="form" action="{{ route('products.destroy', ["id" => $product->id ] ) }}" method="post">

                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>

                            </td>
                          </tr>
                        @endforeach
                      </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
