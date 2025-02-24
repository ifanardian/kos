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
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    @php
    $hargaBulanan = \App\Models\MsTipeKos::where('bulan', 1)->first();
    $hargaTahunan = \App\Models\MsTipeKos::where('bulan', 12)->first();
    @endphp
    <div class="row">
        <!-- Harga Bulanan -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Harga Kos Bulanan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.harga_kamar.update') }}" method="POST"
                        onsubmit="cleanCurrencyInput()">
                        @csrf
                        <input type="hidden" name="tipe" value="bulanan">
                        <div class="text-center mb-3">
                            <div class="input-container">
                                <span class="price-text">Rp</span>
                                <input type="text" class="form-control" name="harga" id="hargaBulananInput"
                                    style="width: 145px;"
                                    value="{{ number_format($hargaBulanan->harga ?? 400000, 0, ',', '.') }}" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Update Harga</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Harga Tahunan -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Harga Kos Tahunan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.harga_kamar.update') }}" method="POST"
                        onsubmit="cleanCurrencyInput()">
                        @csrf
                        <input type="hidden" name="tipe" value="tahunan">
                        <div class="text-center mb-3">
                            <div class="input-container">
                                <span class="price-text">Rp</span>
                                <input type="text" class="form-control" name="harga" id="hargaTahunanInput"
                                    value="{{ number_format($hargaTahunan->harga ?? 4400000, 0, ',', '.') }}" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Update Harga</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Kelola Ketersediaan Kamar</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">No. Kamar</th>
                                <th scope="col">Tipe Kamar</th>
                                <th scope="col">Penyewa</th>
                                <th scope="col">Status</th>
                                <th scope="col">Jatuh Tempo</th>
                                <th scope="col">Action</th>
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

</div>
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
