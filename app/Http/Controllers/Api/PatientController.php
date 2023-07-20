<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Hospital;

class PatientController extends Controller
{

    public function index()
    {
        $patients = Patient::all();
        return response()->json([
            'patients' => $patients
        ]);
    }

    public function store(Request $request)
    {
        if(env('ENABLE_HMS') == true):

            $patient = Patient::create($request->all());

            $hospital = Hospital::where('hms_hospital_id',$request->hms_hospital_id)->first();

            Patient::where('id', $patient->id)->update([
                'uid'      => 'P-' . $patient->id + 10000,
                'hospital_id' => $hospital->id,
                'hospital_name' => $hospital->name,
                'hospital_address' => $hospital->address,
                'hospital_city' => $hospital->city,
                'hospital_state' => $hospital->state,
                'hospital_pincode' => $hospital->pincode,
            ]);

            return response()->json([
                'message' => "Patient saved successfully!",
                'patient' => $patient
            ], 200);

        else :

            return response()->json([
                'message' => "Remote create permission disabled!",
            ], 200);
            
        endif;

    }

    public function update(Request $request, Patient $patient)
    {
        $patient->update($request->all());

        return response()->json([
            'message' => "Patient updated successfully!",
            'patient' => $patient
        ], 200);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json([
            'message' => "Patient deleted successfully!",
        ], 200);
    }

}
