<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Tipe</th>
                <th>Nama Lengkap</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>KTP</th>
                <th>Tanggal Pesan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->tipe }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                        <a href="{{ route('ktp.show', ['filename' => $item->ktp]) }}" >
                            <img src="{{ route('ktp.show', ['filename' => $item->ktp]) }}" alt="KTP" style="width:100px;height:auto;">
                        </a>
                    </td>
                    <td>{{ $item->tanggal_pesan }}</td>
                    <td>
                        {{ $item->status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>