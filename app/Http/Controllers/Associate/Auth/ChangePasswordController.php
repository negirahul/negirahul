<?php

namespace App\Http\Controllers\Associate\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\Models\AssociatePartner;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:associate');
    }

    public function changePasswordForm()
    {
        $id = Auth::guard('associate')->id();
        $user = AssociatePartner::find($id);
        return view('associate.settings.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $id = Auth::guard('associate')->id();

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',

        ]);

        $user = AssociatePartner::find($id);

        if (Hash::check($request->get('current_password'), $user->password)) {

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('associate-partner.password.form')->with('success', 'Password changed successfully!');

        } else {

            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        return redirect()->route('associate-partner.password.form')->with('success', 'Password changed successfully');
    }

}
