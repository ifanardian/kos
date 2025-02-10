@extends('layout-admin.app')

@section('title', 'Data Penghuni Kos')

@section('content')

<style>
    .nav-tabs .nav-link {
    background-color: #ebe8e8; /* Warna abu-abu untuk tab nonaktif */
    color: black;
    transition: background-color 0.3s, color 0.3s;
}

.nav-tabs .nav-link.active {
    background-color: #007bff !important; /* Warna biru untuk tab aktif */
    color: white !important;
    font-weight: bold;
}

</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penghuni</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Penghuni Aktif</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Riwayat Penghuni</button>
            </div>
        </nav>
        <div class="col-xl col-lg-7">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                    tabindex="0">
                    {{-- <div class="col-xl col-lg-7"> --}}
                    <div class="card shadow mb-4">
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table table-sm">
                                <thead class="thead-center">
                                    <tr>
                                        <th scope="col">No Kamar</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nomor Telepon</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Mulai Sewa</th>
                                        <th scope="col">Tanggal Berakhir</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($data as $item) --}}
                                    @foreach ($penghuniAktif as $item)
                                    <tr class="tr-center">
                                        <td>{{$item->no_kamar}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->no_telepon}}</td>
                                        {{-- <td>
                                            <a href="{{ route('admin.ktp', ['filename' => $item->ktp]) }}">
                                        <img src="{{ route('admin.ktp', ['filename' => $item->ktp]) }}" alt="KTP"
                                            style="width:100px;height:auto;">
                                        </a>
                                        </td> --}}
                                        {{-- lama --}}
                                        {{-- <td>{{$item->status_penyewaan ? 'Aktif' : 'Nonaktif'}}</td> --}}
                                        <td>
                                            <span class="{{ $item->status_penyewaan ? 'text-success' : 'text-danger' }}">
                                                {{ $item->status_penyewaan ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        
                                        {{-- fiona ganti ke dropdown --}}
                                        {{-- <td>
                                            <form id="form-update-status" action="{{ route('admin.penyewa') }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $item->email }}">
                                        <input type="hidden" name="no_telepon" value="{{ $item->no_telepon }}">
                                        <input type="hidden" name="no_kamar" value="{{ $item->no_kamar }}">
                                        <select class="form-control" name="status" onchange="this.form.submit()">
                                            <option value="0" {{ $item->status_penyewaan == '0' ? 'selected' : '' }}>
                                                Nonaktif</option>
                                            <option value="1" {{ $item->status_penyewaan == '1' ? 'selected' : '' }}>
                                                Aktif</option>
                                        </select>
                                        </form>
                                        </td> --}}
                                        <td>{{$item->tanggal_menyewa}}</td>
                                        <td>{{$item->tanggal_berakhir}}</td>
                                        <td>
                                            <div class="container">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editModal" data-email="{{ $item->email }}"
                                                    data-nama="{{ $item->nama }}"
                                                    data-no_telepon="{{ $item->no_telepon }}"
                                                    data-tipe_kos="{{ $item->tipe_kos }}"
                                                    data-alamat="{{ $item->alamat }}"
                                                    data-ktp-url="{{ route('admin.ktp', ['filename' => $item->ktp]) }}"
                                                    data-tanggal_menyewa="{{ $item->tanggal_menyewa }}"
                                                    data-tanggal_jatuh_tempo="{{ $item->tanggal_jatuh_tempo }}"
                                                    data-status_penyewaan="{{ $item->status_penyewaan }}"
                                                    data-tanggal_berakhir="{{ $item->tanggal_berakhir }}"
                                                    data-id="{{ $item->id }}">
                                                    <i class="bi bi-pencil-fill"></i> Edit
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <table class="table table-sm">
                                <thead class="thead-center">
                                    <tr>
                                        <th scope="col">No Kamar</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nomor Telepon</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Mulai Sewa</th>
                                        <th scope="col">Tanggal Berakhir</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penghuniRiwayat as $item)
                                    <tr class="tr-center">
                                        <td>{{$item->no_kamar}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->no_telepon}}</td>
                                        <td>
                                            <span class="{{ $item->status_penyewaan ? 'text-success' : 'text-danger' }}">
                                                {{ $item->status_penyewaan ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>                                        
                                        <td>{{$item->tanggal_menyewa}}</td>
                                        <td>{{$item->tanggal_berakhir}}</td>
                                        <td>
                                            <div class="container">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editModal" data-email="{{ $item->email }}"
                                                    data-nama="{{ $item->nama }}"
                                                    data-no_telepon="{{ $item->no_telepon }}"
                                                    data-tipe_kos="{{ $item->tipe_kos }}"
                                                    data-alamat="{{ $item->alamat }}"
                                                    data-ktp-url="{{ route('admin.ktp', ['filename' => $item->ktp]) }}"
                                                    data-tanggal_menyewa="{{ $item->tanggal_menyewa }}"
                                                    data-tanggal_jatuh_tempo="{{ $item->tanggal_jatuh_tempo }}"
                                                    data-status_penyewaan="{{ $item->status_penyewaan }}"
                                                    data-tanggal_berakhir="{{ $item->tanggal_berakhir }}"
                                                    data-id="{{ $item->id }}">
                                                    <i class="bi bi-pencil-fill"></i> Edit
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Penyewa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" action="{{ route('admin.penyewa.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="edit-id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="edit-email" name="email" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="edit-nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit-nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-no_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="edit-no_telepon" name="no_telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-tipe_kos" class="form-label">Tipe Kos</label>
                            <select class="form-control" id="edit-tipe_kos" name="tipe_kos" required>
                                <option value="1" {{ $item->tipe_kos == '1' ? 'selected' : '' }}>Bulanan</option>
                                <option value="2" {{ $item->tipe_kos == '2' ? 'selected' : '' }}>Tahunan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit-alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="edit-alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-ktp" class="form-label">Foto KTP</label>
                            <div class="mb-2">
                                <a href="{{ route('admin.ktp', ['filename' => $item->ktp]) }}" id="preview-ktp">
                                    <img src="{{ route('admin.ktp', ['filename' => $item->ktp]) }}?t={{ time() }}"
                                        alt="KTP" style="width:150px;height:auto;">
                                </a>
                            </div>
                            <input type="file" class="form-control" id="edit-ktp" name="ktp" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="edit-tanggal_menyewa" class="form-label">Tanggal Menyewa</label>
                            <input type="date" class="form-control" id="edit-tanggal_menyewa" name="tanggal_menyewa"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                            <input type="date" class="form-control" id="edit-tanggal_berakhir" name="tanggal_berakhir">
                        </div>
                        <div class="mb-3">
                            <label for="edit-status_penyewaan" class="form-label">Status Penyewaan</label>
                            <select class="form-control" id="edit-status_penyewaan" name="status_penyewaan">
                                <option value="0">Nonaktif</option>
                                <option value="1">Aktif</option>
                            </select>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        // document.getElementById('status').addEventListener('change', function () {
        //     document.getElementById('form-update-status').submit();
        // });

    </script>



    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            // Ambil data dari tombol
            const id = button.getAttribute('data-id');
            const email = button.getAttribute('data-email');
            const nama = button.getAttribute('data-nama');
            const noTelepon = button.getAttribute('data-no_telepon');
            const tipeKos = button.getAttribute('data-tipe_kos');
            const alamat = button.getAttribute('data-alamat');
            const tanggalMenyewa = button.getAttribute('data-tanggal_menyewa');
            const tanggalBerakhir = button.getAttribute('data-tanggal_berakhir');
            const statusPenyewaan = button.getAttribute('data-status_penyewaan');
            const ktpUrl = button.getAttribute('data-ktp-url');

            // Isi data ke dalam modal
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-no_telepon').value = noTelepon;
            document.getElementById('edit-tipe_kos').value = tipeKos;
            document.getElementById('edit-alamat').value = alamat;
            document.getElementById('edit-tanggal_menyewa').value = tanggalMenyewa;
            document.getElementById('edit-tanggal_berakhir').value = tanggalBerakhir;
            document.getElementById('edit-status_penyewaan').value = statusPenyewaan;
            document.getElementById('preview-ktp').firstElementChild.src = ktpUrl || '';
            // Tampilkan preview foto KTP saat ini
            // const ktpPreview = document.getElementById('preview-ktp');
            // ktpPreview.firstElementChild.src = ktpUrl || ''; 
            console.log("KTP URL:", ktpUrl);
        });

        // Preview foto KTP baru yang diunggah
        document.getElementById('edit-ktp').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview-ktp').firstElementChild.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

    </script>

    @endsection
