@extends('layout-admin.app')

@section('title', 'Data Penyewa Kos')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penyewa</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Tambah Data</a>
                    <table class="table table-sm">
                        <thead>
                          <tr>
                            <th scope="col">email</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">No Kamar</th>
                            <th scope="col">Foto KTP</th>
                            <th scope="col">Status</th>
                            <th scope="col">Periode</th>
                            <th scope="col">Jatuh Tempo</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($data as $item)
                            <tr>
                              <th scope="row">{{$item->email}}</th>
                              <td>{{$item->nama}}</td>
                              <td>{{$item->no_telepon}}</td>
                              <td>{{$item->no_kamar}}</td>
                              <td>
                                <a href="{{ route('admin.ktp', ['filename' => $item->ktp]) }}" >
                                  <img src="{{ route('admin.ktp', ['filename' => $item->ktp]) }}" alt="KTP" style="width:100px;height:auto;">
                                </a>
                              </td>
                              <td>{{$item->status}}</td>
                              <td>{{$item->tanggal_menyewa}}</td>
                              <td>{{$item->tanggal_jatuh_tempo}}</td>
                              <td>@mdo</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>

</div>
<!-- /.container-fluid -->
@endsection
