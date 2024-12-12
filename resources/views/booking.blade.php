@extends('layout.layout')
@section('title', 'Booking | Kos Fortuna')
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
<section class="checkout_area padding_top">
    <div class="container">
        <div class="returning_customer">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Detail Pembayaran</h3>
                        <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                            <div class="col-md-11 form-group p_star">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" required />
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="number">No HP (WhatsApp)</label>
                                <input type="text" class="form-control" id="number" name="number" required />
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="email">Alamat Email</label>
                                <input type="text" class="form-control" id="email" name="email" required />
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="address">Alamat Lengkap</label>
                                <textarea class="form-control" name="address" id="address" placeholder="(isi alamat lengkap sesuai KTP)" rows="1"></textarea>
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="ktp">Unggah foto KTP</label>
                                <input type="file" class="form-control file-upload" id="ktp" name="ktp"
                                    accept=".jpg, .jpeg" required />
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="email">Periode Penempatan</label>
                                <input type="text" class="form-control" id="periode" name="periode" placeholder="(cth: November 2024)" required />
                            </div>
                            <div class="col-md-11 form-group p_star">
                                <label for="bookingDate">Tanggal Pemesanan</label>
                                <input type="date" class="form-control" id="bookingDate" name="booking_date" required
                                    min="{{ date('Y-m-d') }}" />
                            </div>
                            <div class="col-md-11 form-group">
                                <label for="message">Order Notes</label>
                                <textarea class="form-control" name="message" id="message" rows="1"></textarea>
                            </div>
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
                            {{-- <a class="btn_3" id="openPopupBtn" type="submit" href="{{ route('checkout') }}">BOOK</a> --}}
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
    // Ambil elemen
    const popup = document.getElementById('popup');
    const bookBtn = document.getElementById('bookBtn');
    const closePopupBtn = document.getElementById('closePopupBtn');
    const popupMessage = document.getElementById('popupMessage');

    // Fungsi untuk mengirim data dan menampilkan pop-up
    bookBtn.addEventListener('click', (e) => {
    e.preventDefault(); // Mencegah aksi default link

    // Kirim data ke server menggunakan AJAX
    const formData = new FormData();
    formData.append('nama', 'John Doe');
    formData.append('email', 'john.doe@example.com');
    formData.append('pesan', 'Pesan dari John Doe');

    fetch('/api/pesan', {
        method: 'POST',
        body: formData
    })
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

@endsection
