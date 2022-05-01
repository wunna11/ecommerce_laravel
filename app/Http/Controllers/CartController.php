<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\RequestStack;


class CartController extends Controller
{
    public function cart()
    {
        if (!Session::has('client')) {
            return redirect()->route('user.login');
        }

        if (!Session::has('cart')) {
            return view('client.cart');
        }
        
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        // print_r($product);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        return redirect()->route('shop')->with('success', 'Product is added to cart!'); 
    }

    public function update(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQty($request->id, $request->quantity);
        Session::put('cart', $cart);
        
        return redirect()->route('cart')->with('success', 'Product quantity is updated');
    }

    public function delete($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items)) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->back()->with('success', 'Product is deleted from cart!');
    }
    
    // public function addToCart($id)
    // {
    //     $product = Product::findOrFail($id);
        
    //     // store cartitems
    //     $cartItems = session()->get('cartItems', []);

    //     if (isset($cartItems[$id]))
    //     {
    //         $cartItems[$id]['quantity']++;
    //     }
    //     else 
    //     {
    //         $cartItems[$id] = [
    //             'image' => $product->image,
    //             'name' => $product->name,
    //             'price' => $product->price,
    //             'quantity' => 1,
    //         ];
    //     };

    //     session()->put('cartItems', $cartItems);
    //     return redirect()->route('shop')->with('success', 'Product is added to cart!');
    // }

    // public function delete(Request $request)
    // {
    //     if ($request->id) {
    //         $cartItems = session()->get('cartItems');

    //         if (isset($cartItems[$request->id])) {
    //             unset($cartItems[$request->id]);
    //             session()->put('cartItems', $cartItems);
    //         }

    //         return redirect()->back()->with('success', 'Product is deleted from cart!');
    //     }
    // }

    // public function update(Request $request)
    // {
    //     if ($request->id && $request->quantity) {
    //         $cartItems = session()->get('cartItems');
    //         $cartItems[$request->id]['quantity'] = $request->quantity;

    //         session()->put('cartItems', $cartItems);
    //     }

    //     return redirect()->back()->with('success', 'Product added to cart!');
    // }

}

