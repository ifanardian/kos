@extends('layout-admin.app')

@section('title', 'Riwayat Pembayaran Bulanan')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Pembayaran</h1>
    </div>

    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <form method="GET" action="{{ route('admin.payment') }}" class="mb-3" id="searchForm">
                        <div class="input-group position-relative" style="width: 450px;">
                            <input 
                                type="text" 
                                name="search" 
                                id="searchInput" 
                                class="form-control" 
                                placeholder="Cari email/nama/no kamar/periode" 
                                value="{{ request('search') }}"
                            >
                    
                            @if(request('search'))
                                <button 
                                    type="button" 
                                    id="clearSearch" 
                                    class="btn position-absolute" 
                                    style="right: 90px; top: 50%; transform: translateY(-50%); z-index: 10;"
                                >
                                    &times;
                                </button>
                            @endif
                    
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" style="width: 90px;">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                
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
                                            <td>" . ($dt->tanggal_pembayaran ? \Carbon\Carbon::parse($dt->tanggal_pembayaran)->format('d-m-Y') : 'belum bayar') . "</td>
                                            <td>" . \Carbon\Carbon::parse($dt->periode_tagihan)->format('d-m-Y') . "</td>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const clearBtn = document.getElementById('clearSearch');
        const input = document.getElementById('searchInput');
        const form = document.getElementById('searchForm');

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                input.value = '';
                form.submit();
            });
        }
    });
</script>



@endsection
