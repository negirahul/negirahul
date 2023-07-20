<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Notifications\User\CredentialsGeneratedNotification;

class UserController extends Controller
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
        $users = User::query();
        if($filter_search){
            $users->where(DB::raw("concat(firstname, ' ', lastname)"), 'like','%' . $filter_search . '%');
        }
        $users = $users->orderBy('id', 'desc')->paginate(20);
        return view('employee.users.manage',  compact('users', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::where('name', 'user')->with('permissions')->first();
        $permissions =  $role->permissions;
        $admins = Admin::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        $users  = User::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        return view('employee.users.create.create',  compact('admins', 'users', 'permissions'));
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
            'linked_employee'          => $request->linked_with_superadmin == 'no' ? 'required' :'',
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

        $user                    =   User::create([
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

        $user->assignRole('user');
        $perm_user = User::find($user->id);
        $perm_user->syncPermissions($request->permission);
        $password = '12345678';
        $user->notify(new CredentialsGeneratedNotification($user->email, $password, $user));


        return redirect()->route('employee.users.index')->with('success', 'User created successfully');
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
        $role = Role::where('name', 'user')->with('permissions')->first();
        $permissions =  $role->permissions;
        $user  = User::find($id);
        $user->permissions = $user->getPermissionNames()->toArray();
        $admins = Admin::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        $users  = User::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        return view('employee.users.edit.edit',  compact('admins', 'users', 'user', 'permissions'));
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
            'uid'                      => 'required|string|max:8|unique:admins|unique:users,uid,'.$id,
            'designation'              => 'required|string|max:30',
            'email'                    => 'required|email|unique:admins|unique:hospitals|unique:associate_partners|unique:employees|unique:users,email,'.$id,
            'phone'                    => 'required|numeric|digits:10',
            'department'               => 'required',
            'linked_with_superadmin'   => 'required',
            'kra'                      =>  'required|string|max:40',
            'linked_employee'          => $request->linked_with_superadmin == 'no' ? 'required' :'',
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

        $user                    =   User::where('id', $id)->update([
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

        $perm_user = User::find($id);
        $perm_user->syncPermissions($request->permission);

        return redirect()->route('employee.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('employee.users.index')->with('success', 'User deleted successfully');
    }

    public function changePassword(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'new_password' => 'required|min:8|confirmed',

        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully');
    }
}
