@extends('layout.layout')
@section('title', 'Tagihan Bulanan | Kos Fortuna')
@section('content')
<!--================Home Banner Area =================-->
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item">
                        <h2>Upload Tagihan</h2>
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
            <div class="row">
                <div class="col-lg-7">
                    {{-- <h3>Detail Pembayaran</h3> --}}
                    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="col-md-11 form-group p_star">
                            <label for="no">No Kamar</label>
                            <input type="text" class="form-control" id="nokamar" name="nokamar" required />
                        </div>
                        <div class="col-md-11 form-group p_star">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" required />
                        </div>
                        <div class="col-md-11 form-group p_star">
                            <label for="bookingDate">Tanggal Pembayaran</label>
                            <input type="date" class="form-control" id="bookingDate" name="booking_date" required
                                min="{{ date('Y-m-d') }}" />
                        </div>
                        <div class="col-md-11 form-group p_star">
                            <label for="email">Periode Pembayaran</label>
                            <input type="text" class="form-control" id="periode" name="periode"
                                placeholder="(cth: November 2024)" required />
                        </div>
                        <div class="col-md-11 form-group p_star">
                            <label for="ktp">Unggah Bukti</label>
                            <input type="file" class="form-control file-upload" id="ktp" name="ktp" accept=".jpg, .jpeg"
                                required />
                        </div>
                        <div class="order-box"
                            style="margin-top: 30px; width: 600px; padding: 15px 0; text-decoration:none">
                            <a class="btn_3" type="submit" href="#">KIRIM</a>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="order_box">
                        <h2>Detail</h2>
                        <div class="payment_item">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal Pembayaran</th>
                                        <th scope="col">Periode Pembayaran</th>
                                        <th scope="col">Nominal</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
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
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ confirmation part end =================-->
@endsection
