<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
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
                                    <form method="POST" action="{{ route('password.store') }}" id="registerForm" class="mx-1 mx-md-4">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $email }}">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="first_name">New Password</label>
                                                <input type="text" id="first_name" name="first_name"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Confirm Password</label>
                                                <input type="text" id="last_name" name="last_name"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="password">
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
