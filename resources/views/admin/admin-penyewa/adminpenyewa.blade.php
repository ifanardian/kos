@extends('layout-admin.app')

@section('title', 'Data Penghuni Kos')

@section('content')

<style>
    .nav-tabs .nav-link {
        background-color: #ebe8e8;
        /* Warna abu-abu untuk tab nonaktif */
        color: black;
        transition: background-color 0.3s, color 0.3s;
    }

    .nav-tabs .nav-link.active {
        background-color: #007bff !important;
        /* Warna biru untuk tab aktif */
        color: white !important;
        font-weight: bold;
    }

</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penghuni</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
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

                <!-- TABEL PENGHUNI AKTIF -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                    tabindex="0">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead-center">
                                    <tr>
                                        <th scope="col">No Kamar</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nomor Telepon</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Mulai Sewa</th>
                                        <th scope="col">Sisa Langganan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penghuniAktif as $item)
                                    <tr class="tr-center">
                                        <td>{{$item->no_kamar}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->no_telepon}}</td>
                                        <td>
                                            <?php
                                             $now = \Carbon\Carbon::now()->format('Y-m-d');
                                             ?>
                                            @if($now>=$item->tanggal_menyewa &&  $item->tanggal_berakhir == null && $item->status_penyewaan == 1 && $item->tanggal_jatuh_tempo>$now)
                                            <span class="{{ $item->status_penyewaan ? 'text-success' : 'text-danger' }}">Aktif</span>
                                            @elseif($item->tanggal_menyewa > $now && $item->tanggal_berakhir == null  && $item->status_penyewaan == 1) 
                                            <span class="text-warning">Calon Penghuni</span>
                                            @elseif($item->tanggal_menyewa <= $now && $item->tanggal_berakhir == null && $item->status_penyewaan == 1 && $item->tanggal_jatuh_tempo<$now)
                                            <span class="text-danger">Belum bayar</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_menyewa)->format('d-m-Y')}}</td>
                                        @if($item->tanggal_menyewa <= \Carbon\Carbon::now()->format('Y-m-d'))
                                        <td>{{ \Carbon\Carbon::now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->startOfDay())}} hari</td>
                                        @else
                                        <td>Belum Aktif</td>
                                        @endif
                                        <td>
                                            <div class="container">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editModal"
                                                    data-id_penyewa="{{ $item->id_penyewa }}">
                                                    <i class="bi bi-pencil-fill"></i> Edit
                                                </button>
                                                
                                                    
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#tagihanModal" data-status="{{ $item->status_penyewaan }}"
                                                    data-id_penyewa2="{{ $item->id_penyewa }}">
                                                    <i class="bi-plus-circle-fill"></i> Tagihan
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

                <!-- TABEL RIWAYAT PENGHUNI -->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                    tabindex="0">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
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
                                            <span
                                                class="{{ $item->status_penyewaan ? 'text-success' : 'text-danger' }}">
                                                {{ $item->status_penyewaan ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td>{{$item->tanggal_menyewa}}</td>
                                        <td>{{$item->tanggal_berakhir}}</td>
                                        <td>
                                            <div class="container">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editModal" data-email="{{ $item->email }}"
                                                    data-id_penyewa="{{ $item->id_penyewa }}">
                                                    <i class="bi bi-pencil-fill"></i> {{ $item->status_penyewaan ? 'Edit' : 'Detail' }}
                                                </button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#tagihanModal" data-status="{{ $item->status_penyewaan }}"
                                                    data-id_penyewa2="{{ $item->id_penyewa }}">
                                                    <i class="bi-plus-circle-fill"></i> Tagihan
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
    </div>


    <!-- /.container-fluid -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Penyewa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" action="{{ route('admin.penyewa') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_penyewa" id="edit-id">
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
                                <?php
                                if($msTipe){
                                    foreach($msTipe as $t){
                                        echo"
                                            <option value=". $t->id_tipe_kos ."> ".$t->deskripsi ."</option>
                                        ";
                                    }
                                }else{
                                    echo"
                                        <option value='' selected>Belum Ada Pilihan Tipe Kos</option>
                                    ";
                                }
                            ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit-alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="edit-alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-ktp" class="form-label">Foto KTP</label>
                            <div class="mb-2">
                                @if (!empty($item->ktp))
                                    <a href="{{ route('admin.ktp.gambar', ['filename' => $item->ktp]) }}" id="preview-ktp">
                                        <img src="{{ route('admin.ktp.gambar', ['filename' => $item->ktp]) }}?t={{ time() }}" alt="KTP" style="width:150px;height:auto;">
                                    </a>
                                @else
                                    <p>Tidak ada KTP tersedia</p>
                                @endif
                            </div>
                            <input type="file" class="form-control" id="edit-ktp" name="ktp" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="edit-tanggal_menyewa" class="form-label">Tanggal Menyewa</label>
                            <input type="date" class="form-control" id="edit-tanggal_menyewa" name="tanggal_menyewa"
                                required>
                        </div>
                        <div class="mb-3" id="tanggalBerakhir" style="display: none;">
                            <label for="edit-tanggal_berakhir" class="form-label" >Tanggal Berakhir</label>
                            <input type="date" class="form-control" id="edit-tanggal_berakhir" name="tanggal_berakhir">
                        </div>
                        <div class="mb-3">
                            <label for="edit-no_kamar" class="form-label">No Kamar</label>
                            <select class="form-control" id="edit-no_kamar" name="no_kamar" required>
                                <?php
                                $kamar = DB::table('kamar')->where('status','F')->get();
                                if($kamar){
                                    foreach($kamar as $t){
                                        echo"
                                            <option value='". $t->id_kamar ."'  > No. ".$t->id_kamar ."</option>
                                        ";
                                    }
                                }else{
                                    echo"
                                        <option value='' selected>Belum Ada Pilihan Tipe Kos</option>
                                    ";
                                }
                            ?>
                            </select>
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

    <!-- Modal -->
<div class="modal fade" id="tagihanModal" tabindex="-1" aria-labelledby="tagihanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Tambahkan modal-lg agar lebih lebar -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tagihanModalLabel">Detail Tagihan Penyewa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Periode</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Status Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody id="tagihanTableBody">
                            <!-- Data akan diisi melalui JavaScript -->
                        </tbody>
                    </table>
                </div>
           
                <div class="modal-footer">
                    <form id="tagihanForm" action="{{ route('admin.payment.emailtagih') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="tagihan-id">
                        <button type="submit" class="btn btn-primary" id="btn-tagihan" >Ingatkan</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Oke</button>
                </div>
        </div>
    </div>
</div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            let id = button.getAttribute('data-id_penyewa');
            document.getElementById('edit-id').value = id;

            $.ajax({
            url: "{{ route('admin.penyewa.byid',['']) }}/"+id,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                const selectElement = document.getElementById("edit-no_kamar");
                const newValue = response.no_kamar;
                let optionExists = [...selectElement.options].some(option => option.value === newValue);
                if (!optionExists) {
                    let newOption = document.createElement("option");
                    newOption.value = newValue;
                    newOption.textContent = "No. "+newValue;
                    selectElement.appendChild(newOption);
                }
                selectElement.value = newValue;
                document.getElementById("edit-ktp").hidden = false;
                document.getElementById('edit-email').value = response.email;
                document.getElementById('edit-nama').value = response.nama;
                document.getElementById('edit-no_telepon').value = response.no_telepon;
                document.getElementById('edit-tipe_kos').value = response.tipe_kos;
                document.getElementById('edit-alamat').value = response.alamat;
                document.getElementById('edit-tanggal_menyewa').value = response.tanggal_menyewa;
                document.getElementById('edit-status_penyewaan').value = response.status_penyewaan;
                
                if(response.tanggal_berakhir && !response.status_penyewaan){
                    document.getElementById("tanggalBerakhir").hidden = false;
                    document.getElementById("edit-tanggal_berakhir").value = response.tanggal_berakhir;
                    document.getElementById("edit-ktp").hidden = true;
                    document.querySelectorAll("#editForm input, #editForm select, #editForm textarea").forEach(element => {
                        element.setAttribute("disabled", "true");
                    });
                }
            },
            error: function(xhr, status, error) {
            }
            });
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


        const tagihanModal = document.getElementById('tagihanModal');
        tagihanModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            let id2 = button.getAttribute('data-id_penyewa2');
            let status = button.getAttribute('data-status');
            document.getElementById('tagihan-id').value = id2;
            
            if(status == 1){
                document.getElementById('btn-tagihan').style.display = 'block';
            }else{
                document.getElementById('btn-tagihan').style.display = 'none';
            }

            let tableBody = document.getElementById("tagihanTableBody");
            tableBody.innerHTML = "<tr><td colspan='4' class='text-center'>Loading...</td></tr>";
            $.ajax({
            url: "{{ route('admin.payment.byid',['']) }}/"+id2,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                tableBody.innerHTML = ""; // Kosongkan isi tabel sebelum diisi ulang
                if (response.data.length === 0) {
                    tableBody.innerHTML = "<tr><td colspan='4' class='text-center'>Tidak ada tagihan</td></tr>";
                } else {
                    (response.data).forEach((item, index) => {
                        if(item.status_verifikasi === 1){
                            var statusBadge = '<span class="badge bg-success">Lunas</span>';
                        }else if( item.status_verifikasi === 0){
                           var statusBadge = '<span class="badge bg-danger">Ditolak</span>';
                        }else if( item.status_verifikasi == NULL && item.tanggal_pembayaran == NULL){
                            var statusBadge = '<span class="badge bg-warning">Belum Dibayar</span>';
                        }else{
                            var statusBadge = '<span class="badge bg-warning">Menunggu Konfirmasi</span>';
                        }

                        let row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.periode_tagihan}</td>
                                <td>${item.tanggal_pembayaran ? item.tanggal_pembayaran : ""}</td>
                                <td>${statusBadge}</td>
                                
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                }
            },
            
            });
        });
    </script>

    @endsection
