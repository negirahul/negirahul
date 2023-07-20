<?php

namespace App\Http\Controllers\Associate\Auth;

use App\Models\AssociatePartner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:associate');
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
    public function show(AssociatePartner $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Superadmin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(AssociatePartner $admin)
    {
        $id             = Auth::guard('associate')->id();
        $admin          = AssociatePartner::find($id);
        $admin->avatar  = isset($admin->avatar) ? asset('storage/uploads/associate/'.$admin->avatar) : URL::to('assets/images/placeholder.png') ;
        return view('associate.settings.my-account', compact('admin'));
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
            'name'=>'required',
            'email'=>'required',
        ]);

        $admin          = AssociatePartner::find($id);
        $admin->name    = $request->name;
        $admin->email   = $request->email;
        $admin->phone   = $request->phone;

        if($request->hasfile('avatar')){

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/associate/', $name, 'public');

            if(isset($admin->avatar)){

                $path   = 'public/uploads/associate/'.$admin->avatar;

                Storage::delete($path);

            }

            $admin->avatar = $name;

        }

        $admin->save();

        return redirect()->route('associate-partner.my-account.edit', $admin->id)->with('success', 'Account updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Superadmin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssociatePartner $admin)
    {
        //
    }
}
