@extends('layout-admin.app')

@section('title', 'Riwayat Pembayaran Bulanan')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Pembayaran</h1>
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
                    <thead class="thead-center">
                      <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Nama Penyewa</th>
                        <th scope="col">No Kamar</th>
                        <th scope="col">Tanggal Pembayaran</th>
                        <th scope="col">Periode Pembayaran</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Metode Pembayaran</th>
                        <th scope="col">Bukti Pembayaran</th>
                        <th scope="col">Status verif</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $dt)
                      <?php
                        if($dt->status_verifikasi == '0'){
                            echo "<tr style =' color: Red;'>";
                        }else{
                            echo "<tr style =' color: Green;'>";
                        }
                      ?>
                          <td>{{$dt->email}}</td>
                          <td>{{DB::table('penyewa')->where('email', $dt->email)->value('nama')}}</td>
                          <td>{{DB::table('penyewa')->where('email', $dt->email)->value('no_kamar')}}</td>
                          <td>{{$dt->tanggal_pembayaran}}</td>
                          <td>{{$dt->periode_tagihan}}</td>
                          <td>{{$dt->total_tagihan}}</td>
                          <td>{{$dt->metode_pembayaran}}</td>
                          <td>
                            @if($dt->bukti_pembayaran != null)
                            <a href="{{ route('admin.buktitf', ['filename' => $dt->bukti_pembayaran]) }}" >
                                <img src="{{ route('admin.buktitf', ['filename' => $dt->bukti_pembayaran]) }}" alt="tf" style="width:100px;height:auto;">
                            </a>
                            @else
                              Tidak Ada Bukti Pembayaran
                            @endif
                          </td>
                          <td>
                          <form id="form-update-status" action="{{ route('admin.action.pembayaran') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $dt->email }}">
                            <input type="hidden" name="periode_tagihan" value="{{ $dt->periode_tagihan }}">
                            <input type="hidden" name="metode_pembayaran" value="{{ $dt->metode_pembayaran }}">
                            <select class="form-control" name="status" onchange="this.form.submit()">
                                <option value="0" {{ $dt->status_verifikasi == '0' ? 'selected' : '' }}>Belum Terverifikasi</option>
                                <option value="1" {{ $dt->status_verifikasi == '1' ? 'selected' : '' }}>Terverifikasi</option>
                            </select>
                          </form>
              

                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    document.getElementById('status').addEventListener('change', function() {
        document.getElementById('form-update-status').submit();
    });
</script>
@endsection
