<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportAdmin;
use App\Exports\ExportAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Notifications\Admin\CredentialsGeneratedNotification;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_search = $request->search;
        $users = Admin::query();
        if($filter_search){
            $users->where(DB::raw("concat(firstname, ' ', lastname)"), 'like','%' . $filter_search . '%');
        }
        $users = $users->orderBy('id', 'desc')->paginate(20);
        return view('user.users.manage',  compact('users', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $role = Role::where('name', 'user')->with('permissions')->first();
        $permissions =  $role->permissions;
        $users = Admin::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        $users  = User::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        return view('user.users.create.create',  compact('users', 'users', 'permissions'));
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
            'uid'                      => 'required|unique:users|unique:users|string|max:8',
            'designation'              => 'required|string|max:30',
            'email'                    => 'required|email|unique:users|unique:users|unique:hospitals|unique:associate_partners|unique:employees',
            'phone'                    => 'required|numeric|digits:10',
            'department'               => 'required',
            'linked_with_superadmin'   => 'required',
            'kra'                      => 'required|string|max:40',
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

        $user                    =   Admin::create([
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

        $perm_user = Admin::find($user->id);
        $perm_user->syncPermissions($request->permission);

        $password = '12345678';
        $user->notify(new CredentialsGeneratedNotification($user->email, $password, $user));

        return redirect()->route('user.users.index')->with('success', 'Admin created successfully');
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
        $user  = Admin::find($id);
        $user->permissions = $user->getPermissionNames()->toArray();
        $role = Role::where('name', 'user')->with('permissions')->first();
        $permissions =  $role->permissions;
        $users = Admin::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        $users  = User::orderBy('id', 'desc')->get(['id', 'firstname', 'lastname', 'employee_code', 'department']);
        return view('user.users.edit.edit',  compact('users', 'users', 'user', 'permissions'));
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
            'uid'                      => 'required|string|max:8|unique:users|unique:users,uid,'.$id,
            'designation'              => 'required|string|max:30',
            'email'                    => 'required|email|unique:users|unique:hospitals|unique:associate_partners|unique:employees|unique:users,email,'.$id,
            'phone'                    => 'required|numeric|digits:10',
            'department'               => 'required',
            'linked_with_superadmin'   => 'required',
            'kra'                      => 'required|string|max:40',
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

        $user                    =   Admin::where('id', $id)->update([
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
        $perm_user = Admin::find($id);
        $perm_user->syncPermissions($request->permission);

        return redirect()->route('user.users.index')->with('success', 'Admin updated successfully');
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
        return redirect()->route('user.users.index')->with('success', 'Admin deleted successfully');
    }

    public function importExport(Request $request){
        return view('user.users.import-export');
    }

    public function import(Request $request){
        Excel::import(new ImportAdmin, $request->file('file')->store('files'));
        return redirect()->back()->with('success', 'Your file successfully imported!!');;
    }

    public function export(Request $request){
        return Excel::download(new ExportAdmin, 'users.xlsx');
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
