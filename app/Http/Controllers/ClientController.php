<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Facade\FlareClient\Http\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
        if (!session()->has('client')) {
            return redirect()->route('login');
        }
        
        if (!session()->has('cart')) {
            return redirect()->route('cart');
        }

        return view('client.checkout');
    }

    public function postCheckout(Request $request)
    {
        if (!session()->has('cart')) {
            return redirect()->route('cart');
        }

        $oldCart = Session::get('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_51KpSXIHCKQjvMlRDSGoyfbV1fEQG3INy9hBROEmXe0DenlSJc9nstGzoUzPYG562y8PcD5ciI5v6M0jMhW2zZXN200aHJnlKy0');
        try {
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => request('stripeToken'), // obtainded with Stripe.js
                "description" => "Test Charge",
            ));

            $order = new Order();
            $order->name = request('name');
            $order->address = request('address');
            $order->cart = serialize($cart);
            $order->payment_id = $charge->id;

            $order->save();

            $orders = Order::where('payment_id', $charge->id)->get();

            $orders->transform(function($order, $key) {
                $order->cart = unserialize($order->cart);

                return $order;
            });

            $email = Session::get('client')->email;

            Mail::to($email)->send(new SendMail($orders));

        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
            return redirect()->route('checkout');
        }

        Session::forget('cart');
        return redirect()->route('cart')->with('success', 'Purchase accomplished successfully !');
    }

    public function viewByCat($name)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $name)->get();

        return view('client.shop', compact('categories', 'products'));
    }
    
}
