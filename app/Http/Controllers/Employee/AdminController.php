<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Notifications\Admin\CredentialsGeneratedNotification;

class AdminController extends Controller
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
    public function index(Request $request)
    {
        $filter_search = $request->search;
        $admins = Admin::query();
        if($filter_search){
            $admins->where(DB::raw("concat(firstname, ' ', lastname)"), 'like','%' . $filter_search . '%');
        }
        $admins = $admins->orderBy('id', 'desc')->paginate(20);
        return view('employee.admins.manage',  compact('admins', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::where('name', 'admin')->with('permissions')->first();
        $permissions =  $role->permissions;
        $admins = Admin::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        $users  = User::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        return view('employee.admins.create.create',  compact('admins', 'users', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'firstname'                => 'required|string|max:15',
            'lastname'                 => isset($request->lastname) ? 'string|max:30' : '',
            'uid'                      => 'required|unique:admins|unique:users|string|max:8',
            'designation'              => 'required|string|max:30',
            'email'                    => 'required|email|unique:admins|unique:users|unique:hospitals|unique:associate_partners|unique:employees',
            'phone'                    => 'required|numeric|digits:10',
            'department'               => 'required',
            'linked_with_superadmin'   => 'required',
            'kra'                      =>  'required|string|max:40',
            'linked_employee'          => $request->linked_with_superadmin == 'no' ? 'required' : '',
            'linked_employee_id'       => $request->linked_with_superadmin == 'no' ? 'required' : '',
        ];

        $messages = [
            'firstname.required'             => 'Please enter firstname',
            'uid.required'                   => 'Please enter employee code.',
'uid.unique'                   => 'This Employee Code is already taken.',
            'designation.required'           => 'Please enter designation.',
            'email.required'                 => 'Please enter official mail ID.',
            'phone.required'                 => 'Please enter contact number.',
            'department.required'            => 'Please select department.',
            'kra.required'                   => 'Please enter KRA',
            'linked_employee.required'       => 'Please select linked employee.',
            'linked_employee_id.required'    => 'Please enter linked employee ID.',
        ];

        $this->validate($request, $rules, $messages);

        $admin                    =   Admin::create([
            'firstname'           =>  $request->firstname,
            'lastname'            =>  $request->lastname,
            'uid'                 =>  $request->uid,
            'employee_code'       =>  'EMP'.$request->uid,
            'designation'         =>  $request->designation,
            'email'               =>  $request->email,
            'phone'               =>  $request->phone,
            'password'            =>  Hash::make('12345678'),
            'department'          =>  $request->department,
            'linked_with_superadmin' => $request->linked_with_superadmin,
            'kra'                 =>  $request->kra,
            'linked_employee'     =>  $request->linked_employee,
            'linked_employee_id'  =>  $request->linked_employee_id
        ]);

        $admin->assignRole('admin');

        $perm_admin = Admin::find($admin->id);
        $perm_admin->syncPermissions($request->permission);

        $password = '12345678';
        $admin->notify(new CredentialsGeneratedNotification($admin->email, $password, $admin));

        return redirect()->route('employee.admins.index')->with('success', 'Admin created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where('name', 'admin')->with('permissions')->first();
        $permissions =  $role->permissions;
        $admin  = Admin::find($id);
        $admin->permissions = $admin->getPermissionNames()->toArray();
        $admins = Admin::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        $users  = User::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        return view('employee.admins.edit.edit',  compact('admins', 'users', 'admin', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'firstname'                => 'required|string|max:15',
            'lastname'                 => isset($request->lastname) ? 'string|max:30' : '',
            'uid'                      => 'required|string|max:8|unique:users|unique:admins,uid,'.$id,
            'designation'              => 'required|string|max:30',
            'email'                    => 'required|email|unique:users|unique:hospitals|unique:associate_partners|unique:employees|unique:admins,email,'.$id,
            'phone'                    => 'required|numeric|digits:10',
            'department'               => 'required',
            'linked_with_superadmin'   => 'required',
            'kra'                      =>  'required|string|max:40',
            'linked_employee'          => $request->linked_with_superadmin == 'no' ? 'required' : '',
            'linked_employee_id'       => $request->linked_with_superadmin == 'no' ? 'required' : '',
        ];

        $messages = [
            'firstname.required'             => 'Please enter firstname',
            'uid.required'                   => 'Please enter employee code.',
'uid.unique'                   => 'This Employee Code is already taken.',
            'designation.required'           => 'Please enter designation.',
            'email.required'                 => 'Please enter official mail ID.',
            'phone.required'                 => 'Please enter contact number.',
            'department.required'            => 'Please select department.',
            'kra.required'                   => 'Please enter KRA',
            'linked_employee.required'       => 'Please select linked employee.',
            'linked_employee_id.required'    => 'Please enter linked employee ID.',
        ];

        $this->validate($request, $rules, $messages);

        $admin                    =   Admin::where('id', $id)->update([
            'firstname'           =>  $request->firstname,
            'lastname'            =>  $request->lastname,
            'uid'                 =>  $request->uid,
            'employee_code'       =>  'EMP'.$request->uid,
            'designation'         =>  $request->designation,
            'email'               =>  $request->email,
            'phone'               =>  $request->phone,
            'department'          =>  $request->department,
            'linked_with_superadmin' => $request->linked_with_superadmin,
            'kra'                 =>  $request->kra,
            'linked_employee'     =>  $request->linked_employee,
            'linked_employee_id'  =>  $request->linked_employee_id
        ]);

        $perm_admin = Admin::find($id);
        $perm_admin->syncPermissions($request->permission);

        return redirect()->route('employee.admins.index')->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        return redirect()->route('employee.admins.index')->with('success', 'Admin deleted successfully');
    }

    public function changePassword(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'new_password' => 'required|min:8|confirmed',

        ]);

        $user = Admin::find($id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully');
    }
}
