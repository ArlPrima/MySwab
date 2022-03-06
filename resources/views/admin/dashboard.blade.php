@extends('layout.admin')

@section('title', 'Dashboard ' . Auth::user()->hospital->name . ' - ' . Auth::user()->name)

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('css/stylesadmin.css')}}">
@endsection

@section('content')
    <div class="main-content">
        <header></header>
        <main>
            <h2 class="dash-title">Overview</h2>
            <div class="dash-cards">
                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>Patient Total</h5>
                            <h4>{{count($patient)}}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-id-badge"></span>
                        <div>
                            <h5>Admin Total</h5>
                            <h4>{{count(Auth::user()->hospital->user)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <section class="recent">
                <div class="activity-grid">
                    <div class="content-list" style="display:flex; flex-direction:column; justify-content:center;align-items:flex-start;">
                        @if (Session::has('success'))
                            <div class="notif-success flex-row montserrat" style="margin-bottom: 15px">
                                <img src="{{asset('img/icon/notif-success.svg')}}" alt="success image">
                                <span>{{Session::get('success')}}</span>
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="notif-danger flex-row montserrat" style="margin-bottom: 15px">
                                <img src="{{asset('img/icon/notif-danger.svg')}}" alt="danger image">
                                <span>{{Session::get('error')}}</span>
                            </div>
                        @endif
                        <div class="activity-card">
                            <h3>Recent activity {{count($patient) >= 1 ? '' : '(Belum ada pasien, pada ' . Auth::user()->hospital->name . ')'}}</h3>
                            @if (count($patient) >= 1)
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Customer Name</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Aprroved by</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patient as $data)
                                                <tr>
                                                    <td>{{date('l, d F - H:i', strtotime($data->created_at))}}</td>
                                                    <td>{{Str::limit($data->name, 25, $end='...')}}</td>
                                                    <td>{{Str::limit($data->address, 65, $end='...')}}</td>
                                                    <td>
                                                        @if ($data->payment == null)
                                                            <span class="badge warning">Waiting</span>
                                                        @elseif ($data->result == null)
                                                            <span class="badge warning">Pending</span>
                                                        @elseif ($data->result->status == 'Progres')
                                                            <span class="badge progres" style="color:#333333;">On Progres</span>
                                                        @elseif ($data->result->status == 'Done')
                                                            <span class="badge success">Done</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($data->result == null)
                                                            -
                                                        @else
                                                            {{$data->result->approved->name}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($data->payment == null)
                                                            Menunggu Pembayaran
                                                        @else
                                                            <a href="{{route('editPatient', $data->id)}}" class="Edit">Edit</a>
                                                        @endif
                                                    </td>                                            
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="summary">
                        <div class="summary-card">
                            <div class="summary-single">
                                <span class="ti-id-badge"></span>
                                <div>
                                    @if (count($patient->whereNotNull('result')) >= 1)
                                        <h5>{{$done}}</h5>
                                    @else
                                        <h5>0</h5>
                                    @endif
                                    <small>Number of Done</small>
                                </div>
                            </div>
                            <div class="summary-single">
                                <span class="ti-id-badge"></span>
                                <div>
                                    @if (count($patient->whereNotNull('result')) >= 1)
                                        <h5>{{$progres}}</h5>
                                    @else
                                        <h5>0</h5>
                                    @endif
                                    <small>Number of Progres</small>
                                </div>
                            </div>
                            <div class="summary-single">
                                <span class="ti-id-badge"></span>
                                <div>
                                    <h5>{{count($patient->whereNotNull('payment')->whereNull('result'))}}</h5>
                                    <small>Number of Pending</small>
                                </div>
                            </div>
                            <div class="summary-single">
                                <span class="ti-id-badge"></span>
                                <div>
                                    <h5>{{count($patient->whereNull('payment'))}}</h5>
                                    <small>Number of Waiting Payment</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
@endsection