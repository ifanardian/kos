@extends('layout.layout')
@section('title', 'Checkout')
@section('content')
<!--================Home Banner Area =================-->
  <!-- breadcrumb start-->
  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Booking Kamar</h2>
              <p>Home <span>-</span> Shop Single</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================Checkout Area =================-->
  @section('content')
  <section class="checkout_area padding_top">
    <div class="container">
      <div class="returning_customer">
        {{-- <div class="check_title">
          <h2>
            Returning Customer?
            <a href="#">Click here to login</a>
          </h2>
        </div>
        <p>
          If you have shopped with us before, please enter your details in the
          boxes below. If you are a new customer, please proceed to the
          Billing & Shipping section.
        </p>
        <form class="row contact_form" action="#" method="post" novalidate="novalidate">
          <div class="col-md-6 form-group p_star">
            <input type="text" class="form-control" id="name" name="name" value=" " />
            <span class="placeholder" data-placeholder="Username or Email"></span>
          </div>
          <div class="col-md-6 form-group p_star">
            <input type="password" class="form-control" id="password" name="password" value="" />
            <span class="placeholder" data-placeholder="Password"></span>
          </div>
          <div class="col-md-12 form-group">
            <button type="submit" value="submit" class="btn_3">
              log in
            </button>
            <div class="creat_account">
              <input type="checkbox" id="f-option" name="selector" />
              <label for="f-option">Remember me</label>
            </div>
            <a class="lost_pass" href="#">Lost your password?</a>
          </div>
        </form>
      </div>
      <div class="cupon_area">
        <div class="check_title">
          <h2>
            Have a coupon?
            <a href="#">Click here to enter your code</a>
          </h2>
        </div> 
        <input type="text" placeholder="Enter coupon code" />
        <a class="tp_btn" href="#">Apply Coupon</a>
      </div>--}}
      <div class="billing_details">
        <div class="row">
          <div class="col-lg-8">
            <h3>Detail Pembayaran</h3>
            <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
              <div class="col-md-11 form-group p_star">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" required/>
              </div>
              <div class="col-md-11 form-group p_star">
                <label for="number">No HP (WhatsApp)</label>
                <input type="text" class="form-control" id="number" name="number" required/>
              </div>
              <div class="col-md-11 form-group p_star">
                <label for="email">Alamat Email</label>
                <input type="text" class="form-control" id="email" name="email" required/>
              </div>
              {{-- <div class="col-md-12 form-group p_star">
                <select class="country_select">
                  <option value="1">Country</option>
                  <option value="2">Country</option>
                  <option value="4">Country</option>
                </select>
              </div> --}}
              <div class="col-md-11 form-group p_star">
                <label for="address">Alamat Lengkap (sesuai KTP)</label>
                <textarea class="form-control" name="address" id="address" rows="1"></textarea>
              </div>
              <div class="col-md-11 form-group p_star">
                <label for="ktp">Unggah foto KTP</label>
                <input type="file" class="form-control file-upload" id="ktp" name="ktp"  accept=".jpg, .jpeg" required/>
              </div>
              {{-- <div class="col-md-12 form-group p_star">
                <select class="country_select">
                  <option value="1">District</option>
                  <option value="2">District</option>
                  <option value="4">District</option>
                </select>
              </div> --}}
              {{-- <div class="col-md-12 form-group">
                <div class="creat_account">
                  <input type="checkbox" id="f-option2" name="selector" />
                  <label for="f-option2">Create an account?</label>
                </div>
              </div> --}}
              <div class="col-md-11 form-group p_star">
                <label for="email">Periode Penempatan</label>
                <input type="text" class="form-control" id="periode" name="periode" required/>
              </div>
              <div class="col-md-11 form-group p_star">
                <label for="bookingDate">Tanggal Pemesanan</label>
                <input type="date" class="form-control" id="bookingDate" name="booking_date" required min="<?= date('Y-m-d'); ?>"/>
              </div>
              <div class="col-md-11 form-group">
                <label for="message">Order Notes</label>
                <textarea class="form-control" name="message" id="message" rows="1"></textarea>
              </div>
              {{-- <button type= "submit">kirim</button> --}}
            </form>
          </div>
          <div class="col-lg-4">
            <div class="order_box">
              <h2>Your Order</h2>
              <div class="payment_item">
                <p>
                  Silahkan isi form untuk melakukan booking kamar kos,  
                  Anda akan bisa melakukan pembayaran setelah admin mengkonfirmasi booking Anda.   
                  Verifikasi akan dikirim via email. Pastikan data yang Anda kirim lengkap dan valid
                </p>
              </div>
              <a class="btn_3" type="submit" href="{{ route('checkout') }}">BOOK</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->
  <!-- custom js -->
  <script src="js/custom.js"></script>
  @endsection
