@extends('user.layout.layout')
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
                <span>Silahkan lakukan pembayaran paling lambat {{ \Carbon\Carbon::parse($payment->periode_tagihan)->subDay()->format('d M Y') }}</span>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="single_confirmation_details">
              <h4>order info</h4>
              <ul>
                <li>
                  <p>order number</p><span>: {{$payment->email}}{{$payment->periode_tagihan}}</span>
                </li>
                <li>
                  <p>Tanggal Jatuh Tempo</p><span>: {{ \Carbon\Carbon::parse($payment->periode_tagihan)->subDay()->format('d M Y') }}</span>
                </li>
                <li>
                  <p>Nama Lengkap</p>
                  <span>: {{$detailPenyewa->nama}}</span>
                </li>
                <li>
                  <p>No HP (WhatsApp)</p>
                  <span>: {{$detailPenyewa->no_telepon}}</span>
                </li>
                <li>
                  <p>Alamat Lengkap</p>
                  <span>: {{$detailPenyewa->alamat}}</span>
                </li>
                <li>
                  <p>Tipe Kos</p>
                  <span>: {{ DB::table('ms_tipe_kos')->where('id', $detailPenyewa->tipe_kos)->value('deskripsi') }}</span>
                
                
                </li>
                <li>
                  <p>Periode Penempatan</p>
                  <span>: {{ \Carbon\Carbon::parse($payment->periode_tagihan)->format('d M Y') }} - {{ \Carbon\Carbon::parse($payment->periode_tagihan)->subDay()->addMonth()->format('d M Y') }}</span>
                </li>
                <li>
                  <p>Tanggal Pemesanan</p>
                  <span>: {{\Carbon\Carbon::parse($detailPenyewa->tanggal_booking)->format('d M Y')}}</span>
                </li>
              </ul>
            </div>

            <div class="order_details_iner">
              <h3>Order Details</h3>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">No Kos</th>
                    <th scope="col" >Tipe</th>
                    <th scope="col"colspan="2">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th><span>{{$detailPenyewa->no_kamar}}</span></th>
                    <th>{{ DB::table('ms_tipe_kos')->where('id', $detailPenyewa->tipe_kos)->value('deskripsi') }}</th>
                    <th colspan="2"> <span>Rp. {{ number_format(DB::table('ms_tipe_kos')->where('id', $detailPenyewa->tipe_kos)->value('harga'), 0, ',', '.') }}</span></th>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th scope="col" colspan="3">Grand Total</th>
                    <th scope="col">Rp. {{ number_format(DB::table('ms_tipe_kos')->where('id', $detailPenyewa->tipe_kos)->value('harga'), 0, ',', '.')}}</th>
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
              <form action="{{ route('payment.action') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <ul class="list">
                  {{-- @if ($bookings) --}}
                  {{-- <li>
                    <a href="#">Product
                      <span>Total</span>
                    </a>
                  </li> --}}
                  <li>
                    {{-- <a href="#"> Sewa Kos {{ $tipe }} --}}
                      {{-- <span class="last">Rp {{ number_format($harga, 0, ',', '.') }} </span> --}}
                    </a>
                  </li>
                </ul>
                <ul class="list list_2">
                  <!-- <li>
                    <a href="#">Subtotal
                      {{-- <span>Rp {{ number_format($harga, 0, ',', '.') }}</span> --}}
                    </a>
                  </li> -->
                  <li>
                    <a href="#">Total
                    <span>Rp {{ number_format(DB::table('ms_tipe_kos')->where('id', $detailPenyewa->tipe_kos)->value('harga'), 0, ',', '.') }}</span>
                    </a>
                  </li>
                </ul>
                {{-- @else
                    <p>Booking information not found.</p>
                @endif --}}
                <div class="payment_item">
                  <div class="radion_btn">
                    <input type="radio" id="f-option5" name="metode_pembayaran" value="Tunai" required />
                    <label for="f-option5">Pembayaran Tunai</label>
                    <div class="check"></div>
                  </div>
                  <p>
                    Datang secara langsung ke XXX untuk melakukan DP dan pembayaran secara tunai.
                  </p>
                </div>
                <div class="payment_item">
                  <div class="radion_btn">
                    <input type="radio" id="f-option6" name="metode_pembayaran" value="Transfer" required />
                    <label for="f-option6">Pembayaran Non Tunai</label>
                    <div class="check"></div>
                  </div>
                  <p>
                    BCA a/n XXX <br>
                    012121212121 <br>
                    BRI a/n XXX <br>
                    98908707886 <br><br>
                    <label for="bukti_tf" >Upload Bukti Pembayaran</label>
                    <input type="file" class="file-upload" id="bukti_tf" name="bukti_tf" accept=".jpg, .jpeg, .png" disabled/>
                  </p>
                </div>
                <input type="hidden" name="email" value="{{ $payment->email }}">
                <input type="hidden" name="periode_tagihan" value="{{ $payment->periode_tagihan }}">
                <button class="btn_3" type="submit">BOOK</button>
              </form>     
            </div>
          </div>
     
        </div>
      </div>
    </div>
  </section>
  <!--================ confirmation part end =================-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('input[type="radio"]').click(function() {
        if($(this).attr('id') == 'f-option5') {
          $('#bukti_tf').attr('required', false);
          $('#bukti_tf').attr('disabled', true);
          $('#bukti_tf').value = '';
        } else {
          $('label[for="bukti_tf"]').show();
          $('#bukti_tf').show();
          $('#bukti_tf').attr('required', true);
          $('#bukti_tf').attr('disabled', false);
          // $('#bukti_tf').removeAttr('disabled');
        }
      });
    });
  </script>
@endsection