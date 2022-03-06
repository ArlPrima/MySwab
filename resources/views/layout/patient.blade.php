<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- style script --}}
    <style>
        html::-webkit-scrollbar {
            width: 16px;
        }

        html::-webkit-scrollbar-track {
            background: #000;
        }

        html::-webkit-scrollbar-thumb {
            background: #A4161A;
            border-radius: 5px;
        }
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
    @yield('css')
</head>
<body>
    <!--========== HEADER ==========-->
    <header class="l-header" id="header">
        <nav class="nav bd-container">

            <a href="{{route('landing')}}" class="nav__logo">
                <img src="{{asset('img/Logo Myswab.svg')}}" alt="">
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="{{route('register')}}" class="nav__link">Your Account</a></li>
                    <li class="nav__item"><a href="{{route('generalInformation')}}" class="nav__link">General Information</a></li>
                    <li class="nav__item"><a href="{{route('payment')}}" class="nav__link">Payment</a></li>
                </ul>
            </div>
        </nav>
    </header>
    
    <!--===== General Information =====-->
    <div class="form" style="display:flex; flex-direction:row; justify-content:center;align-items:center;gap:100px;">
        @yield('content')
    </div>
    
    <!--========== FOOTER ==========-->
    <footer class="footer section">
        <div class="footer__container bd-container bd-grid">
            <div class="footer__content">
                <img src="{{asset('img/Logo Myswab P.svg')}}" alt="" />
            </div>
    
            <div class="footer__content">
                <h3 class="footer__title">Social</h3>
                <a href="https://www.facebook.com" class="footer__social"><i class='bx bxl-facebook-circle '></i></a>
                <a href="https://www.instagram.com" class="footer__social"><i class='bx bxl-twitter'></i></a>
                <a href="https://twitter.com" class="footer__social"><i class='bx bxl-instagram-alt'></i></a>
            </div>
        </div>
    
        <p class="footer__copy" style="padding-bottom: 10px">&#169; @Copyright2021 Design by ArielBintang</p>
    </footer>
    
    <!-- ===== MAIN JS ===== -->
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>