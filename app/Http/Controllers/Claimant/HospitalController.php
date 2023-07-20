<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssociatePartner;
use App\Models\Insurer;
use App\Models\Hospital;
use App\Models\HospitalFacility;
use App\Models\HospitalInfrastructure;
use App\Models\HospitalDepartment;
use App\Models\HospitalTieUp;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportHospital;
use App\Exports\ExportHospital;
use App\Notifications\Hospital\CredentialsGeneratedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HospitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_search = $request->search;
        $hospitals = Hospital::query();
        if($filter_search){
            $hospitals->where('name', 'like','%' . $filter_search . '%');
        }
        $hospitals = $hospitals->orderBy('id', 'desc')->paginate(20);
        return view('admin.hospitals.manage',  compact('hospitals', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $associates = AssociatePartner::get(['name', 'city', 'state', 'id', 'associate_partner_id']);
        $users      = User::get();

        return view('admin.hospitals.create.create',  compact('associates', 'users'));
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
            'name'                     => 'required|min:1|max:60',
            'firstname'                => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:15' : [],
            'lastname'                => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:30' : [],
            'onboarding'               => 'required',
            'by'                       => 'required',
            'pan'                      => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u' : [],
            'panfile'                  => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'rohini'                   => 'required|size:13',
            'rohinifile'               => 'required',
            'code'                     => 'required|numeric|digits:3',
            'landline'                 => 'required|numeric|digits_between:1,10',
            'email'                    => 'required|unique:hospitals|email|min:1|max:45',
            'address'                  => 'required',
            'city'                     => 'required',
            'state'                    => 'required',
            'pincode'                  => 'required|numeric',
            'phone'                    => 'required|numeric|digits:10',
            'linked_associate_partner_id'     => ($request->by == 'Associate Partner') ? 'required' : [],
            'linked_associate_partner'   => ($request->by == 'Associate Partner') ? 'required' : [],
            'assigned_employee'        => 'required',
            'assigned_employee_id'     => 'required',
            'linked_employee'          => 'required',
            'linked_employee_id'       => 'required',
            'assigned_employee_department'        => 'required',
            'linked_employee_department'        => 'required',
        ];

        $messages = [
            'name.required'                   => 'Please enter hospital name',
            'firstname.required'              => 'Please enter owner firstname',
            'onboarding.required'             => 'Please select hospital onboarding.',
            'by.required'                     => 'Please select hospital by.',
            'pan.required'                    => 'Please enter PAN number.',
            'panfile.required'                => 'Please upload PAN Card.',
            'rohini.required'                 => 'Please enter Rohini code.',
            'landline.required'               => "Please enter hospital landline",
            'email.required'                  => 'Please enter official email ID.',
            'address.required'                => 'Please enter address.',
            'city.required'                   => 'Please enter city.',
            'state.required'                  => 'Please enter state.',
            'pincode.required'                => 'Please enter pincode.',
            'phone.required'                  => 'Please enter hospital mobile number.',
            'linked_associate_partner_id.required'   => 'Please enter associate partner ID.',
            'linked_associate_partner.required' => 'Please enter associate partner name.',
        ];

        $this->validate($request, $rules, $messages);

        $hospital                      =  Hospital::create([
            'name'                     => $request->name,
            'onboarding'               => $request->onboarding,
            'by'                       => $request->by,
            'address'                  => $request->address,
            'city'                     => $request->city,
            'state'                    => $request->state,
            'pincode'                  => $request->pincode,
            'password'                 => Hash::make('12345678'),
            'firstname'                => $request->firstname,
            'lastname'                 => $request->lastname,
            'pan'                      => $request->pan,
            'email'                    => $request->email,
            'code'                     => $request->code,
            'landline'                 => $request->landline,
            'phone'                    => $request->phone,
            'rohini'                   => $request->rohini,
            'linked_associate_partner' => $request->linked_associate_partner,
            'linked_associate_partner_id' => $request->linked_associate_partner_id,
            'assigned_employee'        => $request->assigned_employee,
            'assigned_employee_department'        => $request->assigned_employee_department,
            'linked_employee_department'        => $request->linked_employee_department,
            'assigned_employee_id'     => $request->assigned_employee_id,
            'linked_employee'          => $request->linked_employee,
            'linked_employee_id'       => $request->linked_employee_id,
            'comments'                 => $request->comments
        ]);

        $password = '12345678';
        $hospital->notify(new CredentialsGeneratedNotification($hospital->email, $password, $hospital));

        Hospital::where('id', $hospital->id)->update([
            'uid'      => 'HSP'.$hospital->id
        ]);

        if ($request->hasfile('panfile')) {
            $panfile                    = $request->file('panfile');
            $name                       = $panfile->getClientOriginalName();
            $panfile->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'panfile'               =>  $name
            ]);
        }

        if ($request->hasfile('rohinifile')) {
            $rohinifile                    = $request->file('rohinifile');
            $rhnname                       = $rohinifile->getClientOriginalName();
            $rohinifile->storeAs('uploads/hospital/' . $hospital->id . '/', $rhnname, 'public');
            Hospital::where('id', $hospital->id)->update([
                'rohinifile'               =>  $rhnname
            ]);
        }

        return redirect()->route('admin.hospitals.index')->with('success', 'Hospital created successfully');
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
        $hospital          = Hospital::find($id);
        $insurers          = Insurer::all();
        $associates = AssociatePartner::get(['name', 'city', 'state', 'id', 'associate_partner_id']);
        $hospital_tie_ups          = HospitalTieUp::where('hospital_id', $id)->first();
        if (!$hospital_tie_ups) {
            HospitalTieUp::create(['hospital_id'=> $id]);
            $hospital_tie_ups          = HospitalTieUp::where('hospital_id', $id)->first();
        }
        $hospital_facility          = HospitalFacility::where('hospital_id', $id)->first();
        if (!$hospital_facility) {
            HospitalFacility::create(['hospital_id'=> $id]);
            $hospital_facility          = HospitalFacility::where('hospital_id', $id)->first();
        }
        $hospital_nfrastructure          = HospitalInfrastructure::where('hospital_id', $id)->first();
        $hospital_department          = HospitalDepartment::where('hospital_id', $id)->first();
        $hospitals         = Hospital::get();
        $users              = User::get();

        return view('admin.hospitals.edit.edit',  compact('hospital', 'associates', 'hospitals', 'hospital_facility', 'hospital_nfrastructure', 'hospital_department', 'hospital_tie_ups', 'users', 'insurers'));
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
        $hospital             = Hospital::find($id);

        if ($request->hasfile('panfile')) {
            $panfile                    = $request->file('panfile');
            $name                       = $panfile->getClientOriginalName();
            $panfile->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'panfile'               =>  $name
            ]);
        }

        if ($request->hasfile('tanfile')) {
            $tanfile                    = $request->file('tanfile');
            $name                       = $tanfile->getClientOriginalName();
            $tanfile->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'tanfile'               =>  $name
            ]);
        }

        if ($request->hasfile('gstfile')) {
            $gstfile                    = $request->file('gstfile');
            $name                       = $gstfile->getClientOriginalName();
            $gstfile->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'gstfile'               =>  $name
            ]);
        }

        if ($request->hasfile('cancel_cheque_file')) {
            $cancel_cheque_file                    = $request->file('cancel_cheque_file');
            $name                       = $cancel_cheque_file->getClientOriginalName();
            $cancel_cheque_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'cancel_cheque_file'               =>  $name
            ]);
        }

        if ($request->hasfile('tariff_list_soc_file')) {
            $tariff_list_soc_file                    = $request->file('tariff_list_soc_file');
            $name                       = $tariff_list_soc_file->getClientOriginalName();
            $tariff_list_soc_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'tariff_list_soc_file'               =>  $name
            ]);
        }

        if ($request->hasfile('nabh_registration_file')) {
            $nabh_registration_file                    = $request->file('nabh_registration_file');
            $name                       = $nabh_registration_file->getClientOriginalName();
            $nabh_registration_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'nabh_registration_file'               =>  $name
            ]);
        }

        if ($request->hasfile('nabl_registration_file')) {
            $nabl_registration_file                    = $request->file('nabl_registration_file');
            $name                       = $nabl_registration_file->getClientOriginalName();
            $nabl_registration_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'nabl_registration_file'               =>  $name
            ]);
        }

        if ($request->hasfile('signed_mous_file')) {
            $signed_mous_file                    = $request->file('signed_mous_file');
            $name                       = $signed_mous_file->getClientOriginalName();
            $signed_mous_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'signed_mous_file'               =>  $name
            ]);
        }

        if ($request->hasfile('other_documents_file')) {
            $other_documents_file                    = $request->file('other_documents_file');
            $name                       = $other_documents_file->getClientOriginalName();
            $other_documents_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'other_documents_file'               =>  $name
            ]);
        }

        if ($request->hasfile('iso_status_file')) {
            $iso_status_file                    = $request->file('iso_status_file');
            $name                       = $iso_status_file->getClientOriginalName();
            $iso_status_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'iso_status_file'               =>  $name
            ]);
        }

        if ($request->hasfile('pollution_clearance_certificate_file')) {
            $pollution_clearance_certificate_file   = $request->file('pollution_clearance_certificate_file');
            $name = $pollution_clearance_certificate_file->getClientOriginalName();
            $pollution_clearance_certificate_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'pollution_clearance_certificate_file'               =>  $name
            ]);
        }

        if ($request->hasfile('certificate_of_incorporation_file')) {
            $certificate_of_incorporation_file                    = $request->file('certificate_of_incorporation_file');
            $name                       = $certificate_of_incorporation_file->getClientOriginalName();
            $certificate_of_incorporation_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'certificate_of_incorporation_file'               =>  $name
            ]);
        }

        if ($request->hasfile('fire_safety_clearance_certificate_file')) {
            $fire_safety_clearance_certificate_file                    = $request->file('fire_safety_clearance_certificate_file');
            $name                       = $fire_safety_clearance_certificate_file->getClientOriginalName();
            $fire_safety_clearance_certificate_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            Hospital::where('id', $hospital->id)->update([
                'fire_safety_clearance_certificate_file'               =>  $name
            ]);
        }

        if ($request->hasfile('rohinifile')) {
            $rohinifile                    = $request->file('rohinifile');
            $rhnname                       = $rohinifile->getClientOriginalName();
            $rohinifile->storeAs('uploads/hospital/' . $hospital->id . '/', $rhnname, 'public');
            Hospital::where('id', $hospital->id)->update([
                'rohinifile'               =>  $rhnname
            ]);
        }


        $rules = [
            'name'                                      => 'required|min:1|max:60',
            'firstname'                                 => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:15' : [],
            'lastname'                                  => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:30' : [],
            'onboarding'                                => 'required',
            'by'                                        => 'required',
            'pan'                                       => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|size:10' : [],
            'pan'                                       => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u' : [],
            'rohini'                                    => 'required|size:13',
            'rohinifile'                                => (empty($hospital->rohinifile)) ?  'required' : [],
            'code'                                      => 'required|numeric|digits:3',
            'landline'                                  => 'required|numeric|digits_between:1,10',
            'email'                                     => 'required|email|min:1|max:45|unique:hospitals,email,'.$id,
            'address'                                   => 'required',
            'city'                                      => 'required',
            'assigned_employee_department'        => 'required',
            'linked_employee_department'        => 'required',
            'state'                                     => 'required',
            'pincode'                                   => 'required|numeric',
            'phone'                                     => 'required|numeric|digits:10',
            'linked_associate_partner_id'               => ($request->by == 'Associate Partner') ? 'required' : [],
            'linked_associate_partner'                  => ($request->by == 'Associate Partner') ? 'required' : [],
            'assigned_employee'                         => 'required',
            'assigned_employee_id'                      => 'required',
            'linked_employee'                           => 'required',
            'linked_employee_id'                        => 'required',
            'tan'                                       => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:10' : [],
            'tanfile'                                   => ($request->onboarding == 'Tie Up' && empty($hospital->tanfile)) ? 'required' : [],
            'gst'                                       => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:15' : [],
            'gstfile'                                   => ($request->onboarding == 'Tie Up' && empty($hospital->gstfile)) ? 'required' : [],
            'owner_email'                               => ($request->onboarding == 'Tie Up') ? 'required|email|min:1|max:45' : [],
            'owner_phone'                               => ($request->onboarding == 'Tie Up') ? 'required|numeric|digits:10' : [],
            'contact_person_firstname'                  => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:15' : [],
            'contact_person_lastname'                  => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:30' : [],
            'contact_person_email'                      => ($request->onboarding == 'Tie Up') ? 'required|email|min:1|max:45' : [],
            'contact_person_phone'                      => ($request->onboarding == 'Tie Up') ? 'required|numeric|digits:10' : [],
            'registration_no'                           => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:20' : [],
            'medical_superintendent_firstname'          => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:15' : [],
            'medical_superintendent_lastname'          => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:30' : [],
            'medical_superintendent_email'              => ($request->onboarding == 'Tie Up') ? 'required|email|min:1|max:45' : [],
            'medical_superintendent_mobile'             => ($request->onboarding == 'Tie Up') ? 'required|numeric|digits:10' : [],
            'medical_superintendent_registration_no'    => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:20' : [],
            'medical_superintendent_qualification'      => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:30' : [],
            'pollution_clearance_certificate'           => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'pollution_clearance_certificate_file'      => ($request->onboarding == 'Tie Up' && $request->pollution_clearance_certificate != 'No' && empty($hospital->pollution_clearance_certificate_file)) ? 'required' : [],
            'fire_safety_clearance_certificate'         => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'fire_safety_clearance_certificate_file'    => ($request->onboarding == 'Tie Up' && $request->fire_safety_clearance_certificate != 'No' && empty($hospital->fire_safety_clearance_certificate_file)) ? 'required' : [],
            'certificate_of_incorporation'              => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'certificate_of_incorporation_file'         => ($request->onboarding == 'Tie Up' && $request->certificate_of_incorporation != 'No' && empty($hospital->certificate_of_incorporation_file)) ? 'required' : [],
            'bank_name'                                 => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:45' : [],
            'bank_address'                              => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:80' : [],
            'cancel_cheque'                             => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'cancel_cheque_file'                      => ($request->onboarding == 'Tie Up' && $request->cancel_cheque == 'Yes' && empty($hospital->cancel_cheque_file)) ? 'required' : [],
            'bank_account_no'                           => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:20' : [],
            'bank_ifs_code'                             => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:11' : [],
            'nabh_registration_no'                      => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:15' : [],
            'nabh_registration_file'                    => ($request->onboarding == 'Tie Up' && empty($hospital->nabh_registration_file)) ? 'required' : [],
            'nabl_registration_no'                      => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:15' : [],
            'nabl_registration_file'                    => ($request->onboarding == 'Tie Up' && empty($hospital->nabl_registration_file)) ? 'required' : [],
            'tariff_list_soc'                           => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'tariff_list_soc_file'                      => ($request->onboarding == 'Tie Up' && $request->tariff_list_soc == 'Yes' && empty($hospital->tariff_list_soc_file)) ? 'required' : [],
            'signed_mous'                               => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'signed_mous_file'                          => ($request->onboarding == 'Tie Up' && $request->signed_mous == 'Yes' && empty($hospital->signed_mous_file)) ? 'required' : [],
            'other_documents'                           => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'other_documents_file'                      => ($request->onboarding == 'Tie Up' && $request->other_documents == 'Yes' && empty($hospital->other_documents_file)) ? 'required' : [],
            'iso_status'                                => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'iso_status_file'                           => ($request->onboarding == 'Tie Up' && $request->iso_status == 'Yes' && empty($hospital->iso_status_file)) ? 'required' : [],
            'hrms_software'                             => ($request->onboarding == 'Tie Up') ? 'required' : [],
        ];

        $messages = [
            'name.required'                                     => 'Please enter hospital name',
            'firstname.required'                                => 'Please enter owner firstname',
            'onboarding.required'                               => 'Please select hospital onboarding.',
            'by.required'                                       => 'Please select hospital by.',
            'pan.required'                                      => 'Please enter PAN number.',
            'rohini.required'                                   => 'Please enter Rohini code.',
            'landline.required'                                 => "Please enter hospital landline",
            'email.required'                                    => 'Please enter official email ID.',
            'address.required'                                  => 'Please enter address.',
            'city.required'                                     => 'Please enter city.',
            'state.required'                                    => 'Please enter state.',
            'pincode.required'                                  => 'Please enter pincode.',
            'phone.required'                                    => 'Please enter hospital mobile number.',
            'associate_partner_id.required'                     => 'Please enter associate partner ID.',
            'associate_partner_name.required'                   => 'Please enter associate partner name.',
            'tan.required'                                      => 'Please Enter Tan',
            'gst.required'                                      => 'Please Enter Gst',
            'owner_email.required'                              => 'Please Enter Owner Email',
            'owner_phone.required'                              => 'Please Enter Owner Phone',
            'contact_person_firstname.required'                 => 'Please Enter Contact Person Firstname',
            'contact_person_email.required'                     => 'Please Enter Contact Person Email',
            'contact_person_phone.required'                     => 'Please Enter Contact Person Phone',
            'registration_no.required'                          => 'Please Enter Registration No',
            'medical_superintendent_firstname.required'         => 'Please Enter Medical Superintendent Firstname',
            'medical_superintendent_email.required'             => 'Please Enter Medical Superintendent Email',
            'medical_superintendent_mobile.required'            => 'Please Enter Medical Superintendent Mobile',
            'medical_superintendent_registration_no.required'   => 'Please Enter Medical Superintendent Registration No',
            'medical_superintendent_qualification.required'     => 'Please Enter Medical Superintendent Qualification',
            'pollution_clearance_certificate.required'          => 'Please Enter Pollution Clearance Certificate',
            'pollution_clearance_certificate_file.required'     => 'Please Enter Pollution Clearance Certificate File',
            'fire_safety_clearance_certificate.required'        => 'Please Enter Fire Safety Clearance Certificate',
            'fire_safety_clearance_certificate_file.required'   => 'Please Enter Fire Safety Clearance Certificate File',
            'certificate_of_incorporation.required'             => 'Please Enter Certificate Of Incorporation',
            'certificate_of_incorporation_file.required'        => 'Please Enter Certificate Of Incorporation File',
            'bank_name.required'                                => 'Please Enter Bank Name',
            'bank_address.required'                             => 'Please Enter Bank Address',
            'cancel_cheque.required'                            => 'Please Enter Cancel Cheque',
            'bank_account_no.required'                          => 'Please Enter Bank Account No',
            'bank_ifs_code.required'                            => 'Please Enter Bank Ifs Code',
            'tariff_list_soc.required'                          => 'Please Enter Tariff List Soc',
            'nabh_registration_no.required'                     => 'Please Enter Nabh Registration No',
            'nabl_registration_no.required'                     => 'Please Enter Nabl Registration No',
            'signed_mous.required'                              => 'Please Enter Signed Mous',
            'other_documents.required'                          => 'Please Enter Other Documents',
            'hrms_software.required'                            => 'Please Select Hrms Software',
            'iso_status.required'                               => 'Please Enter Iso Status',
        ];

        $this->validate($request, $rules, $messages);

        Hospital::where('id', $id)->update([
            'name'                                      => $request->name,
            'onboarding'                                => $request->onboarding,
            'by'                                        => $request->by,
            'address'                                   => $request->address,
            'city'                                      => $request->city,
            'state'                                     => $request->state,
            'pincode'                                   => $request->pincode,
            'password'                                  => Hash::make('12345678'),
            'firstname'                                 => $request->firstname,
            'lastname'                                  => $request->lastname,
            'pan'                                       => $request->pan,
            'email'                                     => $request->email,
            'landline'                                  => $request->landline,
            'code'                                      => $request->code,
            'phone'                                     => $request->phone,
            'rohini'                                    => $request->rohini,
            'linked_associate_partner'                  => $request->linked_associate_partner,
            'linked_associate_partner_id'               => $request->linked_associate_partner_id,
            'assigned_employee'                         => $request->assigned_employee,
            'assigned_employee_department'              => $request->assigned_employee_department,
            'linked_employee_department'                => $request->linked_employee_department,
            'assigned_employee_id'                      => $request->assigned_employee_id,
            'linked_employee'                           => $request->linked_employee,
            'linked_employee_id'                        => $request->linked_employee_id,
            'tan'                                       => $request->tan,
            'gst'                                       => $request->gst,
            'owner_email'                               => $request->owner_email,
            'owner_phone'                               => $request->owner_phone,
            'contact_person_firstname'                  => $request->contact_person_firstname,
            'contact_person_lastname'                   => $request->contact_person_lastname,
            'contact_person_email'                      => $request->contact_person_email,
            'contact_person_phone'                      => $request->contact_person_phone,
            'registration_no'                           => $request->registration_no,
            'medical_superintendent_firstname'          => $request->medical_superintendent_firstname,
            'medical_superintendent_lastname'           => $request->medical_superintendent_lastname,
            'medical_superintendent_email'              => $request->medical_superintendent_email,
            'medical_superintendent_mobile'             => $request->medical_superintendent_mobile,
            'medical_superintendent_registration_no'    => $request->medical_superintendent_registration_no,
            'medical_superintendent_qualification'      => $request->medical_superintendent_qualification,
            'pollution_clearance_certificate'           => $request->pollution_clearance_certificate,
            'fire_safety_clearance_certificate'         => $request->fire_safety_clearance_certificate,
            'certificate_of_incorporation'              => $request->certificate_of_incorporation,
            'bank_name'                                 => $request->bank_name,
            'bank_address'                              => $request->bank_address,
            'cancel_cheque'                             => $request->cancel_cheque,
            'bank_account_no'                           => $request->bank_account_no,
            'bank_ifs_code'                             => $request->bank_ifs_code,
            'tariff_list_soc'                           => $request->tariff_list_soc,
            'nabh_registration_no'                      => $request->nabh_registration_no,
            'nabl_registration_no'                      => $request->nabl_registration_no,
            'signed_mous'                               => $request->signed_mous,
            'other_documents'                           => $request->other_documents,
            'hrms_software'                             => $request->hrms_software,
            'iso_status'                                => $request->iso_status,
            'comments'                                  => $request->comments
        ]);

        Hospital::where('id', $hospital->id)->update([
            'uid'      => 'HSP'.$hospital->id
        ]);



        return redirect()->back()->with('success', 'Hospital updated successfully');
    }


    public function updateHospitalTieUps(Request $request, $id)
    {
        $hospital             = Hospital::find($id);
        $hospital_tie_ups             = HospitalTieUp::where('hospital_id',$id)->first();


        if ($request->hasfile('bhc_packages_for_surgical_procedures_accepted_file')) {
            $bhc_packages_for_surgical_procedures_accepted_file                    = $request->file('bhc_packages_for_surgical_procedures_accepted_file');
            $name                       = $bhc_packages_for_surgical_procedures_accepted_file->getClientOriginalName();
            $bhc_packages_for_surgical_procedures_accepted_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            HospitalTieUp::where('hospital_id', $hospital->id)->update([
                'bhc_packages_for_surgical_procedures_accepted_file'               =>  $name
            ]);
        }

        if ($request->hasfile('lending_finance_company_agreement_file')) {
            $lending_finance_company_agreement_file                    = $request->file('lending_finance_company_agreement_file');
            $name                       = $lending_finance_company_agreement_file->getClientOriginalName();
            $lending_finance_company_agreement_file->storeAs('uploads/hospital/' . $hospital->id . '/', $name, 'public');
            HospitalTieUp::where('hospital_id', $hospital->id)->update([
                'lending_finance_company_agreement_file'               =>  $name
            ]);
        }

        $rules = [
            'mou_inception_date'                            => ($hospital->onboarding == 'Tie Up' && $hospital->signed_mous == 'Yes') ? 'required' : [],
            'bhc_packages_for_surgical_procedures_accepted' => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'bhc_packages_for_surgical_procedures_accepted_file' => ($hospital->onboarding == 'Tie Up' && $request->bhc_packages_for_surgical_procedures_accepted == 'Yes' && empty($hospital_tie_ups->bhc_packages_for_surgical_procedures_accepted_file)) ? 'required' : [],
            'discount_on_medical_management_cases'          => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'discount_on_final_bill'                        => ($hospital->onboarding == 'Tie Up' && $request->discount_on_medical_management_cases == 'Yes') ? 'required|numeric|digits_between:1,2' : [],
            'discount_on_room_rent'                         => ($hospital->onboarding == 'Tie Up' && $request->discount_on_medical_management_cases == 'Yes') ? 'required|numeric|digits_between:1,2' : [],
            'discount_on_medicines'                         => ($hospital->onboarding == 'Tie Up' && $request->discount_on_medical_management_cases == 'Yes') ? 'required|numeric|digits_between:1,2' : [],
            'discount_on_consumables'                       => ($hospital->onboarding == 'Tie Up' && $request->discount_on_medical_management_cases == 'Yes') ? 'required|numeric|digits_between:1,2' : [],
            'referral_commission_offered'                   => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'referral'                                      => ($hospital->onboarding == 'Tie Up' && $request->referral_commission_offered == 'Yes') ? 'required|numeric|digits_between:1,2' : [],
            'claimstag_usage_services'                      => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'claimstag_installation_charges'                => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,6' : [],
            'claimstag_usage_charges'                       => ($hospital->onboarding == 'Tie Up') ? 'required||numeric|digits_between:1,6' : [],
            'claims_reimbursement_insured_services'         => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'claims_reimbursement_insured_service_charges'  => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,6' : [],
            'cashless_claims_management_services'           => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'cashless_claims_management_services_charges'   => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,6' : [],
            'lending_finance_company_agreement'             => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'lending_finance_company_agreement_file'             => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes' && empty($hospital_tie_ups->lending_finance_company_agreement_file)) ? 'required' : [],
            'lending_finance_company_agreement_date'        => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required' : [],
            'medical_lending_for_patients'                  => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required' : [],
            'medical_lending_service_type'                  => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required' : [],
            'subvention'                                    => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required|max:2' : [],
            'medical_lending_for_bill_invoice_discounting'  => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required' : [],
            'comments_on_invoice_discounting'               => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required|max:40' : [],
            'hospital_management_system_installation'       => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'hms_services'                                  => ($hospital->onboarding == 'Tie Up' && $request->hospital_management_system_installation == 'Yes') ? 'required' : [],
            'hms_charges'                                   => ($hospital->onboarding == 'Tie Up' && $request->hospital_management_system_installation == 'Yes') ? 'required|max:6' : []
        ];

        $messages = [
            'mou_inception_date.required'                               => 'Please Enter Mou Inception Date',
            'bhc_packages_for_surgical_procedures_accepted.required'    => 'Please Enter Bhc Packages For Surgical Procedures Accepted',
            'discount_on_medical_management_cases.required'             => 'Please Enter Discount On Medical Management Cases',
            'discount_on_final_bill.required'                           => 'Please Enter Discount On Final Bill',
            'discount_on_room_rent.required'                            => 'Please Enter Discount On Room Rent',
            'discount_on_medicines.required'                            => 'Please Enter Discount On Medicines',
            'discount_on_consumables.required'                          => 'Please Enter Discount On Consumables',
            'referral_commission_offered.required'                      => 'Please Enter Referral Commission Offered',
            'referral.required'                                         => 'Please Enter referral',
            'claimstag_usage_services.required'                         => 'Please Enter Claimstag Usage Services',
            'claimstag_installation_charges.required'                   => 'Please Enter Claimstag Installation Charges',
            'claimstag_usage_charges.required'                          => 'Please Enter Claimstag Usage Charges',
            'claims_reimbursement_insured_services.required'            => 'Please Enter Claims Reimbursement Insured Services',
            'claims_reimbursement_insured_service_charges.required'     => 'Please Enter Claims Reimbursement Insured Service Charges',
            'cashless_claims_management_services.required'              => 'Please Enter Cashless Claims Management Services',
            'cashless_claims_management_services_charges.required'      => 'Please Enter Cashless Claims Management Services Charges',
            'medical_lending_for_patients.required'                     => 'Please Enter Medical Lending For Patients',
            'medical_lending_service_type.required'                     => 'Please Enter Medical Lending Service Type',
            'subvention.required'                                       => 'Please Enter subvention',
            'medical_lending_for_bill_invoice_discounting.required'     => 'Please Enter Medical Lending For Bill Invoice Discounting',
            'comments_on_invoice_discounting.required'                  => 'Please Enter Comments On Invoice Discounting',
            'lending_finance_company_agreement.required'                => 'Please Enter Lending Finance Company Agreement',
            'lending_finance_company_agreement_date.required'           => 'Please Enter Lending Finance Company Agreement Date',
            'hms_services.required'                                     => 'Please Enter Hms Services',
            'hospital_management_system_installation.required'          => 'Please Enter hospital Management System Installation',
            'hms_charges.required'                                      => 'Please Enter Hms Charges',
            'comments.required'                                         => 'Please Enter comments',
        ];

        $this->validate($request, $rules, $messages);

          $hospitalT =  HospitalTieUp::updateOrCreate([
                'hospital_id' => $id],
                [
                'mou_inception_date'                                => $request->mou_inception_date,
                'bhc_packages_for_surgical_procedures_accepted'     => $request->bhc_packages_for_surgical_procedures_accepted,
                'discount_on_medical_management_cases'              => $request->discount_on_medical_management_cases,
                'discount_on_final_bill'                            => $request->discount_on_final_bill,
                'discount_on_room_rent'                             => $request->discount_on_room_rent,
                'discount_on_medicines'                             => $request->discount_on_medicines,
                'discount_on_consumables'                           => $request->discount_on_consumables,
                'referral_commission_offered'                       => $request->referral_commission_offered,
                'referral'                                          => $request->referral,
                'claimstag_usage_services'                          => $request->claimstag_usage_services,
                'claimstag_installation_charges'                    => $request->claimstag_installation_charges,
                'claimstag_usage_charges'                           => $request->claimstag_usage_charges,
                'claims_reimbursement_insured_services'             => $request->claims_reimbursement_insured_services,
                'claims_reimbursement_insured_service_charges'      => $request->claims_reimbursement_insured_service_charges,
                'cashless_claims_management_services'               => $request->cashless_claims_management_services,
                'cashless_claims_management_services_charges'       => $request->cashless_claims_management_services_charges,
                'medical_lending_for_patients'                      => $request->medical_lending_for_patients,
                'medical_lending_service_type'                      => $request->medical_lending_service_type,
                'subvention'                                        => $request->subvention,
                'medical_lending_for_bill_invoice_discounting'      => $request->medical_lending_for_bill_invoice_discounting,
                'comments_on_invoice_discounting'                   => $request->comments_on_invoice_discounting,
                'lending_finance_company_agreement'                 => $request->lending_finance_company_agreement,
                'lending_finance_company_agreement_date'            => $request->lending_finance_company_agreement_date,
                'hms_services'                                      => $request->hms_services,
                'hospital_management_system_installation'           => $request->hospital_management_system_installation,
                'hms_charges'                                       => $request->hms_charges,
                'comments'                                          => $request->comments
            ]);

        HospitalTieUp::where('hospital_id', $id)->update([
            'uid'      => 'HSPTUP'.$hospital->id
        ]);

        return redirect()->back()->withInput(['tab' => 'hospital_tie_up_details'])->with('success', 'Hospital updated successfully');
    }

    public function updateHospitalFacility(Request $request, $id)
    {
        $hospital             = Hospital::find($id);
        $facility             =  HospitalFacility::where('hospital_id', $id)->first();
        if ($request->hasfile('pharmacy_file')) {
            $pharmacy_file                    = $request->file('pharmacy_file');
            $name                       = $pharmacy_file->getClientOriginalName();
            $pharmacy_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'pharmacy_file'               =>  $name
            ]);
        }

        if ($request->hasfile('lab_file')) {
            $lab_file                    = $request->file('lab_file');
            $name                       = $lab_file->getClientOriginalName();
            $lab_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'lab_file'               =>  $name
            ]);
        }

        if ($request->hasfile('ambulance_file')) {
            $ambulance_file                    = $request->file('ambulance_file');
            $name                       = $ambulance_file->getClientOriginalName();
            $ambulance_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'ambulance_file'               =>  $name
            ]);
        }

        if ($request->hasfile('operation_theatre_file')) {
            $operation_theatre_file                    = $request->file('operation_theatre_file');
            $name                       = $operation_theatre_file->getClientOriginalName();
            $operation_theatre_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'operation_theatre_file'               =>  $name
            ]);
        }

        if ($request->hasfile('icu_file')) {
            $icu_file                    = $request->file('icu_file');
            $name                       = $icu_file->getClientOriginalName();
            $icu_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'icu_file'               =>  $name
            ]);
        }

        if ($request->hasfile('iccu_file')) {
            $iccu_file                    = $request->file('iccu_file');
            $name                       = $iccu_file->getClientOriginalName();
            $iccu_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'iccu_file'               =>  $name
            ]);
        }

        if ($request->hasfile('nicu_file')) {
            $nicu_file                    = $request->file('nicu_file');
            $name                       = $nicu_file->getClientOriginalName();
            $nicu_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'nicu_file'               =>  $name
            ]);
        }

        if ($request->hasfile('csc_sterilization_file')) {
            $csc_sterilization_file                    = $request->file('csc_sterilization_file');
            $name                       = $csc_sterilization_file->getClientOriginalName();
            $csc_sterilization_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'csc_sterilization_file'               =>  $name
            ]);
        }

        if ($request->hasfile('centralized_gas_ons_file')) {
            $centralized_gas_ons_file                    = $request->file('centralized_gas_ons_file');
            $name                       = $centralized_gas_ons_file->getClientOriginalName();
            $centralized_gas_ons_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'centralized_gas_ons_file'               =>  $name
            ]);
        }


        if ($request->hasfile('centralized_ac_file')) {
            $centralized_ac_file                    = $request->file('centralized_ac_file');
            $rhnname                       = $centralized_ac_file->getClientOriginalName();
            $centralized_ac_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $rhnname, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'centralized_ac_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('kitchen_file')) {
            $kitchen_file                    = $request->file('kitchen_file');
            $name                       = $kitchen_file->getClientOriginalName();
            $kitchen_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'kitchen_file'               =>  $name
            ]);
        }

        if ($request->hasfile('usg_machine_file')) {
            $usg_machine_file                    = $request->file('usg_machine_file');
            $name                       = $usg_machine_file->getClientOriginalName();
            $usg_machine_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'usg_machine_file'               =>  $name
            ]);
        }

        if ($request->hasfile('digital_xray_file')) {
            $digital_xray_file                    = $request->file('digital_xray_file');
            $name                       = $digital_xray_file->getClientOriginalName();
            $digital_xray_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'digital_xray_file'               =>  $name
            ]);
        }

        if ($request->hasfile('mri_file')) {
            $mri_file                    = $request->file('mri_file');
            $name                       = $mri_file->getClientOriginalName();
            $mri_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'mri_file'               =>  $name
            ]);
        }

        if ($request->hasfile('ct_file')) {
            $ct_file                    = $request->file('ct_file');
            $name                       = $ct_file->getClientOriginalName();
            $ct_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'ct_file'               =>  $name
            ]);
        }

        if ($request->hasfile('pet_scan_file')) {
            $pet_scan_file                    = $request->file('pet_scan_file');
            $name                       = $pet_scan_file->getClientOriginalName();
            $pet_scan_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'pet_scan_file'               =>  $name
            ]);
        }

        if ($request->hasfile('organ_transplant_unit_file')) {
            $organ_transplant_unit_file                    = $request->file('organ_transplant_unit_file');
            $name                       = $organ_transplant_unit_file->getClientOriginalName();
            $organ_transplant_unit_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'organ_transplant_unit_file'               =>  $name
            ]);
        }

        if ($request->hasfile('burn_unit_file')) {
            $burn_unit_file                    = $request->file('burn_unit_file');
            $name                       = $burn_unit_file->getClientOriginalName();
            $burn_unit_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'burn_unit_file'               =>  $name
            ]);
        }

        if ($request->hasfile('dialysis_unit_file')) {
            $dialysis_unit_file                    = $request->file('dialysis_unit_file');
            $name                       = $dialysis_unit_file->getClientOriginalName();
            $dialysis_unit_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $name, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'dialysis_unit_file'               =>  $name
            ]);
        }

        if ($request->hasfile('blood_bank_file')) {
            $blood_bank_file                    = $request->file('blood_bank_file');
            $rhnname                       = $blood_bank_file->getClientOriginalName();
            $blood_bank_file->storeAs('uploads/hospital/facility/' . $hospital->id . '/', $rhnname, 'public');
            HospitalFacility::where('hospital_id', $hospital->id)->update([
                'blood_bank_file'               =>  $rhnname
            ]);
        }
        $rules = [
            'pharmacy'                          => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'pharmacy_file'                     => ($hospital->onboarding == 'Tie Up' && $request->pharmacy == 'Yes' && empty($facility->pharmacy_file)) ? 'required' : [],
            'lab'                               => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'lab_file'                          => ($hospital->onboarding == 'Tie Up' && $request->lab == 'Yes' && empty($facility->lab_file)) ? 'required' : [],
            'ambulance'                         => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'ambulance_file'                    => ($hospital->onboarding == 'Tie Up' && $request->ambulance == 'Yes' && empty($facility->ambulance_file)) ? 'required' : [],
            'operation_theatre'                 => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'operation_theatre_file'            => ($hospital->onboarding == 'Tie Up' && $request->operation_theatre == 'Yes' && empty($facility->operation_theatre_file)) ? 'required' : [],
            'icu'                               => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'icu_file'                          => ($hospital->onboarding == 'Tie Up' && $request->icu == 'Yes' && empty($facility->icu_file)) ? 'required' : [],
            'iccu'                              => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'iccu_file'                         => ($hospital->onboarding == 'Tie Up' && $request->iccu == 'Yes' && empty($facility->iccu_file)) ? 'required' : [],
            'nicu'                              => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'nicu_file'                         => ($hospital->onboarding == 'Tie Up' && $request->nicu == 'Yes' && empty($facility->nicu_file)) ? 'required' : [],
            'csc_sterilization'                 => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'csc_sterilization_file'            => ($hospital->onboarding == 'Tie Up' && $request->csc_sterilization == 'Yes' && empty($facility->csc_sterilization_file)) ? 'required' : [],
            'centralized_gas_ons'               => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'centralized_gas_ons_file'          => ($hospital->onboarding == 'Tie Up' && $request->centralized_gas_ons == 'Yes' && empty($facility->centralized_gas_ons_file)) ? 'required' : [],
            'centralized_ac'                    => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'centralized_ac_file'               => ($hospital->onboarding == 'Tie Up' && $request->centralized_ac == 'Yes' && empty($facility->centralized_ac_file)) ? 'required' : [],
            'kitchen'                           => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'kitchen_file'                      => ($hospital->onboarding == 'Tie Up' && $request->kitchen == 'Yes' && empty($facility->kitchen_file)) ? 'required' : [],
            'usg_machine'                       => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'usg_machine_file'                  => ($hospital->onboarding == 'Tie Up' && $request->usg_machine == 'Yes' && empty($facility->usg_machine_file)) ? 'required' : [],
            'digital_xray'                      => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'digital_xray_file'                 => ($hospital->onboarding == 'Tie Up' && $request->digital_xray == 'Yes' && empty($facility->digital_xray_file)) ? 'required' : [],
            'ct'                                => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'ct_file'                           => ($hospital->onboarding == 'Tie Up' && $request->ct == 'Yes' && empty($facility->ct_file)) ? 'required' : [],
            'mri'                               => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'mri_file'                          => ($hospital->onboarding == 'Tie Up' && $request->mri == 'Yes' && empty($facility->mri_file)) ? 'required' : [],
            'pet_scan'                          => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'pet_scan_file'                     => ($hospital->onboarding == 'Tie Up' && $request->pet_scan == 'Yes' && empty($facility->pet_scan_file)) ? 'required' : [],
            'organ_transplant_unit'             => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'organ_transplant_unit_file'        => ($hospital->onboarding == 'Tie Up' && $request->organ_transplant_unit == 'Yes' && empty($facility->organ_transplant_unit_file)) ? 'required' : [],
            'burn_unit'                         => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'burn_unit_file'                    => ($hospital->onboarding == 'Tie Up' && $request->burn_unit == 'Yes' && empty($facility->burn_unit_file)) ? 'required' : [],
            'dialysis_unit'                     => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'dialysis_unit_file'                => ($hospital->onboarding == 'Tie Up' && $request->dialysis_unit == 'Yes' && empty($facility->dialysis_unit_file)) ? 'required' : [],
            'blood_bank'                        => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'blood_bank_file'                   => ($hospital->onboarding == 'Tie Up' && $request->blood_bank == 'Yes' && empty($facility->blood_bank_file)) ? 'required' : []
        ];

        $messages = [
            'pharmacy.required'                     => 'Please Enter Pharmacy',
            'pharmacy.required'                     => 'Please Enter Pharmacy File',
            'lab.required'                          => 'Please Enter Lab',
            'lab.required'                          => 'Please Enter Lab File',
            'ambulance.required'                    => 'Please Enter Ambulance',
            'ambulance.required'                    => 'Please Enter Ambulance File',
            'operation_theatre.required'            => 'Please Enter Operation Theatre',
            'operation_theatre.required'            => 'Please Enter Operation Theatre File',
            'icu.required'                          => 'Please Enter ICU',
            'icu.required'                          => 'Please Enter ICU File',
            'iccu.required'                         => 'Please Enter ICCU',
            'iccu.required'                         => 'Please Enter ICCU File',
            'nicu.required'                         => 'Please Enter NICU',
            'nicu.required'                         => 'Please Enter NICU File',
            'csc_sterilization.required'            => 'Please Enter CSC (Sterilization)',
            'csc_sterilization.required'            => 'Please Enter CSC (Sterilization) File',
            'centralized_gas_ons.required'          => 'Please Enter Centralized-Gas (ONS)',
            'centralized_gas_ons.required'          => 'Please Enter Centralized-Gas (ONS) File',
            'centralized_ac.required'               => 'Please Enter Centralized-AC',
            'centralized_ac.required'               => 'Please Enter Centralized-AC File',
            'kitchen.required'                      => 'Please Enter Kitchen',
            'kitchen.required'                      => 'Please Enter Kitchen File',
            'usg_machine.required'                  => 'Please Enter USG Machine',
            'usg_machine.required'                  => 'Please Enter USG Machine File',
            'digital_xray.required'                 => 'Please Enter Digital X-Ray',
            'digital_xray.required'                 => 'Please Enter Digital X-Ray File',
            'ct.required'                           => 'Please Enter CT',
            'ct.required'                           => 'Please Enter CT File',
            'mri.required'                          => 'Please Enter MRI',
            'mri.required'                          => 'Please Enter MRI File',
            'pet_scan.required'                     => 'Please Enter PET Scan',
            'pet_scan.required'                     => 'Please Enter PET Scan File',
            'organ_transplant_unit.required'        => 'Please Enter Organ Transplant Unit',
            'organ_transplant_unit.required'        => 'Please Enter Organ Transplant Unit File',
            'burn_unit.required'                    => 'Please Enter Burn Unit',
            'burn_unit.required'                    => 'Please Enter Burn Unit File',
            'dialysis_unit.required'                => 'Please Enter Dialysis Unit',
            'dialysis_unit.required'                => 'Please Enter Dialysis Unit File',
            'blood_bank.required'                   => 'Please Enter Blood Bank',
            'blood_bank.required'                   => 'Please Enter Blood Bank File',
            'hospital_facility_comments.required'   => 'Please Enter Hospital Facility Comments',
        ];

        $this->validate($request, $rules, $messages);



        $hospitalT =  HospitalFacility::updateOrCreate([
            'hospital_id' => $id],
            [
                'pharmacy'                              => $request->pharmacy,
                'lab'                                   => $request->lab,
                'ambulance'                             => $request->ambulance,
                'operation_theatre'                     => $request->operation_theatre,
                'icu'                                   => $request->icu,
                'iccu'                                  => $request->iccu,
                'nicu'                                  => $request->nicu,
                'csc_sterilization'                     => $request->csc_sterilization,
                'centralized_gas_ons'                   => $request->centralized_gas_ons,
                'centralized_ac'                        => $request->centralized_ac,
                'kitchen'                               => $request->kitchen,
                'usg_machine'                           => $request->usg_machine,
                'digital_xray'                          => $request->digital_xray,
                'ct'                                    => $request->ct,
                'mri'                                   => $request->mri,
                'pet_scan'                              => $request->pet_scan,
                'organ_transplant_unit'                 => $request->organ_transplant_unit,
                'burn_unit'                             => $request->burn_unit,
                'dialysis_unit'                         => $request->dialysis_unit,
                'blood_bank'                            => $request->blood_bank,
                'hospital_facility_comments'            => $request->hospital_facility_comments
            ]);




        return redirect()->back()->with('success', 'Hospital Facility updated successfully');
    }


    public function updateHospitalInfrastructure(Request $request, $id)
    {
        $hospital             = Hospital::find($id);
        $infrastructure       =  HospitalInfrastructure::where('hospital_id', $id)->first();

        if ($request->hasfile('nabl_approved_lab_file')) {
            $nabl_approved_lab_file                    = $request->file('nabl_approved_lab_file');
            $name                       = $nabl_approved_lab_file->getClientOriginalName();
            $nabl_approved_lab_file->storeAs('uploads/hospital/infrastructure/' . $hospital->id . '/', $name, 'public');
            HospitalInfrastructure::where('hospital_id', $hospital->id)->update([
                'nabl_approved_lab_file'               =>  $name
            ]);
        }

        if ($request->hasfile('nabh_status_file')) {
            $nabh_status_file                    = $request->file('nabh_status_file');
            $name                       = $nabh_status_file->getClientOriginalName();
            $nabh_status_file->storeAs('uploads/hospital/infrastructure/' . $hospital->id . '/', $name, 'public');
            HospitalInfrastructure::where('hospital_id', $hospital->id)->update([
                'nabh_status_file'               =>  $name
            ]);
        }


        if ($request->hasfile('nqac_nhsrc_status_file')) {
            $nqac_nhsrc_status_file                    = $request->file('nqac_nhsrc_status_file');
            $name                       = $nqac_nhsrc_status_file->getClientOriginalName();
            $nqac_nhsrc_status_file->storeAs('uploads/hospital/infrastructure/' . $hospital->id . '/', $name, 'public');
            HospitalInfrastructure::where('hospital_id', $hospital->id)->update([
                'nqac_nhsrc_status_file'               =>  $name
            ]);
        }

        if ($request->hasfile('jci_status_file')) {
            $jci_status_file                    = $request->file('jci_status_file');
            $name                       = $jci_status_file->getClientOriginalName();
            $jci_status_file->storeAs('uploads/hospital/infrastructure/' . $hospital->id . '/', $name, 'public');
            HospitalInfrastructure::where('hospital_id', $hospital->id)->update([
                'jci_status_file'               =>  $name
            ]);
        }

        if ($request->hasfile('hippa_status_file')) {
            $hippa_status_file                    = $request->file('hippa_status_file');
            $name                       = $hippa_status_file->getClientOriginalName();
            $hippa_status_file->storeAs('uploads/hospital/infrastructure/' . $hospital->id . '/', $name, 'public');
            HospitalInfrastructure::where('hospital_id', $hospital->id)->update([
                'hippa_status_file'               =>  $name
            ]);
        }

        $rules = [
            'city_category'                     => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'hospital_type'                     => ($hospital->onboarding == 'Tie Up') ? 'required|string|min:1|max:25' : [],
            'hospital_category'                 => ($hospital->onboarding == 'Tie Up') ? 'required|string|max:25' : [],
            'no_of_beds'                        => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,5' : [],
            'no_of_ots'                         => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,3' : [],
            'no_of_modular_ots'                 => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,3' : [],
            'no_of_icus'                        => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,3' : [],
            'no_of_iccus'                       => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,3' : [],
            'no_of_nicus'                       => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,3' : [],
            'no_of_rmos'                        => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,4' : [],
            'no_of_nurses'                      => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,4' : [],
            'nabl_approved_lab'                 => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'nabl_approved_lab_file'            => ($hospital->onboarding == 'Tie Up' && $request->nabl_approved_lab != 'No' && empty($infrastructure->nabl_approved_lab_file)) ? 'required' : [],
            'no_of_dialysis_units'              => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,3' : [],
            'no_ambulance_normal'               => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,3' : [],
            'no_ambulance_acls'                 => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,3' : [],
            'nabh_status'                       => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'nabh_status_file'                  => ($hospital->onboarding == 'Tie Up' && $request->nabh_status != 'NA'  && empty($infrastructure->nabh_status_file)) ? 'required' : [],
            'jci_status'                        => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'jci_status_file'                   => ($hospital->onboarding == 'Tie Up' && $request->jci_status != 'No' && empty($infrastructure->jci_status_file)) ? 'required' : [],
            'nqac_nhsrc_status'                 => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'nqac_nhsrc_status_file'            => ($hospital->onboarding == 'Tie Up' && $request->nqac_nhsrc_status != 'NA' && empty($infrastructure->nqac_nhsrc_status_file)) ? 'required' : [],
            'hippa_status'                      => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'hippa_status_file'                 => ($hospital->onboarding == 'Tie Up' && $request->hippa_status != 'No' && empty($infrastructure->hippa_status_file)) ? 'required' : []
        ];

        $messages = [
            'city_category.required'                    => 'Please Enter City Category',
            'hospital_type.required'                    => 'Please Enter Hospital Type',
            'hospital_category.required'                => 'Please Enter Hospital Category ',
            'no_of_beds.required'                       => 'Please Enter No. of Beds',
            'no_of_ots.required'                        => 'Please Enter No. of OTs',
            'no_of_modular_ots.required'                => 'Please Enter No. of Modular OTs',
            'no_of_icus.required'                       => 'Please Enter No. of ICUs',
            'no_of_iccus.required'                      => 'Please Enter No. of ICCUs',
            'no_of_nicus.required'                      => 'Please Enter No. of NICUs',
            'no_of_rmos.required'                       => 'Please Enter No. of RMOs',
            'no_of_nurses.required'                     => 'Please Enter No. of Nurses',
            'nabl_approved_lab.required'                => 'Please Enter NABL Approved Lab',
            'no_of_dialysis_units.required'             => 'Please Enter No. of Dialysis Units',
            'no_ambulance_normal.required'              => 'Please Enter No. Ambulance - Normal',
            'no_ambulance_acls.required'                => 'Please Enter No. Ambulance - ACLS',
            'nabh_status.required'                      => 'Please Enter NABH Status',
            'jci_status.required'                       => 'Please Enter JCI Status',
            'nqac_nhsrc_status.required'                => 'Please Enter NQAC/NHSRC Status',
            'hippa_status.required'                     => 'Please Enter HIPPA Status',
            'comments.required'                         => 'Please Enter Hospital Infra Comments',
        ];

        $this->validate($request, $rules, $messages);

        $hospitalT =  HospitalInfrastructure::updateOrCreate([
            'hospital_id' => $id],
            [
                'city_category'                     => $request->city_category ? $request->city_category : 'Other',
                'hospital_type'                     => $request->hospital_type,
                'hospital_category'                 => $request->hospital_category,
                'no_of_beds'                        => $request->no_of_beds,
                'no_of_ots'                         => $request->no_of_ots,
                'no_of_modular_ots'                 => $request->no_of_modular_ots,
                'no_of_icus'                        => $request->no_of_icus,
                'no_of_iccus'                       => $request->no_of_iccus,
                'no_of_nicus'                       => $request->no_of_nicus,
                'no_of_rmos'                        => $request->no_of_rmos,
                'no_of_nurses'                      => $request->no_of_nurses,
                'nabl_approved_lab'                 => $request->nabl_approved_lab,
                'no_of_dialysis_units'              => $request->no_of_dialysis_units,
                'no_ambulance_normal'               => $request->no_ambulance_normal,
                'no_ambulance_acls'                 => $request->no_ambulance_acls,
                'nabh_status'                       => $request->nabh_status??'NA',
                'jci_status'                        => $request->jci_status??'No',
                'nqac_nhsrc_status'                 => $request->nqac_nhsrc_status??'NA',
                'hippa_status'                      => $request->hippa_status??'No',
                'comments'                          => $request->comments
            ]);


        return redirect()->back()->with('success', 'Hospital updated successfully');
    }


    public function updateHospitalDepartment(Request $request, $id)
    {
        $hospital             = Hospital::find($id);

        if ($request->hasfile('upload')) {
            $upload                    = $request->file('upload');
            $name                      = $upload->getClientOriginalName();
            $upload->storeAs('uploads/hospital/department/' . $hospital->id . '/', $name, 'public');
            HospitalDepartment::where('hospital_id', $hospital->id)->update([
                'upload'               =>  $name
            ]);
        }

        $rules = [
            'specialization'              => 'required',
            'doctors_firstname'           => ($request->show_doctor == 1) ? 'required' : [],
            'registration_no'             => ($request->show_doctor == 1) ? 'required|max:20' : [],
            'email_id'                    => ($request->show_doctor == 1) ? 'required|email|max:45' : [],
            'doctors_mobile_no'           => ($request->show_doctor == 1) ? 'required|numeric|digits:10' : [],
        ];

        $messages = [
            'specialization.required'            => 'Please Enter Specialization',
            'doctors_firstname.required'         => 'Please Enter Doctors Firstname',
            'registration_no.required'           => 'Please Enter Registration No.',
            'email_id.required'                  => 'Please Enter Email ID',
            'doctors_mobile_no.required'         => 'Please Enter Doctors Mobile No.',
        ];

        $this->validate($request, $rules, $messages);

        HospitalDepartment::updateOrCreate([
            'hospital_id' => $id],
            [
                'specialization'             => $request->specialization,
                'doctors_firstname'          => $request->doctors_firstname,
                'doctors_lastname'           => $request->doctors_lastname,
                'registration_no'            => $request->registration_no,
                'email_id'                   => $request->email_id,
                'doctors_mobile_no'          => $request->doctors_mobile_no,
        ]);



        return redirect()->back()->with('success', 'Hospital updated successfully');
    }

    public function updateHospitalEmpanelmentStatus(Request $request, $id)
    {
        $hospital             = Hospital::find($id);

        if ($request->hasfile('upload')) {
            $upload                             = $request->file('upload');
            $name                               = $upload->getClientOriginalName();
            $upload->storeAs('uploads/hospital/empanelment_status/' . $hospital->id . '/', $name, 'public');
            HospitalDepartment::where('hospital_id', $hospital->id)->update([
                'upload'                        =>  $name
            ]);
        }

        $rules = [
            'specialization'              => 'required',
            'doctors_name'                => 'required',
            'registration_no'             => 'required|max:20',
            'email_id'                    => 'required|email|max:45',
            'doctors_mobile_no'           => 'required|numeric|digits:10',
        ];

        $messages = [
            'specialization.required'            => 'Please Enter Specialization',
            'doctors_name.required'              => 'Please Enter Doctors Name',
            'registration_no.required'           => 'Please Enter Registration No.',
            'email_id.required'                  => 'Please Enter Email ID',
            'doctors_mobile_no.required'         => 'Please Enter Doctors Mobile No.',
        ];

        $this->validate($request, $rules, $messages);

        HospitalDepartment::updateOrCreate([
            'hospital_id' => $id],
            [
                'specialization'             => $request->specialization,
                'doctors_name'               => $request->doctors_name,
                'registration_no'            => $request->registration_no,
                'email_id'                   => $request->email_id,
                'doctors_mobile_no'          => $request->doctors_mobile_no,
        ]);



        return redirect()->back()->with('success', 'Hospital updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function importExport(Request $request){
        return view('admin.hospitals.import-export');
    }

    public function import(Request $request){
        try {
            Excel::import(new ImportHospital, $request->file('file')->store('files'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->with('error', 'import is not proceded successfully, please check sheed, make sure email is unique!!');;

        }
        return redirect()->back()->with('success', 'Your file successfully imported!!');;
    }

    public function export(Request $request){
        return Excel::download(new ExportHospital, 'hospitals.xlsx');
    }

    public function destroy($id)
    {
        Hospital::find($id)->delete();
        return redirect()->route('admin.hospitals.index')->with('success', 'Hospital deleted successfully');
    }
}
