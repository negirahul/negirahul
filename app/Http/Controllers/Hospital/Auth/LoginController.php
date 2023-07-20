<?php

namespace App\Http\Controllers\Hospital\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:hospital')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        /*aG9zcGl0YWxAY2xhaW1zdGFjay5jb20=*/
        if (isset($request->login_token) && !empty($request->login_token)) {
            $email = base64_decode($request->login_token);
            $hospital = Hospital::where('email',$email)->first();

            if ($hospital) {

                if(Auth::guard('hospital')->loginUsingId($hospital->id))
                {
                    return redirect()->intended(route('hospital.patients.index'));

                }
            }
        }
        return view('hospital.auth.login');
    }

    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt to log the user in
        if(Auth::guard('hospital')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $request->remember))
        {
            return redirect()->intended(route('hospital.dashboard'));

        }else{

           return $this->sendFailedLoginResponse($request);
       }

   }

   /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        if(Auth::guard('hospital')->check()) // this means that the hospital was logged in.
        {
            Auth::guard('hospital')->logout();
            return redirect()->route('hospital.login');
        }
    }
}
