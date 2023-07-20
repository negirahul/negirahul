<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BillEntry;

class BillEntryController extends Controller
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
        BillEntry::create($request->except('_token'));
        return redirect()->route('super-admin.bill-entry')->with('success', 'Bill Entry created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $bill_entry = BillEntry::find($id);

        if ($request->hasfile('room_rent_file')) {
            $room_rent_file                    = $request->file('room_rent_file');
            $name                       = $room_rent_file->getClientOriginalName();
            $room_rent_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'room_rent_file'               =>  $name
            ]);
        }

        if ($request->hasfile('nursing_charges_file')) {
            $nursing_charges_file                    = $request->file('nursing_charges_file');
            $name                       = $nursing_charges_file->getClientOriginalName();
            $nursing_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'nursing_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('diet_charges_file')) {
            $diet_charges_file                    = $request->file('diet_charges_file');
            $name                       = $diet_charges_file->getClientOriginalName();
            $diet_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'diet_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('rmo_charges_file')) {
            $rmo_charges_file                    = $request->file('rmo_charges_file');
            $name                       = $rmo_charges_file->getClientOriginalName();
            $rmo_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'rmo_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('administration_charges_file')) {
            $administration_charges_file                    = $request->file('administration_charges_file');
            $name                       = $administration_charges_file->getClientOriginalName();
            $administration_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'administration_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('iv_fluids_file')) {
            $iv_fluids_file                    = $request->file('iv_fluids_file');
            $name                       = $iv_fluids_file->getClientOriginalName();
            $iv_fluids_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'iv_fluids_file'               =>  $name
            ]);
        }

        if ($request->hasfile('blood_transfusion_file')) {
            $blood_transfusion_file                    = $request->file('blood_transfusion_file');
            $name                       = $blood_transfusion_file->getClientOriginalName();
            $blood_transfusion_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'blood_transfusion_file'               =>  $name
            ]);
        }

        if ($request->hasfile('injection_file')) {
            $injection_file                    = $request->file('injection_file');
            $name                       = $injection_file->getClientOriginalName();
            $injection_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'injection_file'               =>  $name
            ]);
        }

        if ($request->hasfile('medical_practitioners_fees_file')) {
            $medical_practitioners_fees_file                    = $request->file('medical_practitioners_fees_file');
            $name                       = $medical_practitioners_fees_file->getClientOriginalName();
            $medical_practitioners_fees_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'medical_practitioners_fees_file'               =>  $name
            ]);
        }

        if ($request->hasfile('specialists_visit_file')) {
            $specialists_visit_file                    = $request->file('specialists_visit_file');
            $name                       = $specialists_visit_file->getClientOriginalName();
            $specialists_visit_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'specialists_visit_file'               =>  $name
            ]);
        }

        if ($request->hasfile('consultants_visit_file')) {
            $consultants_visit_file                    = $request->file('consultants_visit_file');
            $name                       = $consultants_visit_file->getClientOriginalName();
            $consultants_visit_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'consultants_visit_file'               =>  $name
            ]);
        }

        if ($request->hasfile('surgeon_fees_visit_file')) {
            $surgeon_fees_visit_file                    = $request->file('surgeon_fees_visit_file');
            $name                       = $surgeon_fees_visit_file->getClientOriginalName();
            $surgeon_fees_visit_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'surgeon_fees_visit_file'               =>  $name
            ]);
        }

        if ($request->hasfile('anaesthetist_file')) {
            $anaesthetist_file                    = $request->file('anaesthetist_file');
            $name                       = $anaesthetist_file->getClientOriginalName();
            $anaesthetist_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'anaesthetist_file'               =>  $name
            ]);
        }

        if ($request->hasfile('ot_assistant_file')) {
            $ot_assistant_file                    = $request->file('ot_assistant_file');
            $name                       = $ot_assistant_file->getClientOriginalName();
            $ot_assistant_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'ot_assistant_file'               =>  $name
            ]);
        }

        if ($request->hasfile('physiotherapy_file')) {
            $physiotherapy_file                    = $request->file('physiotherapy_file');
            $name                       = $physiotherapy_file->getClientOriginalName();
            $physiotherapy_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'physiotherapy_file'               =>  $name
            ]);
        }

        if ($request->hasfile('pharmacy_charges_file')) {
            $pharmacy_charges_file                    = $request->file('pharmacy_charges_file');
            $name                       = $pharmacy_charges_file->getClientOriginalName();
            $pharmacy_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'pharmacy_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('medicines_file')) {
            $medicines_file                    = $request->file('medicines_file');
            $name                       = $medicines_file->getClientOriginalName();
            $medicines_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'medicines_file'               =>  $name
            ]);
        }

        if ($request->hasfile('drugs_file')) {
            $drugs_file                    = $request->file('drugs_file');
            $name                       = $drugs_file->getClientOriginalName();
            $drugs_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'drugs_file'               =>  $name
            ]);
        }

        if ($request->hasfile('diagnostic_charges_file')) {
            $diagnostic_charges_file                    = $request->file('diagnostic_charges_file');
            $name                       = $diagnostic_charges_file->getClientOriginalName();
            $diagnostic_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'diagnostic_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('lab_tests_file')) {
            $lab_tests_file                    = $request->file('lab_tests_file');
            $name                       = $lab_tests_file->getClientOriginalName();
            $lab_tests_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'lab_tests_file'               =>  $name
            ]);
        }

        if ($request->hasfile('investigation_file')) {
            $investigation_file                    = $request->file('investigation_file');
            $name                       = $investigation_file->getClientOriginalName();
            $investigation_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'investigation_file'               =>  $name
            ]);
        }

        if ($request->hasfile('imaging_investigation_file')) {
            $imaging_investigation_file                    = $request->file('imaging_investigation_file');
            $name                       = $imaging_investigation_file->getClientOriginalName();
            $imaging_investigation_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'imaging_investigation_file'               =>  $name
            ]);
        }

        if ($request->hasfile('other_charges_file')) {
            $other_charges_file                    = $request->file('other_charges_file');
            $name                       = $other_charges_file->getClientOriginalName();
            $other_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'other_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('anaesthesia_file')) {
            $anaesthesia_file                    = $request->file('anaesthesia_file');
            $name                       = $anaesthesia_file->getClientOriginalName();
            $anaesthesia_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'anaesthesia_file'               =>  $name
            ]);
        }

        if ($request->hasfile('blood_file')) {
            $blood_file                    = $request->file('blood_file');
            $name                       = $blood_file->getClientOriginalName();
            $blood_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'blood_file'               =>  $name
            ]);
        }

        if ($request->hasfile('oxygen_file')) {
            $oxygen_file                    = $request->file('oxygen_file');
            $name                       = $oxygen_file->getClientOriginalName();
            $oxygen_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'oxygen_file'               =>  $name
            ]);
        }

        if ($request->hasfile('operation_theatre_charges_file')) {
            $operation_theatre_charges_file                    = $request->file('operation_theatre_charges_file');
            $name                       = $operation_theatre_charges_file->getClientOriginalName();
            $operation_theatre_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'operation_theatre_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('surgical_appliances_charges_file')) {
            $surgical_appliances_charges_file                    = $request->file('surgical_appliances_charges_file');
            $name                       = $surgical_appliances_charges_file->getClientOriginalName();
            $surgical_appliances_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'surgical_appliances_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('implants_for_surgical_procedures_file')) {
            $implants_for_surgical_procedures_file                    = $request->file('implants_for_surgical_procedures_file');
            $name                       = $implants_for_surgical_procedures_file->getClientOriginalName();
            $implants_for_surgical_procedures_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'implants_for_surgical_procedures_file'               =>  $name
            ]);
        }

        if ($request->hasfile('prosthetics_devices_file')) {
            $prosthetics_devices_file                    = $request->file('prosthetics_devices_file');
            $name                       = $prosthetics_devices_file->getClientOriginalName();
            $prosthetics_devices_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'prosthetics_devices_file'               =>  $name
            ]);
        }

        if ($request->hasfile('other_devices_file')) {
            $other_devices_file                    = $request->file('other_devices_file');
            $name                       = $other_devices_file->getClientOriginalName();
            $other_devices_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'other_devices_file'               =>  $name
            ]);
        }

        if ($request->hasfile('implant_charges_file')) {
            $implant_charges_file                    = $request->file('implant_charges_file');
            $name                       = $implant_charges_file->getClientOriginalName();
            $implant_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'implant_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('other_consumable_items_file')) {
            $other_consumable_items_file                    = $request->file('other_consumable_items_file');
            $name                       = $other_consumable_items_file->getClientOriginalName();
            $other_consumable_items_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'other_consumable_items_file'               =>  $name
            ]);
        }

        if ($request->hasfile('payable_consumables_file')) {
            $payable_consumables_file                    = $request->file('payable_consumables_file');
            $name                       = $payable_consumables_file->getClientOriginalName();
            $payable_consumables_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'payable_consumables_file'               =>  $name
            ]);
        }

        if ($request->hasfile('non_payable_consumables_file')) {
            $non_payable_consumables_file                    = $request->file('non_payable_consumables_file');
            $name                       = $non_payable_consumables_file->getClientOriginalName();
            $non_payable_consumables_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'non_payable_consumables_file'               =>  $name
            ]);
        }

        if ($request->hasfile('ambulance_charges_file')) {
            $ambulance_charges_file                    = $request->file('ambulance_charges_file');
            $name                       = $ambulance_charges_file->getClientOriginalName();
            $ambulance_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'ambulance_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('registration_admission_charges_file')) {
            $registration_admission_charges_file                    = $request->file('registration_admission_charges_file');
            $name                       = $registration_admission_charges_file->getClientOriginalName();
            $registration_admission_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'registration_admission_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('package_charges_file')) {
            $package_charges_file                    = $request->file('package_charges_file');
            $name                       = $package_charges_file->getClientOriginalName();
            $package_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'package_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('gipsa_ppn_packages_file')) {
            $gipsa_ppn_packages_file                    = $request->file('gipsa_ppn_packages_file');
            $name                       = $gipsa_ppn_packages_file->getClientOriginalName();
            $gipsa_ppn_packages_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'gipsa_ppn_packages_file'               =>  $name
            ]);
        }

        if ($request->hasfile('bhc_packages_file')) {
            $bhc_packages_file                    = $request->file('bhc_packages_file');
            $name                       = $bhc_packages_file->getClientOriginalName();
            $bhc_packages_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'bhc_packages_file'               =>  $name
            ]);
        }

        if ($request->hasfile('other_file')) {
            $other_file                    = $request->file('other_file');
            $name                       = $other_file->getClientOriginalName();
            $other_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'other_file'               =>  $name
            ]);
        }

        if ($request->hasfile('opd_charges_file')) {
            $opd_charges_file                    = $request->file('opd_charges_file');
            $name                       = $opd_charges_file->getClientOriginalName();
            $opd_charges_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'opd_charges_file'               =>  $name
            ]);
        }

        if ($request->hasfile('wellness_file')) {
            $wellness_file                    = $request->file('wellness_file');
            $name                       = $wellness_file->getClientOriginalName();
            $wellness_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'wellness_file'               =>  $name
            ]);
        }

        if ($request->hasfile('hospital_amount_file')) {
            $hospital_amount_file                    = $request->file('hospital_amount_file');
            $name                       = $hospital_amount_file->getClientOriginalName();
            $hospital_amount_file->storeAs('uploads/cliams/bill-entry/' . $bill_entry->id . '/', $name, 'public');
            BillEntry::where('id', $bill_entry->id)->update([
                'hospital_amount_file'               =>  $name
            ]);
        }

        
        BillEntry::where('id',$id)->update([
            'room_rent_date' => $request->room_rent_date,
            'room_rent_from' => $request->room_rent_from,
            'room_rent_to' => $request->room_rent_to,
            'room_rent_total_days' => $request->room_rent_total_days,
            'room_rent_amount' => $request->room_rent_amount,
            'room_rent_total_amount' => $request->room_rent_total_amount,
            'icu_charges_date' => $request->icu_charges_date,
            'icu_charges_from' => $request->icu_charges_from,
            'icu_charges_to' => $request->icu_charges_to,
            'icu_charges_total_days' => $request->icu_charges_total_days,
            'icu_charges_amount' => $request->icu_charges_amount,
            'icu_charges_total_amount' => $request->icu_charges_total_amount,
            'nursing_charges_date' => $request->nursing_charges_date,
            'nursing_charges_from' => $request->nursing_charges_from,
            'nursing_charges_to' => $request->nursing_charges_to,
            'nursing_charges_total_days' => $request->nursing_charges_total_days,
            'nursing_charges_amount' => $request->nursing_charges_amount,
            'nursing_charges_total_amount' => $request->nursing_charges_total_amount,
            'diet_charges_date' => $request->diet_charges_date,
            'diet_charges_from' => $request->diet_charges_from,
            'diet_charges_to' => $request->diet_charges_to,
            'diet_charges_total_days' => $request->diet_charges_total_days,
            'diet_charges_amount' => $request->diet_charges_amount,
            'diet_charges_total_amount' => $request->diet_charges_total_amount,
            'rmo_charges_date' => $request->rmo_charges_date,
            'rmo_charges_from' => $request->rmo_charges_from,
            'rmo_charges_to' => $request->rmo_charges_to,
            'rmo_charges_total_days' => $request->rmo_charges_total_days,
            'rmo_charges_amount' => $request->rmo_charges_amount,
            'rmo_charges_total_amount' => $request->rmo_charges_total_amount,
            'administration_charges_date' => $request->administration_charges_date,
            'administration_charges_from' => $request->administration_charges_from,
            'administration_charges_to' => $request->administration_charges_to,
            'administration_charges_total_days' => $request->administration_charges_total_days,
            'administration_charges_amount' => $request->administration_charges_amount,
            'administration_charges_total_amount' => $request->administration_charges_total_amount,
            'iv_fluids_date' => $request->iv_fluids_date,
            'iv_fluids_from' => $request->iv_fluids_from,
            'iv_fluids_to' => $request->iv_fluids_to,
            'iv_fluids_total_days' => $request->iv_fluids_total_days,
            'iv_fluids_amount' => $request->iv_fluids_amount,
            'iv_fluids_total_amount' => $request->iv_fluids_total_amount,
            'blood_transfusion_date' => $request->blood_transfusion_date,
            'blood_transfusion_from' => $request->blood_transfusion_from,
            'blood_transfusion_to' => $request->blood_transfusion_to,
            'blood_transfusion_total_days' => $request->blood_transfusion_total_days,
            'blood_transfusion_amount' => $request->blood_transfusion_amount,
            'blood_transfusion_total_amount' => $request->blood_transfusion_total_amount,
            'injection_date' => $request->injection_date,
            'injection_from' => $request->injection_from,
            'injection_to' => $request->injection_to,
            'injection_total_days' => $request->injection_total_days,
            'injection_amount' => $request->injection_amount,
            'injection_total_amount' => $request->injection_total_amount,
            'medical_practitioners_fees_date' => $request->medical_practitioners_fees_date,
            'medical_practitioners_fees_from' => $request->medical_practitioners_fees_from,
            'medical_practitioners_fees_to' => $request->medical_practitioners_fees_to,
            'medical_practitioners_fees_total_days' => $request->medical_practitioners_fees_total_days,
            'medical_practitioners_fees_amount' => $request->medical_practitioners_fees_amount,
            'medical_practitioners_fees_total_amount' => $request->medical_practitioners_fees_total_amount,
            'specialists_visit_date' => $request->specialists_visit_date,
            'specialists_visit_from' => $request->specialists_visit_from,
            'specialists_visit_to' => $request->specialists_visit_to,
            'specialists_visit_total_days' => $request->specialists_visit_total_days,
            'specialists_visit_amount' => $request->specialists_visit_amount,
            'specialists_visit_total_amount' => $request->specialists_visit_total_amount,
            'consultants_visit_date' => $request->consultants_visit_date,
            'consultants_visit_from' => $request->consultants_visit_from,
            'consultants_visit_to' => $request->consultants_visit_to,
            'consultants_visit_total_days' => $request->consultants_visit_total_days,
            'consultants_visit_amount' => $request->consultants_visit_amount,
            'consultants_visit_total_amount' => $request->consultants_visit_total_amount,
            'surgeon_fees_visit_date' => $request->surgeon_fees_visit_date,
            'surgeon_fees_visit_from' => $request->surgeon_fees_visit_from,
            'surgeon_fees_visit_to' => $request->surgeon_fees_visit_to,
            'surgeon_fees_visit_total_days' => $request->surgeon_fees_visit_total_days,
            'surgeon_fees_visit_amount' => $request->surgeon_fees_visit_amount,
            'surgeon_fees_visit_total_amount' => $request->surgeon_fees_visit_total_amount,
            'anaesthetist_date' => $request->anaesthetist_date,
            'anaesthetist_from' => $request->anaesthetist_from,
            'anaesthetist_to' => $request->anaesthetist_to,
            'anaesthetist_total_days' => $request->anaesthetist_total_days,
            'anaesthetist_amount' => $request->anaesthetist_amount,
            'anaesthetist_total_amount' => $request->anaesthetist_total_amount,
            'ot_assistant_date' => $request->ot_assistant_date,
            'ot_assistant_from' => $request->ot_assistant_from,
            'ot_assistant_to' => $request->ot_assistant_to,
            'ot_assistant_total_days' => $request->ot_assistant_total_days,
            'ot_assistant_amount' => $request->ot_assistant_amount,
            'ot_assistant_total_amount' => $request->ot_assistant_total_amount,
            'physiotherapy_date' => $request->physiotherapy_date,
            'physiotherapy_from' => $request->physiotherapy_from,
            'physiotherapy_to' => $request->physiotherapy_to,
            'physiotherapy_total_days' => $request->physiotherapy_total_days,
            'physiotherapy_amount' => $request->physiotherapy_amount,
            'physiotherapy_total_amount' => $request->physiotherapy_total_amount,
            'pharmacy_charges_date' => $request->pharmacy_charges_date,
            'pharmacy_charges_from' => $request->pharmacy_charges_from,
            'pharmacy_charges_to' => $request->pharmacy_charges_to,
            'pharmacy_charges_total_days' => $request->pharmacy_charges_total_days,
            'pharmacy_charges_amount' => $request->pharmacy_charges_amount,
            'pharmacy_charges_total_amount' => $request->pharmacy_charges_total_amount,
            'medicines_date' => $request->medicines_date,
            'medicines_from' => $request->medicines_from,
            'medicines_to' => $request->medicines_to,
            'medicines_total_days' => $request->medicines_total_days,
            'medicines_amount' => $request->medicines_amount,
            'medicines_total_amount' => $request->medicines_total_amount,
            'drugs_date' => $request->drugs_date,
            'drugs_from' => $request->drugs_from,
            'drugs_to' => $request->drugs_to,
            'drugs_total_days' => $request->drugs_total_days,
            'drugs_amount' => $request->drugs_amount,
            'drugs_total_amount' => $request->drugs_total_amount,
            'diagnostic_charges_date' => $request->diagnostic_charges_date,
            'diagnostic_charges_from' => $request->diagnostic_charges_from,
            'diagnostic_charges_to' => $request->diagnostic_charges_to,
            'diagnostic_charges_total_days' => $request->diagnostic_charges_total_days,
            'diagnostic_charges_amount' => $request->diagnostic_charges_amount,
            'diagnostic_charges_total_amount' => $request->diagnostic_charges_total_amount,
            'lab_tests_date' => $request->lab_tests_date,
            'lab_tests_from' => $request->lab_tests_from,
            'lab_tests_to' => $request->lab_tests_to,
            'lab_tests_total_days' => $request->lab_tests_total_days,
            'lab_tests_amount' => $request->lab_tests_amount,
            'lab_tests_total_amount' => $request->lab_tests_total_amount,
            'investigation_date' => $request->investigation_date,
            'investigation_from' => $request->investigation_from,
            'investigation_to' => $request->investigation_to,
            'investigation_total_days' => $request->investigation_total_days,
            'investigation_amount' => $request->investigation_amount,
            'investigation_total_amount' => $request->investigation_total_amount,
            'imaging_investigation_date' => $request->imaging_investigation_date,
            'imaging_investigation_from' => $request->imaging_investigation_from,
            'imaging_investigation_to' => $request->imaging_investigation_to,
            'imaging_investigation_total_days' => $request->imaging_investigation_total_days,
            'imaging_investigation_amount' => $request->imaging_investigation_amount,
            'imaging_investigation_total_amount' => $request->imaging_investigation_total_amount,
            'other_charges_date' => $request->other_charges_date,
            'other_charges_from' => $request->other_charges_from,
            'other_charges_to' => $request->other_charges_to,
            'other_charges_total_days' => $request->other_charges_total_days,
            'other_charges_amount' => $request->other_charges_amount,
            'other_charges_total_amount' => $request->other_charges_total_amount,
            'anaesthesia_date' => $request->anaesthesia_date,
            'anaesthesia_from' => $request->anaesthesia_from,
            'anaesthesia_to' => $request->anaesthesia_to,
            'anaesthesia_total_days' => $request->anaesthesia_total_days,
            'anaesthesia_amount' => $request->anaesthesia_amount,
            'anaesthesia_total_amount' => $request->anaesthesia_total_amount,
            'blood_date' => $request->blood_date,
            'blood_from' => $request->blood_from,
            'blood_to' => $request->blood_to,
            'blood_total_days' => $request->blood_total_days,
            'blood_amount' => $request->blood_amount,
            'blood_total_amount' => $request->blood_total_amount,
            'oxygen_date' => $request->oxygen_date,
            'oxygen_from' => $request->oxygen_from,
            'oxygen_to' => $request->oxygen_to,
            'oxygen_total_days' => $request->oxygen_total_days,
            'oxygen_amount' => $request->oxygen_amount,
            'oxygen_total_amount' => $request->oxygen_total_amount,
            'operation_theatre_charges_date' => $request->operation_theatre_charges_date,
            'operation_theatre_charges_from' => $request->operation_theatre_charges_from,
            'operation_theatre_charges_to' => $request->operation_theatre_charges_to,
            'operation_theatre_charges_total_days' => $request->operation_theatre_charges_total_days,
            'operation_theatre_charges_amount' => $request->operation_theatre_charges_amount,
            'operation_theatre_charges_total_amount' => $request->operation_theatre_charges_total_amount,
            'surgical_appliances_charges_date' => $request->surgical_appliances_charges_date,
            'surgical_appliances_charges_from' => $request->surgical_appliances_charges_from,
            'surgical_appliances_charges_to' => $request->surgical_appliances_charges_to,
            'surgical_appliances_charges_total_days' => $request->surgical_appliances_charges_total_days,
            'surgical_appliances_charges_amount' => $request->surgical_appliances_charges_amount,
            'surgical_appliances_charges_total_amount' => $request->surgical_appliances_charges_total_amount,
            'implants_for_surgical_procedures_date' => $request->implants_for_surgical_procedures_date,
            'implants_for_surgical_procedures_from' => $request->implants_for_surgical_procedures_from,
            'implants_for_surgical_procedures_to' => $request->implants_for_surgical_procedures_to,
            'implants_for_surgical_procedures_total_days' => $request->implants_for_surgical_procedures_total_days,
            'implants_for_surgical_procedures_amount' => $request->implants_for_surgical_procedures_amount,
            'implants_for_surgical_procedures_total_amount' => $request->implants_for_surgical_procedures_total_amount,
            'prosthetics_devices_date' => $request->prosthetics_devices_date,
            'prosthetics_devices_from' => $request->prosthetics_devices_from,
            'prosthetics_devices_to' => $request->prosthetics_devices_to,
            'prosthetics_devices_total_days' => $request->prosthetics_devices_total_days,
            'prosthetics_devices_amount' => $request->prosthetics_devices_amount,
            'prosthetics_devices_total_amount' => $request->prosthetics_devices_total_amount,
            'other_devices_date' => $request->other_devices_date,
            'other_devices_from' => $request->other_devices_from,
            'other_devices_to' => $request->other_devices_to,
            'other_devices_total_days' => $request->other_devices_total_days,
            'other_devices_amount' => $request->other_devices_amount,
            'other_devices_total_amount' => $request->other_devices_total_amount,
            'ambulance_charges_date' => $request->ambulance_charges_date,
            'ambulance_charges_from' => $request->ambulance_charges_from,
            'ambulance_charges_to' => $request->ambulance_charges_to,
            'ambulance_charges_total_days' => $request->ambulance_charges_total_days,
            'ambulance_charges_amount' => $request->ambulance_charges_amount,
            'ambulance_charges_total_amount' => $request->ambulance_charges_total_amount,
            'other_consumable_items_date' => $request->other_consumable_items_date,
            'other_consumable_items_from' => $request->other_consumable_items_from,
            'other_consumable_items_to' => $request->other_consumable_items_to,
            'other_consumable_items_total_days' => $request->other_consumable_items_total_days,
            'other_consumable_items_amount' => $request->other_consumable_items_amount,
            'other_consumable_items_total_amount' => $request->other_consumable_items_total_amount,
            'payable_consumables_date' => $request->payable_consumables_date,
            'payable_consumables_from' => $request->payable_consumables_from,
            'payable_consumables_to' => $request->payable_consumables_to,
            'payable_consumables_total_days' => $request->payable_consumables_total_days,
            'payable_consumables_amount' => $request->payable_consumables_amount,
            'payable_consumables_total_amount' => $request->payable_consumables_total_amount,
            'non_payable_consumables_date' => $request->non_payable_consumables_date,
            'non_payable_consumables_from' => $request->non_payable_consumables_from,
            'non_payable_consumables_to' => $request->non_payable_consumables_to,
            'non_payable_consumables_total_days' => $request->non_payable_consumables_total_days,
            'non_payable_consumables_amount' => $request->non_payable_consumables_amount,
            'non_payable_consumables_total_amount' => $request->non_payable_consumables_total_amount,
            'registration_admission_charges_date' => $request->registration_admission_charges_date,
            'registration_admission_charges_from' => $request->registration_admission_charges_from,
            'registration_admission_charges_to' => $request->registration_admission_charges_to,
            'registration_admission_charges_total_days' => $request->registration_admission_charges_total_days,
            'registration_admission_charges_amount' => $request->registration_admission_charges_amount,
            'registration_admission_charges_total_amount' => $request->registration_admission_charges_total_amount,
            'package_charges_date' => $request->package_charges_date,
            'package_charges_from' => $request->package_charges_from,
            'package_charges_to' => $request->package_charges_to,
            'package_charges_total_days' => $request->package_charges_total_days,
            'package_charges_amount' => $request->package_charges_amount,
            'package_charges_total_amount' => $request->package_charges_total_amount,
            'gipsa_ppn_packages_date' => $request->gipsa_ppn_packages_date,
            'gipsa_ppn_packages_from' => $request->gipsa_ppn_packages_from,
            'gipsa_ppn_packages_to' => $request->gipsa_ppn_packages_to,
            'gipsa_ppn_packages_total_days' => $request->gipsa_ppn_packages_total_days,
            'gipsa_ppn_packages_amount' => $request->gipsa_ppn_packages_amount,
            'gipsa_ppn_packages_total_amount' => $request->gipsa_ppn_packages_total_amount,
            'bhc_packages_date' => $request->bhc_packages_date,
            'bhc_packages_from' => $request->bhc_packages_from,
            'bhc_packages_to' => $request->bhc_packages_to,
            'bhc_packages_total_days' => $request->bhc_packages_total_days,
            'bhc_packages_amount' => $request->bhc_packages_amount,
            'bhc_packages_total_amount' => $request->bhc_packages_total_amount,
            'other_date' => $request->other_date,
            'other_from' => $request->other_from,
            'other_to' => $request->other_to,
            'other_total_days' => $request->other_total_days,
            'other_amount' => $request->other_amount,
            'other_total_amount' => $request->other_total_amount,
            'opd_charges_date' => $request->opd_charges_date,
            'opd_charges_from' => $request->opd_charges_from,
            'opd_charges_to' => $request->opd_charges_to,
            'opd_charges_total_days' => $request->opd_charges_total_days,
            'opd_charges_amount' => $request->opd_charges_amount,
            'opd_charges_total_amount' => $request->opd_charges_total_amount,
            'wellness_date' => $request->wellness_date,
            'wellness_from' => $request->wellness_from,
            'wellness_to' => $request->wellness_to,
            'wellness_total_days' => $request->wellness_total_days,
            'wellness_amount' => $request->wellness_amount,
            'wellness_total_amount' => $request->wellness_total_amount,
            'hospital_amount' => $request->hospital_amount,
            'bhc_amount' => $request->bhc_amount,
            'bhc_total_amount' => $request->bhc_total_amount
        ]);

        return redirect()->route('super-admin.bill-entry')->with('success', 'Bill Entry created successfully');
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
