<?php

namespace App\Http\Controllers\SuperAdmin\Claims;

use App\Http\Controllers\Controller;
use App\Models\Claimant;
use App\Models\DischargeStatus;
use App\Models\Insurer;
use App\Models\Claim;
use Illuminate\Http\Request;

class DischargeStatusController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $claim           = Claim::with('patient')->find($request->claim_id);
        $discharge_exists   = DischargeStatus::where('claim_id', $request->claim_id)->exists();
        $discharge_status   = $discharge_exists ? DischargeStatus::where('claim_id', $request->claim_id)->first() : null;
        $insurers           = Insurer::get();

        return view('super-admin.claims.discharges.create.create', compact('claim', 'discharge_status', 'insurers'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $claimant           = Claimant::with('claim')->find($id);
        $discharge_exists   = DischargeStatus::where('claimant_id', $id)->exists();
        $discharge_status   = $discharge_exists ? DischargeStatus::where('claimant_id', $id)->first() : null;
        $insurers           = Insurer::get();

        return view('super-admin.claims.claimants.edit.discharge-status', compact('claimant', 'discharge_status', 'insurers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateDischargeStatus(Request $request, $id)
    {
        $claim = Claim::find($id);
        $rules = [
            'hospital_id'                                           => 'required|max:40',
            'hospital_name'                                         => 'required|max:255',
            'patient_id'                                            => 'required|max:40',
            'claim_id'                                              => 'required|max:40',
            // 'date_of_admission'                                     => 'required',
            // 'time_of_admission'                                     => 'required',
            // 'hospitalization_due_to'                                => 'required',
            // 'date_of_delivery'                                      => 'required',
            'injury_reason'                                         => ($claim->hospitalization_due_to == 'Injury') ? 'required': [],
            'injury_due_to_substance_abuse_alcohol_consumption'     => isset($request->injury_reason) ? 'required':[],
            'if_medico_legal_case_mlc'                              => isset($request->injury_due_to_substance_abuse_alcohol_consumption) ? 'required':[],
            'reported_to_police'                                    => ($request->if_medico_legal_case_mlc =='Yes') ? 'required' :[],
            'mlc_report_and_police_fir_attached'                    => ($request->reported_to_police =='Yes') ? 'required' :[],
            'fir_or_mlc_no'                                         => ($request->mlc_report_and_police_fir_attached =='Yes') ? 'required|max:27':[],
            'not_reported_to_police_reason'                         => ($request->reported_to_police =='No' && $request->if_medico_legal_case_mlc =='Yes') ?'required|max:100' :[],
            'maternity_date_of_delivery'                            => ($claim->hospitalization_due_to == 'Maternity') ? 'required' : [],
            'maternity_gravida_status_g'                            => ($claim->hospitalization_due_to == 'Maternity') ? 'required|numeric|digits_between:1,2' : [],
            'maternity_gravida_status_p'                            => ($claim->hospitalization_due_to == 'Maternity') ? 'required|numeric|digits_between:1,2' : [],
            'maternity_gravida_status_l'                            => ($claim->hospitalization_due_to == 'Maternity') ? 'required|numeric|digits_between:1,2' : [],
            'maternity_gravida_status_a'                            => ($claim->hospitalization_due_to == 'Maternity') ? 'required|numeric|digits_between:1,2' : [],
            'premature_baby'                                        => ($claim->hospitalization_due_to == 'Maternity') ? 'required' : [],
            'date_of_discharge'                                     => 'required|date|after_or_equal:maternity_date_of_delivery',
            'time_of_discharge'                                     => 'required',
            'discharge_status'                                      => 'required',
            'death_summary'                                         => ($request->discharge_status == 'Deceased') ? 'required|alpha_num|max:100':[],
            'discharge_status_comments'                             => 'max:250',
            // 'death_summary_file'                                    => ($request->death_summary) ? 'required' :[]

        ];

        $messages = [
            'hospital_id.required'                                          => 'Please enter hospital id',
            'hospital_name.required'                                        => 'Please enter hospital name',
            'patient_id.required'                                           => 'Please enter patient id',
            'claim_id.required'                                             => 'Please enter claim id',
            'insurance_coverage.required'                                   => 'Please enter insurance coverage',
            'lending_required.required'                                     => 'Please enter lending required',
            'date_of_admission.required'                                    => 'Please enter date of admission',
            'time_of_admission.required'                                    => 'Please enter time of admission',
            'hospitalization_due_to.required'                               => 'Please enter hospitalization due to',
            'date_of_delivery.required'                                     => 'Please enter date of delivery',
            'injury_reason.required'                                        => 'Please enter injury reason',
            'injury_due_to_substance_abuse_alcohol_consumption.required'    => 'Please enter al injury due to alcohol',
            'reported_to_police.required'                                   => 'Please enter police reported or not',
            'mlc_report_and_police_fir_attached.required'                   => 'Please enter mlc report ',
            'fir_or_mlc_no.required'                                        => 'Please enter mlc number',
            'not_reported_to_police_reason.required'                        => 'Please enter police reported',
            'maternity_date_of_delivery.required'                           => 'Please enter maternity date of delivery',
            'maternity_gravida_status_g.required'                           => 'Please enter maternity gravida status g',
            'maternity_gravida_status_p.required'                           => 'Please enter maternity gravida status p',
            'maternity_gravida_status_l.required'                           => 'Please enter maternity gravida status l',
            'maternity_gravida_status_a.required'                           => 'Please enter maternity gravida status a',
            'premature_baby.required'                                       => 'Please enter premature baby',
            'date_of_discharge.required'                                    => 'Please enter date of discharge',
            'time_of_discharge.required'                                    => 'Please enter time of discharge',
            'discharge_status.required'                                     => 'Please enter discharge status',
            'death_summary.required'                                        => 'Please enter death summary',
            'injury_due_to_substance_abuse_alcohol_consumption_file.required'=>'Please upload file',
            'death_summary_file.required'                                   =>'Please upload death summary file'

        ];

         $this->validate($request, $rules, $messages);

         $claimant = Claimant::where('claim_id', $id)->first();

         DischargeStatus::updateOrCreate([
            'claim_id' => $id
         ],
            [
                'claimant_id' => $claimant->id ?? null,
                'hospital_id' => $claim->patient->hospital_id,
                'patient_id' => $claim->patient->id,
                'injury_reason' => $request->injury_reason,
                'injury_due_to_substance_abuse_alcohol_consumption' => $request->injury_due_to_substance_abuse_alcohol_consumption,
                'if_medico_legal_case_mlc' => $request->if_medico_legal_case_mlc,
                'reported_to_police' => $request->reported_to_police,
                'mlc_report_and_police_fir_attached' => $request->mlc_report_and_police_fir_attached,
                'fir_or_mlc_no' => $request->fir_or_mlc_no,
                'not_reported_to_police_reason' => $request->not_reported_to_police_reason,
                'maternity_date_of_delivery' => $request->maternity_date_of_delivery,
                'maternity_gravida_status_g' => $request->maternity_gravida_status_g,
                'maternity_gravida_status_p' => $request->maternity_gravida_status_p,
                'maternity_gravida_status_l' => $request->maternity_gravida_status_l,
                'maternity_gravida_status_a' => $request->maternity_gravida_status_a,
                'premature_baby' => $request->premature_baby,
                'date_of_discharge' => $request->date_of_discharge,
                'time_of_discharge' => $request->time_of_discharge,
                'discharge_status' => $request->discharge_status,
                'death_summary' => $request->death_summary,
                'discharge_status_comments' => $request->discharge_status_comments,

            ]);
            return redirect()->back()->with('success', 'Discharge status updated successfully');


    }

    public function update(Request $request, $id)
    {
        // echo "<pre>";print_r($request->all());"</pre>";exit;
        $claimant = Claimant::find($id);
        $rules = [
            'hospital_id'                                           => 'required|max:40',
            'hospital_name'                                         => 'required|max:255',
            'patient_id'                                            => 'required|max:40',
            'claim_id'                                              => 'required|max:40',
            // 'date_of_admission'                                     => 'required',
            // 'time_of_admission'                                     => 'required',
            // 'hospitalization_due_to'                                => 'required',
            // 'date_of_delivery'                                      => 'required',
            'injury_reason'                                         => ($claimant->claim->hospitalization_due_to == 'Injury') ? 'required': [],
            'injury_due_to_substance_abuse_alcohol_consumption'     => isset($request->injury_reason) ? 'required':[],
            'if_medico_legal_case_mlc'                              => isset($request->injury_due_to_substance_abuse_alcohol_consumption) ? 'required':[],
            'reported_to_police'                                    => ($request->if_medico_legal_case_mlc =='Yes') ? 'required' :[],
            'mlc_report_and_police_fir_attached'                    => ($request->reported_to_police =='Yes') ? 'required' :[],
            'fir_or_mlc_no'                                         => ($request->mlc_report_and_police_fir_attached =='Yes') ? 'required|max:27':[],
            'not_reported_to_police_reason'                         => ($request->reported_to_police =='No' && $request->if_medico_legal_case_mlc =='Yes') ?'required|max:100' :[],
            'maternity_date_of_delivery'                            => ($claimant->claim->hospitalization_due_to == 'Maternity') ? 'required' : [],
            'maternity_gravida_status_g'                            => ($claimant->claim->hospitalization_due_to == 'Maternity') ? 'required|numeric|digits_between:1,2' : [],
            'maternity_gravida_status_p'                            => ($claimant->claim->hospitalization_due_to == 'Maternity') ? 'required|numeric|digits_between:1,2' : [],
            'maternity_gravida_status_l'                            => ($claimant->claim->hospitalization_due_to == 'Maternity') ? 'required|numeric|digits_between:1,2' : [],
            'maternity_gravida_status_a'                            => ($claimant->claim->hospitalization_due_to == 'Maternity') ? 'required|numeric|digits_between:1,2' : [],
            'premature_baby'                                        => ($claimant->claim->hospitalization_due_to == 'Maternity') ? 'required' : [],
            'date_of_discharge'                                     => ($request->maternity_date_of_delivery &&  $request->date_of_discharge) ? 'required|date|after_or_equal:maternity_date_of_delivery' : '',
            'time_of_discharge'                                     => 'required',
            'discharge_status'                                      => 'required',
            'death_summary'                                         => ($request->discharge_status == 'Deceased' && $request->death_summary) ? 'required|alpha_num|max:100':[],
            'discharge_status_comments'                             => 'max:250',
            // 'death_summary_file'                                    => ($request->death_summary) ? 'required' :[]

        ];

        $messages = [
            'hospital_id.required'                                          => 'Please enter hospital id',
            'hospital_name.required'                                        => 'Please enter hospital name',
            'patient_id.required'                                           => 'Please enter patient id',
            'claim_id.required'                                             => 'Please enter claim id',
            'insurance_coverage.required'                                   => 'Please enter insurance coverage',
            'lending_required.required'                                     => 'Please enter lending required',
            'date_of_admission.required'                                    => 'Please enter date of admission',
            'time_of_admission.required'                                    => 'Please enter time of admission',
            'hospitalization_due_to.required'                               => 'Please enter hospitalization due to',
            'date_of_delivery.required'                                     => 'Please enter date of delivery',
            'injury_reason.required'                                        => 'Please enter injury reason',
            'injury_due_to_substance_abuse_alcohol_consumption.required'    => 'Please enter al injury due to alcohol',
            'reported_to_police.required'                                   => 'Please enter police reported or not',
            'mlc_report_and_police_fir_attached.required'                   => 'Please enter mlc report ',
            'fir_or_mlc_no.required'                                        => 'Please enter mlc number',
            'not_reported_to_police_reason.required'                        => 'Please enter police reported',
            'maternity_date_of_delivery.required'                           => 'Please enter maternity date of delivery',
            'maternity_gravida_status_g.required'                           => 'Please enter maternity gravida status g',
            'maternity_gravida_status_p.required'                           => 'Please enter maternity gravida status p',
            'maternity_gravida_status_l.required'                           => 'Please enter maternity gravida status l',
            'maternity_gravida_status_a.required'                           => 'Please enter maternity gravida status a',
            'premature_baby.required'                                       => 'Please enter premature baby',
            'date_of_discharge.required'                                    => 'Please enter date of discharge',
            'time_of_discharge.required'                                    => 'Please enter time of discharge',
            'discharge_status.required'                                     => 'Please enter discharge status',
            'death_summary.required'                                        => 'Please enter death summary',
            'injury_due_to_substance_abuse_alcohol_consumption_file.required'=>'Please upload file',
            'death_summary_file.required'                                   =>'Please upload death summary file'

        ];

         $this->validate($request, $rules, $messages);


         DischargeStatus::updateOrCreate([
            'claimant_id' => $id
         ],
            [
                'claimant_id' => $claimant->id,
                'hospital_id' => $claimant->hospital_id,
                'patient_id' => $claimant->patient_id,
                'claim_id' => $claimant->claim_id,
                'injury_reason' => $request->injury_reason,
                'injury_due_to_substance_abuse_alcohol_consumption' => $request->injury_due_to_substance_abuse_alcohol_consumption,
                'if_medico_legal_case_mlc' => $request->if_medico_legal_case_mlc,
                'reported_to_police' => $request->reported_to_police,
                'mlc_report_and_police_fir_attached' => $request->mlc_report_and_police_fir_attached,
                'fir_or_mlc_no' => $request->fir_or_mlc_no,
                'not_reported_to_police_reason' => $request->not_reported_to_police_reason,
                'maternity_date_of_delivery' => $request->maternity_date_of_delivery,
                'maternity_gravida_status_g' => $request->maternity_gravida_status_g,
                'maternity_gravida_status_p' => $request->maternity_gravida_status_p,
                'maternity_gravida_status_l' => $request->maternity_gravida_status_l,
                'maternity_gravida_status_a' => $request->maternity_gravida_status_a,
                'premature_baby' => $request->premature_baby,
                'date_of_discharge' => $request->date_of_discharge,
                'time_of_discharge' => $request->time_of_discharge,
                'discharge_status' => $request->discharge_status,
                'death_summary' => $request->death_summary,
                'discharge_status_comments' => $request->discharge_status_comments,

            ]);
            return redirect()->back()->with('success', 'Discharge status updated successfully');


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
