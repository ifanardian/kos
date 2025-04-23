<!DOCTYPE html>
<html>
<head>
    <title>Pengingat Pembayaran</title>
</head>
<body>
    <h1>Pengingat Pembayaran</h1>
    <p>Yth. {{ $user->nama }},</p>
    <p>Ini adalah pengingat bahwa pembayaran Anda sebesar <strong>Rp {{ number_format($langganan->harga, 0, ',', '.') }}</strong> jatuh tempo pada <strong>{{ \Carbon\Carbon::parse($user->tanggal_jatuh_tempo)->translatedFormat('d F Y') }}</strong> (tersisa {{$sisa}} hari).</p>
    <p>Harap pastikan untuk menyelesaikan pembayaran sebelum tanggal jatuh tempo. Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi kami.</p>
    <p>Terima kasih atas perhatian Anda.</p>
    <p>Hormat kami,</p>
    <p>FORTUNA KOST</p>
</body>
</html>