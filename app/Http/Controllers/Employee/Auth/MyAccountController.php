<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Superadmin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $admin)
    {
        $id             = Auth::guard('employee')->id();
        $admin          = Employee::find($id);
        $admin->avatar  = isset($admin->avatar) ? asset('storage/uploads/employee/'.$admin->avatar) : URL::to('assets/images/placeholder.png') ;
        return view('employee.settings.my-account', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Superadmin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'firstname'=>'required',
            'email'=>'required',
        ]);

        $admin          = Employee::find($id);
        $admin->firstname    = $request->firstname;
        $admin->lastname    = $request->lastname;
        $admin->email   = $request->email;
        $admin->phone   = $request->phone;

        if($request->hasfile('avatar')){

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/employee/', $name, 'public');

            if(isset($admin->avatar)){

                $path   = 'public/uploads/employee/'.$admin->avatar;

                Storage::delete($path);

            }

            $admin->avatar = $name;

        }

        $admin->save();

        return redirect()->route('employee.my-account.edit', $admin->id)->with('success', 'Account updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Superadmin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $admin)
    {
        //
    }
}
