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
                    <form id="form-update-status" action="{{ route('update.status.booking', $item->id) }}" method="POST">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $item->id }}">
                        <select name="status" onchange="this.form.submit()">
                            <option value="PENDING" {{ $item->status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                            <option value="APPROVED" {{ $item->status == 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
                            <option value="REJECTED" {{ $item->status == 'REJECT' ? 'selected' : '' }}>REJECTED</option>
                        </select>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        document.getElementById('status').addEventListener('change', function() {
            document.getElementById('form-update-status').submit();
        });
    </script>
</body>
</html>