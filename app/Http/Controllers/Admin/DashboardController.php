<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssociatePartner;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // echo "<pre>";print_r(Auth()->user()->can('permissions:Hospital Module Creation/Editing Rights'));"</pre>";exit;
        $id = Auth()->user()->id;
        $admin  = Admin::find($id);
        $admin->permissions = $admin->getPermissionNames()->toArray();
        $role = Role::where('name', 'admin')->with('permissions')->first();
        $permissions =  $role->permissions;
        $total_associates = AssociatePartner::count();
        $vendor_associates = AssociatePartner::where('type', 'vendor')->count();
        $sales_associates = AssociatePartner::where('type', 'sales')->count();
        return view('admin.dashboard', compact('total_associates', 'vendor_associates', 'sales_associates'));
    }
}
