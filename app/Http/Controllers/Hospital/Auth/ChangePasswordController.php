<?php

namespace App\Http\Controllers\Hospital\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\Models\Hospital;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hospital');
    }

    public function changePasswordForm()
    {
        $id = Auth::guard('hospital')->id();
        $user = Hospital::find($id);
        return view('hospital.settings.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $id = Auth::guard('admin')->id();

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',

        ]);

        $user = Hospital::find($id);

        if (Hash::check($request->get('current_password'), $user->password)) {

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('hospital.password.form')->with('success', 'Password changed successfully!');
        } else {

            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        return redirect()->route('hospital.password.form')->with('success', 'Password changed successfully');
    }
}
