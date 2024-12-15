@extends('layout.layout')
@section('title', 'Dashboard | Kos Fortuna')

@push('styles')
<style>
    .banner_part {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        position: relative;
        background-image: url("{{ asset('images/houses.png') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

</style>
@endpush

@section('content')
<!-- banner part start-->
<section class="banner_part">
    {{-- <div class="banner_video">
        <video autoplay muted loop>
            <source src="{{ asset('images/leaf.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
    </video>
    </div> --}}
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="single_banner_slider">
                    <div class="row">
                        <div class="col-lg-5 col-md-8">
                            <div class="banner_text">
                                <div class="banner_text_iner">
                                    <h1>Kos Fortuna</h1>
                                    <p>Hunian Nyaman, Fasilitas Lengkap, Harga Bersahabat.</p>
                                    <a href="#" class="btn_2">book now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- banner part start-->
<div id="panorama-section">
    <div class="section_tittle text-center">
        <h2>Virtual Tour 360<sup>°</sup></h2>
    </div>
    <div id="panorama">


        <script>
            pannellum.viewer('panorama', {
                "type": "equirectangular",
                "panorama": "{{ asset('images/panorama.png') }}"
            });

        </script>
    </div>
</div>

<!-- product_list start-->
<section class="product_list section_padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="single_product_list_slider">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_product_item">
                                <div class="single_product_text">
                                    <img style="margin-left: 35px" width="30" height="35"
                                        src="https://img.icons8.com/material-outlined/100/map--v1.png" alt="map--v1" />
                                    <h4>Dekat Fasilitas Umum</h4>
                                    {{-- <a href="#" class="add_cart">+ add to cart<i class="ti-heart"></i></a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_product_item">
                                <div class="single_product_text">
                                    <img style="margin-left: 35px" width="30" height="30"
                                        src="https://img.icons8.com/material-outlined/100/bureau.png" alt="bureau" />
                                    <h4>Fasilitas Kamar Lengkap</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_product_item">
                                <div class="single_product_text">
                                    <img style="margin-left: 35px" width="30" height="30"
                                        src="https://img.icons8.com/material-outlined/100/star--v2.png"
                                        alt="star--v2" />
                                    <h4>Harga Bersaing</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_product_item">
                                <div class="single_product_text">
                                    <img style="margin-left: 35px" width="30" height="30"
                                        src="https://img.icons8.com/material-outlined/100/parking.png" alt="parking" />
                                    <h4>Area Parkir Luas</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_product_item">
                                <div class="single_product_text">
                                    <img style="margin-left: 35px" width="30" height="30"
                                        src="https://img.icons8.com/material-outlined/100/wallmount-camera.png"
                                        alt="wallmount-camera" />
                                    <h4>CCTV 24 Jam</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_product_item">
                                <div class="single_product_text">
                                    <img style="margin-left: 35px" width="30" height="30"
                                        src="https://img.icons8.com/material-outlined/100/light-on--v1.png"
                                        alt="light-on--v1" />
                                    <h4>CCTV 24 Jam</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_list part start-->

{{-- GRID --}}
<div class="row-grid dark-bg">
    <div class="column">
        <img src="{{ asset('images/display8.jpeg') }}" style="width:100%">
        <img src="{{ asset('images/display2.jpeg') }}" style="width:100%">
    </div>
    <div class="column">
        <img src="{{ asset('images/display9.jpeg') }}" style="width:100%">
        <img src="{{ asset('images/display5.jpeg') }}" style="width:100%">
    </div>
    <div class="column">
        <img src="{{ asset('images/display6.jpeg') }}" style="width:100%">
        <img src="{{ asset('images/display4.jpeg') }}" style="width:100%">
    </div>
</div>

{{-- carousell --}}
{{-- <div id="carousel-kos" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img src="{{ asset('images/display3.jpeg') }}" class="d-block w-100" alt="Slide 1">
</div>
<!-- Slide 2 -->
<div class="carousel-item">
    <img src="{{ asset('images/display5.jpeg') }}" class="d-block w-100" alt="Slide 2">
</div>
<!-- Slide 3 -->
<div class="carousel-item">
    <img src="{{ asset('images/display7.jpeg') }}" class="d-block w-100" alt="Slide 3">
</div>
</div>
<div>

    <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            <img src="{{ asset('images/display3.jpeg') }}" style="width: 100%" />
        </div>

        <div class="mySlides fade">
            <img src="{{ asset('images/display5.jpeg') }}" style="width: 100%" />
        </div>

        <div class="mySlides fade">
            <img src="{{ asset('images/display7.jpeg') }}" style="width: 100%" />
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div> --}}

    <!-- feature_part start-->
    <section class="feature_part padding_top dark-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="section_tittle text-center">
                        <h2>Kategori Kamar</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-sm-6">
                    <div class="single_feature_post_text">
                        <h3>BULANAN</h3>
                        <div class="price-container">
                            <p><span class="currency">Rp</span> <span class="price">400.000</span> <span
                                    class="period">/ Bulan</span></p>
                            <p style="color: beige">Sisa Kamar: {} </p>
                        </div>
                        <a href="{{ route('booking', ['tipe' => 'Bulanan']) }}" class="feature_btn">BOOK NOW <i
                                class="fas fa-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="single_feature_post_text">
                        <h3>TAHUNAN</h3>
                        <div class="price-container">
                            <p><span class="currency">Rp</span> <span class="price">4.500.000</span> <span
                                    class="period">/ Tahun</span></p>
                            <p style="color: beige">Sisa Kamar: {} </p>
                        </div>
                        <a href="{{ route('booking', ['tipe' => 'Tahunan']) }}" class="feature_btn">BOOK NOW <i
                                class="fas fa-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection

    @push('scripts')
    {{-- <script>
    window.addEventListener("scroll", () => {
        const banner = document.querySelector(".banner_part");
        const scrollPos = window.scrollY; // Mendapatkan posisi scroll
        const maxHeight = window.innerHeight; // Tinggi layar

        // Hitung opacity berdasarkan posisi scroll
        const opacity = Math.min(scrollPos / maxHeight, 1); 

        // Terapkan efek gradasi dinamis
        banner.style.backgroundImage = `
            linear-gradient(to bottom, rgba(0, 0, 0, ${opacity}), rgba(0, 0, 0, 0)),
            url("{{ asset('images/houses.png') }}")
    `;
    });
    </script> --}}
    {{-- <script>
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector(".main_menu");
            const banner = document.querySelector(".banner_part"); // Elemen di bawah navbar

            // Dapatkan posisi scroll
            const bannerHeight = banner.offsetHeight;
            const scrollTop = window.scrollY;

            // Cek jika scroll sudah melewati banner
            if (scrollTop > bannerHeight) {
                navbar.classList.remove("navbar-dark");
                navbar.classList.add("navbar-light");
            } else {
                navbar.classList.remove("navbar-light");
                navbar.classList.add("navbar-dark");
            }
        });

    </script> --}}

    {{-- SCRIPT NAVBAR BERUBAH SAAT DI SCROLL --}}
    <script>
        // const navbar = document.querySelector('.main_menu');

        // window.addEventListener('scroll', () => {
        //     const bannerHeight = document.querySelector('.banner_part').offsetHeight;
        //     if (window.scrollY > bannerHeight) {
        //         navbar.style.background = '#7cbfc8'; // Warna setelah scroll
        //         navbar.style.boxShadow = '0px 2px 5px rgba(255, 255, 255, 0.5);';
        //     } else {
        //         navbar.style.background = 'transparent'; // Transparan saat di atas banner
        //         navbar.style.boxShadow = 'none';
        //     }
        //     });

        const navbar = document.querySelector('.main_menu');
        const navLinks = document.querySelectorAll('.nav-link, .navbar-brand'); // Semua elemen link navbar

        window.addEventListener('scroll', () => {
            const bannerHeight = document.querySelector('.banner_part').offsetHeight;

            if (window.scrollY > bannerHeight) {
                // Ubah warna navbar dan font setelah scroll
                navbar.style.background = '#7cafc8'; // Background warna solid setelah scroll
                // navbar.style.backdropFilter = 'blur(100px)';
                // navbar.style.boxShadow = '0px 2px 5px rgba(255, 255, 255, 0.5)';
                navLinks.forEach(link => {
                    link.style.color = '#fff'; // Warna font terang untuk background solid
                });
            } else {
                // Kembalikan warna navbar dan font ke default saat di atas banner
                navbar.style.background = 'transparent'; // Transparan sebelum scroll
                navbar.style.boxShadow = 'none';
                navLinks.forEach(link => {
                    link.style.color = '#000'; // Warna font gelap untuk background terang
                });
            }
        });

    </script>
    @endpush
