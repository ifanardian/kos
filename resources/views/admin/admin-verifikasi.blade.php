@extends('layout-admin.app')

@section('title', 'Verifikasi Pembayaran')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verifikasi Calon Penghuni</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Tambah Data</a>
                <table class="table table-sm">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama Penyewa</th>
                        <th scope="col">No HP</th>
                        <th scope="col">Email</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Tipe Kamar</th>
                        <th scope="col">Harga</th>
                        <th scope="col">KTP</th>
                        <th scope="col">Tanggal Pemesanan</th>
                        <th scope="col">Periode Penempatan</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $item)
                        <tr>
                          
                          <th scope="row">{{ $item->id }}</th>
                          <td>{{ $item->nama_lengkap }}</td>
                          <td>{{ $item->no_hp }}</td>
                          <td>{{$item->email}}</td>
                          <td>{{$item->alamat}}</td>
                          <td>
                            <?php
                              foreach($tipe as $t){
                                if($item->tipe == $t->tipe_kos){
                                  echo $t->deskripsi;
                                }
                              }
                              
                            ?>
                          </td>
                          <td>{{'harga'}}</td>
                          <td>
                            <a href="{{ route('admin.ktp', ['filename' => $item->ktp]) }}" >
                              <img src="{{ route('admin.ktp', ['filename' => $item->ktp]) }}" alt="KTP" style="width:100px;height:auto;">
                            </a>
                          </td>
                          <td>{{ $item->created_at }}</td>
                          <td>{{ $item->tanggal_pesan }}</td>
                          <td>
                            <form id="form-update-status" action="{{ route('admin.update.statusbooking') }}" method="POST">
                              @csrf
                              <input type="hidden" id="id" name="id" value="{{ $item->id }}">
                              <select name="status" onchange="this.form.submit()">
                                <option value="PENDING" {{ $item->status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                <option value="APPROVED" {{ $item->status == 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
                                <option value="REJECTED" {{ $item->status == 'REJECT' ? 'selected' : '' }}>REJECTED</option>
                              </select>
                            </form>
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
