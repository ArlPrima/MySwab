<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Payment;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PatientController extends Controller
{
    public function form() {
        // Catch data passing
        $isPass      = Session::get('isPass');
        $name        = Session::get('name');
        $email       = Session::get('email');
        $phoneNumber = Session::get('phoneNumber');
        // View
        return view('patient.regist', compact('name', 'email', 'phoneNumber', 'isPass'));
    }

    public function register(Request $request) {
        // Check phone number
        $phone = str_replace(" ","",$request->input('phoneNumber'));
        $phone = str_replace("(","",$phone);
        $phone = str_replace(")","",$phone);
        $phone = str_replace(".","",$phone);
        $phone = str_replace("-","",$phone);
        if(!preg_match('/[^+0-9]/',trim($phone))){
            if(substr(trim($phone), 0, 3) == '+62'){
                $phone = trim($phone);
            }
            elseif(substr(trim($phone), 0, 1) == '0'){
                $phone = '+62'.substr(trim($phone), 1);
            }
        }
        // Merge request input
        $request->merge([
            'phoneNumber' => $phone,
        ]);
        // Validation Input
        $request->validate([
            'name'        => 'required',
            'email'       => 'required',
            'phoneNumber' => 'required',
        ]);
        // Validate Email 
        if (Patient::where('email', $request->input('email'))->exists() and Session::get('isRegister') == null) {
            if (Payment::where('patient_id', Patient::where('email', $request->input('email'))->first()->id)->doesntExist()) {
                Session::flash('error', 'Email telah digunakan, silahkan lakukan pembayaran terlebih dahulu sebelum memakai kembali!');
                return redirect()->route('register');
            }
        }
        // Check register user then edit database
        if (Session::get('isRegister') != null) {
            Patient::where('id', Session::get('patient')->id)
            ->update([
                'name'          => $request->input('name'),
                'email'         => $request->input('email'),
                'phoneNumber'   => $request->input('phoneNumber'),
            ]);
        }
        // Passing Variable
        Session::put('isPass', true);
        Session::put('name', $request->input('name'));
        Session::put('email', $request->input('email'));
        Session::put('phoneNumber', $request->input('phoneNumber'));
        // View
        return redirect()->route('generalInformation');
    }

    public function formInformation() {
        // Check data passing
        if (Session::get('isPass') == null) {
            Session::flash('error', 'Data tidak tersimpan pada sistem, silahkan isi data reservasi dari awal!');
            return redirect()->route('register');
        }
        // Catch data passing
        $isRegister  = Session::get('isRegister');
        $name        = Session::get('name');
        $headOfFamily= Session::get('headOfFamily');
        $numberOfTest= Session::get('numberOfTest');
        $testDate    = Session::get('testDate');
        $address     = Session::get('address');
        $hospital_id = Session::get('hospital_id');
        // Get data from database
        $hospital = Hospital::all();
        // View
        return view('patient.generalInformation', compact('name','headOfFamily','numberOfTest','testDate','address','hospital_id','isRegister','hospital'));
    }

    public function storeInformation(Request $request) {
        // Check data passing
        if (Session::get('isPass') == null) {
            Session::flash('error', 'Data tidak tersimpan pada sistem, silahkan isi data reservasi dari awal!');
            return redirect()->route('register');
        }
        // Validation Input
        $request->validate([
            'headOfFamily'  => 'required',
            'numberOfTest'  => 'required',
            'testDate'      => 'required',
            'address'       => 'required',
            'hospital_id'   => 'required',
        ]);
        // Store data to database (Patient Table)
        Patient::create([
            'name'          => Session::get('name'),
            'email'         => Session::get('email'),
            'phoneNumber'   => Session::get('phoneNumber'),
            'headOfFamily'  => $request->input('headOfFamily'),
            'numberOfTest'  => $request->input('numberOfTest'),
            'testDate'      => $request->input('testDate'),
            'address'       => $request->input('address'),
            'hospital_id'   => $request->input('hospital_id'),
        ]);
        // Passing Variable
        Session::put('isRegister', true);
        Session::put('headOfFamily', $request->input('headOfFamily'));
        Session::put('numberOfTest', $request->input('numberOfTest'));
        Session::put('testDate', $request->input('testDate'));
        Session::put('address', $request->input('address'));
        Session::put('hospital_id', $request->input('hospital_id'));
        Session::put('patient', Patient::where('email',Session::get('email'))->orderBy('created_at', 'desc')->first());
        // View
        return redirect()->route('payment');
    }

    public function editInformation(Request $request) {
        // Check data passing
        if (Session::get('isPass') == null) {
            Session::flash('error', 'Data tidak tersimpan pada sistem, silahkan isi data reservasi dari awal!');
            return redirect()->route('register');
        }
        // Validation Input
        $request->validate([
            'headOfFamily'  => 'required',
            'numberOfTest'  => 'required',
            'testDate'      => 'required',
            'address'       => 'required',
            'hospital_id'   => 'required',
        ]);
        // Edit data to database (Patient Table)
        Patient::where('id', Session::get('patient')->id)
            ->update([
                'headOfFamily'  => $request->input('headOfFamily'),
                'numberOfTest'  => $request->input('numberOfTest'),
                'testDate'      => $request->input('testDate'),
                'address'       => $request->input('address'),
                'hospital_id'   => $request->input('hospital_id'),
            ]);
        // Passing Variable
        Session::put('headOfFamily', $request->input('headOfFamily'));
        Session::put('numberOfTest', $request->input('numberOfTest'));
        Session::put('testDate', $request->input('testDate'));
        Session::put('address', $request->input('address'));
        Session::put('hospital_id', $request->input('hospital_id'));
        // View
        return redirect()->route('payment');
    }
}