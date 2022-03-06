@extends('layout.patient')

@section('title', 'General Information - '.$name)

@section('css')
    <!-- font awesome cdn link  -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{url('css/stylesGI.css')}}">
    <!-- smooth scroll  -->
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
@endsection

@section('content')
    <img src="{{url('img/2.svg')}}" alt="" class="form__img">

    <form name="myform2" method="POST" class="form__content">
        @csrf
        @if ($isRegister != null)
            @method('patch')
        @endif
        <h1 class="form__title">Detail Swab</h1>
        <h2 class="form__title2">Please fill the data below carefully</h2>
        @if ($errors->any())
            <div class="notif-warning flex-row montserrat" style="margin-top: -10px; margin-bottom: 15px">
                <img src="{{asset('img/icon/notif-warning.svg')}}" alt="warning image">
                @if ($errors->has('headOfFamily','numberOfTest','testDate', 'address', 'hospital_id'))    
                    <span>Silahkan isi semua data yang diperlukan terlebih dahulu!</span>
                @elseif ($errors->has('headOfFamily'))
                    @error('headOfFamily')
                        <span>{{$message}}</span>
                    @enderror
                @elseif ($errors->has('numberOfTest'))
                    @error('numberOfTest')
                        <span>{{$message}}</span>
                    @enderror
                @elseif ($errors->has('testDate'))
                    @error('testDate')
                        <span>{{$message}}</span>
                    @enderror
                @elseif ($errors->has('address'))
                    @error('address')
                        <span>{{$message}}</span>
                    @enderror
                @elseif ($errors->has('hospital_id'))
                    @error('hospital_id')
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
        <div class="form__div {{(old('headOfFamily') != null or $headOfFamily != null) ? 'focus' : ''}}">
            <div class="form__icon">
                <i class='bx bx-user-circle'></i>
            </div>
            <div class="form__div-input">
                <label for="" class="form__label">Kepala Keluarga</label>
                <input type="text" class="form__input" name="headOfFamily" value="{{old('headOfFamily') != null ? old('headOfFamily') : $headOfFamily}}">
            </div>
        </div>

        <div class="form__div {{(old('numberOfTest') != null or $numberOfTest != null) ? 'focus' : ''}}">
            <div class="form__icon">
                <i class='bx bx-user-plus'></i>
            </div>
            <div class="form__div-input">
                <label for="" class="form__label">Jumlah Tes</label>
                <input type="text" class="form__input" name="numberOfTest" value="{{old('numberOfTest') != null ? old('numberOfTest') : $numberOfTest}}">
            </div>
        </div>

        <div class="form__div {{(old('testDate') != null or $testDate != null) ? 'focus' : ''}}">
            <div class="form__icon">
                <i class='bx bx-calendar'></i>
            </div>
            <div class="form__div-input">
                <label for="" class="form__label">Tanggal Tes</label>
                @if (old('testDate') == null and $testDate == null)
                    <input type="text" onfocus="(this.type='date')" class="form__input" name="testDate" id="testDate">
                @else
                    <input type="date" class="form__input" name="testDate" id="testDate" value="{{old('testDate') != null ? old('testDate') : $testDate}}">
                @endif
            </div>
        </div>

        <div class="form__div {{(old('address') != null or $address != null) ? 'focus' : ''}}">
            <div class="form__icon">
                <i class='bx bx-been-here'></i>
            </div>
            <div class="form__div-input">
                <label for="" class="form__label">Alamat Tes</label>
                <input type="text" class="form__input" name="address" value="{{old('address') != null ? old('address') : $address}}">
            </div>
        </div>

        <div class="form__div {{(old('hospital_id') != null or $hospital_id != null) ? 'focus' : ''}}">
            <div class="form__icon">
                <i class='bx bx-building-house'></i>
            </div>
            <div class="form__div-input">
                <label for="hospital_id" class="form__label"></label>
                <select name="hospital_id" style="width: 280px;margin-left:20px;height:30px;">
                    @if (count($hospital) >= 1)
                        <option disabled {{(old('hospital_id') == null and $hospital_id == null) ? 'selected' : ''}}>Pilih Rumah Sakit</option>
                        @if (old('hospital_id') != null)
                            @foreach ($hospital as $data)
                                <option value="{{$data->id}}" {{(old('hospital_id') == $data->id ? 'selected' : '')}}>{{$data->name}}</option>
                            @endforeach
                        @else
                            @foreach ($hospital as $data)
                                <option value="{{$data->id}}" {{($hospital_id == $data->id ? 'selected' : '')}}>{{$data->name}}</option>
                            @endforeach
                        @endif
                    @else
                        <option disabled selected>Tidak Rumah Sakit yang Tersedia</option>
                    @endif
                </select>
            </div>
        </div>
        <input type="submit" onclick="(document.getElementById('testDate').type='date')" class="form__button" value="{{$isRegister == null ? 'Next' : 'Edit'}}">
    </form>
@endsection