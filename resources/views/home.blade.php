@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="m-5 ">Products</h2>
        </div>

        <div class="row justify-content-left px-5">
            @foreach ($products as $index => $product)
                <div class="col-12 col-md-5 col-lg-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('/storage/images/' . $product->image) }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            @if ($product->stock > 0)
                                <div class="badge bg-success my-2">in stock</div>
                            @else
                                <div class="badge bg-danger my-2 ">out of stock</div>
                            @endif



                            <p class="card-text">{{ $product->description }}</p>


                            <button class="btn btn-primary float-right  addToCart" data-toggle="modal"
                                data-target="#addToCartModal{{ $product->id }}" {{ $product->stock < 1 ? 'disabled' : '' }}>Add to
                                cart</button>
                        
                        </div>
                    </div>
                </div>
                <!-- add to cart Modal -->
                <div class="modal fade" id="addToCartModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="CartModal"
                    aria-hidden="true">

                    <div class="modal-dialog" role="document">
                        <form action="/cart" method="post" class="form-group" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="CartModal">Add product to cart</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if (Auth::check())
                                        <label for="title">Quantity</label>

                                        <input value="1" max="{{ $product->stock }}" placeholder="Quantity" type="number"
                                            name="quantity" class="form-control">
                                        <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" id="product_stock" name="product_stock" value="{{ $product->stock }}">
                                        Remaining : {{ $product->stock }}
                                    @else
                                        <div class="container">
                                            <div class="row  justify-content-center">
                                                <p>You Must Be Logged In To Do This</p>
                                            </div>
                                            <div class="row  justify-content-center"><a href="/login"
                                                    class="btn btn-primary">Log
                                                    In</a></div>
                                        </div>
                                    @endif

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                                    @if (Auth::check())
                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                    @endif

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                {{-- modal --}}
            @endforeach
        </div>


    </div>
@endsection
