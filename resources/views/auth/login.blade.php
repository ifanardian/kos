<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <title>login</title>
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

        .btn_3 {
            display: inline-block;
            padding: 9px 42px;
            border-radius: 50px;
            background-image: linear-gradient(16deg, #031d34 0%, #054592 64%, #5280a2 100%);
            border: 1px solid #ecfdff;
            font-size: 15px;
            font-weight: 700;
            color: #fff !important;
            text-transform: uppercase;
            font-weight: 400;
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

                                        <div class="d-flex flex-row align-items-center mb-4">
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

                                        <div class="password">
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
