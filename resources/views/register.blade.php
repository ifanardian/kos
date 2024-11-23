<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <section class="vh-100" style="background-color: #3b5d50;">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
      
                      <form method="POST" action="{{route('actionregister')}}" id="registerForm" class="mx-1 mx-md-4">
                        @csrf
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" />
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example1c">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" />
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example1c">Username</label>
                            <input type="text" id="username" name="username" class="form-control" />
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example3c">Email</label>
                            <input type="email" id="email" name="email" class="form-control" />
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example4c">Password</label>
                            <input type="password" id="password" name="password" class="form-control" />
                          </div>
                        </div>
      
                        <!-- <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="form3Example4cd">Repeat your password</label>
                            <input type="password" id="form3Example4cd" class="form-control" />
                          </div>
                        </div>
      
                        <div class="form-check d-flex justify-content-center mb-5">
                          <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                          <label class="form-check-label" for="form2Example3">
                            I agree all statements in <a href="#!">Terms of service</a>
                          </label>
                        </div>
       -->
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" value="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Sign Up</button>
                        </div>
      
                      </form>
      
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
      
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                        class="img-fluid" alt="Sample image">
      
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