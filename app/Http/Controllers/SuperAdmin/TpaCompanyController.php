<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Tpa;
use App\Models\HospitalEmpanelmentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class TpaCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_search = $request->search;
        $tpas = Tpa::query();
        if($filter_search){
            $tpas->where('company', 'like','%' . $filter_search . '%');
        }
        $tpas = $tpas->orderBy('id', 'desc')->paginate(20);
        return view('super-admin.tpa.manage',  compact('tpas', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super-admin.tpa.create');
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
            'company'                   => 'required|string',
            'company_type'              => 'required|string',
        ];

        $messages = [
            'company.required'          => 'Please enter Company Name',
            'company_type.required'     => 'Please select Company Type',
        ];

        $this->validate($request, $rules, $messages);

        $tpa =  Tpa::create($request->all());

        if ($request->hasfile('claim_reimbursement_form')) {
            $claim_reimbursement_form                    = $request->file('claim_reimbursement_form');
            $name                       = $claim_reimbursement_form->getClientOriginalName();
            $claim_reimbursement_form->storeAs('uploads/tpa/' . $tpa->id . '/', $name, 'public');
            TPA::where('id', $tpa->id)->update([
                'claim_reimbursement_form'               =>  $name
            ]);
        }

        if ($request->hasfile('cashless_pre_authorization_request_form')) {
            $cashless_pre_authorization_request_form                    = $request->file('cashless_pre_authorization_request_form');
            $name                       = $cashless_pre_authorization_request_form->getClientOriginalName();
            $cashless_pre_authorization_request_form->storeAs('uploads/tpa/' . $tpa->id . '/', $name, 'public');
            TPA::where('id', $tpa->id)->update([
                'cashless_pre_authorization_request_form'               =>  $name
            ]);
        }

        return redirect()->route('super-admin.tpa.index')->with('success', 'Company created successfully');
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
        $tpa = Tpa::find($id);
        return view('super-admin.tpa.edit', compact('tpa'));
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
            'company'                 => 'required|string',
            'company_type'                 => 'required|string',
            ];

        $messages = [
            'company.required'             => 'Please enter Company Name',
            'company_type.required'             => 'Please select Company Name',
        ];

        $this->validate($request, $rules, $messages);

        $tpa =  Tpa::find($id)->update($request->all());

        $tpa =  Tpa::find($id);

        if ($request->hasfile('claim_reimbursement_form')) {
        $claim_reimbursement_form                    = $request->file('claim_reimbursement_form');
        $name                       = $claim_reimbursement_form->getClientOriginalName();
        $claim_reimbursement_form->storeAs('uploads/tpa/' . $tpa->id . '/', $name, 'public');
        TPA::where('id', $tpa->id)->update([
            'claim_reimbursement_form'               =>  $name
        ]);
    }

    if ($request->hasfile('cashless_pre_authorization_request_form')) {
        $cashless_pre_authorization_request_form                    = $request->file('cashless_pre_authorization_request_form');
        $name                       = $cashless_pre_authorization_request_form->getClientOriginalName();
        $cashless_pre_authorization_request_form->storeAs('uploads/tpa/' . $tpa->id . '/', $name, 'public');
        TPA::where('id', $tpa->id)->update([
            'cashless_pre_authorization_request_form'               =>  $name
        ]);
    }

        return redirect()->route('super-admin.tpa.index')->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HospitalEmpanelmentStatus::where('tpa_id',$id)->delete();

        $tpa  =  Tpa::find($id)->delete();


        return redirect()->route('super-admin.tpa.index')->with('success', 'Company deleted successfully');
    }


    public function deleteFile($id, $field)
    {
        $tpa = Tpa::where('id', $id)->first();
        $filename = 'uploads/tpa/' . $id . '/'. $tpa->$field;
        File::delete($filename);

        $tpa = Tpa::where('id', $id)->update([$field => '']);

        return redirect()->back()->with('success', 'Company file deleted successfully');
    }
}
