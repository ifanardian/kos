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

    <!-- Card Panorama -->
    <div class="col-xl col-lg-7">
        <div class="card shadow mb-4">

            <!-- Card Header-->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Virtual Tour 360<sup>°</sup></h6>
                <div class="dropdown no-arrow">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"data-bs-toggle="modal" data-bs-target="#tambahModal">
                        <i class='fas fa-plus fa-sm text-white-50'></i> 
                        Tambah Data
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
                                    onclick="editPanorama('.$p->id.')">
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

    Card PhotoGrid
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
                    <table class='table table-sm'>
                        <thead>
                            <tr>
                                <th scope='col'>Gambar</th>
                                <th scope='col'style="width: 50%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ asset('images/display8.jpeg') }}" alt="" style="max-height: 100px;">
                                </td>
                                <td><button></button></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Preview Foto -->
                    <!-- <img id="currentPhoto" src="img/default-photo.png" alt="Foto Saat Ini" -->
                        <!-- style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px; border-radius: 8px;"> -->
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
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
                            <label for="yawedit" class="form-label" style="padding: 5px;">Horisontal</label>
                            <input type="range" class="form-range" id="yawedit" name="yawedit" min="-180" max="180" step="0.5" >
                            <label for="pitchedit" class="form-label" style="padding: 5px;">Vertikal</label>
                            <input type="range" class="form-range" name="pitchedit" id="pitchedit" min="-90" max="90" step="0.5" >
    
                            <label for="hfovedit" class="form-label" style="padding: 5px;">Zoom</label>
                            <input type="range" class="form-range" name="hfovedit" id="hfovedit" min="-120" max="-50" step="0.5">
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
</div>

<script>
    let viewer =''
    const BaseUrl = {!! json_encode(asset('images/panorama/').'/') !!};
    let Tempimg = '';

    function previewPanorama(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imageUrl = e.target.result;

                document.getElementById("containerPreview").style.display = "block";
                
                if(viewer != ''){
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
    
    function editPanorama(id) {
        let hotspotContainer = document.getElementById("hotspotContainer");
        hotspotContainer.innerHTML = "";

        document.getElementById("editId").value = id;
        $.ajax({
            url: "{{ route('admin.detail.kelolawebsite') }}",
            method: 'POST',
            data: {
                id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
            const panorama = response.detail;
            panorama.namafile = BaseUrl + panorama.namafile;
            Tempimg = panorama.namafile;
            showPannellum(panorama,response.hotspots)

            
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
        });
    }

    function showPannellum(data,hotspots){
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
            'draggable': false,
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

    // Event listener untuk mengubah tampilan panorama saat input diubah
    document.getElementById("yawedit").addEventListener("input", function () {
        if (viewer) viewer.setYaw(parseFloat(this.value));
    });

    document.getElementById("pitchedit").addEventListener("input", function () {
        if (viewer) viewer.setPitch(parseFloat(this.value));
    });

    document.getElementById("hfovedit").addEventListener("input", function () {
        if (viewer) viewer.setHfov(parseFloat(this.value)*-1);
    });

    function addHotspot(hotspotId = {}) {
        let hotspotContainer = document.getElementById("hotspotContainer");

        if (Object.keys(hotspotId).length ===0) {
            hotspotId = {
                id: "hotspot-" + Date.now(),
                yaw: 0,
                pitch: 0,
                scene: ""
            };
        }
        
        let hotspotDiv = document.createElement("div");
        hotspotDiv.classList.add("hotspot-item", "mb-3");
        hotspotDiv.setAttribute("data-hotspot-id", hotspotId.id);

        hotspotDiv.innerHTML = `
            <div class="border p-3">
                <input type="hidden" class="form-control mb-2" name="id_hotspots" value="${hotspotId.id}">

                <label class="form-label">Horisontal</label>
                <input type="range" class="form-range mb-2 hotspot-input" name="yaw[]" step="0.5" min="-179" max="180" data-hotspot-id="${hotspotId.id}" value="${hotspotId.yaw}">
                
                <label class="form-label">Vertikal</label>
                <input type="range" class="form-range mb-2 hotspot-input" name="pitch[]" step="0.5" min="-89" max="90" data-hotspot-id="${hotspotId.id}" value="${hotspotId.pitch}">

                <label class="form-label">Scene</label>
                <select class="form-control mb-2 hotspot-input" name="scene[]" data-hotspot-id="${hotspotId.id}">
                    <option value="">Pilih Scene</option>
                    @foreach (DB::table('ms_panorama')->get() as $scene)
                        <option value="{{ $scene->id }}">
                            {{ $scene->text }}
                        </option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-danger btn-sm remove-hotspot">Hapus</button>
            </div>
        `;
        hotspotContainer.appendChild(hotspotDiv);

        let selectElement = document.querySelector(`select[data-hotspot-id="${hotspotId.id}"]`);
        if (selectElement) {
            selectElement.value = hotspotId.scene;
        }

        // Tambahkan event listener ke input baru
        hotspotDiv.querySelectorAll(".hotspot-input").forEach(input => {
            input.addEventListener("input", updateHotspotPreview);
            // **Trigger event input secara otomatis**
            input.dispatchEvent(new Event("input"));
        });

        // Event listener untuk tombol hapus
        hotspotDiv.querySelector(".remove-hotspot").addEventListener("click", function () {

            let status = removeHotspotFromViewer(hotspotId.id);
            if(status){
                hotspotDiv.remove();
            }
        });

        console.log("Hotspot ditambahkan dengan ID:", hotspotId.id);
    }
    
    document.getElementById("addHotspot").addEventListener("click", function () {
        addHotspot();
    });

    // Fungsi untuk memperbarui hotspot di preview
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

        // Update viewer dengan hotspot baru
        updatePannellumHotspots(hotspots);
    }

    // Fungsi untuk memperbarui daftar hotspot di pannellum
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
            'draggable': false,
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
            url: '{{ route("admin.save.Hotspots") }}', // Gantilah dengan URL endpoint Laravel Anda
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

    function deletePanorama(){
        let formData = new FormData();
        formData.append('id',document.getElementById("editId").value);
        $.ajax({
            url: '{{ route("admin.delete.panorama") }}', // Gantilah dengan URL endpoint Laravel Anda
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
</script>

@endsection
