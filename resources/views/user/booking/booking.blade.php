@extends('user.layout.layout')
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
                        {{-- <a class="btn_3" id="bookButton" type="submit">BOOK</a> --}}

                        {{-- fiona coba popup --}}
                        <button class="btn_3" id="bookButton" type="submit">BOOK</button>
                        {{-- end --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Struktur Pop-up -->
<div id="popup" class="popup">
    <div class="popup-content">
        <span id="closePopupBtn" class="close-btn">&times;</span>
        <h3>Booking berhasil</h3>
        <p id="popupMessage"></p>
        <button id="confirmBtn">Close</button>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('bookButton').addEventListener('click', function () {
        document.getElementById('formBook').submit();
    });

    // Ambil elemen

    // // fiona coba popup
    // const popup = document.getElementById('popup');
    // const bookButton = document.getElementById('bookButton');
    // const closePopupBtn = document.getElementById('closePopupBtn');
    // const popupMessage = document.getElementById('popupMessage');
    // const formBook = document.getElementById('formBook');

    // // Fungsi untuk mengirim data dan menampilkan pop-up
    // bookButton.addEventListener('click', (e) => {
    //     e.preventDefault(); // Mencegah aksi default tombol submit

    //     // Kirim data form dengan Fetch API
    //     const formData = new FormData(formBook);

    //     fetch(formBook.action, {
    //             method: 'POST',
    //             body: formData,
    //         })
    //         .then(response => response.json {
    //             console.log('Raw Response:', response);
    //             return response.json();
    //         })
    //         .then(data => {
    //             console.log('Parsed Response:', data);
    //             if (data.success) {
    //                 popupMessage.textContent = 'Silahkan menunggu email konfirmasi dari admin.';
    //             } else {
    //                 popupMessage.textContent = 'Gagal melakukan pemesanan. Silakan coba lagi.';
    //             }
    //             popup.style.display = 'flex'; // Tampilkan pop-up
    //         })
    //         .catch(error => {
    //             console.error('Fetch Error:', error);
    //             popupMessage.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
    //             popup.style.display = 'flex'; // Tampilkan pop-up
    //         });
    // });

    // // Fungsi untuk menutup pop-up
    // closePopupBtn.addEventListener('click', () => {
    //     popup.style.display = 'none';
    // });

    // // Menutup pop-up jika klik di luar area konten
    // window.addEventListener('click', (e) => {
    //     if (e.target === popup) {
    //         popup.style.display = 'none';
    //     }
    // });

    // // Tombol "Confirm" pada pop-up
    // document.getElementById('confirmBtn').addEventListener('click', () => {
    //     popup.style.display = 'none';
    // });
    // // end fiona coba popup

</script>

<script>
    const navbar = document.querySelector('.main_menu');
    const navLinks = document.querySelectorAll('.nav-link, .navbar-brand'); // Semua elemen link navbar

    window.addEventListener('scroll', () => {
        const bannerHeight = document.querySelector('.breadcrumb, .breadcrumb_bg').offsetHeight;

        if (window.scrollY > bannerHeight) {
            // Ubah warna navbar dan font setelah scroll
            navbar.style.background = '#7cafc8'; // Background warna solid setelah scroll
            // navbar.style.backdropFilter = 'blur(100px)';
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
