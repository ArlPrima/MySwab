<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function formCheck() {
        // Validate Session
        if (Session::get('isRegister') != null) {
            $id = Session::get('patient')->id;
            // Validation $id
            if ($id == null) {
                Session::flush();
                Session::flash('error', 'Data tidak tersimpan pada sistem, silahkan isi data reservasi dari awal!');
                return redirect()->route('register');
            }
            Session::flash('success', 'Reservasi berhasil, silahkan lakukan pembayaran!');
            return redirect()->route('paymentForm', $id);
        }
        // View form
        return view('patient.payment');
    }

    public function check(Request $request) {
        // Validate
        $request->validate(['email' => 'required|exists:patients,email']);
        // Get id patient
        $id = Patient::where('email', $request->input('email'))->orderBy('created_at','desc')->first()->id;
        // Validation already pay
        if (Payment::where('patient_id', $id)->exists()) {
            Session::flash('success', 'Pembayaran telah selesai dilakukan!');
            return redirect()->route('payment');
        }
        // return view
        return redirect()->route('paymentForm', $id);
    }

    public function form($id) {
        // Validation ID
        if (Patient::where('id', $id)->doesntExist()) {
            Session::flash('warning', 'Anda tidak terdaftar pada reservasi, silahkan reservasi terlebih dahulu!');
            return redirect()->route('payment');
        } else if(Payment::where('patient_id', $id)->exists()) {
            Session::flash('success', 'Pembayaran telah selesai dilakukan!');
            return redirect()->route('payment');
        }
        $patient = Patient::where('id', $id)->first();
        // View
        return view('patient.payment', compact('patient'));
    }

    public function store($id, Request $request) {
        // Validation ID
        if (Patient::where('id', $id)->doesntExist()) {
            Session::flash('warning', 'Anda tidak terdaftar pada reservasi, silahkan reservasi terlebih dahulu!');
            return redirect()->route('payment');
        } else if(Payment::where('patient_id', $id)->exists()) {
            Session::flash('success', 'Pembayaran telah selesai dilakukan!');
            return redirect()->route('payment');
        }
        // Get data from database
        $patient = Patient::where('id', $id)->first();
        // Validation input
        $request->validate(['proof' => 'required|mimes:jpg,png,jpeg,pdf|max:5000']);
        // File proccessing
        if ($request->proof != null) {
            $fileName = time() . '-' . $patient->name . '.' . $request->proof->extension();
            $fileName = Str::of($fileName)->replace(' ', '');
            $request->proof->move(public_path('proof'), $fileName);
        }
        // Store data to database (Payments table)
        Payment::create([
            'patient_id'=> $id,
            'proof'     => $fileName,
            'cost'      => ($patient->numberOfTest * 500000) + 250000,
        ]);
        // Return view
        Session::flush();
        Session::flash('success', 'Pembayaran berhasil dilakukan, silahkan menunggu informasi lebih lanjut di email anda (' . $patient->email . ')');
        return redirect()->route('payment');
    }
}