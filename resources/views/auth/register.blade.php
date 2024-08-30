<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href={{ asset('assets/img/invlogo.png') }}>
	<link rel="stylesheet" type="text/css" href={{ asset('vendor/bootstrap/css/bootstrap.min.css') }}>
	<link rel="stylesheet" type="text/css" href={{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}>
	<link rel="stylesheet" type="text/css" href={{ asset('vendor/animate/animate.css') }}>
	<link rel="stylesheet" type="text/css" href={{ asset('vendor/css-hamburgers/hamburgers.min.css') }}>
	<link rel="stylesheet" type="text/css" href={{ asset('vendor/animsition/css/animsition.min.css') }}>
	<link rel="stylesheet" type="text/css" href={{ asset('vendor/select2/select2.min.css') }}>
	<link rel="stylesheet" type="text/css" href={{ asset('vendor/daterangepicker/daterangepicker.css') }}>
	<link rel="stylesheet" type="text/css" href={{ asset('css/util.css') }}>
	<link rel="stylesheet" type="text/css" href={{ asset('css/main.css') }}>
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="{{ route('register') }}">
                    @csrf
                    <span class="login100-form-title">
                        Sign Up
                    </span>

                    <div class="text-center mb-4">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/img/invlogo.png') }}" alt="Logo" style="max-width: 100px;">
                        </a>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter your name">
                        <input class="input100" type="text" name="name" placeholder="Full Name" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter your email">
                        <input class="input100" type="email" name="email" placeholder="Email" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter password">
                        <input class="input100" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please confirm password">
                        <input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Sign Up
                        </button>
                    </div>

                    <div class="flex-col-c p-t-170 p-b-40">
                        <span class="txt1 p-b-9">
                            Already have an account?
                        </span>

                        <a href="{{ route('login') }}" class="txt3">
                            Sign in now
                        </a>
                    </div>
                </form>
			</div>
		</div>
	</div>

	<script src={{ asset('vendor/jquery/jquery-3.2.1.min.js') }}></script>
	<script src={{ asset('vendor/animsition/js/animsition.min.js') }}></script>
	<script src={{ asset('vendor/bootstrap/js/popper.js') }}></script>
	<script src={{ asset('vendor/bootstrap/js/bootstrap.min.js') }}></script>
	<script src={{ asset('vendor/select2/select2.min.js') }}></script>
	<script src={{ asset('vendor/daterangepicker/moment.min.js') }}></script>
	<script src={{ asset('vendor/daterangepicker/daterangepicker.js') }}></script>
	<script src={{ asset('vendor/countdowntime/countdowntime.js') }}></script>
	<script src={{ asset('js/main.js') }}></script>

</body>
</html>
