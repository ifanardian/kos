@extends('layout.layout')
@section('title', 'Confirmation')
@section('content')
  <!--================Home Banner Area =================-->
  <!-- breadcrumb start-->
  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Payment Confirmation</h2>
              <p>Home <span>-</span> Order Confirmation</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================ confirmation part start =================-->
  <section class="confirmation_part padding_top">
    <div class="container">
      <div class="billing_details">
        <div class="row">
          <div class="col-lg-12">
            <div class="confirmation_tittle">
              <span>Silahkan lakukan pembayaran sebelum {}</span>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="single_confirmation_details">
              <h4>order info</h4>
              <ul>
                <li>
                  <p>order number</p><span>: 60235</span>
                </li>
                <li>
                  <p>data</p><span>: Oct 03, 2017</span>
                </li>
                <li>
                  <p>Nama Lengkap</p>
                  <span>: 56/8</span>
                </li>
                <li>
                  <p>No HP (WhatsApp)</p>
                  <span>: Los Angeles</span>
                </li>
                <li>
                  <p>Alamat Lengkap</p>
                  <span>: United States</span>
                </li>
                <li>
                  <p>Alamat Lengkap</p>
                  <span>: United States</span>
                </li>
                <li>
                  <p>Periode Penempatan</p>
                  <span>: United States</span>
                </li>
                <li>
                  <p>Tanggal Pemesanan</p>
                  <span>: United States</span>
                </li>
              </ul>
            </div>

            <div class="order_details_iner">
              <h3>Order Details</h3>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col" colspan="2">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th colspan="2"><span>Pixelstore fresh Blackberry</span></th>
                    <th>x02</th>
                    <th> <span>$720.00</span></th>
                  </tr>
                  <tr>
                    <th colspan="3">Subtotal</th>
                    <th> <span>$2160.00</span></th>
                  </tr>
                  <tr>
                    <th colspan="3">shipping</th>
                    <th><span>flat rate: $50.00</span></th>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th scope="col" colspan="3">Quantity</th>
                    <th scope="col">Total</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          {{-- <div class="col-lg-6 col-lx-4">
            <div class="single_confirmation_details">
              <h4>Billing Address</h4>
              <ul>
                <li>
                  <p>Street</p><span>: 56/8</span>
                </li>
                <li>
                  <p>city</p><span>: Los Angeles</span>
                </li>
                <li>
                  <p>country</p><span>: United States</span>
                </li>
                <li>
                  <p>postcode</p><span>: 36952</span>
                </li>
              </ul>
            </div>
          </div> --}}
          {{-- <div class="col-lg-6 col-lx-4">
            <div class="single_confirmation_details">
              <h4>Your Info</h4>
              <ul>
                
              </ul>
            </div>
          </div> --}}

          <div class="col-lg-4">
            <div class="order_box">
              <h2>Your Order</h2>
              <ul class="list">
                {{-- @if ($bookings) --}}
                {{-- <li>
                  <a href="#">Product
                    <span>Total</span>
                  </a>
                </li> --}}
                @csrf
                <li>
                  {{-- <a href="#"> Sewa Kos {{ $tipe }} --}}
                    {{-- <span class="last">Rp {{ number_format($harga, 0, ',', '.') }} </span> --}}
                  </a>
                </li>
              </ul>
              <ul class="list list_2">
                <li>
                  <a href="#">Subtotal
                    {{-- <span>Rp {{ number_format($harga, 0, ',', '.') }}</span> --}}
                  </a>
                </li>
                <li>
                  <a href="#">Total
                    {{-- <span>Rp {{ number_format($harga, 0, ',', '.') }}</span> --}}
                  </a>
                </li>
              </ul>
              {{-- @else
                  <p>Booking information not found.</p>
              @endif --}}
              <div class="payment_item">
                <div class="radion_btn">
                  <input type="radio" id="f-option5" name="selector" />
                  <label for="f-option5">Pembayaran Tunai</label>
                  <div class="check"></div>
                </div>
                <p>
                  Datang secara langsung ke XXX untuk melakukan DP dan pembayaran secara tunai.
                </p>
              </div>
              <div class="payment_item">
                <div class="radion_btn">
                  <input type="radio" id="f-option6" name="selector" />
                  <label for="f-option6">Pembayaran Non Tunai</label>
                  <div class="check"></div>
                </div>
                <p>
                  BCA a/n XXX <br>
                  012121212121 <br>
                  BRI a/n XXX <br>
                  98908707886 <br><br>
                  <label for="ktp">Upload Bukti Pembayaran</label>
                  <input type="file" class="file-upload" id="ktp" name="ktp"  accept=".jpg, .jpeg" required/>
                </p>
              </div>
              {{-- <div class="creat_account">
                <input type="checkbox" id="f-option4" name="selector" />
                <label for="f-option4">I’ve read and accept the </label>
                <a href="#">terms & conditions*</a>
              </div> --}}
              <a class="btn_3" type="submit" href="{{ route('checkout') }}">BOOK</a>
            </div>
          </div>      
        </div>
      </div>
    </div>
  </section>
  <!--================ confirmation part end =================-->
@endsection