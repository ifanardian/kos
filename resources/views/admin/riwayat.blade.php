@extends('layout-admin.app')

@section('title', 'Riwayat Pembayaran Bulanan')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Pembayaran</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Tambah Data</a>
                <table class="table table-sm">
                    <thead class="thead-center">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama Penyewa</th>
                        <th scope="col">No Kamar</th>
                        <th scope="col">Tanggal Pembayaran</th>
                        <th scope="col">Periode Pembayaran</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Metode Pembayaran</th>
                        <th scope="col">Status</th>
                        <th scope="col">Bukti Pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
