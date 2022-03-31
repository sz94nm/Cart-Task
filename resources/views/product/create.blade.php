@extends('layouts.master')
@section('content')
    <div class="container mt-3 ">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <a href="/dashboard" class="btn btn-primary ">Back</a>
                            </div>
                            <div class="col-auto">
                                <h3 class="my-0 mx-5">Add product</h3>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        @include('layouts.errors')
                        <form action="/products" method="post" class="form-group" enctype="multipart/form-data">
                            @csrf
                            <label for="title">Title</label>

                            <input value=""  placeholder="Title" type="text" name="title" class="form-control">

                            

                            <label for="description">Description</label>

                            <textarea  class="form-control"  name="description"
                                      placeholder="Description" id="description" cols="30" rows="5">{{old('description')}}</textarea>

                            <input value="" min="0" placeholder="Stock" type="number" name="stock" class="form-control mt-2">

                            <label for="image">Image</label> <input type="file" name="image" id="image" class="mt-3">
                            <div class="row justify-content-center m-3">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-success">Submit</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection