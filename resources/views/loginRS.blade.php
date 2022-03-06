<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="{{url('css/stylesLRS.css')}}">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <title>Login form RS</title> 
        <style>
            .notif-warning, .notif-danger, .notif-success {
                width: 100%;
                height: max-content;
                text-align: justify;
                box-sizing: border-box;
                border-radius: 4px;
                padding: 10px 12px;
                display: flex;
                flex-direction: row;
                justify-content: normal;
                gap: 10px;
            }
            .notif-warning {
                background-color: rgba(249, 220, 92, 0.15);
                border: 1px solid rgba(249, 220, 92, 1);
            }

            .notif-danger {
                background-color: rgba(224, 87, 128, 0.15);
                border: 1px solid rgba(224, 87, 128, 1);
            }

            .notif-success {
                background-color: rgba(82, 183, 136, 0.15);
                border: 1px solid rgba(82, 183, 136, 1);
            }
        </style> 
    </head>
    <body>
        <div class="l-form">
            <div class="shape1"></div>
            <div class="shape2"></div>

            <div class="form">
                <img src="{{url('img/LoginRS.svg')}}" alt="" class="form__img">

                <form method="POST" action="{{ route('login') }}" class="form__content">
                    @csrf
                    <h1 class="form__title">Login as Hospital</h1>
                    @if ($errors->any())
                        <div class="notif-warning flex-row montserrat">
                            <img src="{{asset('img/icon/notif-warning.svg')}}" alt="warning image">
                            @if ($errors->has('username','password','email'))    
                                <span>Silahkan isi ID, Email dan Password terlebih dahulu!</span>
                            @elseif ($errors->has('username','password'))    
                                <span>Silahkan isi ID dan Password terlebih dahulu!</span>
                            @elseif ($errors->has('email','password'))    
                                <span>Silahkan isi Email dan Password terlebih dahulu!</span>
                            @elseif ($errors->has('username','email'))    
                                <span>Silahkan isi ID dan Email terlebih dahulu!</span>
                            @else
                                @foreach ($errors->all() as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="notif-danger flex-row montserrat">
                            <img src="{{asset('img/icon/notif-danger.svg')}}" alt="danger image">
                            <span>{{Session::get('error')}}</span>
                        </div>
                    @endif
                    <div class="form__div {{old('username') != null ? 'focus' : ''}}">
                        <div class="form__icon">
                            <i class='bx bx-user-circle'></i>
                        </div>

                        <div class="form__div-input">
                            <label for="" class="form__label">ID Rumah Sakit</label>
                            <input type="text" class="form__input" name="username" value="{{old('username')}}">
                        </div>
                    </div>

                    <div class="form__div {{old('email') != null ? 'focus' : ''}}">
                        <div class="form__icon">
                            <i class='bx bx-envelope'></i>
                        </div>

                        <div class="form__div-input">
                            <label for="" class="form__label">Email</label>
                            <input type="text" class="form__input" name="email" value="{{old('email')}}">
                        </div>
                    </div>

                    <div class="form__div">
                        <div class="form__icon">
                            <i class='bx bx-lock'></i>
                        </div>

                        <div class="form__div-input">
                            <label for="" class="form__label">Password</label>
                            <input type="password" class="form__input" name="password">
                        </div>
                    </div>

                    <input type="submit" class="form__button" value="Login">

                    <div class="form__social">
                        <span class="form__social-text">Our login with</span>

                        <a href="#" class="form__social-icon"><i class='bx bxl-facebook' ></i></a>
                        <a href="#" class="form__social-icon"><i class='bx bxl-google' ></i></a>
                        <a href="#" class="form__social-icon"><i class='bx bxl-instagram' ></i></a>
                    </div>
                </form>
            </div>

        </div>
        
        <!-- ===== MAIN JS ===== -->
        <script src="{{url('js/main2.js')}}"></script>
    </body>
</html>