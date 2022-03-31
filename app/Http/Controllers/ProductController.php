<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;



use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{

    //serves the admin to the dashboard page after checking the authentication 
    public function indexAdmin()
    {
        $products = Product::all();
        $data = [
            "products" => $products
        ];

        // return view('dashboard', $data);
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('dashboard', $data);
        } else {
            return view('home', $data);
        }
    }
    //serves the user to the home page  

    public function indexUser()
    {
        $products = Product::all();
        $data = [
            "products" => $products
        ];
        return view('home', $data);
    }

    //check if the role is admin to allow for adding items
    public function create()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('/product/create');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [

            "title" => "required",
            "description" => "required",
            "stock" => "required",
            "image" => "image|required",

        ];
        $data = $this->validate($request, $rules);
        $image = $request->file('image');


        //giving a unique file name to the image

        $fileName = str::random(30) . '.' . $image->getClientOriginalExtension();
        $request->file('image')->storeAs('public/images/', $fileName);

        $data["image"] =  $fileName;
        Product::create($data);

        return Response::redirectTo("/dashboard");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pruduct  $pruduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {


        if (Auth::check() && Auth::user()->role == 'admin') {
            $data = [
                "product" => $product
            ];
            return view('/product/update', $data);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pruduct  $pruduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [

            "title" => "required",
            "description" => "required",
            "stock" => "required",
            "image" => "image",

        ];
        $data = $this->validate($request, $rules);
        if ($request->hasFile('image')) {
            $oldImage = ('public/images/' . $product->image);
            $image = $request->file('image');
            //saving the new image
            $fileName = str::random(30) . '.' . $image->getClientOriginalExtension();
            $data["image"] =  $fileName;
            $request->file('image')->storeAs('public/images/', $fileName);
            $product->update($data);
            //delete the old image
            Storage::delete($oldImage);
        } else {
            $product->update($data);
            return Response::redirectTo("/dashboard");
        }

        //giving a unique file name to the new image







        return Response::redirectTo("/dashboard");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pruduct  $pruduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //delete the image before deleting the database record
        if (Storage::exists('public/images/' . $product->image)) {
            Storage::delete('public/images/' . $product->image);
        }
        // Storage::delete($imagePath);
        $product->delete();
        return Response::redirectTo("/dashboard");
    }
}
