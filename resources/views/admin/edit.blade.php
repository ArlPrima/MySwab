@extends('layout.admin')

@section('title', 'Detail Patient ' . $patient->name . ' - ' . $patient->hospital->name)

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('css/stylesadmin.css')}}">
    <style>
        .flex-column {
            display: flex;
            flex-direction: column;
            justify-content: normal;
        }
        .flex-row {
            display: flex;
            flex-direction: row;
            justify-content: normal;
        }
        .form-list {
            gap: 20px;
        }
        .form-group {
            width: 100%;
            gap: 20px;
            flex-wrap: wrap;
        }
        .form-group .formel label {
            width: 175px;
            white-space: nowrap;
        }
        .formel {
            width: 100%;
            gap: 20px;
        }
        .formel label {
            width: 175px;
        }
        .formel input, .formel textarea {
            width: 100%;
            padding: 6px 12px;
            border-radius: 2px;
            border: 1px solid rgba(0, 0, 0, 0.25);
            box-sizing: border-box;
        }
        .submit-form {
            width: 100%;
            gap: 15px;
        }
        .submit-form .list-button {
            gap: 25px;
            justify-content: space-between
        }
        .list-button button {
            width: 100%;
            height: 55px;
            border-radius: 5px;
            border: 1px solid rgba(0, 0, 0, 0.25);
            color: #fefefe;
            font-weight: 500;
            cursor: pointer;
            transition: 0.35s
        }
        .list-button button:hover {
            box-shadow: 0px 5px 15px #21212145;
        }
        #done-button {
            background-color: rgba(50, 167, 83, 1);
        }
        #progress-button {
            background: rgba(249, 187, 0, 1);
        }
        .additional-form {
            width: 100%;
            gap: 5px;
        }
        .additional-form .additional-input {
            align-items: center;
            width: 100%;
            gap: 10px;
        }
        .additional-form .additional-input label {
            width: max-content;
        }
        .additional-form .additional-input input {
            width: 225px;
        }
        .input-list {
            width: 100%;
            gap: 20px;
        }
        .input-group {
            gap: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="main-content">
        <header></header>
        <main>
            <h2 class="dash-title">Detail Customer</h2>
            <form method="POST" class="form-list flex-column" enctype="multipart/form-data">
                @if ($errors->any())
                    <div class="notif-warning flex-row montserrat">
                        <img src="{{asset('img/icon/notif-warning.svg')}}" alt="warning image">
                        @if ($errors->has('password'))
                            @error('password')
                                <span>{{$message}}</span>
                            @enderror
                        @elseif ($errors->has('detail'))
                            @error('detail')
                                <span>{{$message}}</span>
                            @enderror
                        @endif
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="notif-danger flex-row montserrat" style="margin-bottom: 15px">
                        <img src="{{asset('img/icon/notif-danger.svg')}}" alt="danger image">
                        <span>{{Session::get('error')}}</span>
                    </div>
                @endif
                @csrf
                @if ($patient->result != null)
                    @method('patch')
                @endif
                <!-- Modal -->
                <div class="modal fade" id="doneModal" tabindex="-1" aria-labelledby="doneModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="doneModalLabel">Upload Hasil Test</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if ($patient->result != null)
                                    @if ($patient->result->detail != null)
                                        <p>File lama: <a href="{{route('downloadResult', $patient->id)}}" style="margin-left: 5px">{{$patient->result->detail}}</a></p>                                
                                    @endif
                                @endif
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">File Upload:</label>
                                    <input class="form-control" type="file" id="formFile" name="detail">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button id="done-button" type="submit" class="btn btn-primary" name="submit" value="Done" style="border-color:  rgba(50, 167, 83, 1)">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-row formel">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{$patient->name}}" readonly>
                </div>
                <div class="flex-row formel">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{$patient->email}}" readonly>
                </div>
                <div class="flex-row formel">
                    <label for="phone">Nomor HP</label>
                    <input type="text" name="phone" id="phone" value="{{$patient->phoneNumber}}" readonly>
                </div>
                <div class="flex-row formel">
                    <label for="phone">Bukti Pembayaran</label>
                    <a href="{{route('downloadProof', $patient->id)}}" style="text-align: left;width:100%;">{{$patient->payment->proof}}</a>
                </div>
                <div class="flex-row form-group">
                    <div class="flex-row formel">
                        <label for="category">Jenis Tes</label>
                        <input type="text" name="category" id="category" value="Swab-Antigen" readonly>
                    </div>
                    <div class="flex-row formel">
                        <label for="qty">Jumlah Tes</label>
                        <input type="text" name="qty" id="qty" value="{{$patient->numberOfTest}}" readonly>
                    </div>
                    <div class="flex-row formel">
                        <label for="date">Tanggal Tes</label>
                        <input type="text" name="date" id="date" value="{{date('l, d F Y', strtotime($patient->testDate))}}" readonly>
                    </div>
                </div>
                <div class="flex-row formel">
                    <label for="address">Alamat Tes</label>
                    <textarea name="address" id="address" cols="30" rows="5" readonly>{{$patient->address}}</textarea>
                </div>
                {{-- <div class="flex-row formel">
                    <label for="">Rincian Tes</label>
                    <div class="flex-column input-list">
                        <div class="flex-row input-group">
                            <input type="text" name="idPerson1" id="idPerson1" placeholder="Number ID Person 1">
                            <input type="text" name="namePerson1" id="namePerson1" placeholder=" Full Name Person 1">
                        </div>
                        <div class="flex-row input-group">
                            <input type="text" name="idPerson2" id="idPerson2" placeholder="Number ID Person 2">
                            <input type="text" name="namePerson2" id="namePerson2" placeholder=" Full Name Person 2">
                        </div>
                        <div class="flex-row input-group">
                            <input type="text" name="idPerson3" id="idPerson3" placeholder="Number ID Person 3">
                            <input type="text" name="namePerson3" id="namePerson3" placeholder=" Full Name Person 3">
                        </div>
                        <div class="flex-row input-group">
                            <input type="text" name="idPerson4" id="idPerson4" placeholder="Number ID Person 4">
                            <input type="text" name="namePerson4" id="namePerson4" placeholder=" Full Name Person 4">
                        </div>
                    </div>
                </div> --}}
                <div class="flex-row formel">
                    <label for="">Status</label>
                    <div class="flex-column submit-form">
                        <div class="flex-row list-button">
                            <button id="done-button" type="button" data-bs-toggle="modal" data-bs-target="#doneModal">Done</button>
                            <button id="progress-button" type="submit" name="submit" value="Progres">On Progress</button>
                        </div>
                        <div class="flex-column additional-form">
                            <span>*To change Status You Must Rewrite Your Account Password below</span>
                            <div class="flex-row additional-input">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
@endsection
