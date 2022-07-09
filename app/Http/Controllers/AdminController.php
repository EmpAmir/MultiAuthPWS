<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
    //         $user = Admin::where('email', $request->email)->first();
    //         Auth::guard('admin')->login($user);
    //         return redirect()->route('admin.home');
    //     }
    //     return redirect()->route('admin.login')->with('status', 'Failed To Process Login');
    // }
        /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('admin.home');
    }
        /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
        ? new JsonResponse([], 204)
        : redirect('/');
    }
    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
