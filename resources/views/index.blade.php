@extends('layout.default')

@section('title', 'My Swab')

@section('css')
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <!-- smooth scroll  -->
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
@endsection

@section('content')
    <!-- header section starts  -->

    <header>

        <a href="{{route('landing')}}" class="logo">
            <img src="{{asset('img/Logo Myswab.svg')}}" alt="">
        </a>
        <div id="menu" class="fas fa-bars"></div>

        <nav class="navbar">
            <ul>
                <li><a href="#home">home</a></li>
                <li><a href="#protect">protect</a></li>
                <li><a href="#symtoms">symtoms</a></li>
                <li><a href="#prevent">prevent</a></li>
                <li><a href="#handwash">handwash</a></li>
                <li><a href="#spread">spread</a></li>
                <li><a href="{{route('register')}}">reservation</a></li>
                <li><a href="{{route('payment')}}">payment</a></li>
                <li><a href="{{route('login')}}">hospital</a></li>
            </ul>
        </nav>

    </header>

    <!-- header section ends -->

    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="content">

            <span>Covid-19</span>
            <h3>stay safe, stay home</h3>
            <p>MySwab Menyediakan Test COVID-19 Secara Mandiri.
                Dengan MySwab Kesehatan dan Keamanan Anda Lebih Terjaga.
                Segera Reservasi!</p>
            <a href="{{route('register')}}" class="btn">Reservation</a>

        </div>

        <div class="image">
            <img src="{{asset('img/home-img.png')}}" alt="">
        </div>

    </section>

    <!-- home section ends -->

    <section class="protect" id="protect" style="display:flex; flex-direction:column; justify-content:center;">
        <h1 class="heading">Langkah-Langkah <span>Menjaga</span> Diri Anda Dari COVID-19</h1>

        <div class="box-container">

            <div class="box">
                <img src="{{asset('img/protect-1.png')}}" alt="">
                <h3>Memakai Masker</h3>
                <p>Tetap Gunakan Masker Dimanapun Anda Berada!</p>
                <a href="{{route('landing')}}" class="btn">stay safe</a>
            </div>

            <div class="box">
                <img src="{{asset('img/protect-2.png')}}" alt="">
                <h3>Mencuci Tangan</h3>
                <p>Selalu Cuci Tangan Dengan Sabun Dan Air Mengalir Setelah Beraktivitas!</p>
                <a href="{{route('landing')}}" class="btn">stay safe</a>
            </div>

            <div class="box">
                <img src="{{asset('img/protect-3.png')}}" alt="">
                <h3>Menjaga Jarak</h3>
                <p>Jaga Jarak Anda Dengan Orang Sekeliling Anda!</p>
                <a href="{{route('landing')}}" class="btn">stay safe</a>
            </div>

        </div>

    </section>

    <!-- symtoms section starts  -->

    <section class="symtoms" id="symtoms">

        <div class="content">
            <h1 class="heading">Apa Gejala <span>COVID-19?</span></h1>
            <p>Virus corona bisa menimbulkan beragam gejala pada pengidapnya. Gejala yang muncul ini bergantung pada
                jenis virus yang menyerang dan seberapa serius infeksi yang terjadi. Berikut ini beberapa ciri-ciri awal
                corona:</p>
            <ul>
                <div class="one">
                    <li>Demam</li>
                    <li>Sakit Kepala</li>
                    <li>Batuk Kering</li>
                </div>
                <div class="two">
                    <li>Badan Menggigil</li>
                    <li>Flu</li>
                    <li>Sesak Nafas</li>
                </div>
            </ul>
            <a href="{{route('landing')}}" class="btn">stay safe</a>
        </div>

        <div class="image">
            <img src="{{asset('img/symptoms-img.png')}}" alt="">
        </div>

    </section>

    <!-- symtoms section ends -->

    <!-- prevent section starts  -->

    <section class="prevent" id="prevent" style="display:flex; flex-direction:column; justify-content:center;">

        <div class="row">

            <div class="image">
                <img src="{{asset('img/dont-img.png')}}" alt="">
            </div>

            <div class="content">
                <h1 class="heading">Hal-Hal yang <span>Dapat Dihindari</span> Saat COVID</h1>
                <p>Hindarilah Hal-Hal Berikut agar anda terjaga dari virus COVID-19</p>
                <ul>
                    <li>Hindari Berbagi Makanan Dengan Orang Lain</li>
                    <li>Hindari Menyentuh Wajah dan Hidung Anda</li>
                    <li>Hindari Kontak dengan Orang yang sedang sakit</li>
                </ul>
            </div>

        </div>

        <div class="row">

            <div class="content">
                <h1 class="heading">Hal-Hal yang <span>Dapat Dilakukan</span> Saat COVID</h1>
                <p>Lakukan Hal-Hal Berikut agar anda terjaga dari virus COVID-19</p>
                <ul>
                    <li>Cuci Tangan Selama 20 Detik</li>
                    <li>Pakai Masker Jika Keluar Rumah</li>
                    <li>Gunakan Hand-Sanitizer Secara Rutin</li>
                </ul>
            </div>

            <div class="image">
                <img src="{{asset('img/do-img.png')}}" alt="">
            </div>

        </div>

    </section>

    <!-- prevent section ends -->

    <!-- handwash section starts  -->

    <section class="handwash" id="handwash" style="display:flex; flex-direction:column; justify-content:center;">

        <h1 class="heading">Cara <span>Mencuci Tangan</span> Dengan Benar</h1>

        <div class="box-container">

            <div class="box">
                <span>1</span>
                <img src="{{asset('img/hadnwash-1.png')}}" alt="">
                <h3>Gunakan Sabun di Tangan</h3>
            </div>

            <div class="box">
                <span>2</span>
                <img src="{{asset('img/hadnwash-2.png')}}" alt="">
                <h3>Gosok Telapak Tangan</h3>
            </div>

            <div class="box">
                <span>3</span>
                <img src="{{asset('img/hadnwash-3.png')}}" alt="">
                <h3>Gosok Sela-Sela Jari</h3>
            </div>

            <div class="box">
                <span>4</span>
                <img src="{{asset('img/hadnwash-4.png')}}" alt="">
                <h3>Gosok Bagian Belakang Tangan</h3>
            </div>

            <div class="box">
                <span>5</span>
                <img src="{{asset('img/hadnwash-5.png')}}" alt="">
                <h3>Bilas Dengan Air</h3>
            </div>

            <div class="box">
                <span>6</span>
                <img src="{{asset('img/hadnwash-6.png')}}" alt="">
                <h3>Gunakan Handuk Untuk Mengeringkan</h3>
            </div>

        </div>

    </section>

    <!-- handwash section ends -->

    <!-- spread section starts  -->

    <section class="spread" id="spread" style="display:flex; flex-direction:column; justify-content:center;">

        <h1 class="heading">Bagaimana COVID-19 <span>Menyebar</span> Di Seluruh Dunia</h1>

        <div class="image" style="height: max-content;display:flex; flex-direction:column; justify-content:center;">
            <img src="{{asset('img/map.png')}}">
        </div>

    </section>

    <!-- spread section ends -->

    <!-- footer section starts  -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>Tentang Kami</h3>
                <p>MySwab Merupakan Website Untuk Melakukan Test COVID-19 Secara Mandiri. Hubungi Kami Guna Info Lebih
                    Lanjut.</p>
            </div>

            <div class="box">
                <h3>Lokasi</h3>
                <a href="#">surabaya</a>
                <a href="#">Jakarta</a>
                <a href="#">Semarang</a>
                <a href="#">Bandung</a>
                <a href="#">Solo</a>
                <a href="#">Banten</a>
                <a href="#">Sidoarjo</a>
            </div>

            <div class="box">
                <h3>Links</h3>
                <a href="#home">home</a>
                <a href="#protect">protect</a>
                <a href="#symtoms">symtoms</a>
                <a href="#prevent">prevent</a>
                <a href="#handwash">handwash</a>
                <a href="#spread">spread</a>
                <a href="{{route('register')}}">reservation</a>
                <a href="#">hospital</a>
            </div>

            <div class="box">
                <h3>Kontak Informasi</h3>
                <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
                <p> <i class="fas fa-envelope"></i> myswab@gmail.com </p>
                <p> <i class="fas fa-map-marker-alt"></i> Jatim, Tuban - 400104 </p>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>

        </div>

        <h1 class="credit"> created by <a href="#"> arielbintang </a> all rights reserved! </h1>

    </section>

    <!-- footer section ends -->

    <!-- scroll top  -->

    <a href="#home" class="scroll-top">
        <img src="{{asset('img/scroll-img.png')}}" alt="">
    </a>

    <!-- jquery cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- custom js file link  -->
    <script src="{{asset('js/script.js')}}"></script>
@endsection