<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('client.index', compact('sliders', 'products'));
    }

    public function shop()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('client.shop', compact('products', 'categories'));
    }

    

    public function checkout()
    {
        if(!session()->has('cartItems'))
        {
            return redirect()->route('cart');
        }

        return view('client.checkout');
    }

    public function login()
    {
        return view('client.login');
    }

    public function register()
    {
        return view('client.register');
    }
    
    public function viewByCat($name)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $name)->get();

        return view('client.shop', compact('categories', 'products'));
    }
}
