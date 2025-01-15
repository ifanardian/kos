@extends('layout.layout')
@section('title', 'Tagihan Bulanan | Kos Fortuna')
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
                        {{-- <h2>Upload Tagihan</h2> --}}
                        <h2>Detail Pembayaran Sewa Kos</h2>
                        <p>Home <span>-</span> Upload Tagihan</p>
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
            <div class="col">
                <div class="order_box">
                    {{-- <h2>Detail Pembayaran Sewa Kos</h2> --}}
                    <div class="payment_item">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal Pembayaran</th>
                                    <th scope="col">Periode Pembayaran</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@mdo</td>
                                </tr> --}}
                                @forelse ($payment as $pay)
                                <tr>
                                    <td>{{ $pay->tanggal_pembayaran ? date('d-m-Y', strtotime($pay->tanggal_pembayaran)) : '-' }}</td>
                                    <td>{{ date('F Y', strtotime($pay->periode_tagihan)) }}</td>
                                    <td>Rp {{ number_format($pay->total_tagihan, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($pay->status_verifikasi)
                                            <span class="badge bg-success">Terverifikasi</span>
                                        @else
                                            <span class="badge bg-warning">Menunggu Verifikasi</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada pembayaran sebelumnya.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ confirmation part end =================-->

@push('scripts')

{{-- SCRIPT NAVBAR BERUBAH SAAT DI SCROLL --}}
<script>
    const navbar = document.querySelector('.main_menu');
    const navLinks = document.querySelectorAll('.nav-link'); // Semua elemen link navbar

    window.addEventListener('scroll', () => {
        const bannerHeight = document.querySelector('.banner_part').offsetHeight;

        if (window.scrollY > bannerHeight) {
            // Ubah warna navbar dan font setelah scroll
            // navbar.style.background = '#7cafc8'; // Background warna solid setelah scroll
            navbar.style.backdropFilter = 'blur(100px)';
            // navbar.style.boxShadow = '0px 2px 5px rgba(255, 255, 255, 0.5)';
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
@endpush
@endsection
