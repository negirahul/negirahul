<?php

namespace App\Http\Controllers\Claimant;

use App\Http\Controllers\Controller;
use App\Models\AssociatePartner;
use App\Models\Claimant;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:claimant');
    }

    public function index()
    {
        $id = Auth()->user()->id;
        $claimant  = Claimant::find($id);
        $claimant->permissions = $claimant->getPermissionNames()->toArray();
        $role = Role::where('name', 'claimant')->with('permissions')->first();
        $total_associates = AssociatePartner::count();
        $vendor_associates = AssociatePartner::where('type', 'vendor')->count();
        $sales_associates = AssociatePartner::where('type', 'sales')->count();
        return view('claimant.dashboard', compact('total_associates', 'vendor_associates', 'sales_associates'));
    }
}
