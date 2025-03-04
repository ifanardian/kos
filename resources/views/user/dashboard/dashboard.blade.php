@extends('layout.layout')
@section('title', 'Dashboard | Kos Fortuna')

@push('styles')
<style>
    /* .banner_part {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        min-height: 100vh;
        background-image: url("{{ asset('images/houses.png') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        overflow: hidden;
        width: 100%;
        height: auto;
    } */

    .banner_part {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        min-height: 100vh;
        background-image: url("{{ asset('images/houses.png') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        overflow: hidden;
        width: 100%;
        height: auto;
        padding: 20px; /* Tambahkan padding untuk mobile */
    }

    .banner_text_iner p {
        white-space: nowrap; /* Mencegah teks turun ke baris berikutnya */
        overflow: hidden;
        text-overflow: ellipsis; /* Tambahkan elipsis jika teks terlalu panjang */
    }

    @media (max-width: 768px) {
        .banner_text_iner p {
            white-space: normal; /* Izinkan teks turun ke baris berikutnya pada layar kecil */
            word-break: break-word; /* Pecah kata jika terlalu panjang */
        }
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

{{-- VIRTUAL TOUR --}}
<div id="panorama-section">
    <div class="section_tittle text-center">
        <h2>Virtual Tour 360<sup>°</sup></h2>
    </div>
    <div id="panorama" class="align-center">
        <script>
            pannellum.viewer('panorama', {
                "default": {
                    <?php
                        $defaultScene = $panorama->where('default', 1)->first();
                        if ($defaultScene) {
                            echo '"firstScene": "' . $defaultScene->id . '",';
                        }
                    ?>
                    // "author": "Matthew Petroff",
                    "sceneFadeDuration": 1000,
                    "autoLoad": true
                },
                "scenes": {
                    <?php
                        foreach($panorama as $p){
                            $hotspots = '';
                            $temp = DB::Select("
                                SELECT h.pitch, h.yaw, p.text, h.scene
                                FROM panorama_hotspots h
                                JOIN ms_panorama p ON h.scene = p.id
                                WHERE h.id_panorama = ".$p->id.";
                            ");
                            // dd($temp);
                            if(count($temp) > 0){
                                $hotspots= "'hotSpots': [";
                                
                                foreach($temp as $t){
                                    // dd($t->scene);
                                    $hotspots .= "{
                                    'pitch'     : ".$t->pitch.",
                                    'yaw'       : ".$t->yaw.",
                                    'type'      : 'scene',
                                    'text'      : '".$t->text."',
                                    'sceneId'   : '".$t->scene."'
                                    },";
                                    
                                }
                                $hotspots .="]";       
                            }
                            echo"
                                ".$p->id.": {
                                'hfov':".$p->hfov.", //seberapa zoom gambar pas pertama kali diliat
                                'pitch':".$p->pitch.", //seberapa tinggi/rendah letak panahnya (vertikal)
                                'yaw': ".$p->yaw.", //sudut mana yang diliat pertama kali (horizontal)
                                'type':'equirectangular',
                                'panorama':'".asset('images/panorama/'.$p->namafile)."',
                                ".$hotspots."
                            },
                            
                            ";
                        }
                        
                        
                        
                        
                        
                        ?>
                    
                }
            });

        </script>
    </div>
</div>

{{-- CARD FASILITAS --}}
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

{{-- KATEGORI KAMAR --}}
@php
$hargaBulanan = \App\Models\MsTipeKos::where('bulan', 1)->first();
$hargaTahunan = \App\Models\MsTipeKos::where('bulan', 12)->first();
@endphp
<div class="feature_part padding_top_feature dark-bg mb-5 pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="section_tittle text-center">
                    <h2>Kategori Kamar</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="single_feature_post_text text-center">
                    <h3>BULANAN</h3>
                    <div class="price-container">
                        <p>
                            <span class="price">Rp {{ number_format($hargaBulanan->harga ?? 400000, 0, ',', '.') }}</span>
                            <span class="period">/ Bulan</span>
                        </p>
                        <p style="color: beige">Sisa Kamar: {} </p>
                    </div>
                    <a href="{{ route('booking', ['tipe_kos' => '1']) }}" class="feature_btn">BOOK NOW <i class="fas fa-play"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="single_feature_post_text text-center">
                    <h3>TAHUNAN</h3>
                    <div class="price-container">
                        <p>
                            <span class="price">Rp {{ number_format($hargaTahunan->harga ?? 4400000, 0, ',', '.') }}</span>
                            <span class="period">/ Tahun</span>
                        </p>
                        <p style="color: beige">Sisa Kamar: {} </p>
                    </div>
                    <a href="{{ route('booking', ['tipe_kos' => '2']) }}" class="feature_btn">BOOK NOW <i class="fas fa-play"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- @push('scripts')
    <script>
        const navbar = document.querySelector('.main_menu');
        const navLinks = document.querySelectorAll('.nav-link, .navbar-brand, .navbar-toggler'); // Semua elemen link navbar

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
