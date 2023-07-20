<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HospitalDocument;
use App\Models\Hospital;
use App\Models\HospitalDocumentHistory;

class HospitalDocumentController extends Controller
{
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
        $hospital_document          = HospitalDocument::where('hospital_id', $id)->first();
        if (!$hospital_document) {
            HospitalDocument::create(['hospital_id'=> $id]);
            $hospital_document          = HospitalDocument::where('hospital_id', $id)->first();
        }

        $reimbursementdocument = HospitalDocument::where('hospital_id', $id)->exists();

        if (!$reimbursementdocument) {
            HospitalDocument::create(['hospital_id' => $id]);
        }

        $reimbursementdocument = HospitalDocument::where('hospital_id', $id)->first();

        $document_files = HospitalDocumentHistory::where('hospital_id', $id)->get()
        ->groupBy('file_name')
        ->map(function ($pb) { return $pb->keyBy('file_id'); });

        return view('hospital.hospitals.edit.tabs.view-hospital-documents',  compact('hospital_document', 'document_files', 'reimbursementdocument', 'id'));

        

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
    public function update(Request $request, $id)
    {
        //
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
