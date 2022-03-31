@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center ">
                <div class="card w-100">
                    <div class="card-header">
                        <div class="row justify-content-between mt-3">
                            <div class="col-3">
                            </div>

                            <div class="col-3 text-center">
                                <h3> Products</h3>
                            </div>
                            <div class="col-3 text-right">
                                <a href="/products/create" class="btn btn-lg btn-success">Add</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row mb-3 text-center">
                            <div class="col-2">Image</div>
                            <div class="col-2">Name</div>
                            <div class="col-3">Description</div>
                            <div class="col-1">Stock</div>
                            <div class="col-1">Added</div>
                            <div class="col-1">Updated</div>
                            <div class="col-2">Action</div>
                        </div>
                        @foreach ($products as $index => $product)
                            <div class="row align-items-center text-center mb-2">
                                <div class="col-2"><img class="w-50"
                                        src="{{ asset('/storage/images/' . $product->image) }}" alt=""></div>
                                        
                                <div class="col-2">{{ $product->title }}</div>
                                <div class="col-3">{{ $product->description }}</div>
                                <div class="col-1">{{ $product->stock }}</div>
                                <div class="col-1">{{ $product->created_at }}</div>
                                <div class="col-1">{{ $product->updated_at }}</div>
                                <div class="col-2 text-center">
                                    <form method="post" action="/products/{{ $product->id }}">
                                        <a href="/products/{{ $product->id }}/edit" class="btn btn-lg btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <button type="submit" class="btn btn-lg btn-warning"><i
                                                class="bi bi-trash"></i></button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>


                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
