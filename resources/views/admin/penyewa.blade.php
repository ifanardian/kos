@extends('layout-admin.app')

@section('title', 'Data Penyewa Kos')

@section('content')
<h2>Data Penyewa Kos</h2>
<table class="table table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>Nama</th>
            <th>Kamar</th>
            <th>Tanggal Mulai Sewa</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>John Doe</td>
            <td>101</td>
            <td>2024-01-01</td>
            <td>Aktif</td>
        </tr>
        <tr>
            <td>Jane Smith</td>
            <td>102</td>
            <td>2024-02-01</td>
            <td>Aktif</td>
        </tr>
    </tbody>
</table>
@endsection