@extends('layout.patient')

@section('title', 'Payment')

@section('css')
    <!-- font awesome cdn link  -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{url('css/stylesGI.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- smooth scroll  -->
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
@endsection

@section('content')
    <img src="{{url('img/3.svg')}}" alt="" class="form__img" style="height:485px">
    @if (Request::is('payment'))
        <form method="POST" class="form__content" style="width:480px;">
            @csrf
            <h1 class="form__title">Check Payment</h1>
            @if ($errors->any())
                <div class="notif-warning flex-row montserrat" style="margin-top: 10px; margin-bottom: 15px">
                    <img src="{{asset('img/icon/notif-warning.svg')}}" alt="warning image">
                    @if ($errors->has('email'))
                        @error('email')
                            <span>{{$message}}</span>
                        @enderror
                    @endif
                </div>
            @endif
            @if (Session::has('warning'))
                <div class="notif-warning flex-row montserrat" style="margin-top: 10px; margin-bottom: 15px">
                    <img src="{{asset('img/icon/notif-warning.svg')}}" alt="warning image">
                    <span>{{Session::get('warning')}}</span>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="notif-success flex-row montserrat" style="margin-top: 10px; margin-bottom: 15px">
                    <img src="{{asset('img/icon/notif-success.svg')}}" alt="success image">
                    <span>{{Session::get('success')}}</span>
                </div>
            @endif
            <div class="form__div">
                <div class="form__icon">
                    <i class='bx bx-user-circle'></i>
                </div>
                <div class="form__div-input">
                    <label for="" class="form__label">Email Reservasi</label>
                    <input type="text" class="form__input" name="email">
                </div>
            </div>
            <input type="submit" onclick="(document.getElementById('testDate').type='date')" class="form__button" value="Check">
        </form>
    @else
        <div class="form-notif" style="display:flex; flex-direction:column; justify-content:center;align-items:flex-start;width:550px;">
            @if ($errors->any())
                <div class="notif-warning flex-row montserrat" style="margin-top: -10px; margin-bottom: 15px">
                    <img src="{{asset('img/icon/notif-warning.svg')}}" alt="warning image">
                    @if ($errors->has('proof'))
                        @error('proof')
                            <span>{{$message}}</span>
                        @enderror
                    @endif
                </div>
            @endif
            @if (Session::has('success'))
                <div class="notif-success flex-row montserrat" style="margin-top: -10px; margin-bottom: 15px">
                    <img src="{{asset('img/icon/notif-success.svg')}}" alt="success image">
                    <span>{{Session::get('success')}}</span>
                </div>
            @endif
            <form method="POST" class="form__content" enctype="multipart/form-data" style="display:flex; flex-direction:column; justify-content:center;align-items:flex-start;box-sizing: border-box;padding:30px;border:1px solid rgba(0,0,0,0.3);width:100%;border-radius:5px;">
                @csrf
                <h1 class="form__title">Check Payment</h1>
                <div class="alt-text" style="display:flex; flex-direction:row; justify-content:center;align-items:center;gap:5px;">
                    <img src="{{asset('img/icon/time.svg')}}" alt="">
                    <span style="font-family: Montserrat;font-style: normal;font-weight: normal;font-size: 16px;line-height: 32px;letter-spacing: 0.02em;color: #333333;">Express Result, Keluarga {{$patient->headOfFamily}}</span>
                </div>
                <div class="alt-text" style="display:flex; flex-direction:column; justify-content:center;align-items:flex-start;margin-top:15px;">
                    <span style="font-family: Montserrat;font-style: normal;font-weight: 500;font-size: 20px;line-height: 32px;letter-spacing: 0.02em;color: #333333;">Swab-Antigen Test</span>
                    <span style="font-family: Montserrat;font-style: normal;font-weight: 500;font-size: 16px;line-height: 32px;letter-spacing: 0.02em;">{{$patient->numberOfTest}} x IDR 500.000</span>
                </div>
                <div class="alt-text" style="display:flex; flex-direction:row; justify-content:center;align-items:flex-end;margin-top:15px;">
                    <span style="font-family: Montserrat;font-style: normal;font-weight: 500;font-size: 24px;letter-spacing: 0.03em;color: #333333;width:200px;margin:0;">Subtotal</span>
                    <span style="font-family: Montserrat;font-style: normal;font-weight: 600;font-size: 24px;letter-spacing: 0.03em;color: #333333;margin:0;">Rp {{number_format($patient->numberOfTest*500000,0,',','.')}}</span>
                </div>
                <div class="alt-text" style="display:flex; flex-direction:row; justify-content:center;align-items:flex-end;">
                    <span style="font-family: Montserrat;font-style: normal;font-weight: 500;font-size: 24px;letter-spacing: 0.03em;color: #333333;width:200px;margin:0;">Service Cost</span>
                    <span style="font-family: Montserrat;font-style: normal;font-weight: 600;font-size: 24px;letter-spacing: 0.03em;color: #333333;margin:0;">Rp 250.000</span>
                </div>
                <div class="alt-text" style="display:flex; flex-direction:row; justify-content:flex-start;align-items:center;box-sizing: border-box;padding:15px 0; border-top:0.5px solid #999999;border-bottom:0.5px solid #999999;width:100%;margin:15px 0;">
                    <span style="font-family: Montserrat;font-style: normal;font-weight: 500;font-size: 24px;letter-spacing: 0.03em;color: #333333;width:200px;margin:0;">Grand Total</span>
                    <span style="font-family: Montserrat;font-style: normal;font-weight: 500;font-size: 36px;color: #333333;">Rp {{number_format(($patient->numberOfTest*500000)+250000,0,',','.')}}</span>
                </div>
                <div class="alt-text" style="display:flex; flex-direction:row; justify-content:center;align-items:flex-start;gap:15px;">
                    <span style="font-family: Montserrat;font-style: normal;font-weight: 500;font-size: 20px;letter-spacing: 0.02em;color: #333333;width:265px;margin:0;">Test Address</span>
                    <span style="font-family: Montserrat;font-style: normal;font-weight: normal;font-size: 16px;letter-spacing: 0.02em;color: #333333;text-align: justify;">{{$patient->address}}</span>
                </div>
                <div class="alt-text" style="display:flex; flex-direction:column; justify-content:center;align-items:flex-start;margin-top:5px;width:100%;">
                    <span style="font-family: Montserrat;font-style: normal;font-weight: 600;font-size: 20px;letter-spacing: 0.02em;color: #333333;width:200px;margin:0;">Proof of Payments</span>
                    <input class="form-control" type="file" name="proof" id="proof" style="width:100%">
                </div>
                <div class="group-button" style="display:flex; flex-direction:row; justify-content:center;align-items:flex-end;gap:25px;width:100%;">
                    <input type="button" onclick="location.href = '{{url()->previous()}}'" class="form__button" value="Back" style="margin-bottom: -10px; margin-top:15px;background-color:#d8d8d8;color:#333333;">
                    <input type="submit" class="form__button" value="Pay" style="margin-bottom: -10px; margin-top:15px;">
                </div>
            </form>
        </div>
    @endif
@endsection