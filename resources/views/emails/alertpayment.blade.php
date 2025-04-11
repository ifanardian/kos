<!DOCTYPE html>
<html>
<head>
    <title>Pengingat Pembayaran</title>
</head>
<body>
    <h1>Pengingat Pembayaran</h1>
    <p>Yth. {{ $user->nama }},</p>
    <p>Ini adalah pengingat bahwa pembayaran Anda sebesar {{ $langganan->harga }} jatuh tempo pada {{ $user->tanggal_jatuh_tempo }} (tersisa {{$sisa}} hari).</p>
    <p>Harap pastikan untuk menyelesaikan pembayaran sebelum tanggal jatuh tempo. Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi kami.</p>
    <p>Terima kasih atas perhatian Anda.</p>
    <p>Salam hormat,</p>
    <p>FORTUNA KOST</p>
</body>
</html>