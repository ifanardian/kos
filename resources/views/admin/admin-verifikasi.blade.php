@extends('layout-admin.app')

@section('title', 'Verifikasi Pembayaran')

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
        <h1 class="h3 mb-0 text-gray-800">Verifikasi Calon Penghuni</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="row">
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-pending-tab" data-bs-toggle="tab" data-bs-target="#nav-pending"
                    type="button" role="tab" aria-controls="nav-pending" aria-selected="true">Pending</button>
                <button class="nav-link" id="nav-approved-tab" data-bs-toggle="tab" data-bs-target="#nav-approved"
                    type="button" role="tab" aria-controls="nav-approved" aria-selected="false">Approved</button>
                <button class="nav-link" id="nav-rejected-tab" data-bs-toggle="tab" data-bs-target="#nav-rejected"
                    type="button" role="tab" aria-controls="nav-rejected" aria-selected="false">Rejected</button>
            </div>
        </nav>
        <div class="col-xl col-lg-7">
            <div class="tab-content" id="nav-tabContent">

                {{-- PENDING --}}
                <div class="tab-pane fade show active" id="nav-pending" role="tabpanel" aria-labelledby="nav-home-tab"
                    tabindex="0">
                    <div class="card shadow mb-4">
                        <!-- Card Body -->
                        <div class="card-body">
                            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                    class="fas fa-download fa-sm text-white-50"></i> Tambah Data</a> --}}
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="thead-center">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nama Penyewa</th>
                                            <th scope="col">No HP</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Tipe Kamar</th>
                                            <!-- <th scope="col">Harga</th> -->
                                            <th scope="col">KTP</th>
                                            <th scope="col">Tanggal Pemesanan</th>
                                            <th scope="col">Periode Penempatan</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pending as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->no_hp }}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->alamat}}</td>
                                            <td>
                                                <?php
                                                foreach($tipe as $t){
                                                    if($item->tipe_kos == $t->id){
                                                    echo $t->deskripsi;
                                                    }
                                                }
                                                
                                                ?>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.ktp', ['filename' => $item->ktp]) }}">
                                                    <img src="{{ route('admin.ktp', ['filename' => $item->ktp]) }}"
                                                        alt="KTP" style="width:100px;height:auto;">
                                                </a>
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->periode_penempatan }}</td>
                                            <td>
                                                <form id="form-update-status-{{ $item->id }}"
                                                    action="{{ route('admin.update.statusbooking') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" id="id" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" id="room_number" name="room_number" value="">
                                                    <input type="hidden" id="alasan_ditolak" name="alasan_ditolak" value="">
                                                    <select class="form-control" name="status"
                                                        id="status-select-{{ $item->id }}"
                                                        onchange="handleStatusChange(this, '{{ $item->id }}')">
                                                        <option value="PENDING"
                                                            {{ $item->status == 'PENDING' ? 'selected' : '' }}>PENDING
                                                        </option>
                                                        <option value="APPROVED"
                                                            {{ $item->status == 'APPROVED' ? 'selected' : '' }}>APPROVED
                                                        </option>
                                                        <option value="REJECTED"
                                                            {{ $item->status == 'REJECTED' ? 'selected' : '' }}>REJECTED
                                                        </option>
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

                {{-- APPROVED --}}
                <div class="tab-pane fade" id="nav-approved" role="tabpanel" aria-labelledby="nav-approved-tab"
                    tabindex="0">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="thead-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Penyewa</th>
                                            <th>No HP</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Tipe Kamar</th>
                                            <th>KTP</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Periode Penempatan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($approved as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->no_hp }}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->alamat}}</td>
                                            <td>
                                                @foreach($tipe as $t)
                                                @if($item->tipe_kos == $t->id)
                                                {{ $t->deskripsi }}
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.ktp', ['filename' => $item->ktp]) }}">
                                                    <img src="{{ route('admin.ktp', ['filename' => $item->ktp]) }}"
                                                        alt="KTP" style="width:100px;height:auto;">
                                                </a>
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->periode_penempatan }}</td>
                                            <td>{{ $item->status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB REJECTED -->
                <div class="tab-pane fade" id="nav-rejected" role="tabpanel" aria-labelledby="nav-rejected-tab"
                    tabindex="0">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="thead-center">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Penyewa</th>
                                            <th>No HP</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Tipe Kamar</th>
                                            <th>KTP</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Periode Penempatan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rejected as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->no_hp }}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->alamat}}</td>
                                            <td>
                                                @foreach($tipe as $t)
                                                @if($item->tipe_kos == $t->id)
                                                {{ $t->deskripsi }}
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.ktp', ['filename' => $item->ktp]) }}">
                                                    <img src="{{ route('admin.ktp', ['filename' => $item->ktp]) }}"
                                                        alt="KTP" style="width:100px;height:auto;">
                                                </a>
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->periode_penempatan }}</td>
                                            <td>{{ $item->status }}</td>
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

</div>
<!-- /.container-fluid -->

<!-- Modal approve -->
<div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="roomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roomModalLabel">Tentukan Nomor Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="mb-3">
                    <label for="modal-room-number" class="form-label">Nomor Kamar</label>
                    <select id="modal-room-number" class="form-control">
                        <option value="" selected disabled>Pilih Nomor Kamar</option>
                        <?php
                            $kamar = DB::table('kamar')->where('status','F')->get();
                            foreach($kamar as $k){
                                echo"
                                    <option value='".$k->id_kamar."'>No. ".$k->id_kamar."</option>
                                ";
                            }
                        ?>
                        
                    </select>
                    {{-- <label for="modal-room-number" class="form-label">Nomor Kamar</label>
          <input type="text" class="form-control" id="modal-room-number" placeholder="Masukkan nomor kamar"> --}}
                    <input type="hidden" id="no_form" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Simpan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="cancelStatus()"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menolak pemesanan ini?</p>
                <p>Alasan penolakan:</p>
                <textarea class="form-control" id="alasan" name="alasan" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    onclick="cancelStatus()">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitForm2()">Ya</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function handleStatusChange(selectElement, itemId) {
        if (selectElement.value === "APPROVED") {
            const modal = new bootstrap.Modal(document.getElementById('roomModal'));
            document.getElementById('no_form').value = itemId;
            modal.show();
        } else {
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            document.getElementById('no_form').value = itemId;
            confirmModal.show();
        }
    }

    function submitForm2() {
        const formId = document.getElementById('form-update-status-' + document.getElementById('no_form').value);
        $('#alasan_ditolak').val($('#alasan').val());
        formId.submit();
    }

    function cancelStatus() {
        var selectElement = document.getElementById('status-select-' + document.getElementById('no_form').value);
        selectElement.selectedIndex = 0;
    }

    function submitForm() {
        const roomNumberInput = document.getElementById('modal-room-number').value;
        if (!roomNumberInput) {
            alert("Nomor kamar tidak boleh kosong!");
            return;
        }

        let itemId = document.getElementById('no_form').value;
        document.getElementById('form-update-status-' + itemId).querySelector('#room_number').value = roomNumberInput;
        document.getElementById('form-update-status-' + itemId).submit();
    }

</script>
@endsection
