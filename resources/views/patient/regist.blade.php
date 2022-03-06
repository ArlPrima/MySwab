@extends('layout.patient')

@section('title', ($isPass == null ? 'Registration' : 'Registration - '.$name))

@section('css')
    <!-- font awesome cdn link  -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('css/stylesYA.css')}}">
    <!-- smooth scroll  -->
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
@endsection

@section('content')    
    <img src="{{asset('img/1.svg')}}" alt="" class="form__img">

    <form method="POST" class="form__content">
        @csrf
        <h1 class="form__title">Registration</h1>
        <h2 class="form__title2">Please fill the data below carefully</h2>
        @if ($errors->any())
            <div class="notif-warning flex-row montserrat" style="margin-top: -10px; margin-bottom: 15px">
                <img src="{{asset('img/icon/notif-warning.svg')}}" alt="warning image">
                @if ($errors->has('name','phoneNumber','email'))    
                    <span>Silahkan isi Nama Lengkap, Alamat Email dan No HP terlebih dahulu!</span>
                @elseif ($errors->has('name'))
                    @error('name')
                        <span>{{$message}}</span>
                    @enderror
                @elseif ($errors->has('email'))
                    @error('email')
                        <span>{{$message}}</span>
                    @enderror
                @elseif ($errors->has('phoneNumber'))
                    @error('phoneNumber')
                        <span>{{$message}}</span>
                    @enderror
                @endif
            </div>
        @endif
        @if (Session::has('error'))
            <div class="notif-danger flex-row montserrat" style="margin-top: -10px; margin-bottom: 15px">
                <img src="{{asset('img/icon/notif-danger.svg')}}" alt="danger image">
                <span>{{Session::get('error')}}</span>
            </div>
        @endif
        <div class="form__div {{(old('name') != null or $name != null) ? 'focus' : ''}}">
            <div class="form__icon">
                <i class='bx bx-user'></i>
            </div>

            <div class="form__div-input">
                <label for="" class="form__label">Nama Lengkap</label>
                <input type="text" class="form__input" name="name" value="{{old('name') != null ? old('name') : $name}}">
            </div>
        </div>

        <div class="form__div {{(old('email') != null or $email != null) ? 'focus' : ''}}">
            <div class="form__icon">
                <i class='bx bx-envelope'></i>
            </div>

            <div class="form__div-input">
                <label for="" class="form__label">Email</label>
                <input type="text" class="form__input" name="email" value="{{old('email') != null ? old('email') : $email}}">
            </div>
        </div>

        <div class="form__div {{(old('phoneNumber') != null or $phoneNumber != null) ? 'focus' : ''}}">
            <div class="form__icon">
                <i class='bx bx-phone-call'></i>
            </div>

            <div class="form__div-input">
                <label for="" class="form__label">No Telepon</label>
                <input type="text" class="form__input" name="phoneNumber" value="{{old('phoneNumber') != null ? old('phoneNumber') : $phoneNumber}}">
            </div>
        </div>

        <button type="submit" class="form__button">{{$isPass == null ? 'Next' : 'Edit'}}</button>

    </form>
@endsection