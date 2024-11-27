<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contoh book</title>
</head>
<body>
    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label for="tipe">Tipe Kamar:</label>
            <select name="tipe" id="tipe">
            <option value="1">BULANAN | 200k</option>
            <option value="2">TAHUNAN | 1M</option>
            </select>
        </div>
        <div>
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap">
        </div>
        <div>
            <label for="no_hp">No HP:</label>
            <input type="text" name="no_hp" id="no_hp">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="alamat">Alamat:</label>
            <textarea name="alamat" id="alamat"></textarea>
        </div>
        <div>
            <label for="ktp_file_path">Upload KTP:</label>
            <input type="file" name="ktp" id="ktp">
        </div>
        <div>
            <label for="tanggal_pesan">Tanggal Pesan</label>
            <input type="date" name="tanggal_pesan" id="tanggal_pesan">
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>