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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <title>Create Password</title>
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
                                <div class="col-md-10 col-lg-7 col-xl-10 order-2 order-lg-1">

                                    <p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4">Create Password</p>
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <form method="POST" action="{{ route('password.store') }}" id="registerForm" class="mx-1 mx-md-6">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $email }}">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="password">New Password</label>
                                                <input type="password" id="password" name="password"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-5">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                                <input type="password" id="last_name" name="password_confirmation"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="password text-center">
                                            <button class="btn_3" type="submit" value="submit">Set Password</button>
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
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
  $(document).ready(function(){
      $('#registerForm').on('submit', function(event){
          event.preventDefault();
          let username = $('#username').val();
          let email = $('#email').val();
          let password = $('#password').val();
          let firstName = $('#first_name').val();
          let lastName = $('#last_name').val();

          $.ajax({
              url: '/actionregister',
              method: 'POST',
              contentType: 'application/json',
              data: JSON.stringify({
                  username: username,
                  email: email,
                  password: password,
                  first_name: firstName,
                  last_name: lastName
              }),
              success: function(response){
                  alert("Registration successful");
                  window.location.href = '/login';
              },
              error: function(xhr, status, error){
                alert("Registration failed. Please fill out all field");
              }
          });
      });
  });
</script> --}}

</html>
