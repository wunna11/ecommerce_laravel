<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    public function login()
    {
        return view('client.login');
    }

    public function register()
    {
        return view('client.register');
    }


    public function post_login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $client = Client::where('email', request('email'))->first();

        if ($client) {
            if (Hash::check(request('password'), $client->password)) {
                session()->put('client', $client);

                return redirect()->route('index');
            } else {
                return back()->with('error', 'Wrong password or email');
            }
        } else {
            return back()->with('error', "You do not have a account");
        }
    }

    public function post_register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:clients|max:255',
            'password' => 'required|min:6'
        ]);

        if ($validated) {
            $client = new Client();
            $client->email = request('email');
            $client->password  = Hash::make(request('password'));

            $client->save();

            return redirect()->route('login');
        }

        return back()->withErrors($validated);
    }

    public function logout()
    {
        session()->forget('client');
        return back();
    }
}
