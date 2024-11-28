<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kos</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
    <style>
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            width: 250px;
            z-index: 1000;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px; /* Harus sama dengan lebar sidebar */
            padding: 20px;
        }
    </style>   
</head>
<body>
    {{-- <div class="d-flex"> --}}
        <div class="sidebar">
            <a href="">Dashboard</a>
            <a href="">Data Penyewa Kos</a>
            <a href="">Kelola Kamar</a>
            <a href="">Riwayat Pembayaran</a>
            <a href="">Verifikasi Pembayaran</a> 
            {{-- {{ route('admin.verifikasi') }} --}}
        </div>

        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Dashboard Admin</a>
                </div>
            </nav>
            <div class="container mt-4">
                {{-- <header>
                    <h1>@yield('title')</h1>
                </header> --}}
                @yield('content')
            </div>
        </div>
    {{-- </div> --}}
    {{-- <div class="content">
        <header>
            <h1>@yield('title')</h1>
        </header>
        @yield('content')
    </div> --}}
</body>
</html>
