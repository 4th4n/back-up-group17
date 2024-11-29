<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Method para sa pag-display ng login page
    public function showLoginForm()
    {
        return view('login'); // Load ang login.blade.php
    }
    
    public function showDashboard()
    {
        return view('admin.dashboard'); // Loads resources/views/admin/dashboard.blade.php
    }

    // Method para sa pag-handle ng login logic
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Check if the user exists
        $user = \App\Models\User::where('email', $request->email)->first();
    
        if ($user) {
            // Check if the password matches
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->intended('admin_dashboard');
            } else {
                return back()->withErrors(['password' => 'Invalid password.']);
            }
        } else {
            return back()->withErrors(['email' => 'No user found with that email.']);
        }
    }

    // Method to handle logout and redirect to the login page
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user
        
        // Redirect to login page after logout
        return redirect()->route('login');
    }
    // public function index()
    // {
    //     $products = Product::all(); // Retrieve all products from the database
    //     return view('admin.dashboard', compact('products')); // Pass products to the view
    // }

}


