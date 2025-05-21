<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <title>dashboard</title> -->
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/luck.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
    <!-- animate CSS -->
    <link rel="stylesheet" href={{ asset('css/animate.css') }}>
    <!-- style CSS -->
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <style>
        body {
            background-color: #e3f6ff; 
        }
    </style>
    @stack('styles')
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ route('dashboard') }}"> 
                            <img src="{{ asset('images/luck.png') }}" style="width: 35px; margin-right: 15px;"> Kostiva
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('checkout') }}">Contact</a>
                                </li>
                                <?php
                                    $user = Auth::user();
                                    if($user){
                                        echo'
                                            <li class="nav-item">
                                                <a class="nav-link" href="'. route('booking') .'">Tagihan</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="'. route('logout') .'">Logout</a>
                                            </li>
                                        ';
                                        
                                    }else{
                                        echo'
                                            <li class="nav-item">
                                                <a class="nav-link" href="'. route('booking') .'">Booking</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="'. route('login') .'">Login</a>
                                            </li>
                                        ';
                                    }

                                ?>
                            </ul>
                        </div>
                        <div class="d-flex">
                            <div class="nav-item">
                            <?php
                                $user = Auth::user();
                                if($user){
                                    echo'
                                        <a class="nav-link" href="'. route('logout') .'">LOGOUT</a>
                                    ';
                                    
                                }else{
                                    echo'
                                        <a class="nav-link" href="'. route('login') . '">LOGIN</a>
                                    ';
                                }
                            ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <main>
         @yield('content') 
    </main>
    
    <!--::footer_part start::-->
    <footer class="footer_part">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-sm-6 col-lg-6">
                    <div class="single_footer_part">
                        <div class="maps_container">
                            <h4>Our Location</h4>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1148.3001655459595!2d110.49470678989275!3d-7.34160484265857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a79c376ec6c21%3A0x6b978b8638843e71!2sMbak%20Lusi%201!5e0!3m2!1sen!2sid!4v1733029132564!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="col-sm-6 col-lg-8">
                        <div class="single_footer_part">
                            <h4>Alamat Lengkap</h4>
                            <ul class="list-unstyled">
                                <li><a>Jl. Anggrek No. 5, Jakarta, Indonesia</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-8">
                        <div class="single_footer_part">
                            <h4>Jam Operasional</h4>
                            <ul class="list-unstyled">
                                <li><a>Senin - Minggu : <br> 08.00-18.00 </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-8">
                        <div class="single_footer_part">
                            <h4>Kontak</h4>
                            <ul class="list-unstyled">
                                <li><a>WhatsApp +XXXXXXXXXXXXX</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-8">
                        <div class="single_footer_part">
                            <h4>Social</h4>
                            <ul class="list-unstyled">
                                <li><a>WhatsApp +XXXXXXXXXXXXX</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="copyright_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                    </div>
                    <div class="col-lg-4">
                        <div class="footer_icon social_icon">
                            <ul class="list-unstyled">
                                <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>

</html>