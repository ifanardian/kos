@extends('layout-admin.app')

@section('title', 'Riwayat Pembayaran Bulanan')

@section('content')
<h2>Riwayat Pembayaran</h2>
<table class="table table-hover mt-3">
    <thead class="table-dark">
        <tr>
            <th>Nama Penyewa</th>
            <th>Kamar</th>
            <th>Jumlah</th>
            <th>Status Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>John Doe</td>
            <td>101</td>
            <td>Rp 1,000,000</td>
            <td><span class="badge bg-success">Lunas</span></td>
        </tr>
        <tr>
            <td>Jane Smith</td>
            <td>102</td>
            <td>Rp 1,500,000</td>
            <td><span class="badge bg-danger">Belum Lunas</span></td>
        </tr>
    </tbody>
</table>
@endsection