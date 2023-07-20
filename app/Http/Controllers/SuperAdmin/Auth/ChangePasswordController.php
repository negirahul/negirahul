<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\Models\Admin;
use App\Models\SuperAdmin;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:super-admin');
    }

    public function changePasswordForm()
    {
        $id = Auth::guard('super-admin')->id();
        $user = SuperAdmin::find($id);
        return view('super-admin.settings.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $id = Auth::guard('super-admin')->id();

        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',

        ]);

        $user = SuperAdmin::find($id);

        if (Hash::check($request->get('current_password'), $user->password)) {

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('super-admin.password.form')->with('success', 'Password changed successfully!');
        } else {

            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        return redirect()->route('super-admin.password.form')->with('success', 'Password changed successfully');
    }
}
