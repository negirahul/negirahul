<?php

namespace App\Http\Controllers\Admin\Claims;

use App\Http\Controllers\Controller;
use App\Models\AssociatePartner;
use App\Models\Claim;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\InsurancePolicy;
use App\Models\Insurer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClaimController extends Controller
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
        $claims = Claim::with('patient');
        if ($filter_search) {
            $claims->whereHas('patient', function ($q) use ($filter_search) {
                $q->where(function ($q) use ($filter_search) {
                    $q->where('uid', 'like', '%' . $filter_search . '%');
                });
            });
        }
        $claims = $claims->orderBy('id', 'desc')->paginate(20);

        return view('admin.claims.claims.manage',  compact('claims', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $patient_id     = $request->patient_id;
        $hospitals      = Hospital::get();
        $patient        = isset($patient_id) ? Patient::find($request->patient_id) : null;
        $patients       = Patient::get();
        return view('admin.claims.claims.create.create',  compact('hospitals', 'patient_id', 'patient', 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =  [
            'patient_id'                => 'required',
            'hospital_name'             => 'required',
            'hospital_id'               => 'required',
            'hospital_address'          => 'required',
            'hospital_city'             => 'required',
            'hospital_state'            => 'required',
            'hospital_pincode'          => 'required|numeric',
            'associate_partner_id'      => "required_if:$request->associate_partner_id,'!=',null",
            'registration_no'           => 'required|max:20',
            'title'                     => 'required',
            'firstname'                 => 'required|max:25',
            'lastname'                  => isset($request->lastname) ? 'max:25' : '',
            'middlename'                => isset($request->middlename) ? 'max:25' : '',
            'age'                       => 'required',
            'gender'                    => 'required',
            'admission_date'            => 'required',
            'admission_time'            => 'required',
            'abha_id'                   => 'required|max:45',
            'insurance_coverage'        => 'required',
            'policy_no'                 => $request->insurance_coverage == 'yes' ? 'required|max:16' : '',
            'company_tpa_id_card_no'    => $request->insurance_coverage == 'yes' ? 'required|max:16' : '',
            'lending_required'          => 'required',
            'hospitalization_due_to'    => 'required',
            'date_of_delivery'          => 'required',
            'system_of_medicine'        => 'required',
            'treatment_type'            => 'required',
            'admission_type_1'          => 'required',
            'admission_type_2'          => 'required',
            'admission_type_3'          => 'required',
            'claim_category'            => 'required',
            'treatment_category'        => 'required',
            'disease_category'          => 'required',
            'disease_name'              => 'required',
            'disease_type'              => 'required',
            'estimated_amount'          => 'required|max:8',
            'comments'                  => isset($request->comments) ? 'max:250' : '',
        ];

        $messages =  [
            'patient_id.required'                => 'Please select Patient ID',
            'hospital_name.required'             => 'Please enter Hospital Name',
            'hospital_id.required'               => 'Please enter Hospital ID.',
            'hospital_address.required'          => 'Please enter Hospital address.',
            'hospital_city.required'             => 'Please enter Hospital city.',
            'hospital_state.required'            => 'Please enter Hospital state.',
            'hospital_pincode.required'          => 'Please enter Hospital pincode.',
            'associate_partner_id.required'      => 'Please enter Associate Partner Id.',
            'registration_no.required'           => 'Please enter IP (In-patient) Registration No.',
            'title.required'                     => 'Please select Title',
            'firstname.required'                 => 'Please enter Firstname',
            'age.required'                       => 'Please enter Age',
            'gender.required'                    => 'Please select Gender',
            'admission_date.required'            => 'Please enter Admission date',
            'admission_time.required'            => 'Please enter Admission time',
            'abha_id.required'                   => 'Please enter ABHA ID',
            'insurance_coverage.required'        => 'Please select Insurance Coverage',
            'policy_no.required'                 => 'Please enter Policy No.',
            'company_tpa_id_card_no.required'    => 'Please enter Company / TPA ID Card No.',
            'lending_required.required'          => 'Please select Lending required',
            'hospitalization_due_to.required'    => 'Please select Hospitalization due to',
            'date_of_delivery.required'          => 'Please enter Date of delivery',
            'system_of_medicine.required'        => 'Please select System of medicine',
            'treatment_type.required'            => 'Please select Treatment type',
            'admission_type_1.required'          => 'Please select Admission type 1',
            'admission_type_2.required'          => 'Please select Admission type 2',
            'admission_type_3.required'          => 'Please select Admission type 3',
            'claim_category.required'            => 'Please select claim category',
            'treatment_category.required'        => 'Please select treatment category',
            'disease_category.required'          => 'Please select disease category',
            'disease_name.required'              => 'Please enter disease name',
            'disease_type.required'              => 'Please select disease type',
            'estimated_amount.required'          => 'Please enter estimated amount',
        ];

        $this->validate($request, $rules, $messages);

        $claim = Claim::create([
            'patient_id'                => $request->patient_id,
            'admission_date'            => $request->admission_date,
            'admission_time'            => $request->admission_time,
            'abha_id'                   => $request->abha_id,
            'insurance_coverage'        => $request->insurance_coverage,
            'policy_no'                 => $request->policy_no,
            'company_tpa_id_card_no'    => $request->company_tpa_id_card_no,
            'lending_required'          => $request->lending_required,
            'hospitalization_due_to'    => $request->hospitalization_due_to,
            'date_of_delivery'          => $request->date_of_delivery,
            'system_of_medicine'        => $request->system_of_medicine,
            'treatment_type'            => $request->treatment_type,
            'admission_type_1'          => $request->admission_type_1,
            'admission_type_2'          => $request->admission_type_2,
            'admission_type_3'          => $request->admission_type_3,
            'claim_category'            => $request->claim_category,
            'treatment_category'        => $request->treatment_category,
            'disease_category'          => $request->disease_category,
            'disease_name'              => $request->disease_name,
            'disease_type'              => $request->disease_type,
            'estimated_amount'          => $request->estimated_amount,
            'comments'                  => $request->comments,
        ]);

        Claim::where('id', $claim->id)->update([
            'uid'      => 'C-' . Carbon::parse($claim->created_at)->format('Y-m-d') . '-' . $claim->id
        ]);

        Patient::where('id', $claim->patient_id)->update([
            'title'                             => $request->title,
            'firstname'                         => $request->firstname,
            'middlename'                        => $request->middlename,
            'lastname'                          => $request->lastname,
            'age'                               => $request->age,
            'gender'                            => $request->gender,
            'hospital_id'                       => $request->hospital_id,
            'hospital_name'                     => $request->hospital_name,
            'hospital_address'                  => $request->hospital_address,
            'hospital_city'                     => $request->hospital_city,
            'hospital_state'                    => $request->hospital_state,
            'registration_number'               => $request->registration_no,
            'hospital_pincode'                  => $request->hospital_pincode,
            'associate_partner_id'              => $request->associate_partner_id,
        ]);

        return redirect()->route('admin.claims.edit', $claim->id)->with('success', 'Claim created successfully');
    }

    public function updateInsurancePolicy(Request $request, $id)
    {
        $rules = [
            'patient_id'                                => 'required',
            'claim_id'                                  => 'required',
            'policy_no'                                 => 'required|max:16',
            'insurance_company'                         => 'required',
            'policy_name'                               => 'required',
            'certificate_no'                            => 'required|max:16',
            'company_tpa_id_card_no'                    => 'required|max:16',
            'tpa_name'                                  => 'required|max:75',
            'policy_type'                               => 'required',
            'group_name'                                => $request->policy_type == 'Group' ? 'required|max:75' : '',
            'start_date'                                => 'required',
            'expiry_date'                               => 'required',
            'commencement_date'                         => 'required',
            'proposer_title'                            => 'required',
            'proposer_firstname'                        => 'required|max:25',
            'proposer_middlename'                       => isset($request->proposer_middlename) ? 'max:25' : '',
            'proposer_lastname'                         => isset($request->proposer_lastname) ? 'max:25' : '',
            'is_primary_insured_and_patient_same'       => 'required',
            'primary_insured_address'                   => $request->is_primary_insured_and_patient_same == 'Yes' ? 'required' : 'required|max:100',
            'primary_insured_city'                      => 'required',
            'primary_insured_state'                     => 'required',
            'primary_insured_pincode'                   => 'required',
            'no_of_person_insured'                      => 'required|max:2',
            'basic_sum_insured'                         => 'required|max:8',
            'cumulative_bonus_cv'                       => 'required|max:8',
            'agent_broker_code'                         => 'required|max:10',
            'agent_broker_name'                         => 'required|max:60',
            'additional_policy'                         => 'required',
            'policy_no_additional'                      => $request->additional_policy == 'Yes' ? 'required' : '',
            'currently_covered'                         => 'required',
            'commencement_date_other'                   => $request->currently_covered == 'Yes' ? 'required' : '',
            'insurance_company_other'                   => $request->currently_covered == 'Yes' ? 'required|max:60' : '',
            'policy_no_other'                           => $request->currently_covered == 'Yes' ? 'required|max:16' : '',
            'sum_insured_other'                         => $request->currently_covered == 'Yes' ? 'required|max:8' : '',
            'hospitalized'                              => 'required',
            'admission_date_past'                       => $request->hospitalized == 'Yes' ? 'required' : '',
            'diagnosis'                                 => $request->hospitalized == 'Yes' ? 'required|max:60' : '',
            'primary_insured_firstname'                 => 'required|max:15',
            'primary_insured_gender'                    => 'required',
            'primary_insured_age'                       => 'required|max:3',
            'primary_insured_relation'                  => 'required',
            'primary_insured_sum_insured'               => 'required|max:8',
            'primary_insured_cumulative_bonus'          => 'required|max:8',
            'primary_insured_balance_sum_insured'       => 'required|max:8',
            'dependent_insured_firstname'               => 'required|max:15',
            'dependent_insured_gender'                  => 'required',
            'dependent_insured_age'                     => 'required|max:3',
            'dependent_insured_relation'                => 'required',
            'dependent_insured_sum_insured'             => 'required|max:8',
            'dependent_insured_cumulative_bonus'        => 'required|max:8',
            'dependent_insured_balance_sum_insured'     => 'required|max:8',
        ];

        $messages = [
            'patient_id.required'                                => 'Please enter Patient UID',
            'claim_id.required'                                  => 'Please enter Claim UID',
            'policy_no.required'                                 => 'Please enter Policy No.',
            'insurance_company.required'                         => 'Please select Insurance Company',
            'policy_name.required'                               => 'Please select Policy Name',
            'certificate_no.required'                            => 'Please enter SI No. / Certificate No.',
            'company_tpa_id_card_no.required'                    => 'Please enter Company / TPA ID Card No.',
            'tpa_name.required'                                  => 'Please enter TPA Name.',
            'policy_type.required'                               => 'Please select Policy Type',
            'group_name.required'                                => 'Please enter Group Name.',
            'start_date.required'                                => 'Please enter Policy Start Date.',
            'expiry_date.required'                               => 'Please enter Policy Expiry Date.',
            'commencement_date.required'                         => 'Please enter Policy Commencement Date.',
            'proposer_title.required'                            => 'Please select Title.',
            'proposer_firstname.required'                        => 'Please select Title.',
            'is_primary_insured_and_patient_same.required'       => 'Please select If Primary insured and Patient are same.',
            'primary_insured_address.required'                   => 'Please enter Address.',
            'primary_insured_city.required'                      => 'Please enter City.',
            'primary_insured_state.required'                     => 'Please enter State.',
            'primary_insured_pincode.required'                   => 'Please enter Pincode.',
            'no_of_person_insured.required'                      => 'Please enter No. of person insured',
            'basic_sum_insured.required'                         => 'Please enter Basic sum insured.',
            'cumulative_bonus_cv.required'                       => 'Please enter Cumulative Bonus.',
            'agent_broker_code.required'                         => 'Please enter Agent Broker Code.',
            'agent_broker_name.required'                         => 'Please enter Agent Broker Name.',
            'additional_policy.required'                         => 'Please select if covered under any Top-up/Additional Policy.',
            'policy_no_additional.required'                      => 'Please enter Policy No. (Top Up / Additional)',
            'currently_covered.required'                         => 'Please select if currently covered by any other Mediclaim/Health Insurance.',
            'commencement_date_other.required'                   => 'Please enter Policy Commencement Date (Other Policy).',
            'insurance_company_other.required'                   => 'Please enter Insurance Company Name (Other Policy).',
            'policy_no_other.required'                           => 'Please enter Policy No. (Other Policy)',
            'sum_insured_other.required'                         => 'Please enter Sum Insured (Other Policy)',
            'hospitalized.required'                              => 'Please select if patient ever been hospitalized in the last 4 years since the inception of the contract',
            'admission_date_past.required'                       => 'Please enter Admission Date (Past)',
            'diagnosis.required'                                 => 'Please enter Diagnosis (Previous)',
            'primary_insured_firstname.required'                 => 'Please enter First name',
            'primary_insured_gender.required'                    => 'Please select Gender',
            'primary_insured_age.required'                       => 'Please enter age',
            'primary_insured_relation.required'                  => 'Please select Relation',
            'primary_insured_sum_insured.required'               => 'Please enter sum insured',
            'primary_insured_cumulative_bonus.required'          => 'Please enter cumulative bonus',
            'primary_insured_balance_sum_insured.required'       => 'Please enter balance sum insured',
            'dependent_insured_firstname.required'               => 'Please enter First name',
            'dependent_insured_gender.required'                  => 'Please select Gender',
            'dependent_insured_age.required'                     => 'Please enter age',
            'dependent_insured_relation.required'                => 'Please select Relation',
            'dependent_insured_sum_insured.required'             => 'Please enter sum insured',
            'dependent_insured_cumulative_bonus.required'        => 'Please enter cumulative bonus',
            'dependent_insured_balance_sum_insured.required'     => 'Please enter balance sum insured',

        ];

        $this->validate($request, $rules, $messages);

        $insurance_policy = InsurancePolicy::create([
            'patient_id'                                => $request->patient_id,
            'claim_id'                                  => $request->claim_id,
            'policy_no'                                 => $request->policy_no,
            'insurer_id'                                => $request->insurance_company,
            'policy_id'                                 => $request->policy_name,
            'certificate_no'                            => $request->certificate_no,
            'company_tpa_id_card_no'                    => $request->company_tpa_id_card_no,
            'tpa_name'                                  => $request->tpa_name,
            'policy_type'                               => $request->policy_type,
            'group_name'                                => $request->group_name,
            'start_date'                                => $request->start_date,
            'expiry_date'                               => $request->expiry_date,
            'commencement_date'                         => $request->commencement_date,
            'title'                                     => $request->proposer_title,
            'firstname'                                 => $request->proposer_firstname,
            'middlename'                                => $request->proposer_middlename,
            'lastname'                                  => $request->proposer_lastname,
            'is_primary_insured_and_patient_same'       => $request->is_primary_insured_and_patient_same,
            'primary_insured_address'                   => $request->primary_insured_address,
            'primary_insured_city'                      => $request->primary_insured_city,
            'primary_insured_state'                     => $request->primary_insured_state,
            'primary_insured_pincode'                   => $request->primary_insured_pincode,
            'no_of_person_insured'                      => $request->no_of_person_insured,
            'basic_sum_insured'                         => $request->basic_sum_insured,
            'cumulative_bonus_cv'                       => $request->cumulative_bonus_cv,
            'agent_broker_code'                         => $request->agent_broker_code,
            'agent_broker_name'                         => $request->agent_broker_name,
            'additional_policy'                         => $request->additional_policy,
            'policy_no_additional'                      => $request->policy_no_additional,
            'currently_covered'                         => $request->currently_covered,
            'commencement_date_other'                   => $request->commencement_date_other,
            'insurance_company_other'                   => $request->insurance_company_other,
            'policy_no_other'                           => $request->policy_no_other,
            'sum_insured_other'                         => $request->sum_insured_other,
            'hospitalized'                              => $request->hospitalized,
            'admission_date_past'                       => $request->admission_date_past,
            'diagnosis'                                 => $request->diagnosis,
            'comments'                                  => $request->comments,
            'primary_insured_firstname'                 => $request->primary_insured_firstname,
            'primary_insured_gender'                    => $request->primary_insured_gender,
            'primary_insured_age'                       => $request->primary_insured_age,
            'primary_insured_relation'                  => $request->primary_insured_relation,
            'primary_insured_sum_insured'               => $request->primary_insured_sum_insured,
            'primary_insured_cumulative_bonus'          => $request->primary_insured_cumulative_bonus,
            'primary_insured_balance_sum_insured'       => $request->primary_insured_balance_sum_insured,
            'primary_insured_comment'                   => $request->primary_insured_comment,
            'dependent_insured_firstname'               => $request->dependent_insured_firstname,
            'dependent_insured_gender'                  => $request->dependent_insured_gender,
            'dependent_insured_age'                     => $request->dependent_insured_age,
            'dependent_insured_relation'                => $request->dependent_insured_relation,
            'dependent_insured_sum_insured'             => $request->dependent_insured_sum_insured,
            'dependent_insured_cumulative_bonus'        => $request->dependent_insured_cumulative_bonus,
            'dependent_insured_balance_sum_insured'     => $request->dependent_insured_balance_sum_insured,
            'dependent_insured_comment'                 => $request->dependent_insured_comment,
        ]);

        return redirect()->route('admin.claims.index')->with('success', 'Claim updated successfully');

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
        $hospitals      = Hospital::get();
        $insurers       = Insurer::get();
        $claim          = Claim::with('patient')->find($id);
        $patients       = Patient::get();
        return view('admin.claims.claims.edit.edit',  compact('hospitals', 'claim', 'patients', 'insurers'));
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
        $rules =  [
            'patient_id'                => 'required',
            'hospital_name'             => 'required',
            'hospital_id'               => 'required',
            'hospital_address'          => 'required',
            'hospital_city'             => 'required',
            'hospital_state'            => 'required',
            'hospital_pincode'          => 'required|numeric',
            'associate_partner_id'      => "required_if:$request->associate_partner_id,'!=',null",
            'registration_no'           => 'required|max:20',
            'title'                     => 'required',
            'firstname'                 => 'required|max:25',
            'lastname'                  => isset($request->lastname) ? 'max:25' : '',
            'middlename'                => isset($request->middlename) ? 'max:25' : '',
            'age'                       => 'required',
            'gender'                    => 'required',
            'admission_date'            => 'required',
            'admission_time'            => 'required',
            'abha_id'                   => 'required|max:45',
            'insurance_coverage'        => 'required',
            'policy_no'                 => $request->insurance_coverage == 'yes' ? 'required|max:16' : '',
            'company_tpa_id_card_no'    => $request->insurance_coverage == 'yes' ? 'required|max:16' : '',
            'lending_required'          => 'required',
            'hospitalization_due_to'    => 'required',
            'date_of_delivery'          => 'required',
            'system_of_medicine'        => 'required',
            'treatment_type'            => 'required',
            'admission_type_1'          => 'required',
            'admission_type_2'          => 'required',
            'admission_type_3'          => 'required',
            'claim_category'            => 'required',
            'treatment_category'        => 'required',
            'disease_category'          => 'required',
            'disease_name'              => 'required',
            'disease_type'              => 'required',
            'estimated_amount'          => 'required|max:8',
            'comments'                  => isset($request->comments) ? 'max:250' : '',
            'claim_intimation_done'         => $request->insurance_coverage == 'Yes' ? 'required' : '',
            'claim_intimation_number_mail'  => $request->claim_intimation_done == 'Yes' ? 'required' : '',
        ];

        $messages =  [
            'patient_id.required'                   => 'Please select Patient ID',
            'hospital_name.required'                => 'Please enter Hospital  Name',
            'hospital_id.required'                  => 'Please enter Hospital ID.',
            'hospital_address.required'             => 'Please enter Hospital address.',
            'hospital_city.required'                => 'Please enter Hospital city.',
            'hospital_state.required'               => 'Please enter Hospital state.',
            'hospital_pincode.required'             => 'Please enter Hospital pincode.',
            'associate_partner_id.required'         => 'Please enter Associate Partner Id.',
            'registration_no.required'              => 'Please enter IP (In-patient) Registration No.',
            'title.required'                        => 'Please select Title',
            'firstname.required'                    => 'Please enter Firstname',
            'age.required'                          => 'Please enter Age',
            'gender.required'                       => 'Please select Gender',
            'admission_date.required'               => 'Please enter Admission date',
            'admission_time.required'               => 'Please enter Admission time',
            'abha_id.required'                      => 'Please enter ABHA ID',
            'insurance_coverage.required'           => 'Please select Insurance Coverage',
            'policy_no.required'                    => 'Please enter Policy No.',
            'company_tpa_id_card_no.required'       => 'Please enter Company / TPA ID Card No.',
            'lending_required.required'             => 'Please select Lending required',
            'hospitalization_due_to.required'       => 'Please select Hospitalization due to',
            'date_of_delivery.required'             => 'Please enter Date of delivery',
            'system_of_medicine.required'           => 'Please select System of medicine',
            'treatment_type.required'               => 'Please select Treatment type',
            'admission_type_1.required'             => 'Please select Admission type 1',
            'admission_type_2.required'             => 'Please select Admission type 2',
            'admission_type_3.required'             => 'Please select Admission type 3',
            'claim_category.required'               => 'Please select claim category',
            'treatment_category.required'           => 'Please select treatment category',
            'disease_category.required'             => 'Please select disease category',
            'disease_name.required'                 => 'Please enter disease name',
            'disease_type.required'                 => 'Please select disease type',
            'estimated_amount.required'             => 'Please enter estimated amount',
            'claim_intimation_done.required'        => 'Please select if claim intimation is done or not',
            'claim_intimation_number_mail.required' => 'Please enter claim intimation number / mail',
        ];

        $this->validate($request, $rules, $messages);

        $claim = Claim::where('id', $id)->update([
            'patient_id'                            => $request->patient_id,
            'admission_date'                        => $request->admission_date,
            'admission_time'                        => $request->admission_time,
            'abha_id'                               => $request->abha_id,
            'insurance_coverage'                    => $request->insurance_coverage,
            'policy_no'                             => $request->policy_no,
            'company_tpa_id_card_no'                => $request->company_tpa_id_card_no,
            'lending_required'                      => $request->lending_required,
            'hospitalization_due_to'                => $request->hospitalization_due_to,
            'date_of_delivery'                      => $request->date_of_delivery,
            'system_of_medicine'                    => $request->system_of_medicine,
            'treatment_type'                        => $request->treatment_type,
            'admission_type_1'                      => $request->admission_type_1,
            'admission_type_2'                      => $request->admission_type_2,
            'admission_type_3'                      => $request->admission_type_3,
            'claim_category'                        => $request->claim_category,
            'treatment_category'                    => $request->treatment_category,
            'disease_category'                      => $request->disease_category,
            'disease_name'                          => $request->disease_name,
            'disease_type'                          => $request->disease_type,
            'estimated_amount'                      => $request->estimated_amount,
            'comments'                              => $request->comments,
            'claim_intimation_done'                 => $request->claim_intimation_done,
            'claim_intimation_number_mail'          => $request->claim_intimation_number_mail,
        ]);


        Patient::where('id', $request->patient_id)->update([
            'title'                             => $request->title,
            'firstname'                         => $request->firstname,
            'middlename'                        => $request->middlename,
            'lastname'                          => $request->lastname,
            'age'                               => $request->age,
            'gender'                            => $request->gender,
            'hospital_id'                       => $request->hospital_id,
            'hospital_name'                     => $request->hospital_name,
            'hospital_address'                  => $request->hospital_address,
            'hospital_city'                     => $request->hospital_city,
            'hospital_state'                    => $request->hospital_state,
            'registration_number'               => $request->registration_no,
            'hospital_pincode'                  => $request->hospital_pincode,
            'associate_partner_id'              => $request->associate_partner_id,
        ]);

        return redirect()->route('admin.claims.edit', $id)->with('success', 'Claim updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
