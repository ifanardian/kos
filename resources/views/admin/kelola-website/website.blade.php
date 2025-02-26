@extends('layout-admin.app')

@section('title', 'Kelola Website')

@section('content')

@push('styles')
    <style>
        .panorama {
            display: inline-block;
            width: calc(33.33% - 10px); /* 3 kolom dengan jarak */
            height: 200px; /* Sesuaikan tinggi */
            min-width: 150px; /* Agar tidak terlalu kecil */
            background: #ddd; /* Placeholder jika gambar tidak muncul */
        }

        @media (max-width: 768px) {
            .panorama {
                width: calc(50% - 10px); /* Jadi 2 kolom di layar kecil */
            }
        }

        @media (max-width: 480px) {
            .panorama {
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
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
            </div>
            
            <!-- Card Body -->
            <div class="card-body">
                <div class="text mb-3" >
                    <!-- Preview Foto -->
                     <?php
                        
                        foreach($panorama as $p){
                            echo" <div id='".$p->scene."' class='panorama'>".$p->text."</div>";
                            $hotspots = '';
                            $temp = DB::table('panorama_hotspots')->where('id_panorama',$p->id)->get();

                            if($temp->isNotEmpty()){
                                $hotspots= "'hotSpots': [";
                                
                                foreach($temp as $t){
                                    // dd($t->yaw);
                                    $hotspots .= "
                                        {
                                            'pitch': ".$t->pitch.",
                                            'yaw': ".$t->yaw.",
                                            'type': 'scene',
                                            'text': '".$panorama[(int)$p->scene]->text."',
                                            
                                        },
                                    ";
                                    
                                }
                                $hotspots .="]";       
                            }
                            
                            echo"
                                <script>
                                    pannellum.viewer('".$p->scene."', {
                                        'type': 'equirectangular',
                                        'panorama': '".asset('images/'.$p->namafile)."',
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
