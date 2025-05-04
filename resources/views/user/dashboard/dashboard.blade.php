@extends('layout.layout')
@section('title', 'Dashboard | Kos Fortuna')

@push('styles')
<style>

    .banner_part {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        min-height: 100vh;
        background-image: url("{{ auto_asset('images/houses.png') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        overflow: hidden;
        width: 100%;
        height: auto;
        padding: 20px; 
    }

    .banner_text_iner p {
        white-space: nowrap; 
        overflow: hidden;
        text-overflow: ellipsis; 
    }

    @media (max-width: 768px) {
        .banner_text_iner p {
            white-space: normal; 
            word-break: break-word; 
        }
    }

</style>
@endpush

@section('content')
<!-- banner part start-->
<section class="banner_part">
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
                                    <a href="{{ route('booking') }}" class="btn_2">pesan sekarang</a>
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
<?php if(isset($panorama) && $panorama->count() > 0): ?>
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
                                echo '"firstScene": "' . $defaultScene->id_panorama . '",';
                            }
                        ?>
                        "sceneFadeDuration": 1000,
                        "autoLoad": true
                    },
                    "scenes": {
                        <?php
                            foreach($panorama as $p){
                                $hotspots = '';
                                $temp = $p->hotspots;
                                // dd($p);
                                if(count($temp) > 0){
                                    $hotspots = "'hotSpots': [";
                                    
                                    foreach($temp as $t){
                                        // dd($t->scenePanorama);
                                        $hotspots .= "{
                                            'pitch'     : ".$t->pitch.",
                                            'yaw'       : ".$t->yaw.",
                                            'type'      : 'scene',
                                            'text'      : '".$t->scenePanorama->text."',
                                            'sceneId'   : '".$t->scene."'
                                        },";
                                    }
                                    $hotspots .= "]";       
                                }
                                echo "
                                    ".$p->id_panorama.": {
                                        'hfov':".$p->hfov.", //seberapa zoom gambar pas pertama kali diliat
                                        'pitch':".$p->pitch.", //seberapa tinggi/rendah letak panahnya (vertikal)
                                        'yaw': ".$p->yaw.", //sudut mana yang diliat pertama kali (horizontal)
                                        'type':'equirectangular',
                                        'panorama':'".auto_asset($p->namafile)."',
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
    
<?php endif; ?>
{{-- CARD FASILITAS --}}
<div class="ag-format-container mt-4 mb-5" id="facility">
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
    <?php
        for($i = 0 ; $i<6;$i++){
            
            echo '
            <div class="column">
                <a href="" data-bs-toggle="modal" data-bs-target="#editGridModal" nama-gambar="'.$gambar[$i]['nama_gambar'].'" id-gambar="'.$gambar[$i]['id_gambar'].'">
                    <img src="'. auto_asset("images/grid/".$gambar[$i]['nama_gambar']) .'" style="width:100%">
                </a>';
            $i ++;
            echo '
                <a href="" data-bs-toggle="modal" data-bs-target="#editGridModal" nama-gambar="'. $gambar[$i]['nama_gambar'].'" id-gambar="'.$gambar[$i]['id_gambar'].'">
                    <img src="'. auto_asset("images/grid/".$gambar[$i]['nama_gambar']) .'" style="width:100%">
                </a>
            </div>'
                ;
        }
    ?>
</div>

@if($MsTipeKos->isNotEmpty())
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
                @foreach($MsTipeKos as $m)
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="single_feature_post_text text-center">
                            <h3>{{ $m->deskripsi }}</h3>
                            <div class="price-container">
                                <p>
                                    <span class="price">Rp {{number_format($m->harga ?? 400000, 0, ',', '.')}}</span>
                                    <span class="period">/ {{ $m->bulan }} bulan</span>
                                </p>
                            </div>
                            <a href="{{ route('booking', ['tipe_kos' => $m->id_tipe_kos]) }}" class="feature_btn">BOOK NOW <i class="fas fa-play"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@endsection

{{-- @push('scripts')
    <script>
        const navbar = document.querySelector('.main_menu');
        const navLinks = document.querySelectorAll('.nav-link, .navbar-brand, .navbar-toggler'); 

        window.addEventListener('scroll', () => {
            const bannerHeight = document.querySelector('.banner_part').offsetHeight;

            if (window.scrollY > bannerHeight) {
                navbar.style.background = '#7cafc8';
                navLinks.forEach(link => {
                    link.style.color = '#fff'; 
                });
            } else {
                navbar.style.background = 'transparent'; 
                navbar.style.boxShadow = 'none';
                navLinks.forEach(link => {
                    link.style.color = '#000'; 
                });
            }
        });

    </script>
    @endpush --}}
