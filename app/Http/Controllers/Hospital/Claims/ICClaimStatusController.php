<?php

namespace App\Http\Controllers\Hospital\Claims;

use App\Http\Controllers\Controller;
use App\Models\AssessmentStatus;
use App\Models\Claimant;
use App\Models\Claim;
use App\Models\Insurer;
use App\Models\ICClaimStatus;
use App\Models\AssociatePartner;
use Illuminate\Http\Request;

class ICClaimStatusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:hospital');
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
        $claimant           = Claimant::with(['claim', 'patient', 'hospital'])->find($request->claimant_id);
        $ic_claims_exists     = ICClaimStatus::where('claimant_id', $request->claimant_id)->exists();
        $icclaim_status     = $ic_claims_exists ? ICClaimStatus::where('claimant_id', $request->claimant_id)->first() : null;
        $insurers           = Insurer::get();

        $associates = AssociatePartner::get(['associate_partners.id', 'associate_partners.name', 'associate_partners.associate_partner_id']);

        return view('hospital.claims.ic_claims.create.create', compact('icclaim_status', 'insurers', 'claimant', 'associates'));
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
        $claimant           = Claimant::where('claimant_id', $id)->first();
        $assessment         = AssessmentStatus::where('claimant_id', $id)->first();
        $ic_claims_exists     = ICClaimStatus::where('claimant_id', $id)->exists();
        $icclaim_status     = $ic_claims_exists ?ICClaimStatus::where('claimant_id', $claimant->id)->first() : null;
        $insurers           = Insurer::get();

        $associates = VendorServiceType::join('associate_partners', 'associate_partners.id', 'vendor_service_types.associate_partner_id')->where('vendor_service_types.medical_ic_claims_patient', 'yes')->get(['associate_partners.id', 'associate_partners.name', 'associate_partners.associate_partner_id']);

        return view('hospital.claims.claimants.edit.ic_claims-status', compact('claimant', 'assessment', 'icclaim_status', 'insurers', 'claimant', 'associates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $claimant           = Claimant::with('claim')->find($id);
        $claim              = Claim::find($id);
        $claimant           = Claimant::where('claimant_id', $id)->first();
        $assessment         = AssessmentStatus::where('claimant_id', $id)->first();
        $ic_claims_exists     = ICClaimStatus::where('claimant_id', $id)->exists();
        $icclaim_status     = $ic_claims_exists ?ICClaimStatus::where('claimant_id', $claimant->id)->first() : null;
        $insurers           = Insurer::get();

        $associates = VendorServiceType::join('associate_partners', 'associate_partners.id', 'vendor_service_types.associate_partner_id')->where('vendor_service_types.medical_ic_claims_patient', 'yes')->get(['associate_partners.id', 'associate_partners.name', 'associate_partners.associate_partner_id']);

        return view('hospital.claims.claimants.edit.ic_claims-status', compact('claimant', 'assessment', 'icclaim_status', 'insurers', 'claimant', 'associates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateICClaimStatus(Request $request, $id)
    {
        $claimant      = Claimant::find($id);
        
        if ($claimant->claimant) {
            $assessment    = AssessmentStatus::where('claimant_id', $claimant->claimant->id)->first();
        }else{
            $assessment    = null;
        }

        /*if (!$claimant || !$claimant->claimant || !$assessment) {
            return redirect()->back()->with('warning', 'Please create/update claimant and/or assessment first!');
        }*/

        $ic_claims   =    ICClaimStatus::updateOrCreate(
            ['claimant_id'   => $id],
            [
            'patient_id'    => $claimant->patient_id,
            'claim_id'      => $claimant->claim_id,
            'claimant_id'   => @$claimant->claimant->id,
            'hospital_id'   => $claimant->hospital_id]
        );

        switch ($request->form_type) {
            case 'loan-application-form':
                $rules = [    
                    'medical_ic_claims_type'              =>'required',
                    'vendor_partner_name_nbfc_or_bank'  =>'required',
                    'vendor_partner_id'                 =>'required|max:40',
                ];
                
                $messages =  [   
                    'medical_ic_claims_type.required'             =>'Please Enter medical ic_claims type',
                    'vendor_partner_name_nbfc_or_bank.required' =>'Please select vendor partner name nbfc or bank',
                    'vendor_partner_id.required'                =>'Please Enter vendor partner id',                                           
                ];
                
                $this->validate($request, $rules, $messages);

                $upadeted =ICClaimStatus::where('claimant_id', $id)->update([                  
                    'medical_ic_claims_type'              =>  $request->medical_ic_claims_type,
                    'vendor_partner_name_nbfc_or_bank'  =>  $request->vendor_partner_name_nbfc_or_bank,
                    'vendor_partner_id'                 =>  $request->vendor_partner_id,
                    'loan_application_comments'         =>  $request->loan_application_comments,            
                ]);

                break;

            case 'loan-application-status-form':
                $rules = [
                    'date_of_loan_application'  => ($request->applyloan == 1) ? 'required' : '',   
                    'date_of_loan_re_application'      => ($request->date_of_loan_application &&  $request->date_of_loan_re_application) ? 'required|date|after_or_equal:date_of_loan_application' : '',
                    'loan_id_or_no'             => ($request->applyloan == 1) ? 'required|max:20' : '',
                    'loan_status'               => ($request->applyloan == 1) ? 'required' : '',   
                    'loan_end_date'      => ($request->loan_start_date &&  $request->loan_end_date) ? 'required|date|after_or_equal:loan_start_date' : '',
                ];
                
                $messages =  [
                    'date_of_loan_application.required'       =>'Please Enter date of loan application',   
                    'loan_id_or_no.required'                  =>'Please Enter loan id or no',    
                    'loan_status.required'                    =>'Please Enter loan status',
                   
                    
                ];
                
                $this->validate($request, $rules, $messages);
                if ($request->applyloan == 1) {

                   ICClaimStatus::where('claimant_id', $id)->update([                   
                        'date_of_loan_application'                  => $request->date_of_loan_application,
                        'time_of_loan_application'                  => $request->time_of_loan_application,
                        'date_of_loan_re_application'               => $request->date_of_loan_re_application,
                        'time_of_loan_re_application'               => $request->time_of_loan_re_application,
                        'loan_id_or_no'                             => $request->loan_id_or_no,
                        'loan_status'                               => $request->loan_status,
                        'loan_approved_amount'                      => $request->loan_approved_amount,
                        'loan_disbursed_amount'                     => $request->loan_disbursed_amount,
                        'date_of_loan_disbursement'                 => $request->date_of_loan_disbursement,
                        'loan_tenure'                               => $request->loan_tenure,
                        'loan_instalments'                          => $request->loan_instalments,
                        'loan_start_date'                           => $request->loan_start_date,
                        'loan_end_date'                             => $request->loan_end_date,
                        'insurance_claim_settlement_date'           => $request->insurance_claim_settlement_date,
                        'insurance_claim_settled_amount'            => $request->insurance_claim_settled_amount,
                        'insurance_claim_amount_disbursement_date'  => $request->insurance_claim_amount_disbursement_date,
                        'loan_application_status_comments'          => $request->loan_application_status_comments,          
                    ]);
                }
                break;
            case 'loan-reapplication-form':
               ICClaimStatus::where('claimant_id', $id)->update([                   
                    're_apply_loan_amount'                  =>  $request->re_apply_loan_amount,
                    'loan_re_application_status_comments'   =>  $request->loan_re_application_status_comments,                         
                ]);
                break;
            default:
                # code...
                break;
            
        }
        return redirect()->back()->with('success', 'Lending status updated successfully');
    }

    public function update(Request $request, $id)
    {
        $claimant      = Claimant::with('claim')->find($id);

        $ic_claims   =    ICClaimStatus::updateOrCreate(
            ['claimant_id'  => $id,
        ],
        [
            'patient_id'      => $claimant->patient_id,
            'claim_id'      => $claimant->claim_id,
            'hospital_id'   => $claimant->hospital_id
        ]
    );

        $rules = [    
            'ic_claim_status'              =>'required',
        ];

        $this->validate($request, $rules);


        ICClaimStatus::where('claimant_id', $id)->update([                   
            /*'title' => $request->title,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,*/
            'hospital_name' => $request->hospital_name,
            'associate_partner_name' => $request->associate_partner_name,
            'insurance_co_name' => $request->insurance_co_name,
            'policy_no' => $request->policy_no,
            'tpa_name' => $request->tpa_name,
            'tpa_card_no' => $request->tpa_card_no,
            'claim_intimation_no' => $request->claim_intimation_no,
            'date_receiving_main_claim_documents' => $request->date_receiving_main_claim_documents,
            'date_dispatching_main_claim_documents_to_ic_or_tpa' => $request->date_dispatching_main_claim_documents_to_ic_or_tpa,
            'date_receiving_pre_claim_documents' => $request->date_receiving_pre_claim_documents,
            'date_dispatching_pre_claim_documents_to_ic_or_tpa' => $request->date_dispatching_pre_claim_documents_to_ic_or_tpa,
            'date_receiving_post_claim_documents' => $request->date_receiving_post_claim_documents,
            'date_dispatching_post_claim_documents_to_ic_or_tpa' => $request->date_dispatching_post_claim_documents_to_ic_or_tpa,
            'date_receiving_query1_documents' => $request->date_receiving_query1_documents,
            'date_dispatching_query1_documents_to_ic_or_tpa' => $request->date_dispatching_query1_documents_to_ic_or_tpa,
            'date_receiving_query2_documents' => $request->date_receiving_query2_documents,
            'date_dispatching_query2_documents_to_ic_or_tpa' => $request->date_dispatching_query2_documents_to_ic_or_tpa,
            'date_receiving_query3_documents' => $request->date_receiving_query3_documents,
            'date_dispatching_query3_documents_to_ic_or_tpa' => $request->date_dispatching_query3_documents_to_ic_or_tpa,
            'ic_claim_status' => $request->ic_claim_status,
            'date_settlement' => $request->date_settlement,
            'settled_amount' => $request->settled_amount,
            'date_disbursement' => $request->date_disbursement,
            'ic_claim_status_comments' => $request->ic_claim_status_comments,  
        ]);

        return redirect()->back()->with('success', 'Insurance Company Claim status updated successfully');
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
