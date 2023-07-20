<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\AssociatePartner;
use App\Models\Hospital;
use App\Models\HospitalFacility;
use App\Models\HospitalInfrastructure;
use App\Models\HospitalDepartment;
use App\Models\HospitalTieUp;
use App\Models\User;
use App\Models\Insurer;
use App\Notifications\Hospital\CredentialsGeneratedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HospitalController extends Controller
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
        $hospitals = Hospital::query();
        if($filter_search){
            $hospitals->where('name', 'like','%' . $filter_search . '%');
        }
        $hospitals = $hospitals->orderBy('id', 'desc')->paginate(20);
        return view('employee.hospitals.manage',  compact('hospitals', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $associates = AssociatePartner::get();
        $users      = User::get();

        return view('employee.hospitals.create.create',  compact('associates', 'users'));
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
            'name'                     => 'required',
            'firstname'                => 'required',
            'onboarding'               => 'required',
            'by'                       => 'required',
            'pan'                      => 'required|alpha_num',
            'panfile'                  => 'required',
            'rohini'                   => 'required',
            'rohinifile'               => 'required',
            'landline'                 => 'required|numeric|digits:10',
            'email'                    => 'required|unique:hospitals',
            'address'                  => 'required',
            'city'                     => 'required',
            'state'                    => 'required',
            'pincode'                  => 'required|numeric',
            'phone'                    => 'required|numeric|digits:10',
            'associate_partner_id'     => 'required',
            'associate_partner_name'   => 'required',
            'assigned_employee'        => 'required',
            'assigned_employee_id'     => 'required',
            'linked_employee'          => 'required',
            'linked_employee_id'       => 'required',
        ];

        $messages = [
            'name.required'                   => 'Please enter hospital name',
            'firstname.required'              => 'Please enter owner firstname',
            'onboarding.required'             => 'Please select hospital onboarding.',
            'by.required'                     => 'Please select hospital by.',
            'pan.required'                    => 'Please enter PAN number.',
            'panfile.required'                => 'Please upload PAN Card.',
            'rohini.required'                 => 'Please enter Rohini code.',
            'rohinifile.required'             => 'Please upload Rohini file.',
            'landline.required'               => "Please enter hospital landline",
            'email.required'                  => 'Please enter official email ID.',
            'address.required'                => 'Please enter address.',
            'city.required'                   => 'Please enter city.',
            'state.required'                  => 'Please enter state.',
            'pincode.required'                => 'Please enter pincode.',
            'phone.required'                  => 'Please enter hospital mobile number.',
            'associate_partner_id.required'   => 'Please enter associate partner ID.',
            'associate_partner_name.required' => 'Please enter associate partner name.',
            'assigned_employee.required'      => 'Please select assigned employee.',
            'assigned_employee_id.required'   => 'Please enter assigned employee ID.',
            'linked_employee.required'        => 'Please select linked employee.',
            'linked_employee_id.required'     => 'Please enter linked employee ID.',
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
            'landline'                 => $request->landline,
            'phone'                    => $request->phone,
            'rohini'                   => $request->rohini,
            'linked_associate_partner' => $request->associate_partner_name,
            'linked_associate_partner_id' => $request->associate_partner_id,
            'assigned_employee'        => $request->assigned_employee,
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

        return redirect()->route('employee.hospitals.index')->with('success', 'Hospital created successfully');
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
        return view('employee.hospitals.edit.edit',  compact('hospital', 'hospitals', 'hospital_facility', 'hospital_nfrastructure', 'hospital_department', 'hospital_tie_ups', 'users', 'insurers'));
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
            'name'                     => 'required',
            'firstname'                => 'required',
            'onboarding'               => 'required',
            'by'                       => 'required',
            'pan'                      => 'required|alpha_num',
            'rohini'                   => 'required',
            'landline'                 => 'required|numeric|digits:10',
            'email'                    => 'required|unique:hospitals,email,'.$id,
            'address'                  => 'required',
            'city'                     => 'required',
            'state'                    => 'required',
            'pincode'                  => 'required|numeric',
            'phone'                    => 'required|numeric|digits:10',
            'associate_partner_id'     => 'required',
            'tan' => 'required',
            'gst' => 'required',
            'owner_email' => 'required|email',
            'owner_phone' => 'required|numeric|digits:10',
            'contact_person_name' => 'required',
            'contact_person_email' => 'required|email',
            'contact_person_phone' => 'required|numeric|digits:10',
            'registration_no' => 'required|alpha_num|digits_between:1,20',
            'medical_superintendent_name' => 'required',
            'medical_superintendent_email' => 'required|email',
            'medical_superintendent_mobile' => 'required|numeric|digits:10',
            'medical_superintendent_registration_no' => 'required|alpha_num|digits_between:1,20',
            'medical_superintendent_qualification' => 'required',
            'pollution_clearance_certificate' => 'required',
            'fire_safety_clearance_certificate' => 'required',
            'certificate_of_incorporation' => 'required',
            'bank_name' => 'required',
            'bank_address' => 'required',
            'cancel_cheque' => 'required',
            'bank_account_no' => 'required|alpha_num|digits_between:1,20',
            'bank_ifs_code' => 'required|alpha_num|digits_between:1,11',
            'tariff_list_soc' => 'required',
            'nabh_registration_no' => 'required|alpha_num|digits_between:1,15',
            'nabl_registration_no' => 'required|alpha_num|digits_between:1,15',
            'signed_mous' => 'required',
            'other_documents' => 'required',
            'hrms_software' => 'required',
            'iso_status' => 'required'
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
            'associate_partner_id.required'   => 'Please enter associate partner ID.',
            'associate_partner_name.required' => 'Please enter associate partner name.',
            'tan.required' => 'Please Enter Tan',
            'gst.required' => 'Please Enter Gst',
            'owner_email.required' => 'Please Enter Owner Email',
            'owner_phone.required' => 'Please Enter Owner Phone',
            'contact_person_name.required' => 'Please Enter Contact Person Name',
            'contact_person_email.required' => 'Please Enter Contact Person Email',
            'contact_person_phone.required' => 'Please Enter Contact Person Phone',
            'registration_no.required' => 'Please Enter Registration No',
            'medical_superintendent_name.required' => 'Please Enter Medical Superintendent Name',
            'medical_superintendent_email.required' => 'Please Enter Medical Superintendent Email',
            'medical_superintendent_mobile.required' => 'Please Enter Medical Superintendent Mobile',
            'medical_superintendent_registration_no.required' => 'Please Enter Medical Superintendent Registration No',
            'medical_superintendent_qualification.required' => 'Please Enter Medical Superintendent Qualification',
            'pollution_clearance_certificate.required' => 'Please Enter Pollution Clearance Certificate',
            'fire_safety_clearance_certificate.required' => 'Please Enter Fire Safety Clearance Certificate',
            'certificate_of_incorporation.required' => 'Please Enter Certificate Of Incorporation',
            'bank_name.required' => 'Please Enter Bank Name',
            'bank_address.required' => 'Please Enter Bank Address',
            'cancel_cheque.required' => 'Please Enter Cancel Cheque',
            'bank_account_no.required' => 'Please Enter Bank Account No',
            'bank_ifs_code.required' => 'Please Enter Bank Ifs Code',
            'tariff_list_soc.required' => 'Please Enter Tariff List Soc',
            'nabh_registration_no.required' => 'Please Enter Nabh Registration No',
            'nabl_registration_no.required' => 'Please Enter Nabl Registration No',
            'signed_mous.required' => 'Please Enter Signed Mous',
            'other_documents.required' => 'Please Enter Other Documents',
            'hrms_software.required' => 'Please Enter Hrms Software',
            'iso_status.required' => 'Please Enter Iso Status',
        ];

        $this->validate($request, $rules, $messages);

        Hospital::where('id', $id)->update([
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
            'landline'                 => $request->landline,
            'phone'                    => $request->phone,
            'rohini'                   => $request->rohini,
            'linked_associate_partner' => $request->associate_partner_name,
            'linked_associate_partner_id' => $request->associate_partner_id,
            'tan' => $request->tan,
            'gst' => $request->gst,
            'owner_email' => $request->owner_email,
            'owner_phone' => $request->owner_phone,
            'contact_person_name' => $request->contact_person_name,
            'contact_person_email' => $request->contact_person_email,
            'contact_person_phone' => $request->contact_person_phone,
            'registration_no' => $request->registration_no,
            'medical_superintendent_name' => $request->medical_superintendent_name,
            'medical_superintendent_email' => $request->medical_superintendent_email,
            'medical_superintendent_mobile' => $request->medical_superintendent_mobile,
            'medical_superintendent_registration_no' => $request->medical_superintendent_registration_no,
            'medical_superintendent_qualification' => $request->medical_superintendent_qualification,
            'pollution_clearance_certificate' => $request->pollution_clearance_certificate,
            'fire_safety_clearance_certificate' => $request->fire_safety_clearance_certificate,
            'certificate_of_incorporation' => $request->certificate_of_incorporation,
            'bank_name' => $request->bank_name,
            'bank_address' => $request->bank_address,
            'cancel_cheque' => $request->cancel_cheque,
            'bank_account_no' => $request->bank_account_no,
            'bank_ifs_code' => $request->bank_ifs_code,
            'tariff_list_soc' => $request->tariff_list_soc,
            'nabh_registration_no' => $request->nabh_registration_no,
            'nabl_registration_no' => $request->nabl_registration_no,
            'signed_mous' => $request->signed_mous,
            'other_documents' => $request->other_documents,
            'hrms_software' => $request->hrms_software,
            'iso_status' => $request->iso_status,
            'comments'                 => $request->comments
        ]);

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

        if ($request->hasfile('rohinifile')) {
            $rohinifile                    = $request->file('rohinifile');
            $rhnname                       = $rohinifile->getClientOriginalName();
            $rohinifile->storeAs('uploads/hospital/' . $hospital->id . '/', $rhnname, 'public');
            Hospital::where('id', $hospital->id)->update([
                'rohinifile'               =>  $rhnname
            ]);
        }

        return redirect()->back()->with('success', 'Hospital updated successfully');
    }


    public function updateHospitalTieUps(Request $request, $id)
    {
        $hospital             = Hospital::find($id);

        $rules = [
            'mou_inception_date'                     => isset($request->mou_inception_date)?'required':'',
            'bhc_packages_for_surgical_procedures_accepted'                => 'required',
            'discount_on_medical_management_cases'               => 'required',
            'discount_on_final_bill'                       => 'required_if:discount_on_medical_management_cases,Yes|numeric|digits_between:1,2',
            'discount_on_room_rent'                      => 'required_if:discount_on_medical_management_cases,Yes|numeric|digits_between:1,2',
            'discount_on_medicines'                   => 'required_if:discount_on_medical_management_cases,Yes|numeric|digits_between:1,2',
            'discount_on_consumables'                 => 'required_if:discount_on_medical_management_cases,Yes|numeric|digits_between:1,2',
            'referral_commission_offered'                    => 'required',
            'referral'                  => 'required_if:referral_commission_offered,Yes|numeric|digits_between:1,2',
            'claimstag_usage_services'                     => 'required',
            'claimstag_installation_charges'                    => 'required|numeric|digits_between:1,6',
            'claimstag_usage_charges'                  => 'required||numeric|digits_between:1,6',
            'claims_reimbursement_insured_services'                    => 'required',
            'claims_reimbursement_insured_service_charges'     => 'required|numeric|digits_between:1,2',
            'cashless_claims_management_services' => 'required',
            'cashless_claims_management_services_charges' => 'required|numeric|digits_between:1,2',
            'lending_finance_company_agreement' => 'required',
            'lending_finance_company_agreement_date' => 'required_if:lending_finance_company_agreement,Yes',
            'medical_lending_for_patients' => 'required_if:lending_finance_company_agreement,Yes',
            'medical_lending_service_type' => 'required_if:lending_finance_company_agreement,Yes',
            'subvention' => 'required_if:lending_finance_company_agreement,Yes|numeric:digits_between:1,2',
            'medical_lending_for_bill_invoice_discounting' => 'required_if:lending_finance_company_agreement,Yes',
            'comments_on_invoice_discounting' => 'required_if:lending_finance_company_agreement,Yes|max:40',
            'hospital_management_system_installation' => 'required',
            'hms_services' => 'required_if:hospital_management_system_installation,Yes',
            'hms_charges' => 'required_if:hospital_management_system_installation,Yes|numeric',
            'comments' => 'required|string|max:250',
        ];

        $messages = [
            'mou_inception_date.required'                   => 'Please Enter Mou Inception Date',
            'bhc_packages_for_surgical_procedures_accepted.required'              => 'Please Enter Bhc Packages For Surgical Procedures Accepted',
            'discount_on_medical_management_cases.required'             => 'Please Enter Discount On Medical Management Cases',
            'discount_on_final_bill.required'                     => 'Please Enter Discount On Final Bill',
            'discount_on_room_rent.required'                    => 'Please Enter Discount On Room Rent',
            'discount_on_medicines.required'                 => 'Please Enter Discount On Medicines',
            'discount_on_consumables.required'               => 'Please Enter Discount On Consumables',
            'referral_commission_offered.required'                  => 'Please Enter Referral Commission Offered',
            'referral.required'                => 'Please Enter referral',
            'claimstag_usage_services.required'                   => 'Please Enter Claimstag Usage Services',
            'claimstag_installation_charges.required'                  => 'Please Enter Claimstag Installation Charges',
            'claimstag_usage_charges.required'                => 'Please Enter Claimstag Usage Charges',
            'claims_reimbursement_insured_services.required'                  => 'Please Enter Claims Reimbursement Insured Services',
            'claims_reimbursement_insured_service_charges.required'   => 'Please Enter Claims Reimbursement Insured Service Charges',
            'cashless_claims_management_services.required' => 'Please Enter Cashless Claims Management Services',
            'cashless_claims_management_services_charges.required' => 'Please Enter Cashless Claims Management Services Charges',
            'medical_lending_for_patients.required' => 'Please Enter Medical Lending For Patients',
            'medical_lending_service_type.required' => 'Please Enter Medical Lending Service Type',
            'subvention.required' => 'Please Enter subvention',
            'medical_lending_for_bill_invoice_discounting.required' => 'Please Enter Medical Lending For Bill Invoice Discounting',
            'comments_on_invoice_discounting.required' => 'Please Enter Comments On Invoice Discounting',
            'lending_finance_company_agreement.required' => 'Please Enter Lending Finance Company Agreement',
            'lending_finance_company_agreement_date.required' => 'Please Enter Lending Finance Company Agreement Date',
            'hms_services.required' => 'Please Enter Hms Services',
            'hospital_management_system_installation.required' => 'Please Enter hospital Management System Installation',
            'hms_charges.required' => 'Please Enter Hms Charges',
            'comments.required' => 'Please Enter comments',
        ];

        

        $this->validate($request, $rules, $messages);

          $hospitalT =  HospitalTieUp::updateOrCreate([
                'hospital_id' => $id],
                [
                'mou_inception_date'                     => $request->mou_inception_date,
                'bhc_packages_for_surgical_procedures_accepted'               => $request->bhc_packages_for_surgical_procedures_accepted,
                'discount_on_medical_management_cases'                       => $request->discount_on_medical_management_cases,
                'discount_on_final_bill'                  => $request->discount_on_final_bill,
                'discount_on_room_rent'                     => $request->discount_on_room_rent,
                'discount_on_medicines'                    => $request->discount_on_medicines,
                'discount_on_consumables'                  => $request->discount_on_consumables,
                'referral_commission_offered'                 => $request->referral_commission_offered,
                'referral'                => $request->referral,
                'claimstag_usage_services'                 => $request->claimstag_usage_services,
                'claimstag_installation_charges'                      => $request->claimstag_installation_charges,
                'claimstag_usage_charges'                    => $request->claimstag_usage_charges,
                'claims_reimbursement_insured_services'                 => $request->claims_reimbursement_insured_services,
                'claims_reimbursement_insured_service_charges'                    => $request->claims_reimbursement_insured_service_charges,
                'cashless_claims_management_services'                   => $request->cashless_claims_management_services,
                'cashless_claims_management_services_charges' => $request->cashless_claims_management_services_charges,
                'medical_lending_for_patients' => $request->medical_lending_for_patients,
                'medical_lending_service_type' => $request->medical_lending_service_type,
                'subvention' => $request->subvention,
                'medical_lending_for_bill_invoice_discounting' => $request->medical_lending_for_bill_invoice_discounting,
                'comments_on_invoice_discounting' => $request->comments_on_invoice_discounting,
                'lending_finance_company_agreement' => $request->lending_finance_company_agreement,
                'lending_finance_company_agreement_date' => $request->lending_finance_company_agreement_date,
                'hms_services' => $request->hms_services,
                'hospital_management_system_installation' => $request->hospital_management_system_installation,
                'hms_charges' => $request->hms_charges,
                'comments' => $request->comments
            ]);
        
        HospitalTieUp::where('hospital_id', $id)->update([
            'uid'      => 'HSPTUP'.$hospital->id
        ]);

        return redirect()->back()->with('success', 'Hospital updated successfully');
    }

    public function updateHospitalFacility(Request $request, $id)
    {        
        $hospital             = Hospital::find($id);

        $rules = [
            'pharmacy'                     => 'required',
            'lab'                => 'required',
            'ambulance'               => 'required',
            'operation_theatre'                       => 'required',
            'icu'                      => 'required',
            'iccu'                   => 'required',
            'nicu'                 => 'required',
            'csc_sterilization'                    => 'required',
            'centralized_gas_ons'                  => 'required',
            'centralized_ac'                     => 'required',
            'kitchen'                    => 'required',
            'usg_machine'                  => 'required',
            'digital_xray'                    => 'required',
            'ct'     => 'required',
            'mri' => 'required',
            'pet_scan' => 'required',
            'organ_transplant_unit' => 'required',
            'burn_unit' => 'required',
            'dialysis_unit' => 'required',
            'blood_bank' => 'required',
            'hospital_facility_comments' => 'required'
        ];

        $messages = [
            'pharmacy.required'                   => 'Please Enter Pharmacy',
            'lab.required'              => 'Please Enter Lab',
            'ambulance.required'             => 'Please Enter Ambulance',
            'operation_theatre.required'                     => 'Please Enter Operation Theatre',
            'icu.required'                    => 'Please Enter ICU',
            'iccu.required'                 => 'Please Enter ICCU',
            'nicu.required'               => 'Please Enter NICU',
            'csc_sterilization.required'                  => 'Please Enter CSC (Sterilization)',
            'centralized_gas_ons.required'                => 'Please Enter Centralized-Gas (ONS)',
            'centralized_ac.required'                   => 'Please Enter Centralized-AC',
            'kitchen.required'                  => 'Please Enter Kitchen',
            'usg_machine.required'                => 'Please Enter USG Machine',
            'digital_xray.required'                  => 'Please Enter Digital X-Ray',
            'ct.required'   => 'Please Enter CT',
            'mri.required' => 'Please Enter MRI',
            'pet_scan.required' => 'Please Enter PET Scan',
            'organ_transplant_unit.required' => 'Please Enter Organ Transplant Unit',
            'burn_unit.required' => 'Please Enter Burn Unit',
            'dialysis_unit.required' => 'Please Enter Dialysis Unit',
            'blood_bank.required' => 'Please Enter Blood Bank',
            'hospital_facility_comments.required' => 'Please Enter Hospital Facility Comments',
        ];

        $this->validate($request, $rules, $messages);

      

        $hospitalT =  HospitalFacility::updateOrCreate([
            'hospital_id' => $id],
            [
                'pharmacy'                              => $request->pharmacy,
                'lab'                                   => $request->lab,
                'ambulance'                              => $request->ambulance,
                'operation_theatre'                     => $request->operation_theatre,
                'icu'                                    => $request->icu,
                'iccu'                                  => $request->iccu,
                'nicu'                                  => $request->nicu,
                'csc_sterilization'                     => $request->csc_sterilization,
                'centralized_gas_ons'                    => $request->centralized_gas_ons,
                'centralized_ac'                        => $request->centralized_ac,
                'kitchen'                                => $request->kitchen,
                'usg_machine'                            => $request->usg_machine,
                'digital_xray'                          => $request->digital_xray,
                'ct'                                    => $request->ct,
                'mri'                                   => $request->mri,
                'pet_scan' =>                           $request->pet_scan,
                'organ_transplant_unit' =>              $request->organ_transplant_unit,
                'burn_unit' =>                          $request->burn_unit,
                'dialysis_unit' =>                      $request->dialysis_unit,
                'blood_bank' =>                         $request->blood_bank,
                'hospital_facility_comments' =>         $request->hospital_facility_comments
            ]);


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

        return redirect()->back()->with('success', 'HospitalFacility updated hospital_successfully');
    }


    public function updateHospitalInfrastructure(Request $request, $id)
    {
        
        $hospital             = Hospital::find($id);

        $rules = [
            'city_category'                     => 'required',
            'hospital_type'                => 'required|string|max:25',
            'hospital_category'               => 'required|string|max:25',
            'no_of_beds'                       => 'required|numeric|digits_between:1,3',
            'no_of_ots'                      => 'required|numeric|digits_between:1,3',
            'no_of_modular_ots'                   => 'required|numeric|digits_between:1,3',
            'no_of_icus'                 => 'required|numeric|digits_between:1,3',
            'no_of_iccus'                    => 'required|numeric|digits_between:1,3',
            'no_of_nicus'                  => 'required|numeric|digits_between:1,3',
            'no_of_rmos'                     => 'required|numeric|digits_between:1,4',
            'no_of_nurses'                    => 'required|numeric|digits_between:1,4',
            'nabl_approved_lab'                  => 'required',
            'no_of_dialysis_units'                    => 'required|numeric|digits_between:1,3',
            'no_ambulance_normal'     => 'required|numeric|digits_between:1,3',
            'no_ambulance_acls' => 'required|numeric|digits_between:1,3',
            'nabh_status' => 'required',
            'jci_status' => 'required',
            'nqac_nhsrc_status' => 'required',
            'hippa_status' => 'required',
            'comments' => 'required|string|max:250'
        ];

        $messages = [
            'city_category.required'                   => 'Please Enter City Category',
            'hospital_type.required'              => 'Please Enter Hospital Type',
            'hospital_category.required'             => 'Please Enter Hospital Category ',
            'no_of_beds.required'                     => 'Please Enter No. of Beds',
            'no_of_ots.required'                    => 'Please Enter No. of OTs',
            'no_of_modular_ots.required'                 => 'Please Enter No. of Modular OTs',
            'no_of_icus.required'               => 'Please Enter No. of ICUs',
            'no_of_iccus.required'                  => 'Please Enter No. of ICCUs',
            'no_of_nicus.required'                => 'Please Enter No. of NICUs',
            'no_of_rmos.required'                   => 'Please Enter No. of RMOs',
            'no_of_nurses.required'                  => 'Please Enter No. of Nurses',
            'nabl_approved_lab.required'                => 'Please Enter NABL Approved Lab',
            'no_of_dialysis_units.required'                  => 'Please Enter No. of Dialysis Units',
            'no_ambulance_normal.required'   => 'Please Enter No. Ambulance - Normal',
            'no_ambulance_acls.required' => 'Please Enter No. Ambulance - ACLS',
            'nabh_status.required' => 'Please Enter NABH Status',
            'jci_status.required' => 'Please Enter JCI Status',
            'nqac_nhsrc_status.required' => 'Please Enter NQAC/NHSRC Status',
            'hippa_status.required' => 'Please Enter HIPPA Status',
            'comments.required' => 'Please Enter Hospital Infra Comments',
        ];

        $this->validate($request, $rules, $messages);

        $hospitalT =  HospitalInfrastructure::updateOrCreate([
            'hospital_id' => $id],
            [
                'city_category'                     => $request->city_category ? $request->city_category : 'Other',
                'hospital_type'               => $request->hospital_type,
                'hospital_category'                       => $request->hospital_category,
                'no_of_beds'                  => $request->no_of_beds,
                'no_of_ots'                     => $request->no_of_ots,
                'no_of_modular_ots'                    => $request->no_of_modular_ots,
                'no_of_icus'                  => $request->no_of_icus,
                'no_of_iccus'                 => $request->no_of_iccus,
                'no_of_nicus'                => $request->no_of_nicus,
                'no_of_rmos'                 => $request->no_of_rmos,
                'no_of_nurses'                      => $request->no_of_nurses,
                'nabl_approved_lab'                    => $request->nabl_approved_lab,
                'no_of_dialysis_units'                 => $request->no_of_dialysis_units,
                'no_ambulance_normal'                    => $request->no_ambulance_normal,
                'no_ambulance_acls'                   => $request->no_ambulance_acls,
                'nabh_status' => $request->nabh_status,
                'jci_status' => $request->jci_status,
                'nqac_nhsrc_status' => $request->nqac_nhsrc_status,
                'hippa_status' => $request->hippa_status,
                'comments' => $request->comments
            ]);


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

        return redirect()->back()->with('success', 'Hospital updated successfully');
    }


    public function updateHospitalDepartment(Request $request, $id)
    {
        $hospital             = Hospital::find($id);

        $rules = [
            'specialization'              => 'required',
            'doctors_name'                => 'required_if:$request->show_doctor,1',
            'registration_no'             => 'required_if:$request->show_doctor,1|max:20',
            'email_id'                    => 'required_if:$request->show_doctor,1|email|max:45',
            'doctors_mobile_no'           => 'required_if:$request->show_doctor,1|numeric|digits:10',
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

        if ($request->hasfile('upload')) {
            $upload                    = $request->file('upload');
            $name                       = $upload->getClientOriginalName();
            $upload->storeAs('uploads/hospital/department/' . $hospital->id . '/', $name, 'public');
            HospitalDepartment::where('hospital_id', $hospital->id)->update([
                'upload'               =>  $name
            ]);
        }

        return redirect()->back()->with('success', 'Hospital updated successfully');
    }

    public function updateHospitalEmpanelmentStatus(Request $request, $id)
    {
        $hospital             = Hospital::find($id);

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

        if ($request->hasfile('upload')) {
            $upload                    = $request->file('upload');
            $name                       = $upload->getClientOriginalName();
            $upload->storeAs('uploads/hospital/empanelment_status/' . $hospital->id . '/', $name, 'public');
            HospitalDepartment::where('hospital_id', $hospital->id)->update([
                'upload'               =>  $name
            ]);
        }

        return redirect()->back()->with('success', 'Hospital updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hospital::find($id)->delete();
        return redirect()->route('employee.hospitals.index')->with('success', 'Hospital deleted successfully');
    }
}
