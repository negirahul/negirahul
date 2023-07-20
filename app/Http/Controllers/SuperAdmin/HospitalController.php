<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\AssociatePartner;
use App\Models\Insurer;
use App\Models\Patient;
use App\Models\Hospital;
use App\Models\HospitalFacility;
use App\Models\HospitalInfrastructure;
use App\Models\HospitalDepartment;
use App\Models\HospitalTieUp;
use App\Models\HospitalDocument;
use App\Models\HospitalEmpanelmentStatus;
use App\Models\HospitalDocumentHistory;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportHospital;
use App\Exports\ExportHospital;
use App\Models\Tpa;
use App\Notifications\Hospital\CredentialsGeneratedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class HospitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:super-admin');
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
        return view('super-admin.hospitals.manage',  compact('hospitals', 'filter_search'));
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

        return view('super-admin.hospitals.create.create',  compact('associates', 'users'));
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
            'rohini'                   => 'required|size:13',
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
            'assigned_employee_department'        => 'required',
            'linked_employee_department'        => 'required',
            'linked_employee'          => 'required',
            'linked_employee_id'       => 'required',
        ];

        $messages = [
            'name.required'                   => 'Please enter hospital name',
            'firstname.required'              => 'Please enter owner firstname',
            'onboarding.required'             => 'Please select hospital onboarding.',
            'by.required'                     => 'Please select hospital by.',
            'pan.required'                    => 'Please enter PAN number.',
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

        /*$response = Http::post(env('REMOTE_HOSPITAL_CREATE_URL'), [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'password' => '12345678',
            'uid' => 'HPS'.$hospital->id,
            'hospital_by' => 'Claimstack'
        ]);*/

        

        return redirect()->route('super-admin.hospitals.index')->with('success', 'Hospital created successfully');
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
    public function edit(Request $request, $id)
    {
        $hospital          = Hospital::find($id);
        $insurers          = Insurer::all();
        $tpas              = Tpa::all();

        $associates = AssociatePartner::get(['name', 'city', 'state', 'id', 'associate_partner_id']);

        $hospital_tie_ups          = HospitalTieUp::where('hospital_id', $id)->first();
        if (!$hospital_tie_ups) {
            HospitalTieUp::create(['hospital_id'=> $id, 'status' => 1]);
            $hospital_tie_ups          = HospitalTieUp::where('hospital_id', $id)->first();
        }

        $hospital_facility          = HospitalFacility::where('hospital_id', $id)->first();
        if (!$hospital_facility) {
            HospitalFacility::create(['hospital_id'=> $id]);
            $hospital_facility          = HospitalFacility::where('hospital_id', $id)->first();
        }

        $hospital_nfrastructure          = HospitalInfrastructure::where('hospital_id', $id)->first();
        if (!$hospital_nfrastructure) {
            HospitalInfrastructure::create(['hospital_id'=> $id]);
            $hospital_nfrastructure          = HospitalInfrastructure::where('hospital_id', $id)->first();
        }

        $hospital_document          = HospitalDocument::where('hospital_id', $id)->first();
        if (!$hospital_document) {
            HospitalDocument::create(['hospital_id'=> $id]);
            $hospital_document          = HospitalDocument::where('hospital_id', $id)->first();
        }


        if (isset($request->company_id) && !empty($request->company_id)) {
            $empanelment_status          = HospitalEmpanelmentStatus::where(['hospital_id' => $id, 'id' => $request->company_id])->first();
        }else{
            $empanelment_status          = null;
        }
        
        $hospital_department          = HospitalDepartment::where('hospital_id', $id)->get();
        
        if(isset($request->doctor_id)){ 
            $hospital_doctor = HospitalDepartment::where('id', $request->doctor_id)->get()->first();
        } else{
            $hospital_doctor = [];
        }

        $hospitals         = Hospital::get();

        $empanelments         = HospitalEmpanelmentStatus::where('hospital_id', $id)->latest()->paginate(10);

        $users              = User::get();

        return view('super-admin.hospitals.edit.edit',  compact('hospital','tpas', 'associates', 'hospitals', 'hospital_facility', 'hospital_nfrastructure', 'hospital_department','hospital_doctor', 'hospital_tie_ups', 'users', 'insurers', 'hospital_document', 'empanelment_status','empanelments', 'id'));
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

       

        $rules = [
            'name'                                      => 'required|min:1|max:60',
            'firstname'                                 => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:15' : [],
            'lastname'                                  => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:30' : [],
            'onboarding'                                => 'required',
            'by'                                        => 'required',
            'pan'                                       => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u' : [],
            'code'                                      => 'required|numeric|digits:3',
            'landline'                                  => 'required|numeric|digits_between:1,10',
            'email'                                     => 'required|email|min:1|max:45|unique:hospitals,email,'.$id,
            'address'                                   => 'required',
            'city'                                      => 'required',
            'assigned_employee_department'              => 'required',
            'linked_employee_department'                => 'required',
            'state'                                     => 'required',
            'pincode'                                   => 'required|numeric',
            'owner_pan'                                 => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u' : [],
            'owner_aadhar'                              => 'required|size:12',
            'phone'                                     => 'required|numeric|digits:10',
            'linked_associate_partner_id'               => ($request->by == 'Associate Partner') ? 'required' : [],
            'linked_associate_partner'                  => ($request->by == 'Associate Partner') ? 'required' : [],
            'assigned_employee'                         => 'required',
            'assigned_employee_id'                      => 'required',
            'linked_employee'                           => 'required',
            'linked_employee_id'                        => 'required',
            'tan'                                       => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|size:10' : [],
            'gst'                                       => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|size:15' : [],
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
            'fire_safety_clearance_certificate'         => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'certificate_of_incorporation'              => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'bank_name'                                 => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:45' : [],
            'bank_address'                              => ($request->onboarding == 'Tie Up') ? 'required|min:1|max:80' : [],
            'cancel_cheque'                             => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'bank_account_no'                           => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:20' : [],
            'bank_ifs_code'                             => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:11' : [],
            'nabh_registration_no'                      => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:15' : [],
            'nabl_registration_no'                      => ($request->onboarding == 'Tie Up') ? 'required|alpha_num|min:1|max:15' : [],
            'tariff_list_soc'                           => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'signed_mous'                               => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'other_documents'                           => ($request->onboarding == 'Tie Up') ? 'required' : [],
            'iso_status'                                => ($request->onboarding == 'Tie Up') ? 'required' : [],
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
            'owner_pan'                                 => $request->owner_pan,
            'owner_aadhar'                              => $request->owner_aadhar,
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

        $rules = [
            'mou_inception_date'                            => ($hospital->onboarding == 'Tie Up' && $hospital->signed_mous == 'Yes') ? 'required' : [],
            'bhc_packages_for_surgical_procedures_accepted' => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'agreed_for'                                    => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
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
            'lending_finance_company_agreement_date'        => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required' : [],
            'medical_lending_for_patients'                  => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required' : [],
            'medical_lending_service_type'                  => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required' : [],
            'subvention'                                    => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required|max:2' : 'max:2',
            'medical_lending_for_bill_invoice_discounting'  => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required' : [],
            'comments_on_invoice_discounting'               => ($hospital->onboarding == 'Tie Up' && $request->lending_finance_company_agreement == 'Yes') ? 'required|max:40' : [],
            'hospital_management_system_installation'       => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'hms_services'                                  => ($hospital->onboarding == 'Tie Up' && $request->hospital_management_system_installation == 'Yes') ? 'required' : [],
            'hms_charges'                                   => ($hospital->onboarding == 'Tie Up' && $request->hospital_management_system_installation == 'Yes') ? 'required|max:6' : 'max:6'
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
                'agreed_for'                                        => $request->agreed_for,
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
       
        $rules = [
            'pharmacy'                          => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'lab'                               => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'ambulance'                         => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'operation_theatre'                 => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'icu'                               => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'iccu'                              => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'nicu'                              => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'csc_sterilization'                 => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'centralized_gas_ons'               => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'centralized_ac'                    => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'kitchen'                           => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'usg_machine'                       => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'digital_xray'                      => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'ct'                                => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'mri'                               => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'pet_scan'                          => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'organ_transplant_unit'             => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'burn_unit'                         => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'dialysis_unit'                     => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'blood_bank'                        => ($hospital->onboarding == 'Tie Up') ? 'required' : [],        ];

        $messages = [
            'pharmacy.required'                     => 'Please Enter Pharmacy',
            'lab.required'                          => 'Please Enter Lab',
            'ambulance.required'                    => 'Please Enter Ambulance',
            'operation_theatre.required'            => 'Please Enter Operation Theatre',
            'icu.required'                          => 'Please Enter ICU',
            'iccu.required'                         => 'Please Enter ICCU',
            'nicu.required'                         => 'Please Enter NICU',
            'csc_sterilization.required'            => 'Please Enter CSC (Sterilization)',
            'centralized_gas_ons.required'          => 'Please Enter Centralized-Gas (ONS)',
            'centralized_ac.required'               => 'Please Enter Centralized-AC',
            'kitchen.required'                      => 'Please Enter Kitchen',
            'usg_machine.required'                  => 'Please Enter USG Machine',
            'digital_xray.required'                 => 'Please Enter Digital X-Ray',
            'ct.required'                           => 'Please Enter CT',
            'mri.required'                          => 'Please Enter MRI',
            'pet_scan.required'                     => 'Please Enter PET Scan',
            'organ_transplant_unit.required'        => 'Please Enter Organ Transplant Unit',
            'burn_unit.required'                    => 'Please Enter Burn Unit',
            'dialysis_unit.required'                => 'Please Enter Dialysis Unit',
            'blood_bank.required'                   => 'Please Enter Blood Bank',
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
            'no_of_dialysis_units'              => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,3' : [],
            'no_ambulance_normal'               => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,3' : [],
            'no_ambulance_acls'                 => ($hospital->onboarding == 'Tie Up') ? 'required|numeric|digits_between:1,3' : [],
            'nabh_status'                       => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'jci_status'                        => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'nqac_nhsrc_status'                 => ($hospital->onboarding == 'Tie Up') ? 'required' : [],
            'hippa_status'                      => ($hospital->onboarding == 'Tie Up') ? 'required' : []
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
            'specialization'              =>  'required',
            'doctors_firstname'           =>  'required',
            'registration_no'             =>  'required|max:20',
            'email_id'                    =>  'required|email|max:45',
            'doctors_mobile_no'           =>  'required|numeric|digits:10',
        ];

        $messages = [
            'specialization.required'            => 'Please Enter Specialization',
            'doctors_firstname.required'         => 'Please Enter Doctors Firstname',
            'registration_no.required'           => 'Please Enter Registration No.',
            'email_id.required'                  => 'Please Enter Email ID',
            'doctors_mobile_no.required'         => 'Please Enter Doctors Mobile No.',
        ];

        $this->validate($request, $rules, $messages);
        
        if(isset($request->doctor_id)):
            HospitalDepartment::where('id',$request->doctor_id)->update(
                [
                    'hospital_id'                =>$id,
                    'specialization'             => $request->specialization,
                    'doctors_firstname'          => $request->doctors_firstname,
                    'doctors_lastname'           => $request->doctors_lastname,
                    'registration_no'            => $request->registration_no,
                    'email_id'                   => $request->email_id,
                    'doctors_mobile_no'          => $request->doctors_mobile_no,
                ]);
            $msg = 'Doctor Updated Successfully';
        else:
            HospitalDepartment::Create(
                [
                    'hospital_id'                =>$id,
                    'specialization'             => $request->specialization,
                    'doctors_firstname'          => $request->doctors_firstname,
                    'doctors_lastname'           => $request->doctors_lastname,
                    'registration_no'            => $request->registration_no,
                    'email_id'                   => $request->email_id,
                    'doctors_mobile_no'          => $request->doctors_mobile_no,
                ]);
            $msg = 'Doctor Added Successfully';
        endif;



        return redirect()->back()->with('success', $msg);
    }

    public function deleteDoctor(Request $request,$id){

        HospitalDepartment::where('id',$id)->delete();
        return redirect()->back()->with('success', 'Doctor Deleted Successfully');
    }

    public function storeHospitalEmpanelmentStatus(Request $request)
    {
        $hospital             = Hospital::find($request->id);

        $rules = [
            'company_name'              => 'required',
            'empanelled'                => 'required',
            'hospital_id_as_per_the_selected_company'             => ($request->empanelled == 'Yes') ? 'required|max:25' : '',
            'signed_mou'                    => ($request->empanelled == 'Yes') ? 'required' : '',
            'signed_mou_file'                    => ($request->empanelled == 'Yes' && $request->signed_mou == 'Yes') ? 'required' : '',
            'agreed_packages_and_tariff_pdf_other_images'           => ($request->empanelled == 'Yes') ? 'required' : '',
            'agreed_packages_and_tariff_pdf_other_images_file'           => ($request->empanelled == 'Yes' && $request->agreed_packages_and_tariff_pdf_other_images == 'Yes') ? 'required' : '',
            'negative_listing_status'           => 'required',
            'negative_listing_status_file'           => ($request->empanelled == 'Yes' && $request->negative_listing_status == 'Yes' && empty($empanelment_status->negative_listing_status_file)) ? 'required' : '',
        ];

        $messages = [
            'company_name.required'            => 'Please Select Company Name',
            'empanelled.required'              => 'Please Select Empanelled',
            'hospital_id_as_per_the_selected_company.required'           => 'Please Enter Hospital Id As Per The Selected Company',
            'signed_mou.required'                  => 'Please Select Signed Mou',
            'signed_mou_file.required'                  => 'Please Select Signed Mou File',
            'agreed_packages_and_tariff_pdf_other_images.required'         => 'Please Select Agreed Packages And Tariff Pdf Other Images',
            'agreed_packages_and_tariff_pdf_other_images_file.required'         => 'Please Select Agreed Packages And Tariff Pdf Other Images File',
            'negative_listing_status.required'         => 'Please Select Negative Listing Status',
            'negative_listing_status_file.required'         => 'Please Select Negative Listing Status File',
        ];

        $this->validate($request, $rules, $messages);

        HospitalEmpanelmentStatus::create([
            'hospital_id' => $request->id,
            'tpa_id'             => $request->company_name,
            'company_type'             => $request->company_type,
            'empanelled'               => $request->empanelled,
            'hospital_id_as_per_the_selected_company'            => $request->hospital_id_as_per_the_selected_company,
            'signed_mou'                   => $request->signed_mou,
            'agreed_packages_and_tariff_pdf_other_images'          => $request->agreed_packages_and_tariff_pdf_other_images,
            'upload_packages_and_tariff_excel_or_csv'          => $request->upload_packages_and_tariff_excel_or_csv,
            'negative_listing_status'          => $request->negative_listing_status,
            'hospital_empanelment_status_comments'          => $request->hospital_empanelment_status_comments
        ]);

        if ($request->hasfile('signed_mou_file')) {
            $signed_mou_file                    = $request->file('signed_mou_file');
            $name                       = $signed_mou_file->getClientOriginalName();
            $signed_mou_file->storeAs('uploads/hospital/empanelment_status/' . $hospital->id . '/', $name, 'public');
            HospitalEmpanelmentStatus::where('hospital_id', $hospital->id)->update([
                'signed_mou_file'               =>  $name
            ]);
        }

        if ($request->hasfile('agreed_packages_and_tariff_pdf_other_images_file')) {
            $agreed_packages_and_tariff_pdf_other_images_file                    = $request->file('agreed_packages_and_tariff_pdf_other_images_file');
            $name                       = $agreed_packages_and_tariff_pdf_other_images_file->getClientOriginalName();
            $agreed_packages_and_tariff_pdf_other_images_file->storeAs('uploads/hospital/empanelment_status/' . $hospital->id . '/', $name, 'public');
            HospitalEmpanelmentStatus::where('hospital_id', $hospital->id)->update([
                'agreed_packages_and_tariff_pdf_other_images_file'               =>  $name
            ]);
        }

        if ($request->hasfile('upload_packages_and_tariff_excel_or_csv_file')) {
            $upload_packages_and_tariff_excel_or_csv_file                    = $request->file('upload_packages_and_tariff_excel_or_csv_file');
            $name                       = $upload_packages_and_tariff_excel_or_csv_file->getClientOriginalName();
            $upload_packages_and_tariff_excel_or_csv_file->storeAs('uploads/hospital/empanelment_status/' . $hospital->id . '/', $name, 'public');
            HospitalEmpanelmentStatus::where('hospital_id', $hospital->id)->update([
                'upload_packages_and_tariff_excel_or_csv_file'               =>  $name
            ]);
        }

        if ($request->hasfile('negative_listing_status_file')) {
            $negative_listing_status_file                    = $request->file('negative_listing_status_file');
            $name                       = $negative_listing_status_file->getClientOriginalName();
            $negative_listing_status_file->storeAs('uploads/hospital/empanelment_status/' . $hospital->id . '/', $name, 'public');
            HospitalEmpanelmentStatus::where('hospital_id', $hospital->id)->update([
                'negative_listing_status_file'               =>  $name
            ]);
        }

        return redirect()->back()->with('success', 'Hospital Empanelment Status Created successfully');
    }

    public function updateHospitalEmpanelmentStatus(Request $request, $id)
    {
        $hospital             = Hospital::find($id);

        $empanelment_status          = HospitalEmpanelmentStatus::where(['hospital_id' => $id, 'id' => $request->company_id])->first();

        if ($request->form_type == 'empanelment_status') {

            $rules = [
                'company_name'              => 'required',
                'company_type'              => 'required',
                'empanelled'                => 'required',
                'hospital_id_as_per_the_selected_company'             => ($request->empanelled == 'Yes') ? 'required|max:25' : '',
                'signed_mou'                    => ($request->empanelled == 'Yes') ? 'required' : '',
                'signed_mou_file'                    => ($request->empanelled == 'Yes' && $request->signed_mou == 'Yes' ) ? 'required' : '',
                'agreed_packages_and_tariff_pdf_other_images'           => ($request->empanelled == 'Yes') ? 'required' : '',
                'agreed_packages_and_tariff_pdf_other_images_file'           => ($request->empanelled == 'Yes' && $request->agreed_packages_and_tariff_pdf_other_images == 'Yes' ) ? 'required' : '',
            ];

            $messages = [
                'company_name.required'            => 'Please Select Company Name',
                'empanelled.required'              => 'Please Select Empanelled',
                'hospital_id_as_per_the_selected_company.required'           => 'Please Enter Hospital Id As Per The Selected Company',
                'signed_mou.required'                  => 'Please Select Signed Mou',
                'signed_mou_file.required'                  => 'Please Select Signed Mou File',
                'agreed_packages_and_tariff_pdf_other_images.required'         => 'Please Select Agreed Packages And Tariff Pdf Other Images',
                'agreed_packages_and_tariff_pdf_other_images_file.required'         => 'Please Select Agreed Packages And Tariff Pdf Other Images File',
            ];

            $this->validate($request, $rules, $messages);

            HospitalEmpanelmentStatus::updateOrCreate([
            'hospital_id' => $id, 'tpa_id' => $request->company_name],
            [
                'company_type'             => $request->company_type,
                'empanelled'               => $request->empanelled,
                'hospital_id_as_per_the_selected_company'            => $request->hospital_id_as_per_the_selected_company,
                'signed_mou'                   => $request->signed_mou,
                'agreed_packages_and_tariff_pdf_other_images'          => $request->agreed_packages_and_tariff_pdf_other_images,
                'upload_packages_and_tariff_excel_or_csv'          => $request->upload_packages_and_tariff_excel_or_csv,
            ]);

        }else{
            $rules = [
                'negative_listing_status'           => 'required',
                'negative_listing_status_file'           => ($request->empanelled == 'Yes' && $request->negative_listing_status == 'Yes' && empty($empanelment_status->negative_listing_status_file)) ? 'required' : '',
            ];

            $messages = [
                'negative_listing_status.required'         => 'Please Select Negative Listing Status',
                'negative_listing_status_file.required'         => 'Please Select Negative Listing Status File',
            ];

            $this->validate($request, $rules, $messages);

            HospitalEmpanelmentStatus::updateOrCreate([
            'hospital_id' => $id, 'id' => $request->company_id],
            [
                'negative_listing_status'          => $request->negative_listing_status,
                'hospital_empanelment_status_comments'          => $request->hospital_empanelment_status_comments,
            ]);
        }

        if ($request->hasfile('signed_mou_file')) {
            $signed_mou_file                    = $request->file('signed_mou_file');
            $name                       = $signed_mou_file->getClientOriginalName();
            $signed_mou_file->storeAs('uploads/hospital/empanelment_status/' . $hospital->id . '/', $name, 'public');
            HospitalEmpanelmentStatus::where('hospital_id', $hospital->id)->update([
                'signed_mou_file'               =>  $name
            ]);
        }

        if ($request->hasfile('agreed_packages_and_tariff_pdf_other_images_file')) {
            $agreed_packages_and_tariff_pdf_other_images_file                    = $request->file('agreed_packages_and_tariff_pdf_other_images_file');
            $name                       = $agreed_packages_and_tariff_pdf_other_images_file->getClientOriginalName();
            $agreed_packages_and_tariff_pdf_other_images_file->storeAs('uploads/hospital/empanelment_status/' . $hospital->id . '/', $name, 'public');
            HospitalEmpanelmentStatus::where('hospital_id', $hospital->id)->update([
                'agreed_packages_and_tariff_pdf_other_images_file'               =>  $name
            ]);
        }

        if ($request->hasfile('upload_packages_and_tariff_excel_or_csv_file')) {
            $upload_packages_and_tariff_excel_or_csv_file                    = $request->file('upload_packages_and_tariff_excel_or_csv_file');
            $name                       = $upload_packages_and_tariff_excel_or_csv_file->getClientOriginalName();
            $upload_packages_and_tariff_excel_or_csv_file->storeAs('uploads/hospital/empanelment_status/' . $hospital->id . '/', $name, 'public');
            HospitalEmpanelmentStatus::where('hospital_id', $hospital->id)->update([
                'upload_packages_and_tariff_excel_or_csv_file'               =>  $name
            ]);
        }

        if ($request->hasfile('negative_listing_status_file')) {
            $negative_listing_status_file                    = $request->file('negative_listing_status_file');
            $name                       = $negative_listing_status_file->getClientOriginalName();
            $negative_listing_status_file->storeAs('uploads/hospital/empanelment_status/' . $hospital->id . '/', $name, 'public');
            HospitalEmpanelmentStatus::where('hospital_id', $hospital->id)->update([
                'negative_listing_status_file'               =>  $name
            ]);
        }

        return redirect()->back()->with('success', 'Hospital Empanelment Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function importExport(Request $request){
        return view('super-admin.hospitals.import-export');
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
        $patient = Patient::where('hospital_id', $id)->exists();

        if ($patient) {
            return redirect()->back()->with('success', 'This Hospital is assigned to Patient so you can not deleted it!!');
        }

        Hospital::find($id)->delete();
        return redirect()->route('super-admin.hospitals.index')->with('success', 'Hospital deleted successfully');
    }

    public function destroyCompany($id,$eid)
    {
        HospitalEmpanelmentStatus::where(['hospital_id' => $id, 'id' => $eid])->delete();
        return redirect()->route('super-admin.hospitals.edit',$id)->with('success', 'Company deleted successfully!');
    }

    public function updateHospitalDocuments(Request $request, $id)
    {
        $document = HospitalDocument::updateOrCreate(
            [
                'hospital_id' => $id
            ],
            []
        );

        switch ($request->form_type) {
            case 'hospital_documents':

                $rules = [
                    'hospital_pan_card'           => empty($document->hospital_pan_card) ? 'required' : [],
                    'hospital_owners_pan_card'    => empty($document->hospital_owners_pan_card) ? 'required' : [],
                    'hospital_owners_aadhar_card'              => empty($document->hospital_owners_aadhar_card) ? 'required' : [],
                ];

                $messages = [
                    'hospital_pan_card.required'            => 'Please upload Hospital Pan Card',
                    'hospital_owners_pan_card.required'              => 'Please upload Hospital Owner Pan Card',
                    'hospital_owners_aadhar_card.required'           => 'Please upload Hospital Owner Aadhar Card.'
                ];

                $this->validate($request, $rules, $messages);

                if ($request->hasfile('hospital_pan_card')) {
                    $hospital_pan_card = $request->file('hospital_pan_card');
                    $name = $hospital_pan_card->getClientOriginalName();
                    $hospital_pan_card->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_pan_card)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_pan_card', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_pan_card', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_pan_card', 'file_path' => $document->hospital_pan_card, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_pan_card' =>  $name
                    ]);
                }

                if ($request->hasfile('hospital_cancel_cheque')) {
                    $hospital_cancel_cheque = $request->file('hospital_cancel_cheque');
                    $name = $hospital_cancel_cheque->getClientOriginalName();
                    $hospital_cancel_cheque->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_cancel_cheque)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_cancel_cheque', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_cancel_cheque', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_cancel_cheque', 'file_path' => $document->hospital_cancel_cheque, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_cancel_cheque' =>  $name
                    ]);
                }

                if ($request->hasfile('hospital_owners_pan_card')) {
                    $hospital_owners_pan_card = $request->file('hospital_owners_pan_card');
                    $name = $hospital_owners_pan_card->getClientOriginalName();
                    $hospital_owners_pan_card->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_owners_pan_card)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_owners_pan_card', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_owners_pan_card', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_owners_pan_card', 'file_path' => $document->hospital_owners_pan_card, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_owners_pan_card' =>  $name
                    ]);
                }

                if ($request->hasfile('hospital_owners_aadhar_card')) {
                    $hospital_owners_aadhar_card = $request->file('hospital_owners_aadhar_card');
                    $name = $hospital_owners_aadhar_card->getClientOriginalName();
                    $hospital_owners_aadhar_card->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_owners_aadhar_card)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_owners_aadhar_card', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_owners_aadhar_card', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_owners_aadhar_card', 'file_path' => $document->hospital_owners_aadhar_card, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_owners_aadhar_card' =>  $name
                    ]);
                }

                if ($request->hasfile('hospital_other_documents')) {
                    $hospital_other_documents = $request->file('hospital_other_documents');
                    $name = $hospital_other_documents->getClientOriginalName();
                    $hospital_other_documents->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_other_documents)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_other_documents', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_other_documents', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_other_documents', 'file_path' => $document->hospital_other_documents, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_other_documents' =>  $name
                    ]);
                }


                break;
            case 'hospital_fi_form':

            if ($request->hasfile('pharmacy')) {
                    $pharmacy = $request->file('pharmacy');
                    $name = $pharmacy->getClientOriginalName();
                    $pharmacy->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->pharmacy)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'pharmacy', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'pharmacy', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'pharmacy', 'file_path' => $document->pharmacy, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'pharmacy' =>  $name
                    ]);
                }

                if ($request->hasfile('lab')) {
                    $lab = $request->file('lab');
                    $name = $lab->getClientOriginalName();
                    $lab->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->lab)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'lab', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'lab', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'lab', 'file_path' => $document->lab, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'lab' =>  $name
                    ]);
                }

                if ($request->hasfile('ambulance')) {
                    $ambulance = $request->file('ambulance');
                    $name = $ambulance->getClientOriginalName();
                    $ambulance->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->ambulance)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'ambulance', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'ambulance', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'ambulance', 'file_path' => $document->ambulance, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'ambulance' =>  $name
                    ]);
                }

                if ($request->hasfile('operation_theatre')) {
                    $operation_theatre = $request->file('operation_theatre');
                    $name = $operation_theatre->getClientOriginalName();
                    $operation_theatre->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->operation_theatre)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'operation_theatre', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'operation_theatre', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'operation_theatre', 'file_path' => $document->operation_theatre, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'operation_theatre' =>  $name
                    ]);
                }

                if ($request->hasfile('icu')) {
                    $icu = $request->file('icu');
                    $name = $icu->getClientOriginalName();
                    $icu->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->icu)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'icu', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'icu', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'icu', 'file_path' => $document->icu, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'icu' =>  $name
                    ]);
                }

               if ($request->hasfile('iccu')) {
                    $iccu = $request->file('iccu');
                    $name = $iccu->getClientOriginalName();
                    $iccu->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->iccu)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'iccu', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'iccu', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'iccu', 'file_path' => $document->iccu, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'iccu' =>  $name
                    ]);
                }

                if ($request->hasfile('nicu')) {
                    $nicu = $request->file('nicu');
                    $name = $nicu->getClientOriginalName();
                    $nicu->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->nicu)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'nicu', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'nicu', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'nicu', 'file_path' => $document->nicu, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'nicu' =>  $name
                    ]);
                }

                if ($request->hasfile('csc_sterilization')) {
                    $csc_sterilization = $request->file('csc_sterilization');
                    $name = $csc_sterilization->getClientOriginalName();
                    $csc_sterilization->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->csc_sterilization)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'csc_sterilization', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'csc_sterilization', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'csc_sterilization', 'file_path' => $document->csc_sterilization, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'csc_sterilization' =>  $name
                    ]);
                }

                if ($request->hasfile('centralized_gas_ons')) {
                    $centralized_gas_ons = $request->file('centralized_gas_ons');
                    $name = $centralized_gas_ons->getClientOriginalName();
                    $centralized_gas_ons->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->centralized_gas_ons)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'centralized_gas_ons', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'centralized_gas_ons', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'centralized_gas_ons', 'file_path' => $document->centralized_gas_ons, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'centralized_gas_ons' =>  $name
                    ]);
                }

                if ($request->hasfile('centralized_ac')) {
                    $centralized_ac = $request->file('centralized_ac');
                    $name = $centralized_ac->getClientOriginalName();
                    $centralized_ac->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->centralized_ac)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'centralized_ac', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'centralized_ac', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'centralized_ac', 'file_path' => $document->centralized_ac, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'centralized_ac' =>  $name
                    ]);
                }

                if ($request->hasfile('kitchen')) {
                    $kitchen = $request->file('kitchen');
                    $name = $kitchen->getClientOriginalName();
                    $kitchen->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->kitchen)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'kitchen', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'kitchen', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'kitchen', 'file_path' => $document->kitchen, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'kitchen' =>  $name
                    ]);
                }

                if ($request->hasfile('usg_machine')) {
                    $usg_machine = $request->file('usg_machine');
                    $name = $usg_machine->getClientOriginalName();
                    $usg_machine->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->usg_machine)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'usg_machine', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'usg_machine', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'usg_machine', 'file_path' => $document->usg_machine, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'usg_machine' =>  $name
                    ]);
                }

                if ($request->hasfile('digital_x_ray')) {
                    $digital_x_ray = $request->file('digital_x_ray');
                    $name = $digital_x_ray->getClientOriginalName();
                    $digital_x_ray->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->digital_x_ray)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'digital_x_ray', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'digital_x_ray', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'digital_x_ray', 'file_path' => $document->digital_x_ray, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'digital_x_ray' =>  $name
                    ]);
                }

                if ($request->hasfile('ct')) {
                    $ct = $request->file('ct');
                    $name = $ct->getClientOriginalName();
                    $ct->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->ct)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'ct', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'ct', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'ct', 'file_path' => $document->ct, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'ct' =>  $name
                    ]);
                }

                if ($request->hasfile('mri')) {
                    $mri = $request->file('mri');
                    $name = $mri->getClientOriginalName();
                    $mri->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->mri)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'mri', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'mri', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'mri', 'file_path' => $document->mri, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'mri' =>  $name
                    ]);
                }

                if ($request->hasfile('pet_scan')) {
                    $pet_scan = $request->file('pet_scan');
                    $name = $pet_scan->getClientOriginalName();
                    $pet_scan->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->pet_scan)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'pet_scan', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'pet_scan', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'pet_scan', 'file_path' => $document->pet_scan, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'pet_scan' =>  $name
                    ]);
                }

                if ($request->hasfile('organ_transplant_unit')) {
                    $organ_transplant_unit = $request->file('organ_transplant_unit');
                    $name = $organ_transplant_unit->getClientOriginalName();
                    $organ_transplant_unit->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->organ_transplant_unit)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'organ_transplant_unit', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'organ_transplant_unit', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'organ_transplant_unit', 'file_path' => $document->organ_transplant_unit, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'organ_transplant_unit' =>  $name
                    ]);
                }

                if ($request->hasfile('burn_unit')) {
                    $burn_unit = $request->file('burn_unit');
                    $name = $burn_unit->getClientOriginalName();
                    $burn_unit->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->burn_unit)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'burn_unit', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'burn_unit', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'burn_unit', 'file_path' => $document->burn_unit, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'burn_unit' =>  $name
                    ]);
                }

                if ($request->hasfile('dialysis_unit')) {
                    $dialysis_unit = $request->file('dialysis_unit');
                    $name = $dialysis_unit->getClientOriginalName();
                    $dialysis_unit->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->dialysis_unit)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'dialysis_unit', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'dialysis_unit', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'dialysis_unit', 'file_path' => $document->dialysis_unit, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'dialysis_unit' =>  $name
                    ]);
                }

                if ($request->hasfile('blood_bank')) {
                    $blood_bank = $request->file('blood_bank');
                    $name = $blood_bank->getClientOriginalName();
                    $blood_bank->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->blood_bank)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'blood_bank', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'blood_bank', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'blood_bank', 'file_path' => $document->blood_bank, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'blood_bank' =>  $name
                    ]);
                }

               if ($request->hasfile('other')) {
                    $other = $request->file('other');
                    $name = $other->getClientOriginalName();
                    $other->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->other)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'other', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'other', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'other', 'file_path' => $document->other, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'other' =>  $name
                    ]);
                }

                break;
            case 'hospital_certificates':

                $rules = [
                    'hospital_registration_certificate'           => empty($document->hospital_registration_certificate) ? 'required' : [],
                    'hospital_rohini_certificate'    => empty($document->hospital_rohini_certificate) ? 'required' : [],
                ];

                $messages = [
                    'hospital_registration_certificate.required'            => 'Please upload Hospital Registration certiticate',
                    'hospital_rohini_certificate.required'              => 'Please upload Hospital Rohini Certificate'
                ];

                $this->validate($request, $rules, $messages);

                if ($request->hasfile('hospital_registration_certificate')) {
                    $hospital_registration_certificate = $request->file('hospital_registration_certificate');
                    $name = $hospital_registration_certificate->getClientOriginalName();
                    $hospital_registration_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_registration_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_registration_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_registration_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_registration_certificate', 'file_path' => $document->hospital_registration_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_registration_certificate' =>  $name
                    ]);
                }

                if ($request->hasfile('hospital_rohini_certificate')) {
                    $hospital_rohini_certificate = $request->file('hospital_rohini_certificate');
                    $name = $hospital_rohini_certificate->getClientOriginalName();
                    $hospital_rohini_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_rohini_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_rohini_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_rohini_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_rohini_certificate', 'file_path' => $document->hospital_rohini_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_rohini_certificate' =>  $name
                    ]);
                }

                if ($request->hasfile('hospital_pollution_clearance_certificate')) {
                    $hospital_pollution_clearance_certificate = $request->file('hospital_pollution_clearance_certificate');
                    $name = $hospital_pollution_clearance_certificate->getClientOriginalName();
                    $hospital_pollution_clearance_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_pollution_clearance_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_pollution_clearance_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_pollution_clearance_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_pollution_clearance_certificate', 'file_path' => $document->hospital_pollution_clearance_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_pollution_clearance_certificate' =>  $name
                    ]);
                }

                if ($request->hasfile('hospital_fire_safety_clearance_certificate')) {
                    $hospital_fire_safety_clearance_certificate = $request->file('hospital_fire_safety_clearance_certificate');
                    $name = $hospital_fire_safety_clearance_certificate->getClientOriginalName();
                    $hospital_fire_safety_clearance_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_fire_safety_clearance_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_fire_safety_clearance_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_fire_safety_clearance_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_fire_safety_clearance_certificate', 'file_path' => $document->hospital_fire_safety_clearance_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_fire_safety_clearance_certificate' =>  $name
                    ]);
                }

                if ($request->hasfile('hospital_certificate_of_incorporation')) {
                    $hospital_certificate_of_incorporation = $request->file('hospital_certificate_of_incorporation');
                    $name = $hospital_certificate_of_incorporation->getClientOriginalName();
                    $hospital_certificate_of_incorporation->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_certificate_of_incorporation)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_certificate_of_incorporation', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_certificate_of_incorporation', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_certificate_of_incorporation', 'file_path' => $document->hospital_certificate_of_incorporation, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_certificate_of_incorporation' =>  $name
                    ]);
                }

                if ($request->hasfile('hospital_certificate_of_incorporation')) {
                    $hospital_certificate_of_incorporation = $request->file('hospital_certificate_of_incorporation');
                    $name = $hospital_certificate_of_incorporation->getClientOriginalName();
                    $hospital_certificate_of_incorporation->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_certificate_of_incorporation)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_certificate_of_incorporation', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_certificate_of_incorporation', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_certificate_of_incorporation', 'file_path' => $document->hospital_certificate_of_incorporation, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_certificate_of_incorporation' =>  $name
                    ]);
                }

                if ($request->hasfile('hospital_tan_certificate')) {
                    $hospital_tan_certificate = $request->file('hospital_tan_certificate');
                    $name = $hospital_tan_certificate->getClientOriginalName();
                    $hospital_tan_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_tan_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_tan_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_tan_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_tan_certificate', 'file_path' => $document->hospital_tan_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_tan_certificate' =>  $name
                    ]);
                }


                if ($request->hasfile('hospital_gst_certificate')) {
                    $hospital_gst_certificate = $request->file('hospital_gst_certificate');
                    $name = $hospital_gst_certificate->getClientOriginalName();
                    $hospital_gst_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hospital_gst_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hospital_gst_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hospital_gst_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hospital_gst_certificate', 'file_path' => $document->hospital_gst_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hospital_gst_certificate' =>  $name
                    ]);
                }

                if ($request->hasfile('nabl_certificate')) {
                    $nabl_certificate = $request->file('nabl_certificate');
                    $name = $nabl_certificate->getClientOriginalName();
                    $nabl_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->nabl_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'nabl_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'nabl_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'nabl_certificate', 'file_path' => $document->nabl_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'nabl_certificate' =>  $name
                    ]);
                }

                if ($request->hasfile('nabh_certificate')) {
                    $nabh_certificate = $request->file('nabh_certificate');
                    $name = $nabh_certificate->getClientOriginalName();
                    $nabh_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->nabh_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'nabh_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'nabh_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'nabh_certificate', 'file_path' => $document->nabh_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'nabh_certificate' =>  $name
                    ]);
                }

                if ($request->hasfile('jci_certificate')) {
                    $jci_certificate = $request->file('jci_certificate');
                    $name = $jci_certificate->getClientOriginalName();
                    $jci_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->jci_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'jci_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'jci_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'jci_certificate', 'file_path' => $document->jci_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'jci_certificate' =>  $name
                    ]);
                }

                if ($request->hasfile('nqac_or_nhsrc_certificate')) {
                    $nqac_or_nhsrc_certificate = $request->file('nqac_or_nhsrc_certificate');
                    $name = $nqac_or_nhsrc_certificate->getClientOriginalName();
                    $nqac_or_nhsrc_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->nqac_or_nhsrc_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'nqac_or_nhsrc_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'nqac_or_nhsrc_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'nqac_or_nhsrc_certificate', 'file_path' => $document->nqac_or_nhsrc_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'nqac_or_nhsrc_certificate' =>  $name
                    ]);
                }

                if ($request->hasfile('hippa_certificate')) {
                    $hippa_certificate = $request->file('hippa_certificate');
                    $name = $hippa_certificate->getClientOriginalName();
                    $hippa_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->hippa_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'hippa_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'hippa_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'hippa_certificate', 'file_path' => $document->hippa_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'hippa_certificate' =>  $name
                    ]);
                }

                if ($request->hasfile('iso_certificates')) {
                    $iso_certificates = $request->file('iso_certificates');
                    $name = $iso_certificates->getClientOriginalName();
                    $iso_certificates->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->iso_certificates)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'iso_certificates', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'iso_certificates', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'iso_certificates', 'file_path' => $document->iso_certificates, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'iso_certificates' =>  $name
                    ]);
                }

                if ($request->hasfile('other_certificates')) {
                    $other_certificates = $request->file('other_certificates');
                    $name = $other_certificates->getClientOriginalName();
                    $other_certificates->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->other_certificates)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'other_certificates', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'other_certificates', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'other_certificates', 'file_path' => $document->other_certificates, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'other_certificates' =>  $name
                    ]);
                }

                break;
            case 'doctor_registration':
                $rules = [
                    'medical_superintendents_registration_certificate'           => empty($document->medical_superintendents_registration_certificate) ? 'required' : [],
                ];

                $messages = [
                    'medical_superintendents_registration_certificate.required'            => 'Please upload Medical superintendents registration certificate',
                ];

                $this->validate($request, $rules, $messages);

                if ($request->hasfile('medical_superintendents_registration_certificate')) {
                    $medical_superintendents_registration_certificate = $request->file('medical_superintendents_registration_certificate');
                    $name = $medical_superintendents_registration_certificate->getClientOriginalName();
                    $medical_superintendents_registration_certificate->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->medical_superintendents_registration_certificate)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'medical_superintendents_registration_certificate', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'medical_superintendents_registration_certificate', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'medical_superintendents_registration_certificate', 'file_path' => $document->medical_superintendents_registration_certificate, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'medical_superintendents_registration_certificate' =>  $name
                    ]);
                }

                if ($request->hasfile('doctors_registration_certificate_other')) {
                    $doctors_registration_certificate_other = $request->file('doctors_registration_certificate_other');
                    $name = $doctors_registration_certificate_other->getClientOriginalName();
                    $doctors_registration_certificate_other->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->doctors_registration_certificate_other)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'doctors_registration_certificate_other', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'doctors_registration_certificate_other', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'doctors_registration_certificate_other', 'file_path' => $document->doctors_registration_certificate_other, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'doctors_registration_certificate_other' =>  $name
                    ]);
                }

                
                break;
            case 'hospital_mous':

                if ($request->hasfile('mou_with_bhc')) {
                    $mou_with_bhc = $request->file('mou_with_bhc');
                    $name = $mou_with_bhc->getClientOriginalName();
                    $mou_with_bhc->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->mou_with_bhc)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'mou_with_bhc', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'mou_with_bhc', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'mou_with_bhc', 'file_path' => $document->mou_with_bhc, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'mou_with_bhc' =>  $name
                    ]);
                }

                if ($request->hasfile('mous_with_nbfcs_banks_triparty')) {
                    $mous_with_nbfcs_banks_triparty = $request->file('mous_with_nbfcs_banks_triparty');
                    $name = $mous_with_nbfcs_banks_triparty->getClientOriginalName();
                    $mous_with_nbfcs_banks_triparty->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->mous_with_nbfcs_banks_triparty)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'mous_with_nbfcs_banks_triparty', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'mous_with_nbfcs_banks_triparty', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'mous_with_nbfcs_banks_triparty', 'file_path' => $document->mous_with_nbfcs_banks_triparty, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'mous_with_nbfcs_banks_triparty' =>  $name
                    ]);
                }

                if ($request->hasfile('mous_ic_or_tpa_or_govt_or_psu_or_other_corporates')) {
                    $mous_ic_or_tpa_or_govt_or_psu_or_other_corporates = $request->file('mous_ic_or_tpa_or_govt_or_psu_or_other_corporates');
                    $name = $mous_ic_or_tpa_or_govt_or_psu_or_other_corporates->getClientOriginalName();
                    $mous_ic_or_tpa_or_govt_or_psu_or_other_corporates->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->mous_ic_or_tpa_or_govt_or_psu_or_other_corporates)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'mous_ic_or_tpa_or_govt_or_psu_or_other_corporates', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'mous_ic_or_tpa_or_govt_or_psu_or_other_corporates', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'mous_ic_or_tpa_or_govt_or_psu_or_other_corporates', 'file_path' => $document->mous_ic_or_tpa_or_govt_or_psu_or_other_corporates, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'mous_ic_or_tpa_or_govt_or_psu_or_other_corporates' =>  $name
                    ]);
                }

                break;
            case 'hospital_packages':

            if ($request->hasfile('agreed_tariff_and_packages')) {
                    $agreed_tariff_and_packages = $request->file('agreed_tariff_and_packages');
                    $name = $agreed_tariff_and_packages->getClientOriginalName();
                    $agreed_tariff_and_packages->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->agreed_tariff_and_packages)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'agreed_tariff_and_packages', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'agreed_tariff_and_packages', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'agreed_tariff_and_packages', 'file_path' => $document->agreed_tariff_and_packages, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'agreed_tariff_and_packages' =>  $name
                    ]);
                }


                if ($request->hasfile('other_packages')) {
                    $other_packages = $request->file('other_packages');
                    $name = $other_packages->getClientOriginalName();
                    $other_packages->storeAs('uploads/hospital/documents/' . $id . '/', $name, 'public');

                    if (!empty($document->other_packages)) {
                        $exists = HospitalDocumentHistory::where(['file_name' => 'other_packages', 'hospital_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  HospitalDocumentHistory::where(['file_name' => 'other_packages', 'hospital_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        HospitalDocumentHistory::insert(
                            ['file_name' => 'other_packages', 'file_path' => $document->other_packages, 'hospital_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    HospitalDocument::where('hospital_id', $id)->update([
                        'other_packages' =>  $name
                    ]);
                }

                break;
            default:
                # code...
                break;
        }
        return redirect()->back()->with('success', 'Hospital Document updated successfully');
    }
}
