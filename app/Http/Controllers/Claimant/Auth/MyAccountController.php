<?php

namespace App\Http\Controllers\Claimant\Auth;

use App\Models\Claimant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:claimant');
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
     * @param  \App\Models\Superclaimant  $claimant
     * @return \Illuminate\Http\Response
     */
    public function show(Claimant $claimant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Superclaimant  $claimant
     * @return \Illuminate\Http\Response
     */
    public function edit(Claimant $claimant)
    {
        $id             = Auth::guard('claimant')->id();
        $claimant          = Claimant::find($id);
        $claimant->avatar  = isset($claimant->avatar) ? asset('storage/uploads/claimant/'.$claimant->avatar) : URL::to('assets/images/placeholder.png') ;
        return view('claimant.settings.my-account', compact('claimant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Superclaimant  $claimant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'firstname'=>'required',
            'email'=>'required',
        ]);

        $claimant          = Claimant::find($id);
        $claimant->firstname    = $request->firstname;
        $claimant->lastname    = $request->lastname;
        $claimant->email   = $request->email;
        $claimant->phone   = $request->phone;

        if($request->hasfile('avatar')){

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/claimant/', $name, 'public');

            if(isset($claimant->avatar)){

                $path   = 'public/uploads/claimant/'.$claimant->avatar;

                Storage::delete($path);

            }

            $claimant->avatar = $name;

        }

        $claimant->save();

        return redirect()->route('claimant.my-account.edit', $claimant->id)->with('success', 'Account updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Superclaimant  $claimant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Claimant $claimant)
    {
        //
    }
}
