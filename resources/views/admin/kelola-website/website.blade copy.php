@extends('layout-admin.app')

@section('title', 'Kelola Website')

@section('content')

@push('styles')
    <style>
        .panorama-container {
            display: inline-block;
            width: calc(33.33% - 10px); /* 3 kolom dengan jarak */
            height: 200px; /* Sesuaikan tinggi */
            min-width: 150px; /* Agar tidak terlalu kecil */
            background: #ddd; /* Placeholder jika gambar tidak muncul */
        }

        @media (max-width: 768px) {
            .panorama-container {
                width: calc(50% - 10px); /* Jadi 2 kolom di layar kecil */
            }
        }

        @media (max-width: 480px) {
            .panorama-container {
                width: 100%; /* Jadi 1 kolom di layar kecil */
            }
        }
    </style>
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Website</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>
    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Virtual Tour 360<sup>°</sup></h6>
                <div class="dropdown no-arrow">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class='fas fa-plus fa-sm text-white-50'></i> 
                        Tambah Data
                    </button>
                </div>
            </div>
            
            <!-- Card Body -->
            <div class="card-body">
                <div class="text mb-3" >
                    <!-- Preview Foto -->
                     <?php
                        foreach($panorama as $p){

                            echo' 
                            <div class="panorama-container">
                                <div class="panorama-header">
                                    <span>'.$p->text.'</span>
                                    <span class="menu-icon" onclick="showUpdateMenu('.$p->id.')">&#x22EE;</span>
                                </div>
                                <div id="'.$p->id.'" class="panorama"></div> 
                            </div>
                            ';
                            $hotspots = '';
                            $temp = DB::Select("
                                SELECT h.pitch, h.yaw, p.text
                                FROM panorama_hotspots h
                                JOIN ms_panorama p ON h.scene = p.id
                                WHERE h.id_panorama = ".$p->id.";
                            ");
                            if(count($temp) > 0){
                                $hotspots= "'hotSpots': [";
                                foreach($temp as $t){
                                    $hotspots .= "{'pitch': ".$t->pitch.",'yaw': ".$t->yaw.",'type': 'scene','text': '".$t->text."',  },";
                                }
                                $hotspots .="]";       
                            }
                            echo"
                                <script>
                                    pannellum.viewer('".$p->id."', {
                                        'type': 'equirectangular',
                                        'panorama': '".asset('images/panorama/'.$p->namafile)."',
                                        'autoLoad': true,
                                        'yaw': ".$p->yaw.",  
                                        'pitch':".$p->pitch.",
                                        'hfov':".$p->hfov.",
                                        ".$hotspots."
                                    });
                                </script>
                                ";
                        }
                     ?>
                </div>
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
                <!-- <form id="photoForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="newPhoto">Ganti Foto</label>
                        <input type="file" class="form-control-file" id="newPhoto" name="photo" accept="image/*"
                            onchange="previewPhoto(event)">
                    </div>
                    <button type="submit" class="btn btn-primary">Unggah Foto</button>
                </form> -->
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
            <form id="msTipeKos" action="{{route('post.admin.kelolawebsite')}}" method="POST" enctype="multipart/form-data"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label" style="padding: 5px;">Gambar</label>
                        <input style="width: min-content;" type="file" class="form-control-file" id="gambar" name="gambar" accept="image/*" onchange="previewPanorama(event)">
                    </div>
                    <div class="mb-3" id="containerPreview" style="display:none; ">
                        <label for="gambar" class="form-label" style="padding: 5px;">Preview Gambar Ketika Load</label>
                        <div style="padding: 5px; border: 2px solid grey;">   
                            <div id='preview' style="height: 300px; width: calc(100% - 10px); margin: 5px;"></div>
    
                            <label for="yaw" class="form-label" style="padding: 5px;">Horisontal</label>
                            <input type="range" class="form-range" id="yaw" name="yaw" min="-180" max="180" step="0.5" >
    
                            <label for="pitch" class="form-label" style="padding: 5px;">Vertikal</label>
                            <input type="range" class="form-range" name="pitch" id="pitch" min="-90" max="90" step="0.5" >
    
                            <label for="hfov" class="form-label" style="padding: 5px;">Zoom</label>
                            <input type="range" class="form-range" name="hfov" id="hfov" min="-120" max="-50" step="0.5">
                        </div>
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


<script>
    let viewer; // Variabel global untuk Pannellum viewer

    function previewPanorama(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imageUrl = e.target.result;

                // Tampilkan container setelah gambar dipilih
                document.getElementById("containerPreview").style.display = "block";

                // Hapus viewer lama jika ada
                if (viewer) {
                    viewer.destroy();
                }

                // Buat viewer baru
                viewer = pannellum.viewer('preview', {
                    'type': 'equirectangular',
                    'panorama': imageUrl,
                    'autoLoad': true,
                    'yaw': 0,                   // Kunci posisi yaw
                    'pitch': 0,                 // Kunci posisi pitch
                    'hfov': 85,
                    'draggable': false,          // Nonaktifkan drag dengan mouse
                    'mouseZoom': false,         // Nonaktifkan zoom dengan scroll
                    'showControls': false,       // Sembunyikan tombol navigasi
                });

                // Set nilai input sesuai dengan posisi awal
                document.getElementById("yaw").value = viewer.getYaw();
                document.getElementById("pitch").value = viewer.getPitch();
                document.getElementById("hfov").value = viewer.getHfov()*-1;
            };
            reader.readAsDataURL(file);
        }
    }

    // Event listener untuk mengubah tampilan panorama saat input diubah
    document.getElementById("yaw").addEventListener("input", function () {
        if (viewer) viewer.setYaw(parseFloat(this.value));
    });

    document.getElementById("pitch").addEventListener("input", function () {
        if (viewer) viewer.setPitch(parseFloat(this.value));
    });

    document.getElementById("hfov").addEventListener("input", function () {
        if (viewer) viewer.setHfov(parseFloat(this.value)*-1);
    });
    function previewPhoto(event) {
        const photoPreview = document.getElementById('preview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                photoPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
