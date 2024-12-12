<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- Tombol untuk membuka pop-up -->
    <button id="openPopupBtn">Open Pop-up</button>

    <!-- Struktur pop-up -->
    <div id="popup" class="popup">
    <div class="popup-content">
        <span id="closePopupBtn" class="close-btn">&times;</span>
        <h2>Pop-up Title</h2>
        <p>This is a pop-up message!</p>
        <button id="confirmBtn">Confirm</button>
    </div>
    </div>

</body>
<script>
    // Ambil elemen
    const popup = document.getElementById('popup');
    const openPopupBtn = document.getElementById('openPopupBtn');
    const closePopupBtn = document.getElementById('closePopupBtn');

    // Fungsi untuk membuka pop-up
    openPopupBtn.addEventListener('click', () => {
    popup.style.display = 'flex'; // Tampilkan pop-up
    });

    // Fungsi untuk menutup pop-up
    closePopupBtn.addEventListener('click', () => {
    popup.style.display = 'none'; // Sembunyikan pop-up
    });

    // Tutup pop-up jika klik di luar area konten
    window.addEventListener('click', (e) => {
    if (e.target === popup) {
        popup.style.display = 'none';
    }
    });

</script>
</html>