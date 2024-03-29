<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin');
    }

    public function showLoginForm()
    {
      return view ('auth.admin-login');
    }

    public function login (Request $request)
    {
      // validate the form data
      $this->validate($request, [
        'email'  =>  'required|email',
        'password' => 'required|min:6'
      ]);

      // Attemp to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // If successful, then redirect to their intended location
        return redirect()->intended(route('admin.dashboard'));
      }

        // If unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
