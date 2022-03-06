<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Patient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard() {
        // Get data from database
        $patient = Patient::where('hospital_id', Auth::user()->hospital->id)->orderBy('created_at','desc')->get();
        $done = 0;
        $progres = 0;
        foreach ($patient->whereNotNull('result') as $data) {
            if ($data->result->status == 'Done') {
                $done += 1;
            } else if ($data->result->status == 'Progres') {
                $progres += 1;
            }
        }
        // Return view
        return view('admin.dashboard', compact('patient', 'done', 'progres'));
    }

    public function edit($id) {
        // Validation $id
        if (Patient::where('id', $id)->doesntExist()) {
            Session::flash('error', 'Pasient tidak terdaftar pada sistem, silahkan pilih pasien lain!');
            return redirect()->route('dashboard');
        } else if (Patient::where('id', $id)->first()->hospital_id != Auth::user()->hospital->id) {
            Session::flash('error', 'Pasient tidak berasal dari rumah sakit ini, silahkan pilih pasien lain!');
            return redirect()->route('dashboard');
        } else if (Patient::where('id', $id)->first()->payment == null) {
            Session::flash('error', 'Pasient belum melakukan pembayaran, silahkan pilih pasien lain!');
            return redirect()->route('dashboard');
        }
        // Get data from database
        $patient = Patient::where('id', $id)->first();
        // Return View
        return view('admin.edit', compact('patient'));
    }

    public function store($id, Request $request) {
        // Validation $id
        if (Patient::where('id', $id)->doesntExist()) {
            Session::flash('error', 'Pasient tidak terdaftar pada sistem, silahkan pilih pasien lain!');
            return redirect()->route('dashboard');
        } else if (Patient::where('id', $id)->first()->hospital_id != Auth::user()->hospital->id) {
            Session::flash('error', 'Pasient tidak berasal dari rumah sakit ini, silahkan pilih pasien lain!');
            return redirect()->route('dashboard');
        } else if (Patient::where('id', $id)->first()->payment == null) {
            Session::flash('error', 'Pasient belum melakukan pembayaran, silahkan pilih pasien lain!');
            return redirect()->route('dashboard');
        }
        // Validation input
        $request->validate(['password' => 'required']);
        // Check Password
        if (Hash::check($request->input('password'), Auth::user()->password)) {
            // Check submit state
            if ($request->input('submit') == 'Progres') {
                // Store data to database (Result table)
                Result::create([
                    'patient_id'    => $id,
                    'approvedBy'    => Auth::user()->id,
                    'status'        => $request->input('submit'),
                ]);
            } else {
                // Validate file upload
                $request->validate(['detail' => 'required|mimes:jpg,png,jpeg,pdf|max:5000']);
                // File proccessing
                if ($request->detail != null) {
                    $fileName = time() . '-' . Patient::where('id', $id)->first()->name . '-result' . '.' . $request->detail->extension();
                    $fileName = Str::of($fileName)->replace(' ', '');
                    $request->detail->move(public_path('result'), $fileName);
                }
                // Store data to database (Result table)
                Result::create([
                    'patient_id'    => $id,
                    'approvedBy'    => Auth::user()->id,
                    'status'        => $request->input('submit'),
                    'detail'        => $fileName,
                ]);
            }
            // Return view
            Session::flash('success', 'Pasient "' . Patient::where('id', $id)->first()->name . '" berhasil diedit!');
            return redirect()->route('dashboard');
        } else {
            Session::flash('error', 'Password tidak sesuai, silahkan isi kembali dengan teliti!');
            return redirect()->route('editPatient', $id);
        }
    }

    public function update($id, Request $request) {
        // Validation $id
        if (Patient::where('id', $id)->doesntExist()) {
            Session::flash('error', 'Pasient tidak terdaftar pada sistem, silahkan pilih pasien lain!');
            return redirect()->route('dashboard');
        } else if (Patient::where('id', $id)->first()->hospital_id != Auth::user()->hospital->id) {
            Session::flash('error', 'Pasient tidak berasal dari rumah sakit ini, silahkan pilih pasien lain!');
            return redirect()->route('dashboard');
        } else if (Patient::where('id', $id)->first()->payment == null) {
            Session::flash('error', 'Pasient belum melakukan pembayaran, silahkan pilih pasien lain!');
            return redirect()->route('dashboard');
        }
        // Validation input
        $request->validate(['password' => 'required']);
        // Check Password
        if (Hash::check($request->input('password'), Auth::user()->password)) {
            // Check submit state
            if ($request->input('submit') == 'Progres') {
                // Update data to database (Result table)
                Result::where('patient_id', $id)
                    ->update([
                        'approvedBy'    => Auth::user()->id,
                        'status'        => $request->input('submit'),
                    ]);
            } else {
                // Validate file upload
                $request->validate(['detail' => 'required|mimes:jpg,png,jpeg,pdf|max:5000']);
                // File proccessing
                $file = Result::where('patient_id', $id)->first()->detail;
                if ($request->detail != null) {
                    if ($file != null) {
                        File::delete(public_path('result/' . $file));
                    }
                    $fileName = time() . '-' . Patient::where('id', $id)->first()->name . '-result' . '.' . $request->detail->extension();
                    $fileName = Str::of($fileName)->replace(' ', '');
                    $request->detail->move(public_path('result'), $fileName);
                }
                // Update data to database (Result table)
                Result::where('patient_id', $id)
                    ->update([
                        'approvedBy'    => Auth::user()->id,
                        'status'        => $request->input('submit'),
                        'detail'        => $fileName,
                    ]);
            }
            // Return view
            Session::flash('success', 'Pasient "' . Patient::where('id', $id)->first()->name . '" berhasil diedit!');
            return redirect()->route('dashboard');
        } else {
            Session::flash('error', 'Password tidak sesuai, silahkan isi kembali dengan teliti!');
            return redirect()->route('editPatient', $id);
        }
    }

    public function downloadProof(Patient $patient) {
        // Check payment
        if ($patient->payment != null) {
            // Download
            return response()->download(public_path('proof/' . $patient->payment->proof));
        } else {
            Session::flash('error', 'Pasien belum melakukan pembayaran, silahkan coba lagi lain waktu!');
            return redirect()->route('editPatient', $patient->id);
        }
    }

    public function downloadResult($id) {
        // Check result
        if (Result::where('patient_id', $id)->exists()) {
            if (Result::where('patient_id', $id)->first()->detail != null) {
                // Download
                return response()->download(public_path('result/' . Result::where('patient_id', $id)->first()->detail));
            } else {
                Session::flash('error', 'Pasien tidak memiliki hasil tes, silahkan coba lagi lain waktu!');
                return redirect()->route('editPatient', $id);
            }
        } else {
            Session::flash('error', 'Pasien tidak memiliki hasil tes, silahkan coba lagi lain waktu!');
            return redirect()->route('editPatient', $id);
        }
    }
}