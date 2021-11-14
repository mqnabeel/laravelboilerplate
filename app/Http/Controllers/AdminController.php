<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminController extends Controller
{
    //
    use AuthenticatesUsers;

    // public function login(Request $request){
       
    //     $credentials = $request->only('email','password');
    //     if(Auth::guard('admin')->attempt($credentials,$request->remmeber)){
    //         $user =  Admin::where('email',$request->email)->first();
    //         Auth::guard('admin')->login($user);
    //         return redirect()->route('admin.dashboard');
    //     }
    //     return redirect()->route('admin.login')->with('status','Failed tp Process Login');

    // }
    public function logout(Request $request)
    {
        $this->guard()->logout();

      
        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResource([], 204)
            : redirect('/');
    }
    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('admin.dashboard');
    }
    

    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.authenticate')->with('status','logout Succesfully');
    }
    // public function logout(){
    //     if(Auth::gurad('admin')->logout()){
    //         return redirect()->route('admin.authenticate')->with('status','logout Succesfully');
    //     }
    // }
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
