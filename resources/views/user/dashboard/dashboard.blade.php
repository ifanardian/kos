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
                                    <h1>Kos Fortunaa</h1>
                                    <p>Hunian Nyaman, Fasilitas Lengkap, Harga Bersahabat.</p>
                                    <a href="{{ route('booking') }}" class="btn_2">book now</a>
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
                "default": {
                    "firstScene": "beranda",
                    // "author": "Matthew Petroff",
                    "sceneFadeDuration": 1000,
                    "autoLoad": true
                },

                "scenes": {
                    "beranda": {
                        "hfov": 160, //seberapa zoom gambar pas pertama kali diliat
                        "pitch": -10, //seberapa tinggi/rendah letak panahnya (vertikal)
                        "yaw": 80, //sudut mana yang diliat pertama kali (horizontal)
                        "type": "equirectangular",
                        "panorama": "{{ asset('images/panorama.jpeg') }}",
                        "hotSpots": [{
                                "pitch": -9.1,
                                "yaw": 257,
                                "type": "scene",
                                "text": "Kamar Mandi",
                                "sceneId": "kamarmandi"
                            },
                            {
                                "pitch": -9.1,
                                "yaw": 78,
                                "type": "scene",
                                "text": "Tempat Jemur",
                                "sceneId": "jemur"
                            }

                        ]
                    },

                    "kamarmandi": {
                        "hfov": 120,
                        "pitch": -12,
                        "yaw": 130,
                        "type": "equirectangular",
                        "panorama": "{{ asset('images/km.jpeg') }}",
                        "hotSpots": [{
                                "pitch": -8,
                                "yaw": 217,
                                "type": "scene",
                                "text": "Tempat Jemur",
                                "sceneId": "jemur",
                                "targetYaw": -23,
                                "targetPitch": 2
                            },
                            {
                                "pitch": -18,
                                "yaw": 217,
                                "type": "scene",
                                "text": "Beranda",
                                "sceneId": "beranda",
                                "targetYaw": -25, //scene pertama kali (horizontal)
                                "targetPitch": -1 //seberapa ndangak (vertikal)
                            }
                        ]
                    },
                    "jemur": {
                        "hfov": 120,
                        "pitch": -12,
                        "yaw": 355.5,
                        "type": "equirectangular",
                        "panorama": "{{ asset('images/jmr.jpeg') }}",
                        "hotSpots": [{
                                "pitch": -4,
                                "yaw": -6.5,
                                "type": "scene",
                                "text": "Kamar Mandi",
                                "sceneId": "kamarmandi",
                                "targetYaw": 130,
                                "targetPitch": -5
                            },
                            {
                                "pitch": -12, //seberapa naik panahnya
                                "yaw": -6,
                                "type": "scene",
                                "text": "Beranda",
                                "sceneId": "beranda",
                                "targetYaw": -94, //scene pertama kali (horizontal)
                                "targetPitch": -5 //seberapa ndangak (vertikal)
                            }
                        ]
                    }
                }
            });

        </script>
    </div>
</div>

{{-- card 2 --}}
<div class="ag-format-container mt-4 mb-5">
    <div class="ag-courses_box">
        <div class="ag-courses_item">
            <a class="ag-courses-item_link">
                <div class="ag-courses-item_bg"></div>

                <div class="ag-courses-item_title">
                    Dekat Fasilitas Umum
                </div>
            </a>
        </div>

        <div class="ag-courses_item">
            <a class="ag-courses-item_link">
                <div class="ag-courses-item_bg"></div>

                <div class="ag-courses-item_title">
                    Fasilitas Kamar Lengkap
                </div>
            </a>
        </div>

        <div class="ag-courses_item">
            <a class="ag-courses-item_link">
                <div class="ag-courses-item_bg"></div>

                <div class="ag-courses-item_title">
                    Harga Bersaing
                </div>
            </a>
        </div>

        <div class="ag-courses_item">
            <a class="ag-courses-item_link">
                <div class="ag-courses-item_bg"></div>

                <div class="ag-courses-item_title">
                    Area Parkir Luas
                </div>
            </a>
        </div>

        <div class="ag-courses_item">
            <a class="ag-courses-item_link">
                <div class="ag-courses-item_bg"></div>

                <div class="ag-courses-item_title">
                    Akses Jalan Mudah
                </div>
            </a>
        </div>

        <div class="ag-courses_item">
            <a class="ag-courses-item_link">
                <div class="ag-courses-item_bg"></div>

                <div class="ag-courses-item_title">
                    CCTV 24 Jam
                </div>
            </a>
        </div>

    </div>
</div>
{{-- end card --}}

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

@php
    $hargaBulanan = \App\Models\MsTipeKos::where('bulan', 1)->first();
    $hargaTahunan = \App\Models\MsTipeKos::where('bulan', 12)->first();
@endphp
<section class="feature_part padding_top_feature dark-bg">
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
                        <p>
                            <span class="price">Rp {{ number_format($hargaBulanan->harga ?? 400000, 0, ',', '.') }}</span> 
                            <span class="period">/ Bulan</span></p>
                        <p style="color: beige">Sisa Kamar: {} </p>
                    </div>
                    <a href="{{ route('booking', ['tipe_kos' => '1']) }}" class="feature_btn">BOOK NOW <i
                            class="fas fa-play"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="single_feature_post_text">
                    <h3>TAHUNAN</h3>
                    <div class="price-container">
                        <p><span class="price">Rp {{ number_format($hargaTahunan->harga ?? 4400000, 0, ',', '.') }}</span> 
                            <span class="period">/ Tahun</span></p>
                        <p style="color: beige">Sisa Kamar: {} </p>
                    </div>
                    <a href="{{ route('booking', ['tipe_kos' => '2']) }}" class="feature_btn">BOOK NOW <i
                            class="fas fa-play"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

{{-- @push('scripts')
    <script>
        const navbar = document.querySelector('.main_menu');
        const navLinks = document.querySelectorAll('.nav-link, .navbar-brand'); // Semua elemen link navbar

        window.addEventListener('scroll', () => {
            const bannerHeight = document.querySelector('.banner_part').offsetHeight;

            if (window.scrollY > bannerHeight) {
                // Ubah warna navbar dan font setelah scroll
                navbar.style.background = '#7cafc8';
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
    @endpush --}}
