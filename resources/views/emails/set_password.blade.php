<!DOCTYPE html>
<html>
<head>
    <title>AKTIVASI KOS</title>
</head>
<body>
    <h1>Selamat Datang, {{ $email }}</h1>
    <p>Silakan ikuti langkah-langkah berikut untuk melanjutkan proses pemesanan kos:</p>
    <ol style="margin-left: 20px;">
        <li>Buatlah kata sandi baru untuk dapat masuk ke akun Anda <a href="{{ $url_setpassword }}">disini</a>.</li>
        <li>Masuklah menggunakan alamat email yang Anda daftarkan beserta kata sandi baru.</li>
        <li>Masuk ke menu <a href="{{ $url_payment }}">Tagihan</a> untuk melakukan pembayaran kos.</li>
    </ol>
    <p>Terima kasih.</p>
    
</body>
</html>
