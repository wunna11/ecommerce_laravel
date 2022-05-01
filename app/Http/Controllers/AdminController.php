<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use function Opis\Closure\unserialize;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function orders()
    {
        $orders = Order::get();

        $orders->transform(function($order, $key) {
            $order->cart = unserialize($order->cart);

            return $order;
        });
        return view('admin.orders', compact('orders'));
    }

}
