@extends('layout-admin.app')

@section('title', 'Kelola Website')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Website</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Virtual Tour 360<sup>°</sup></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="text-center mb-3">
                    <!-- Preview Foto -->
                    <img id="currentPhoto" src="img/default-photo.png" alt="Foto Saat Ini"
                        style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
                </div>
                <!-- Form Ganti Foto -->
                <form id="photoForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="newPhoto">Ganti Foto</label>
                        <input type="file" class="form-control-file" id="newPhoto" name="photo" accept="image/*"
                            onchange="previewPhoto(event)">
                    </div>
                    <button type="submit" class="btn btn-primary">Unggah Foto</button>
                </form>
            </div>

        </div>
    </div>

    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Photo Grid</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="text-center mb-3">
                    <!-- Preview Foto -->
                    <img id="currentPhoto" src="img/default-photo.png" alt="Foto Saat Ini"
                        style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
                </div>
                <!-- Form Ganti Foto -->
                <form id="photoForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="newPhoto">Ganti Foto</label>
                        <input type="file" class="form-control-file" id="newPhoto" name="photo" accept="image/*"
                            onchange="previewPhoto(event)">
                    </div>
                    <button type="submit" class="btn btn-primary">Unggah Foto</button>
                </form>
            </div>

        </div>
    </div>

    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Kelola Ketersediaan Kamar</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Tambah Data</a>
                <table class="table table-sm">
                    <thead>
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

<script>
    function previewPhoto(event) {
        const photoPreview = document.getElementById('currentPhoto');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                photoPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Contoh: Simpan foto baru (opsional, tambahkan logika upload)
    const form = document.getElementById('photoForm');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        alert('Foto berhasil diunggah!');
        // Tambahkan logika unggah foto ke server di sini
    });

</script>

<!-- /.container-fluid -->
@endsection
