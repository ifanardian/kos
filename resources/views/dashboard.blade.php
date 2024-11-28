@extends('layout.layout')
@section('title', 'Dashboard')
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
                                            <p>Incididunt ut labore et dolore magna aliqua quis ipsum
                                                suspendisse ultrices gravida. Risus commodo viverra</p>
                                            <a href="#" class="btn_2">book now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner_img d-none d-lg-block">
                                    <img src="img/banner_img.png" alt="">
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
          <h2>Virtual Tour 360</h2>
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
                                        <img src="img/product/product_2.png" alt="">
                                        <div class="single_product_text">
                                            <img style="margin-left: 35px" width="30" height="35" src="https://img.icons8.com/material-outlined/100/map--v1.png" alt="map--v1"/>
                                            <h4>Dekat Fasilitas Umum</h4>
                                            {{-- <a href="#" class="add_cart">+ add to cart<i class="ti-heart"></i></a> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single_product_item">
                                        <img src="img/product/product_2.png" alt="">
                                        <div class="single_product_text">
                                            <img style="margin-left: 35px" width="30" height="30" src="https://img.icons8.com/material-outlined/100/bureau.png" alt="bureau"/>
                                            <h4>Fasilitas Kamar Lengkap</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single_product_item">
                                        <img src="img/product/product_3.png" alt="">
                                        <div class="single_product_text">
                                            <img style="margin-left: 35px" width="30" height="30" src="https://img.icons8.com/material-outlined/100/star--v2.png" alt="star--v2"/>
                                            <h4>Harga Bersaing</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single_product_item">
                                        <img src="img/product/product_4.png" alt="">
                                        <div class="single_product_text">
                                            <img style="margin-left: 35px" width="30" height="30" src="https://img.icons8.com/material-outlined/100/parking.png" alt="parking"/>
                                            <h4>Area Parkir Luas</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single_product_item">
                                        <img src="img/product/product_5.png" alt="">
                                        <div class="single_product_text">
                                            <img style="margin-left: 35px" width="30" height="30" src="https://img.icons8.com/material-outlined/100/wallmount-camera.png" alt="wallmount-camera"/>
                                            <h4>CCTV 24 Jam</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="single_product_item">
                                        <img src="img/product/product_6.png" alt="">
                                        <div class="single_product_text">
                                            <img style="margin-left: 35px" width="30" height="30" src="https://img.icons8.com/material-outlined/100/light-on--v1.png" alt="light-on--v1"/>
                                            <h4>Listrik & Air Gratis</h4>
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
    <div class="row-grid"> 
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
    <section class="feature_part padding_top">
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
                            <p><span class="currency">Rp</span> <span class="price">400.000</span> <span class="period">/ Bulan</span></p>
                            <p>Sisa Kamar: {} </p>  
                        </div>
                        <a href="{{ route('booking', ['tipe' => 'Bulanan']) }}" class="feature_btn">BOOK NOW <i class="fas fa-play"></i></a>
                        <img src="img/feature/feature_1.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="single_feature_post_text">
                        <h3>TAHUNAN</h3> 
                        <div class="price-container">
                            <p><span class="currency">Rp</span> <span class="price">4.500.000</span> <span class="period">/ Tahun</span></p>
                            <p>Sisa Kamar: {} </p>  
                        </div>
                        <a href="{{ route('booking', ['tipe' => 'Tahunan']) }}" class="feature_btn">BOOK NOW <i class="fas fa-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- upcoming_event part start-->


    <!-- awesome_shop start-->
    {{-- <section class="our_offer section_padding">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-md-6">
                    <div class="offer_img">
                        <img src="img/offer_img.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="offer_text">
                        <h2>Weekly Sale on
                            60% Off All Products</h2>
                        <div class="date_countdown">
                            <div id="timer">
                                <div id="days" class="date"></div>
                                <div id="hours" class="date"></div>
                                <div id="minutes" class="date"></div>
                                <div id="seconds" class="date"></div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="enter email address"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <a href="#" class="input-group-text btn_2" id="basic-addon2">book now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- awesome_shop part start-->

    <!-- product_list part start-->
    {{-- <section class="product_list best_seller section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Best Sellers <span>shop</span></h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class="best_product_slider owl-carousel">
                        <div class="single_product_item">
                            <img src="img/product/product_1.png" alt="">
                            <div class="single_product_text">
                                <h4>Quartz Belt Watch</h4>
                                <h3>$150.00</h3>
                            </div>
                        </div>
                        <div class="single_product_item">
                            <img src="img/product/product_2.png" alt="">
                            <div class="single_product_text">
                                <h4>Quartz Belt Watch</h4>
                                <h3>$150.00</h3>
                            </div>
                        </div>
                        <div class="single_product_item">
                            <img src="img/product/product_3.png" alt="">
                            <div class="single_product_text">
                                <h4>Quartz Belt Watch</h4>
                                <h3>$150.00</h3>
                            </div>
                        </div>
                        <div class="single_product_item">
                            <img src="img/product/product_4.png" alt="">
                            <div class="single_product_text">
                                <h4>Quartz Belt Watch</h4>
                                <h3>$150.00</h3>
                            </div>
                        </div>
                        <div class="single_product_item">
                            <img src="img/product/product_5.png" alt="">
                            <div class="single_product_text">
                                <h4>Quartz Belt Watch</h4>
                                <h3>$150.00</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- product_list part end-->

    <!-- subscribe_area part start-->
    <section class="subscribe_area section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="subscribe_area_text text-center">
                        <h5>Join Our Newsletter</h5>
                        <h2>Subscribe to get Updated
                            with new offers</h2>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="enter email address"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <a href="#" class="input-group-text btn_2" id="basic-addon2">subscribe now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::subscribe_area part end::-->
    @push('scripts')
        <script src="js/custom.js"></script>
    @endpush

    <script>
        let slideIndex = 0;
        showSlides();
  
        function plusSlides(n) {
          showSlides((slideIndex += n));
        }
  
        function currentSlide(n) {
          showSlides((slideIndex = n));
        }
  
        function showSlides() {
          let i;
          let slides = document.getElementsByClassName("mySlides");
  
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          slideIndex++;
          if (slideIndex > slides.length) {
            slideIndex = 1;
          }
          slides[slideIndex - 1].style.display = "block";
          setTimeout(showSlides, 3000); // Change image every 2 seconds
        }
      </script>
@endsection