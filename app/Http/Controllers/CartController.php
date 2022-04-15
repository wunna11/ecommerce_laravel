<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\RequestStack;

class CartController extends Controller
{
    public function cart()
    {
        // $value = session()->all('cartItems');
        // dd($value);
        return view('client.cart');
    }
    
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        
        // store cartitems
        $cartItems = session()->get('cartItems', []);

        if (isset($cartItems[$id]))
        {
            $cartItems[$id]['quantity']++;
        }
        else 
        {
            $cartItems[$id] = [
                'image' => $product->image,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        };

        session()->put('cartItems', $cartItems);
        return redirect()->route('shop')->with('success', 'Product is added to cart!');
    }

    public function delete(Request $request)
    {
        if ($request->id) {
            $cartItems = session()->get('cartItems');

            if (isset($cartItems[$request->id])) {
                unset($cartItems[$request->id]);
                session()->put('cartItems', $cartItems);
            }

            return redirect()->back()->with('success', 'Product is deleted from cart!');
        }
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cartItems = session()->get('cartItems');
            $cartItems[$request->id]['quantity'] = $request->quantity;

            session()->put('cartItems', $cartItems);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
