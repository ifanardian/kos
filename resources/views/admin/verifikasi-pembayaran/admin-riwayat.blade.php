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
                        class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
                <div class="table-responsive">
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
                                <th scope="col">Status Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                if(count($data)>0){
                                    foreach ($data as $dt) {
                                        if ($dt->status_verifikasi == '0') {
                                            echo "<tr style='color: Red;'>";
                                        } else if ($dt->status_verifikasi == '1') {
                                            echo "<tr style='color: Green;'>";
                                        }else{
                                            echo "<tr>";
                                        }
                                        echo "
                                            <td>" . DB::table('penyewa')->where('id_penyewa', $dt->id_penyewa)->value('email') . "</td>
                                            <td>" . DB::table('penyewa')->where('id_penyewa', $dt->id_penyewa)->value('nama') . "</td>
                                            <td>" . DB::table('penyewa')->where('id_penyewa', $dt->id_penyewa)->value('no_kamar') . "</td>
                                            <td>" . ($dt->tanggal_pembayaran ??  'belum bayar') . "</td>
                                            <td>" . $dt->periode_tagihan . "</td>
                                            <td>" . $dt->total_tagihan . "</td>
                                            <td>" . $dt->metode_pembayaran . "</td>
                                        ";

                                        if ($dt->bukti_pembayaran != null) {
                                            echo "
                                                <td>
                                                    <a href='" . route('admin.payment.gambar', ['filename' => $dt->bukti_pembayaran]) . "'>
                                                        <img src='" . route('admin.payment.gambar', ['filename' => $dt->bukti_pembayaran]) . "' alt='tf'
                                                            style='width:100px;height:auto;'>
                                                    </a>
                                                </td>
                                            ";
                                        } else {
                                            echo "
                                                <td>
                                                    Tidak Ada Bukti Pembayaran
                                                </td>
                                            ";
                                        }

                                        echo "
                                            <td>
                                                <form action='" . route('admin.payment') . "' method='POST'>
                                                    " . csrf_field() . "
                                                    <input type='hidden' name='id_penyewa' value='" . $dt->id_penyewa . "'>
                                                    <input type='hidden' name='periode_tagihan' value='" . $dt->periode_tagihan . "'>
                                                    <input type='hidden' name='created_at' value='" . $dt->created_at . "'>
                                                    <select class='form-control' name='status' onchange='this.form.submit()' ".($dt->status_verifikasi == '0'||$dt->status_verifikasi == '1' ? 'disabled' : '' ).">
                                                        <option value=''" . ($dt->status_verifikasi == null ? 'selected' : '') .">Pilih</option>
                                                        <option value='0' " . ($dt->status_verifikasi == '0' ? 'selected' : '') . " style='color:red;'>Ditolak</option>
                                                        <option value='1' " . ($dt->status_verifikasi == '1' ? 'selected ' : '') . " style='color:green;'>Disetuji</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>";
                                    }
                                }
                                else{
                                    echo"
                                        <tr>
                                            <td colspan = '9'> 
                                                <h6 class='m-0 font-weight-bold text-primary' style='text-align: center;';>TIDAK ADA DATA</h6>
                                            </td>
                                        </tr>
                                    ";
                                }
                            ?>

                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    document.getElementById('status').addEventListener('change', function () {
        document.getElementById('form-update-status').submit();
    });

</script>
@endsection
