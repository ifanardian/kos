@extends('layout-admin.app')

@section('title', 'Kelola Kamar')

@section('content')
<h2>Kelola Kamar</h2>
<a href="#" class="btn btn-primary mb-3">Tambah Kamar</a>
<table class="table table-bordered">
    <thead>
        <tr class="table-secondary">
            <th>Nomor Kamar</th>
            <th>Tipe Kamar</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>101</td>
            <td>Standar</td>
            <td>Rp 1,000,000</td>
            <td>Kosong</td>
            <td>
                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <tr>
            <td>102</td>
            <td>Deluxe</td>
            <td>Rp 1,500,000</td>
            <td>Terisi</td>
            <td>
                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
    </tbody>
</table>
@endsection