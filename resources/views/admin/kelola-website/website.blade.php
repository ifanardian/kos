@extends('layout-admin.app')

@section('title', 'Kelola Website')

@section('content')

@push('styles')
<style>
    .panorama-container {
        position: relative;
        width: calc(25% - 10px);
        min-width: 100px;
        background: #ddd;
        border-radius: 8px;
        overflow: hidden;
        margin: 5px;
        cursor: pointer;
        padding: 15px;
        text-align: center;
        font-weight: bold;
        font-size: 16px;
    }
    
    .row-grid {
        width: 80%;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 0 10px;
        justify-content: center;
        align-items: center;
        margin: auto;
        height: auto; /* Sesuaikan tinggi agar tidak bertindih */
        position: relative; /* Pastikan posisi relatif */
        z-index: 0; /* Pastikan grid foto berada di bawah */
        margin-bottom: 3rem;
    }

    .column {
        flex: 1 1 calc(33.33% - 20px); /* 3 kolom untuk desktop */
        max-width: calc(33.33% - 20px);
    }

    @media (max-width: 576px) {
        .column {
            flex: 1 1 100%; /* 1 kolom untuk mobile */
            max-width: 100%;
        }    
    }

    @media only screen and (min-width: 576px) and (max-width: 767px) {
        .column {
            -ms-flex: 100%;
            flex: 100%;
            max-width: 90%;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .column {
            flex: 1 1 calc(50% - 20px); /* 2 kolom untuk tablet */
            max-width: calc(50% - 20px);
        }
    }

    @media only screen and (min-width: 992px) and (max-width: 1200px) {
        .column {
            flex: 1 1 calc(50% - 20px); /* 2 kolom untuk tablet */
            max-width: 90%;
        }
    }

    .column img {
        margin-top: 8px;
        vertical-align: middle;
        width: 100%;
    }


    .preview-wrapper {
        display: flex;
        align-items: center;
        gap: 20px;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 10px;
        max-width: 800px;
    }

    .image-box {
        width: 300px;
        height: 200px;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f8f8;
    }

    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .arrow {
        font-size: 30px;
        color: #888;
    }


</style>
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Website</h1>
    </div>

    <!-- Card Panorama -->
    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">

            <!-- Card Header-->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Virtual Tour 360<sup>°</sup></h6>
                    <!-- Tanda Tanya -->
                    <button class="btn btn-link p-0 ms-2" data-bs-toggle="modal" data-bs-target="#tutorialModal">
                        <i class="fas fa-question-circle text-info" style="font-size: 1.25rem;"></i>
                    </button>
                </div>
                <div class="dropdown no-arrow">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                        data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class='fas fa-plus fa-sm text-white-50'></i>
                        Tambah Panorama
                    </button>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <?php
                        foreach($panorama as $p){
                            $default = "";
                            if($p->default){
                                $default ="style=background-color:lightgreen";
                            }
                            echo' 
                            <div class="panorama-container" '.$default.'>

                                <div data-bs-toggle="modal" data-bs-target="#editModal" 
                                    onclick="editPanorama('.$p->id_panorama.')">
                                    '.$p->text.'
                                </div>
                            </div>
                            ';
                        }
                     ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Card PhotoGrid -->
    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Photo Grid</h6>
            </div>
            
            <p class="text-center" style="font-size: 15px; font-weight: bold; color:#4b6fdb; margin-top:1rem;">Klik gambar untuk edit.</p>
                <div class="row-grid dark-bg">
                    <?php
                        for($i = 0 ; $i<6;$i++){
                            
                            echo '
                            <div class="column">
                                <a href="" data-bs-toggle="modal" data-bs-target="#editGridModal" nama-gambar="'.$gambar[$i]['nama_gambar'].'" id-gambar="'.$gambar[$i]['id_gambar'].'">
                                    <img src="'. asset("images/grid/".$gambar[$i]['nama_gambar']) .'" style="width:100%">
                                </a>';
                            $i ++;
                            echo '
                                <a href="" data-bs-toggle="modal" data-bs-target="#editGridModal" nama-gambar="'. $gambar[$i]['nama_gambar'].'" id-gambar="'.$gambar[$i]['id_gambar'].'">
                                    <img src="'. asset("images/grid/".$gambar[$i]['nama_gambar']) .'" style="width:100%">
                                </a>
                            </div>'
                                ;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Tambah -->
<div class="modal fade" id="editGridModal" tabindex="-1" aria-labelledby="editGridModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal">Update Grid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="msTipeKos" action="{{route('admin.kelolawebsite.grid')}}" method="POST" enctype="multipart/form-data" enctype="multipart/form-data">
                    @csrf
                    <div class="preview-wrapper">
                        <div class="image-box">
                            <img src="{{ asset('storage/path-lama.jpg') }}" alt="Gambar Lama" id="gambarLama">
                        </div>
                        <div class="arrow">➡️</div>
                        <div class="image-box">
                            <img src="" alt="Preview Gambar Baru" id="previewGrid">
                        </div>
                    </div>    
                    <div class="mb-3">
                        <input type="hidden" id="id_gambar" name="id_gambar">
                        <label for="gambar" class="form-label" style="padding: 5px;">Ubah Gambar</label>
                        <input style="width: min-content;" type="file" class="form-control-file" id="gambar"
                            name="gambar" accept="image/*">
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
        

<!-- Modal Tambah -->
{{-- <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal">Tambah Panorama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="msTipeKos" action="{{route('admin.kelolawebsite')}}" method="POST"
                enctype="multipart/form-data" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label" style="padding: 5px;">Gambar</label>
                        <input style="width: min-content;" type="file" class="form-control-file" id="gambar"
                            name="gambar" accept="image/*" onchange="previewPanorama(event)">
                    </div>
                    <div class="mb-3" id="containerPreview" style="display:none; ">
                        <label for="gambar" class="form-label" style="padding: 5px;">Preview Gambar Ketika Load</label>
                        <div style="padding: 5px; border: 2px solid grey;">
                            <div id='preview' style="height: 300px; width: calc(100% - 10px); margin: 5px;"></div>

                            <label for="yaw" class="form-label" style="padding: 5px;">Horizontal</label>
                            <input type="range" class="form-range" id="yaw" name="yaw" min="-180" max="180" step="0.5">

                            <label for="pitch" class="form-label" style="padding: 5px;">Vertikal</label>
                            <input type="range" class="form-range" name="pitch" id="pitch" min="-90" max="90"
                                step="0.5">

                            <label for="hfov" class="form-label" style="padding: 5px;">Zoom</label>
                            <input type="range" class="form-range" name="hfov" id="hfov" min="-120" max="-50"
                                step="0.5">
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
</div> --}}

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal">Tambah Panorama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="msTipeKos" action="{{ route('admin.kelolawebsite') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="mb-3" id="containerPreview" style="display:none;">
                        <label for="gambar" class="form-label" style="padding: 5px;">Preview Gambar Ketika Load</label>
                        <div style="padding: 5px;">
                            <div id="preview" style="height: 300px; width: calc(100% - 10px); margin: 5px;"></div>

                            <label for="yaw" class="form-label" style="padding: 5px;">
                                Horizontal
                                <i class="fas fa-question-circle text-info" data-bs-toggle="tooltip" title="Arah pandangan ke kiri/kanan."></i>
                            </label>
                            <input type="range" class="form-range" id="yaw" name="yaw" min="-180" max="180" step="0.5">

                            <label for="pitch" class="form-label" style="padding: 5px;">
                                Vertikal
                                <i class="fas fa-question-circle text-info" data-bs-toggle="tooltip" title="Arah pandangan ke atas/bawah."></i>
                            </label>
                            <input type="range" class="form-range" name="pitch" id="pitch" min="-90" max="90" step="0.5">

                            <label for="hfov" class="form-label" style="padding: 5px;">
                                Zoom
                                <i class="fas fa-question-circle text-info" data-bs-toggle="tooltip" title="Pengaturan zoom untuk gambar panorama, semakin besar nilai zoom, semakin dekat tampilan gambar."></i>
                            </label>
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


<!-- Modal Edit / hapus Panorama -->
{{-- <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel2">UPDATE GAMBAR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="editId">
                    <div class="mb-3">
                        <label class="form-label">Set as Default</label>
                        <div>
                            <input type="radio" id="defaultYes" name="isDefault" value="1">
                            <label for="defaultYes">Ya</label>

                            <input type="radio" id="defaultNo" name="isDefault" value="0">
                            <label for="defaultNo">Tidak</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editText" class="form-label">Judul Panorama</label>
                        <input type="text" class="form-control" id="editText">
                    </div>
                    <div class="mb-3" id="containerPreview2" style="display:none; ">
                        <label for="gambar" class="form-label" style="padding: 5px;">Preview Gambar Ketika Load</label>
                        <div class="border p-3">
                            <div id='previewedit' style="height: 300px; width: calc(100% - 10px); margin: 5px;"></div>
                            <label for="yawedit" class="form-label" style="padding: 5px;">Horizontal</label>
                            <input type="range" class="form-range" id="yawedit" name="yawedit" min="-180" max="180"
                                step="0.5">
                            <label for="pitchedit" class="form-label" style="padding: 5px;">Vertikal</label>
                            <input type="range" class="form-range" name="pitchedit" id="pitchedit" min="-90" max="90"
                                step="0.5">

                            <label for="hfovedit" class="form-label" style="padding: 5px;">Zoom</label>
                            <input type="range" class="form-range" name="hfovedit" id="hfovedit" min="-120" max="-50"
                                step="0.5">
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="addHotspot">Tambah Hotspot</button>
                    </div>

                    <div id="hotspotContainer"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="deletePanorama()">Hapus</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveHotspots()">Simpan</button>
            </div>
        </div>
    </div>
</div> --}}

<!-- Modal Edit / hapus Panorama -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel2">UPDATE GAMBAR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="editId">

                    <!-- Default -->
                    <div class="mb-3">
                        <label class="form-label">Set as Default 
                            <!-- Tanda Tanya dengan ikon -->
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Pilih jika panorama ini ingin dijadikan default yang akan muncul pertama kali ketika halaman dibuka.">
                                <i class="fas fa-question-circle text-info" style="font-size: 18px; cursor: pointer;"></i>
                            </span>
                        </label>
                        <div>
                            <input type="radio" id="defaultYes" name="isDefault" value="1">
                            <label for="defaultYes">Ya</label>

                            <input type="radio" id="defaultNo" name="isDefault" value="0">
                            <label for="defaultNo">Tidak</label>
                        </div>
                    </div>

                    <!-- Judul Panorama -->
                    <div class="mb-3">
                        <label for="editText" class="form-label">Judul Panorama</label>
                        <input type="text" class="form-control" id="editText">
                    </div>

                    <!-- Preview Gambar -->
                    <div class="mb-3" id="containerPreview2" style="display:none; ">
                        <label for="gambar" class="form-label" style="padding: 5px;">Preview Gambar Ketika Load
                            <!-- Tanda Tanya dengan ikon -->
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Ini adalah gambar yang akan terlihat pertama kali ketika panorama dimuat. Anda bisa menyesuaikan posisi gambar saat load.">
                                <i class="fas fa-question-circle text-info" style="font-size: 18px; cursor: pointer;"></i>
                            </span>
                        </label>
                        <div class="border p-3">
                            <div id='previewedit' style="height: 300px; width: calc(100% - 10px); margin: 5px;"></div>
                            
                            <label for="yawedit" class="form-label" style="padding: 5px;">Horizontal 
                                <!-- Tanda Tanya dengan ikon -->
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Arah pandangan ke kiri/kanan.">
                                    <i class="fas fa-question-circle text-info" style="font-size: 18px; cursor: pointer;"></i>
                                </span>
                            </label>
                            <input type="range" class="form-range" id="yawedit" name="yawedit" min="-180" max="180" step="0.5">
                            
                            <label for="pitchedit" class="form-label" style="padding: 5px;">Vertikal 
                                <!-- Tanda Tanya dengan ikon -->
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Arah pandangan ke atas/bawah.">
                                    <i class="fas fa-question-circle text-info" style="font-size: 18px; cursor: pointer;"></i>
                                </span>
                            </label>
                            <input type="range" class="form-range" name="pitchedit" id="pitchedit" min="-90" max="90" step="0.5">
                            
                            <label for="hfovedit" class="form-label" style="padding: 5px;">Zoom 
                                <!-- Tanda Tanya dengan ikon -->
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Pengaturan zoom untuk gambar panorama, semakin besar nilai zoom, semakin dekat tampilan gambar.">
                                    <i class="fas fa-question-circle text-info" style="font-size: 18px; cursor: pointer;"></i>
                                </span>
                            </label>
                            <input type="range" class="form-range" name="hfovedit" id="hfovedit" min="-120" max="-50" step="0.5">
                        </div>
                    </div>

                    <!-- Hotspot -->
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="addHotspot">
                            Tambah Hotspot 
                            <!-- Tanda Tanya dengan ikon -->
                            
                        </button>
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Hotspot adalah tanda panah yang dapat mengarahkan pengguna ke pemandangan lain dalam panorama.">
                            <i class="fas fa-question-circle text-info" style="font-size: 18px; cursor: pointer;"></i>
                        </span>
                    </div>

                    <div id="hotspotContainer">
                        
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="deletePanorama()">Hapus</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveHotspots()">Simpan</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="tutorialModal" tabindex="-1" aria-labelledby="tutorialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tutorialModalLabel">Panduan Penggunaan Panorama</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <ol>
            <li>Masukkan nama panorama dan gambar yang ingin ditampilkan.</li>
            <li>Atur posisi panorama menggunakan slider untuk mengatur yaw (horizontal), pitch (vertikal), dan zoom (hfov).</li>
            <li>Setelah panorama selesai ditambahkan, klik tombol panorama untuk menambahkan atau mengubah hotspot.</li>
            <li>Hotspot yang baru ditambahkan akan muncul di sisi pengguna.</li>
            <li>Jika diperlukan, bisa menghapus panorama yang sudah tidak diperlukan. Panorama default akan digantikan dengan yang baru jika panorama yang dihapus adalah panorama utama.</li>
          </ol>
          <p class="text-muted"><strong>Tips:</strong> Pastikan gambar panorama memiliki rasio 2:1 (misalnya 8000x4000 piksel) untuk hasil yang optimal.</p>
        </div>
      </div>
    </div>
  </div>
  

<script>
    let viewer = ''
    const BaseUrl = {!!json_encode(asset('images/panorama/').'/') !!};
    let Tempimg = '';

    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });


    function previewPanorama(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imageUrl = e.target.result;

                document.getElementById("containerPreview").style.display = "block";

                if (viewer != '') {
                    viewer.destroy();
                }
                // Buat viewer baru
                viewer = pannellum.viewer('preview', {
                    'type': 'equirectangular',
                    'panorama': imageUrl,
                    'autoLoad': true,
                    'yaw': 0, // Kunci posisi yaw
                    'pitch': 0, // Kunci posisi pitch
                    'hfov': 85,
                    'draggable': true, // Nonaktifkan drag dengan mouse
                    'mouseZoom': false, // Nonaktifkan zoom dengan scroll
                    'showControls': false, // Sembunyikan tombol navigasi
                });

                document.getElementById("yaw").value = viewer.getYaw();
                document.getElementById("pitch").value = viewer.getPitch();
                document.getElementById("hfov").value = viewer.getHfov() * -1;
            };
            reader.readAsDataURL(file);
        }
    }

    document.getElementById("yaw").addEventListener("input", function () {
        if (viewer) viewer.setYaw(parseFloat(this.value));
    });

    document.getElementById("pitch").addEventListener("input", function () {
        if (viewer) viewer.setPitch(parseFloat(this.value));
    });

    document.getElementById("hfov").addEventListener("input", function () {
        if (viewer) viewer.setHfov(parseFloat(this.value) * -1);
    });

    function editPanorama(id) {
        let hotspotContainer = document.getElementById("hotspotContainer");
        hotspotContainer.innerHTML = "";

        document.getElementById("editId").value = id;
        $.ajax({
            url: "{{ route('admin.kelolawebsite.detail') }}",
            method: 'POST',
            data: {
                id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response.hotspots);
                const panorama = response.detail;
                // panorama.namafile = BaseUrl + panorama.namafile;
                Tempimg = panorama.namafile;
                showPannellum(panorama, response.hotspots)


            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function showPannellum(data, hotspots) {
        if (viewer) {
            viewer.destroy();
        }
        document.getElementById("containerPreview2").style.display = "block";
        viewer = pannellum.viewer('previewedit', {
            'type': 'equirectangular',
            'panorama': data.namafile,
            'autoLoad': true,
            'yaw': Number(data.yaw),
            'pitch': Number(data.pitch),
            'hfov': Number(data.hfov),
            'draggable': true,
            'mouseZoom': false,
            'showControls': false,
        });
        document.getElementById(data.default ? "defaultYes" : "defaultNo").checked = true;
        document.getElementById("defaultNo").disabled = false;
        if (data.default == 1) {
            console.log('default : ',data.default)
            // document.getElementById("defaultYes").disabled = true;
            document.getElementById("defaultNo").disabled = true;
        }
        document.getElementById("editText").value  = data.text;
        document.getElementById("yawedit").value = Number(data.yaw);
        document.getElementById("pitchedit").value = Number(data.pitch);
        document.getElementById("hfovedit").value = Number(data.hfov)*-1;

        
        if(Array.isArray(hotspots) && hotspots.length > 0){
            hotspots.forEach(element => {
                addHotspot(element)
            });
        }
    }

    document.getElementById("yawedit").addEventListener("input", function () {
        if (viewer) viewer.setYaw(parseFloat(this.value));
    });

    document.getElementById("pitchedit").addEventListener("input", function () {
        if (viewer) viewer.setPitch(parseFloat(this.value));
    });

    document.getElementById("hfovedit").addEventListener("input", function () {
        if (viewer) viewer.setHfov(parseFloat(this.value) * -1);
    });

    function addHotspot(hotspotId = {}) {
        let hotspotContainer = document.getElementById("hotspotContainer");
        console.log("367 : "+hotspotId.id_hotspot);
        if (Object.keys(hotspotId).length === 0) {
            hotspotId = {
                id_hotspot: "hotspot-" + Date.now(),
                yaw: 0,
                pitch: 0,
                scene: ""
            };
        }
        
        let hotspotDiv = document.createElement("div");
        hotspotDiv.classList.add("hotspot-item", "mb-3");
        hotspotDiv.setAttribute("data-hotspot-id", hotspotId.id_hotspot);

        hotspotDiv.innerHTML = `
            <div class="border p-3">
                <input type="hidden" class="form-control mb-2" name="id_hotspots" value="${hotspotId.id_hotspot}">

                <!-- Horizontal -->
                <label class="form-label">Horizontal
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Mengatur letak panah hotspot ke kiri/kanan.">
                        <i class="fas fa-question-circle text-info" style="font-size: 18px; cursor: pointer;"></i>
                    </span>
                </label>
                <input type="range" class="form-range mb-2 hotspot-input" name="yaw[]" step="0.5" min="-179" max="180" data-hotspot-id="${hotspotId.id_hotspot}" value="${hotspotId.yaw}">

                <!-- Vertikal -->
                <label class="form-label">Vertikal
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Mengatur letak panah hotspot ke atas/bawah.">
                        <i class="fas fa-question-circle text-info" style="font-size: 18px; cursor: pointer;"></i>
                    </span>
                </label>
                <input type="range" class="form-range mb-2 hotspot-input" name="pitch[]" step="0.5" min="-89" max="90" data-hotspot-id="${hotspotId.id_hotspot}" value="${hotspotId.pitch}">

                <!-- Scene -->
                <label class="form-label">Scene
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Pilih scene lain untuk mengarahkan pengguna ke pemandangan lain saat hotspot diklik.">
                        <i class="fas fa-question-circle text-info" style="font-size: 18px; cursor: pointer;"></i>
                    </span>
                </label>
                <select class="form-control mb-2 hotspot-input" name="scene[]" data-hotspot-id="${hotspotId.id_hotspot}">
                    <option value="">Pilih Scene</option>
                    @foreach ($panorama as $scene)
                        <option value="{{ $scene->id_panorama }}">
                            {{ $scene->text }}
                        </option>
                    @endforeach
                </select>

                <button type="button" class="btn btn-danger btn-sm remove-hotspot">Hapus</button>
            </div>
        `;
        hotspotContainer.appendChild(hotspotDiv);

        let selectElement = document.querySelector(`select[data-hotspot-id="${hotspotId.id_hotspot}"]`);
        if (selectElement) {
            selectElement.value = hotspotId.scene;
        }

        hotspotDiv.querySelectorAll(".hotspot-input").forEach(input => {
            input.addEventListener("input", updateHotspotPreview);
            input.dispatchEvent(new Event("input"));
        });

        hotspotDiv.querySelector(".remove-hotspot").addEventListener("click", function () {

            let status = removeHotspotFromViewer(hotspotId.id_hotspot);
            if(status){
                hotspotDiv.remove();
            }
        });

        var tooltipTriggerList = [].slice.call(hotspotDiv.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        console.log("Hotspot ditambahkan dengan ID:", hotspotId.id_hotspot);
    }

    document.getElementById("addHotspot").addEventListener("click", function () {
        addHotspot();
    });

    function updateHotspotPreview() {
        let hotspotContainer = document.getElementById("hotspotContainer");
        let hotspots = [];
        
        hotspotContainer.querySelectorAll(".hotspot-item").forEach(item => {
            let hotspotId = item.getAttribute("data-hotspot-id");
            let yaw = parseFloat(item.querySelector("[name='yaw[]']").value) || 0;
            let pitch = parseFloat(item.querySelector("[name='pitch[]']").value) || 0;
            let scene = item.querySelector("[name='scene[]']").value || "";
            let sceneSelect = item.querySelector("[name='scene[]']");
            let sceneText = sceneSelect.options[sceneSelect.selectedIndex].text;

            hotspots.push({
                id: hotspotId,
                pitch: pitch,
                yaw: yaw,
                type: "scene",
                text: sceneText,
            });
        });

        updatePannellumHotspots(hotspots);
    }

    function updatePannellumHotspots(hotspots) {
        if (viewer) {
            viewer.destroy();
        }
        viewer = pannellum.viewer('previewedit', {
            'type': 'equirectangular',
            'panorama': Tempimg, 
            'autoLoad': true,
            'yaw': Number(document.getElementById("yawedit").value),
            'pitch': Number(document.getElementById("pitchedit").value),
            'hfov': Number(document.getElementById("hfovedit").value)*-1,
            'draggable': true,
            'mouseZoom': false,
            'showControls': false,
            'hotSpots': hotspots,
        });
    }

    let datadihapus = [];
    // Fungsi untuk menghapus hotspot dari viewer
    function removeHotspotFromViewer(hotspotId) {
        //let hotspots = viewer.getConfig().hotSpots.filter(h => h.id !== hotspotId);
        // console.log(hotspotId);
    
        if (!isNaN(hotspotId)) {
            datadihapus.push(hotspotId);
        }
        console.log(datadihapus);
        return true;
        //updatePannellumHotspots(hotspots);
    }

    function saveHotspots() {
        let formData = new FormData();
        formData.append('id',document.getElementById("editId").value);
        formData.append('default',document.querySelector('input[name="isDefault"]:checked').value);
        formData.append('text',document.getElementById("editText").value);
        formData.append('yaw',document.getElementById("yawedit").value);
        formData.append('pitch',document.getElementById("pitchedit").value);
        formData.append('hfov',document.getElementById("hfovedit").value);
        datadihapus.forEach((item, index) => {
            // console.log(item)
            formData.append(`dihapus[${index}]`,item);
        });

        // Ambil semua hotspot dari form
        document.querySelectorAll(".hotspot-item").forEach((item, index) => {
            let idValue = item.querySelector("[name='id_hotspots']").value;
        
            if (!isNaN(idValue) && idValue.trim() !== "") {
                formData.append(`hotspots[${index}][id]`, idValue);
            }
            formData.append(`hotspots[${index}][pitch]`, item.querySelector("[name='pitch[]']").value);
            formData.append(`hotspots[${index}][yaw]`, item.querySelector("[name='yaw[]']").value);
            formData.append(`hotspots[${index}][scene]`, item.querySelector("[name='scene[]']").value);
        });
        // Kirim data dengan AJAX ke Laravel
        $.ajax({
            url: '{{ route("admin.kelolawebsite.hotspots") }}', // Gantilah dengan URL endpoint Laravel Anda
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                alert('Hotspot berhasil disimpan!');
            }, 
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Gagal menyimpan hotspot!');
            }
        });
        let modal = document.querySelector('.modal.show'); // Cari modal yang sedang terbuka
        let modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
            location.reload(true);

        }
    }

    function deletePanorama(){
        let formData = new FormData();
        formData.append('id',document.getElementById("editId").value);
        $.ajax({
            url: '{{ route("admin.kelolawebsite.hotspots.delete") }}', // Gantilah dengan URL endpoint Laravel Anda
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert('Hotspot berhasil disimpan!');
                console.log(response);
            }, 
            error: function(xhr) {
                alert('Gagal menyimpan hotspot!');
                console.error(xhr.responseText);
            }
        });

        let modal = document.querySelector('.modal.show'); // Cari modal yang sedang terbuka
        let modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
            location.reload(true);
        }
    }
    document.getElementById('gambar').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('previewGrid').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    document.querySelectorAll('[data-bs-target="#editGridModal"]').forEach(function(link) {
        link.addEventListener('click', function () {
            let gambarSrc = "{{ asset('images/grid') }}/" + this.getAttribute('nama-gambar');
            console.log(gambarSrc)
            let id_gambar =  this.getAttribute('id-gambar');
            document.getElementById('gambarLama').src = gambarSrc;
            document.getElementById('id_gambar').value = id_gambar;
        });
    });
</script>

@endsection
