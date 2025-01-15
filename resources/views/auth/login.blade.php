<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <link rel="icon" href="{{ asset('images/luck.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}>
    <!-- animate CSS -->
    <link rel="stylesheet" href={{ asset('css/animate.css') }}>
    <!-- style CSS -->
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <title>Login | Kos Fortuna</title>
    <style>
        body {
            font-family: "Lexend", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
            letter-spacing: 1px;
            background-image: url("{{ asset('images/flipped-house.png') }}");
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            overflow: hidden;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #ccc;
            border-radius: 0;
            box-shadow: none;
        }

        .form-control:focus {
            border-bottom: 2px solid #007bff;
            outline: none;
            box-shadow: none;
        }

        .form-label {
            font-weight: bold;
        }

        .alert {
            margin-top: 20px;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-5">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-5 col-xl-10 order-2 order-lg-1">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    @if ($errors->has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>

                                    <form method="POST" action="{{ route('actionlogin') }}" id="loginForm"
                                        class="mx-1 mx-md-8">
                                        @csrf
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Email</label>
                                                <input type="email" id="email" name="email" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-5">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c">Password</label>
                                                <input type="password" id="password" name="password"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        {{-- <p class="text-center">Don't have an account? <a href="{{ url('register') }}">Sign
                                        up</a></p> --}}

                                        {{-- <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" value="submit"
                                                class="btn btn-primary btn-lg">Login</button>
                                        </div> --}}

                                        <div class="password text-center">
                                            <button class="btn_3" type="submit" value="submit">Login</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    </script>
</body>

</html>
