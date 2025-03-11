@extends('layout.layout')
@section('title', 'Booking | Kos Fortuna')

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

    .is-invalid {
        border-color: red;
        background-color: #f8d7da;
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
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required />
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
                                <option value="">-- Pilih Tipe Kamar --</option>
                                @foreach ($tipeKos as $tipe)
                                {{-- lama --}}
                                {{-- <option value="{{ $tipe->id }}">{{ $tipe->deskripsi	}} | Rp {{ number_format($tipe->harga, 0, ',', '.') }}
                                </option> --}}
                                {{-- fiona coba --}}
                                <option value="{{ $tipe->id }}" {{-- $selectedTipe == $tipe->id ? 'selected' : '' --}}>
                                    {{ $tipe->deskripsi }} | Rp {{ number_format($tipe->harga, 0, ',', '.') }}
                                </option>
                                {{-- <option value="{{ $tipe->id }}" {{ old('tipe_kos') == $tipe->id ? 'selected' : '' }}>
                                    {{ $tipe->deskripsi }} | Rp {{ number_format($tipe->harga, 0, ',', '.') }}
                                </option> --}}
                                
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-11 form-group p_star">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" id="alamat"
                                placeholder="(isi alamat lengkap sesuai KTP)" rows="1" required></textarea>
                        </div>
                        <div class="col-md-11 form-group p_star">
                            <label for="ktp">Unggah foto KTP</label>
                            <input type="file" class="form-control file-upload" id="ktp" name="ktp" accept=".jpg, .jpeg"
                                required />
                        </div>
                        <div class="col-md-11 form-group p_star">
                            <label for="periode_penempatan">Periode Penempatan</label>
                            <input type="date" class="form-control" id="periode_penempatan" name="periode_penempatan"
                                required min="{{ date('Y-m-d') }}" />
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
                        <div class="password text-center">
                            <a class="btn_3" id="bookButton" type="submit">BOOKING</a>
                        </div>

                        {{-- fiona coba popup --}}
                        {{-- <button class="btn_3" id="bookButton" form="formBook" type="button">BOOK</button> --}}
                        {{-- end --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- custom js -->
<script src="js/custom.js"></script>
{{-- lama --}}
<script>
    document.getElementById('bookButton').addEventListener('click', function() {
        document.getElementById('formBook').submit();
    });
</script>

{{-- fiona coba validasi form --}}
<script>
    document.getElementById('bookButton').addEventListener('click', function (event) {
        // Prevent default submission
        event.preventDefault();

        // Select the form and its fields
        const form = document.getElementById('formBook');
        console.log('Form:', form);
        const fields = form.querySelectorAll('[required]');
        let isValid = true;

        // Check each required field
        fields.forEach(field => {
            if (!field.value.trim()) {
                console.log(`Field ${field.name || field.id} is invalid`);
                isValid = false;
                field.classList.add('is-invalid'); // Optional: Add a visual indicator
            } else {
                field.classList.remove('is-invalid'); // Remove the indicator if valid
            }
        });

        // If all fields are valid, submit the form
        if (isValid) {
            alert('Booking berhasil! Harap menunggu email.');
            form.submit();
        } else {
            alert('Harap isi semua field yang wajib diisi.');
        }
    });
</script>


<script>
    const navbar = document.querySelector('.main_menu');
    const navLinks = document.querySelectorAll('.nav-link, .navbar-brand, .navbar-toggler'); // Semua elemen link navbar

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
@endsection
