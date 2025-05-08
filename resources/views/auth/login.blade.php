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
        body{
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: "Lexend", sans-serif;
            background-image: url("{{ asset('images/flipped-house.png') }}");
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            overflow: hidden;
        }
        .main{
            width: 450px;
            height: 500px;
            background: #e5f4fb26;
            overflow: hidden;border-radius: 10px;
            box-shadow: 5px 20px 50px #000;
        }
        #chk{
            display: none;
        }
        .login{
            position: relative;
            width:100%;
            height: 100%;
        }
        label{
            color: #000017;
            font-size: 2em;
            justify-content: center;
            display: flex;
            margin: 50px;
            font-weight: bold;
            cursor: pointer;
            transition: .5s ease-in-out;
        }
        input{
            width: 66%;
            height: 37px;
            background: #fff; /*#e0dede*/
            justify-content: center;
            display: flex;
            margin: 30px auto;
            padding: 19px;
            border: none;
            outline: none;
            border-radius: 5px;
        }
        .login .btn-submit{
            width: 40%;
            height: 40px;
            margin: 10px auto;
            justify-content: center;
            display: block;
            color: #fff;
            background: #000017;
            font-size: 1em;
            font-weight: bold;
            margin-top: 40px;
            outline: none;
            border: none;
            border-radius: 5px;
            transition: .2s ease-in;
            cursor: pointer;
        }
        .btn-submit:hover{
            background: #174054;
        }
        .reset{
            height: 460px;
            background: #000017;
            border-radius: 60% / 10%;
            transform: translateY(-180px);
            transition: .8s ease-in-out;
        }
        .reset label{
            white-space: nowrap;
            color: #ffffff;
            font-size: 1.9em;
            transform: scale(.6);
        }
        .reset .btn-reset{
            width: 40%;
            height: 40px;
            margin: 10px auto;
            justify-content: center;
            display: block;
            color: #174054;
            background: #E3F6FF;
            font-size: 1em;
            font-weight: bold;
            margin-top: 40px;
            outline: none;
            border: none;
            border-radius: 5px;
            transition: .2s ease-in;
            cursor: pointer;
        }

        #chk:checked ~ .reset{
            transform: translateY(-500px);
        }
        #chk:checked ~ .reset label{
            transform: scale(.9);	
        }
        #chk:checked ~ .login label{
            padding: 80px;
            transform: scale(.6);
        }
        
    </style>
</head>

<body>
    <div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="login">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

				<form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" id="email" required="" >
					<input type="password" name="password" placeholder="Password" id="password" required="">
					<button type="submit" class="btn-submit" value="submit">LOGIN</button>
				</form>
			</div>

			<div class="reset">
				<form method="POST" action="{{ route('password.email') }}">
                    @csrf
					<label for="chk" aria-hidden="true">Lupa Password</label>
					<input type="email" name="email" placeholder="Email" required="">
					<button class="btn-reset">RESET PASSWORD</button>
				</form>
			</div>
	</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
