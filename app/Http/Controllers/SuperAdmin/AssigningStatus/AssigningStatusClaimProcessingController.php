<?php

namespace App\Http\Controllers\SuperAdmin\AssigningStatus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\Insurer;
use App\Models\Admin;
use Carbon\Carbon;

class AssigningStatusClaimProcessingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        \DB::connection()->enableQueryLog();
        $filter_search = $request->search;
        $filter_claim_id = $request->claim_id;
        $filter_date_from_to = $request->date_from_to;
        $filter_status = $request->status;

        $claims = Claim::query();
        if($filter_search){
            $claims->where('name', 'like','%' . $filter_search . '%');
            $claims->orWhere('uid', 'like','%' . $filter_search . '%');
        }  
          

        if($filter_claim_id){
            $claims->where('uid', '=',  $filter_claim_id );
        }

        if($filter_date_from_to){

            $d = explode('-',$filter_date_from_to);
            $claims->whereDate('created_at', '>=',  Carbon::parse($d[0])->format('Y-m-d') );
            $claims->whereDate('created_at','<=',Carbon::parse($d[1])->format('Y-m-d') );
        }

        if($filter_status && $filter_status != 'All'){
            $claims->whereHas('claimProcessing', function ($q) use ($filter_status) {
                $q->where('final_assessment_status', $filter_status);
            });
        }

        ( is_null($filter_claim_id) && is_null($filter_date_from_to) && is_null($filter_status) ) ?

            $claims = $claims->where('insurance_coverage', 'Yes')->orWhere('lending_required', 'Yes')->orWhere(['insurance_coverage' => 'Yes', 'lending_required' => 'Yes'])->orderBy('id', 'desc')->paginate(20)
        :  $claims = $claims->orderBy('id', 'desc')->paginate(20);
        
        $queries = \DB::getQueryLog();

        $last_query = end($queries);

        return view('super-admin.assigning-status.processing.manage',  compact('claims', 'filter_search','filter_claim_id','filter_date_from_to','filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $claim = Claim::find($id);
        $insurers = Insurer::get();

        $admins = Admin::whereHas('permissions', function($q1) {
            $q1->where('name', '=', 'Claim Processing Rights (Including Editing)');
        })->get(['id', 'firstname', 'lastname', 'department', 'employee_code']);


        $admins->map(function ($item) {
            $item->name = $item->firstname . ' ' . $item->lastname;
            $item->role = 'Admin';
            unset($item->firstname);
            unset($item->lastname);
            return $item;
        });

        return view('super-admin.assigning-status.processing.create',  compact('claim','insurers', 'admins'));
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
        $claim      = Claim::find($id);

        switch ($request->form_type) {
            case 'pre_assessment_assign_form':
                $rules =  [
                    'assign_to_claim_processing'                                 => 'required',
                ];

                $messages =  [
                    'assign_to_claim_processing.required'                               => 'Please select Assign To'

                ];

                $this->validate($request, $rules, $messages);

                Claim::where('id', $id)->update([
                    'assign_to_claim_processing'                                => $request->assign_to_claim_processing,
                    'assigned_at_claim_processing'                                => Now()
                ]);
                break;
            case 'pre_assessment_re_assign_form':
                $rules =  [
                    're_assign_to_claim_processing'           => 'required',
                ];

                $messages =  [
                    're_assign_to_claim_processing.required'   => 'please select Re Assign To',
                ];

                $this->validate($request, $rules, $messages);

                Claim::where('id', $id)->update([
                    're_assign_to_claim_processing'                   => $request->re_assign_to_claim_processing,
                    'claim_processing_status'                         => 0,
                    're_assigned_at_claim_processing'                 => Now()

                ]);

                break;
            default:
                # code...
                break;

        }
        return redirect()->back()->with('success', 'Assigned successfully');
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
