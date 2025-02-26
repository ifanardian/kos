@extends('layout-admin.app')

@section('title', 'Kelola Kamar')

@section('content')

<style>
    .form-control {
        font-size: 30px;
        border: none;
        border-bottom: 2px solid #ccc;
        border-radius: 0;
        box-shadow: none;
        width: 170px;
        /* Sesuaikan lebar input */
        display: inline-block;
    }

    .form-control:focus {
        border-bottom: 2px solid #007bff;
        outline: none;
        box-shadow: none;
    }

    .input-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .price-text {
        font-size: 30px;
        font-weight: bold;
    }

</style>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Kamar</h1>
    </div>

    <div class='col-xl col-lg-7'>
        <div class='card shadow mb-4'>
            <div class='card-header py-3 d-flex flex-row align-items-center justify-content-between'>
                <h6 class='m-0 font-weight-bold text-primary'>List Langganan Kos</h6>
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#editModal">
                    <i class='fas fa-plus fa-sm text-white-50'></i> Tambah Data
                </button>
            </div>
                <div class='row'>
                <?php
                    if($msTipe){
                        foreach($msTipe as $harga){
                            echo"
                                
                                    <div class='col-md-6'>
                                        <div class='card shadow mb-4'>
                                            <div class='card-header py-3'>
                                                <h6 class='m-0 font-weight-bold text-primary'>Harga Kos ".$harga->deskripsi."</h6>
                                            </div>
                                            <div class='card-body'>
                                                <form action='".route('admin.harga_kamar.update')."' method='POST'
                                                    onsubmit='cleanCurrencyInput()'>
                                                    ".csrf_field()."
                                                    <input type='hidden' name='tipe' value='bulanan'>
                                                    <div class='text-center mb-3'>
                                                        <div class='input-container'>
                                                            <span class='price-text'>Rp</span>
                                                            <input type='text' class='form-control' name='harga' id='hargaBulananInput' style='width: 145px;'
                                                                value='".number_format($harga->harga, 0, ',', '.')."' required>
                                                        </div>
                                                        <br>
                                                        <button type='submit' class='btn btn-primary'>Update Harga</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                
                            ";
                        }
                    }else{
                        echo"
                            <div class='card-body'>
                                <h6 class='m-0 font-weight-bold text-primary' style='text-align: center;';>TIDAK ADA DATA</h6>
                            </div>
                        ";
                    }
            
        ?>
        </div>
    </div>

    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Kelola Kamar</h6>
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#editModal2">
                    <i class='fas fa-plus fa-sm text-white-50'></i> Tambah Data
                </button>
            </div>
            <div class='card-body'>
                
                <?php
                if($kamar){
                    echo"
                        <div class='card-body'>
                            <table class='table table-sm'>
                                <thead>
                                    <tr>
                                        <th scope='col'>No. Kamar</th>
                                        <th scope='col'>Status</th>
                                        <th scope='col'>Penyewa</th>
                                        <th scope='col'>Tipe Kamar</th>
                                        <th scope='col'>Jatuh Tempo</th>
                                        <th scope='col'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                        ";
                    
                    foreach($kamar as $k){
                        $status = $k->status === 'T' ? 'Tersewa' : 'Kosong';
                        $nama = $k->nama ?? '-';
                        $deskripsi = $k->deskripsi ?? '-';
                        $tanggal = $k->tanggal_jatuh_tempo ?? '-';
                        echo"
                            <tr>
                                <th scope='row'>".$k->id_kamar."</th>
                                <td>". $status ."</td>
                                <td>". $nama ."</td>
                                <td>". $deskripsi ."</td>
                                <td>". $tanggal ."</td>
                                <td>
                                    <button>Tombol</button>
                                </td>
                            </tr>
                        ";
                    }
                    echo"
                                </tbody>
                            </table>
                        </div>
                    ";
                }else{
                    echo"
                    <div class='table-responsive'>
                        <table class='table table-sm'>
                            <thead>
                                <tr>
                                    <th scope='col'>No. Kamar</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'>Penyewa</th>
                                    <th scope='col'>Tipe Kamar</th>
                                    <th scope='col'>Jatuh Tempo</th>
                                    <th scope='col'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <td colspan='6' rowspan='2'>
                                        <h6 class='m-0 font-weight-bold text-primary' style='text-align: center;';>TIDAK ADA DATA</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    ";
                }
            
            
            ?>
            </div>
        </div>

    </div>

</div>

<!-- /.container-fluid -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal">Tambah Data Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="msTipeKos" action="{{route('post.admin.tipekos')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="harga" class="form-label">harga</label>
                        <input type="nummber" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="bulan" class="form-label">jumlah bulan</label>
                        <input type="text" class="form-control" id="bulan" name="bulan" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

   

<!-- /.container-fluid -->
<div class="modal fade" id="editModal2" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal">Tambah Data Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="msTipeKos" action="{{route('post.admin.kamar')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="noKamar" class="form-label">No. Kamar</label>
                        <input type="nummber" class="form-control" id="noKamar" name="noKamar" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- /.container-fluid -->



<script>
    // Fungsi untuk format angka dengan titik sebagai pemisah ribuan
    function formatCurrency(value) {
        // Menghapus semua karakter selain angka
        value = value.replace(/\D/g, '');
        // Menambahkan titik setiap tiga digit
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Fungsi untuk membersihkan format saat form disubmit
    function cleanCurrencyInput() {
        // Hapus titik sebelum pengiriman data
        let hargaBulananInput = document.getElementById('hargaBulananInput');
        let hargaTahunanInput = document.getElementById('hargaTahunanInput');

        // Hapus titik di input sebelum mengirimkan form
        hargaBulananInput.value = hargaBulananInput.value.replace(/\D/g, '');
        hargaTahunanInput.value = hargaTahunanInput.value.replace(/\D/g, '');
    }

    // Menangani input pada Harga Bulanan
    document.getElementById('hargaBulananInput').addEventListener('input', function () {
        let formattedValue = formatCurrency(this.value);
        this.value = formattedValue; // Update nilai di input
    });

    // Menangani input pada Harga Tahunan
    document.getElementById('hargaTahunanInput').addEventListener('input', function () {
        let formattedValue = formatCurrency(this.value);
        this.value = formattedValue; // Update nilai di input
    });
</script>
@endsection

