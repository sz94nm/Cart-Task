@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between mt-3">
                            <div class="col-3">
                                <a href="/" class="btn btn-lg btn-primary"><i class="bi bi-arrow-left"></i>Back</a>
                            </div>

                            <div class="col-3 text-center">
                                <h3> My Cart</h3>
                            </div>
                            <div class="col-3 text-right">
                                <a href="/empty" class="btn btn-lg btn-warning">Empty Cart<i class="bi bi-trash"></i></a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row mb-3 text-center">
                            <div class="col-3">Image</div>
                            <div class="col-3">Product name</div>
                            <div class="col-3">Quantity</div>
                            <div class="col-3">Action</div>
                        </div>
                        @foreach ($cartItems as $index => $cart)
                            <div class="row align-items-center text-center">
                                <div class="col-3"><img class="w-50"
                                        src="{{ asset('/storage/images/' . $cart->product->image) }}" alt=""></div>
                                <div class="col-3">{{ $cart->product->title }}</div>
                                <div class="col-3">{{ $cart->quantity }}</div>

                                <div class="col-3 text-center">
                                    <form method="post" action="/cart/{{ $cart->id }}">
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

    </div>
@endsection
