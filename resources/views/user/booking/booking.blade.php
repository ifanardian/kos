@extends('user.layout.layout')
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
                            {{-- <a class="btn_3" id="bookButton" type="submit">BOOK</a> --}}

                            <button class="btn_3" id="bookBtn" type="submit" href="#">BOOK</button>
                            
                            <!-- Struktur pop-up -->
                            <div id="popup" class="popup">
                                <div class="popup-content">
                                    <span id="closePopupBtn" class="close-btn">&times;</span>
                                    <h2>Pop-up Title</h2>
                                    <p>This is a pop-up message!</p>
                                    <button id="confirmBtn">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!--================End Checkout Area =================-->
<script>
    // document.getElementById('bookButton').addEventListener('click', function () {
    //     document.getElementById('formBook').submit();
    // });

    // Ambil elemen
    const popup = document.getElementById('popup');
    const bookBtn = document.getElementById('bookBtn');
    const closePopupBtn = document.getElementById('closePopupBtn');
    const popupMessage = document.getElementById('popupMessage');

    // Fungsi untuk mengirim data dan menampilkan pop-up
    bookBtn.addEventListener('click', (e) => {
        e.preventDefault(); // Mencegah aksi default link

        // fetch('/api/pesan', {
        //     method: 'POST',
        //     body: formData
        // })

        document.getElementById('bookButton').addEventListener('click', function () {
            document.getElementById('formBook').submit();
        });
        .then(response => response.json())
        .then(data => {
            if (data.success) {
            popupMessage.textContent = 'Pemesanan berhasil dilakukan!';
            popup.style.display = 'flex'; // Tampilkan pop-up
            } else {
            popupMessage.textContent = 'Gagal melakukan pemesanan!';
            popup.style.display = 'flex'; // Tampilkan pop-up
            }
        })
        .catch(error => {
            console.error(error);
        });
    });

    // Fungsi untuk menutup pop-up
    closePopupBtn.addEventListener('click', () => {
        popup.style.display = 'none'; // Sembunyikan pop-up
    });

    // Menutup pop-up jika klik di luar area konten
    window.addEventListener('click', (e) => {
        if (e.target === popup) {
            popup.style.display = 'none';
        }
    });
</script>

<script>
    // const navbar = document.querySelector('.main_menu');

    // window.addEventListener('scroll', () => {
    //     const bannerHeight = document.querySelector('.banner_part').offsetHeight;
    //     if (window.scrollY > bannerHeight) {
    //         navbar.style.background = '#7cbfc8'; // Warna setelah scroll
    //         navbar.style.boxShadow = '0px 2px 5px rgba(255, 255, 255, 0.5);';
    //     } else {
    //         navbar.style.background = 'transparent'; // Transparan saat di atas banner
    //         navbar.style.boxShadow = 'none';
    //     }
    //     });

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
@endsection
