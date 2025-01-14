@extends('layout.layout')
@section('title', 'Payment | Kos Fortuna')

@push('styles')
<style>
    .main_menu .navbar-brand {
        color: #ffffce;
    }

    .main_menu .main-menu-item ul li .nav-link {
        color: #ffffce;
    }

    .main_menu .main-menu-item ul li .nav-link:hover {
        color: #6987af;
    }

    .main_menu .d-flex .nav-item {
        color: #ffffce;
    }

    .main_menu .d-flex .nav-item:hover {
        color: #6987af;
    }

</style>
@endpush

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
                        {{-- <p><strong> Status Pembayaran: <span>{{$payment->status_verifikasi}}</span></strong></p> --}}
                        {{-- <p><strong>Status Pembayaran: 
                            <span>{{$payment->status_verifikasi ? 'Terverifikasi' : 'Menunggu Verifikasi'}}</span></strong></p> --}}
                        @if ($isFirstPayment)
                            {{-- <span>Silahkan lakukan pembayaran paling lambat
                            {{ \Carbon\Carbon::parse($payment->periode_tagihan)->subDay()->format('d M Y') }}</span> --}}
                            <p>Silahkan lakukan pembayaran pertama untuk menyelesaikan proses pemesanan. <br> 
                                <span>Pembayaran paling lambat
                                {{ \Carbon\Carbon::parse($payment->periode_tagihan)->subDay()->format('d M Y') }}</span></p>
                            <p><strong>Status Pembayaran: 
                                <span>{{$payment->status_verifikasi ? 'Terverifikasi' : 'Menunggu Verifikasi'}}</span></strong></p>
                        @else
                            <p>Silahkan lakukan pembayaran untuk memperpanjang masa tinggal Anda.</p>
                        @endif
                        
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="single_confirmation_details">
                        <h4>order info</h4>
                        <ul>
                            @if ($isFirstPayment)
                                <li>
                                    <p>order number</p><span>: {{$payment->email}}_{{$payment->periode_tagihan}}</span>
                                </li>
                                <li>
                                    <p>Tanggal Jatuh Tempo</p><span>:
                                        {{ \Carbon\Carbon::parse($payment->periode_tagihan)->subDay()->format('d M Y') }}</span>
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
                                    <span>:
                                        {{ DB::table('ms_tipe_kos')->where('id', $detailPenyewa->tipe_kos)->value('deskripsi') }}</span>


                                </li>
                                <li>
                                    <p>Periode Penempatan</p>
                                    <span>: {{ \Carbon\Carbon::parse($payment->periode_tagihan)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($payment->periode_tagihan)->subDay()->addMonth()->format('d M Y') }}</span>
                                </li>
                                <li>
                                    <p>Tanggal Pemesanan</p>
                                    <span>:
                                        {{\Carbon\Carbon::parse($detailPenyewa->tanggal_booking)->format('d M Y')}}</span>
                                </li>
                            @else
                                <li>
                                    <p>Tanggal Jatuh Tempo</p>
                                    <span>: {{ \Carbon\Carbon::parse($payment->periode_tagihan)->subDay()->format('d M Y') }}</span>
                                </li>
                                <li>
                                    <p>Nama Lengkap</p>
                                    <span>: {{$detailPenyewa->nama}}</span>
                                </li>
                                <li>
                                    <p>Tipe Kos</p>
                                    <span>: {{ DB::table('ms_tipe_kos')->where('id', $detailPenyewa->tipe_kos)->value('deskripsi') }}</span>
                                </li>
                                <li>
                                    <p>Periode Penempatan</p>
                                    <span>: {{ \Carbon\Carbon::parse($payment->periode_tagihan)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($payment->periode_tagihan)->subDay()->addMonth()->format('d M Y') }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="order_details_iner">
                        <div class="order_header">
                            <h3>Order Details</h3>
                            <a class="btn_3" href="{{ route('cobatagihan') }}" >LIHAT TAGIHAN BULAN SEBELUMNYA</a>
                        </div>
                        {{-- <button class="btn_3" type="submit">LIHAT TAGIHAN BULAN SEBELUMNYA</button>
                        <h3>Order Details</h3> --}}
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">No Kamar</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col" colspan="2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><span>{{$detailPenyewa->no_kamar}}</span></th>
                                    <th>{{ DB::table('ms_tipe_kos')->where('id', $detailPenyewa->tipe_kos)->value('deskripsi') }}
                                    </th>
                                    <th colspan="2"> <span>Rp.
                                            {{ number_format(DB::table('ms_tipe_kos')->where('id', $detailPenyewa->tipe_kos)->value('harga'), 0, ',', '.') }}</span>
                                    </th>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col" colspan="3">Grand Total</th>
                                    <th scope="col">Rp.
                                        {{ number_format(DB::table('ms_tipe_kos')->where('id', $detailPenyewa->tipe_kos)->value('harga'), 0, ',', '.')}}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>OPSI PEMBAYARAN</h2>
                        <form action="{{ route('payment.action') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="metode_pembayaran" value="Tunai"
                                        required />
                                    <label for="f-option5">Pembayaran Tunai</label>
                                    <div class="check"></div>
                                </div>
                                <p>
                                    Datang secara langsung ke Kos Fortuna untuk melakukan pembayaran secara
                                    tunai.
                                </p>
                            </div>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="metode_pembayaran" value="Transfer"
                                        required />
                                    <label for="f-option6">Pembayaran Non Tunai</label>
                                    <div class="check"></div>
                                </div>
                                <p>
                                    Lusiana <br>
                                    BCA 0130743048 <br>
                                    BRI 378701034178537 <br><br>
                                    <label for="bukti_tf">Upload Bukti Pembayaran</label>
                                    <input type="file" class="file-upload" id="bukti_tf" name="bukti_tf"
                                        accept=".jpg, .jpeg, .png" disabled />
                                </p>
                            </div>
                            <input type="hidden" name="email" value="{{ $payment->email }}">
                            <input type="hidden" name="periode_tagihan" value="{{ $payment->periode_tagihan }}">
                            <button class="btn_3" type="submit">BAYAR</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--================ confirmation part end =================-->


{{-- @push('scripts') --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('input[type="radio"]').click(function () {
            if ($(this).attr('id') == 'f-option5') {
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

<script>
    const navbar = document.querySelector('.main_menu');
    const navLinks = document.querySelectorAll('.nav-link, .navbar-brand'); // Semua elemen link navbar

    window.addEventListener('scroll', () => {
        const bannerHeight = document.querySelector('.breadcrumb, .breadcrumb_bg').offsetHeight;

        if (window.scrollY > bannerHeight) {
            // Ubah warna navbar dan font setelah scroll
            navbar.style.background = '#7cafc8'; // Background warna solid setelah scroll
            navLinks.forEach(link => {
                link.style.color = '#fff'; // Warna font terang untuk background solid
            });
        } else {
            // Kembalikan warna navbar dan font ke default saat di atas banner
            navbar.style.background = 'transparent'; // Transparan sebelum scroll
            navbar.style.boxShadow = 'none';
            navLinks.forEach(link => {
                link.style.color = '#e5e5d2'; // Warna font gelap untuk background terang
            });
        }
    });

</script>
{{-- @endpush --}}
@endsection