<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Prophecy\Call\Call;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\saveProductRequest;
use App\Http\Requests\updateProductRequest;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function products()
    {
        // Mail::raw('Hello World', function ($msg) {
        //     $msg->to('wana192770@gmail.com')->subject('Product List');
        // });
        
        $categories = Category::all();
        $products = Product::orderBy('id', 'desc')->get();

        // Mail::to('wana192770@gmail.com')->send(new SendMail($products));
        return view('admin.product.products', compact('categories', 'products'));

        
    }

    public function add()
    {
        $categories = Category::all();
        return view('admin.product.add_product', compact('categories'));
    }

    public function save(saveProductRequest $request)
    {
        $product = new Product();
        $product->name = request('name');
        $product->price = request('price');
        $product->category_id = request('category_id');
        $product->status = 1;

        $image = request('image');
        $imageName = uniqid()."_".$image->getClientOriginalName();
        $image->move(public_path("storage/product_images/"), $imageName);
        $product->image = $imageName;
        
        $product->save();

        return back()->with('success', 'The '.$product->name.' has been created successfully!');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.product.edit_product', compact('product', 'categories'));
    }

    public function update(updateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = request('name');
        $product->price = request('price');
        $product->category_id = request('category_id');
        $product->status = 1;

        if(request('image')) {
            $image = request('image');
            $imageName = uniqid()."_".$image->getClientOriginalName();
            $image->move(public_path("storage/product_images/"), $imageName);
            $product->image = $imageName;
        }

        $product->update();

        return back()->with('success', 'The '.$product->name.' has been updated successfully!');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if($product->image != 'noimage.jpg')
        {
            Storage::delete('public/slider_images/'.$product->image);
        }

        $product->delete();

        return back()->with('success', 'The '.$product->name.' has been deleted successfully!');
    }

    public function activate($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->update();

        return back()->with('success', 'The '.$product->name.' has been activated successfully!');
    }

    public function deactivate($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 0;
        $product->update();

        return back()->with('success', 'The '.$product->name.' has been deactivated successfully!');
    }
}
