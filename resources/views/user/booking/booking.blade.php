@extends('user.layout.layout')
@section('title', 'Checkout')
{{-- @push('styles')
    <style>
        body {
            background-color: #021526;
        }
    </style>
@endpush --}}
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
                        <p>Home <span>-</span> Booking Kamar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!--================Checkout Area =================-->

<section class="checkout_area padding_top">
    <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-7">
                        <form id="formBook" action="{{ route('checkout.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-11 form-group p_star">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                    required />
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="no_hp">No HP (WhatsApp)</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" required />
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="email">Alamat Email</label>
                                <input type="email" class="form-control" id="email" name="email" required />
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="tipe_kos">Tipe Kamar</label>
                                <select class="form-control" id="tipe_kos" name="tipe_kos">
                                    @foreach ($tipeKos as $tipe)
                                    <option value="{{ $tipe->id }}">{{ $tipe->deskripsi	}} || Rp. {{ $tipe->harga }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="alamat">Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat" id="alamat"
                                    placeholder="(isi alamat lengkap sesuai KTP)" rows="1"></textarea>
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="ktp">Unggah foto KTP</label>
                                <input type="file" class="form-control file-upload" id="ktp" name="ktp"
                                    accept=".jpg, .jpeg" required />
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="periode_penempatan">Periode Penempatan</label>
                                <input type="date" class="form-control" id="periode_penempatan"
                                    name="periode_penempatan" required min="{{ date('Y-m-d') }}"/>
                            </div>
                            <div class="col-md-11 form-group">
                                <label for="note">Order Notes</label>
                                <textarea class="form-control" name="note" id="note" rows="1"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <div class="order_box">
                            <h2>Perhatian!</h2>
                            <div class="payment_item">
                                <p>
                                    Silahkan isi form untuk melakukan booking kamar kos,
                                    Anda akan bisa melakukan pembayaran setelah admin mengkonfirmasi booking Anda.
                                    Verifikasi akan dikirim via email. Pastikan data yang Anda kirim lengkap dan valid
                                </p>
                            </div>
                            <a class="btn_3" id="bookButton" type="submit">BOOK</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!--================End Checkout Area =================-->
<!-- custom js -->
<script src="js/custom.js"></script>
<script>
    document.getElementById('bookButton').addEventListener('click', function () {
        document.getElementById('formBook').submit();
    });
</script>
@endsection
