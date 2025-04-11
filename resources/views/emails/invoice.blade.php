<!DOCTYPE html>
<html>
<head>
    <title>FORTUNA KOS</title>
</head>
<body>
    <h1>Halo, {{ $user->nama }}</h1>
    @if($status == '1')
    <h4>Selamat Pembayaranan Anda Telah Dikonfirmasi</h4>
    <p>Terima kasih atas pembayaran Anda.</p>
    @elseif($status == '0')
    <h4>Pembayaranan Anda Gagal</h4>
    <p>Harap segera melakukan pembayaran agar dapat segera di konfirmasi.</p>
    @endif
    <p>Terima kasih.</p>
</body>
</html>
