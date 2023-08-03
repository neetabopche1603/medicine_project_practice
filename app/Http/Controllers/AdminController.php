<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    // Admin View
    public function adminLoginView(){
        return view('authentications.login');
    }
    // Admin Login
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Check if "remember" checkbox is checked

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            // Admin logged in successfully
            return redirect()->intended('admin/dashboard');
        }

        // Failed login attempt
        return redirect()->back()->with(['error' => 'Invalid credentials']);
    }

    // Admin Logout
    public function adminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('adminLoginView');
    }
}
