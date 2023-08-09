<?php

namespace App\Exports;

use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PatientExport implements FromView
{

        /**
     * @return View
     */
    public function view():View
    {
        $patients = Patient::with(['patient_adress','patient_phone'])->orderBy('id','desc')->get();
        
        return view('patients.index', [
            'patients' => $patients
        ]);
    }
}
