<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('public/admin/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/vendor/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/vendor/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/vendor/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/vendor/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('public/admin/vendor/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65">
	@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
    </div>
	@endif
	@if ($message = Session::get('error'))
	    <div class="alert alert-danger alert-block">
	        <button type="button" class="close" data-dismiss="alert">×</button> 
	            <strong>{{ $message }}</strong>
	    </div>
	@endif
				<form class="login100-form validate-form" method="post" action="{{route('admin.signup')}}" id="registerform">
					<span class="login100-form-title p-b-49">
						Sign Up
					</span>
					@csrf
					<div class="wrap-input100 validate-input m-b-23" >
						<span class="label-input100">Email</span>
						<input class="input100" type="email" name="email" placeholder="Type your email" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');" id="emailid">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<span id="semailerr"></span>
					<span id="erroremail"></span>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Type your password" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');" id="spassword">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<span id="spasserr"></span>

					<div class="wrap-input100 validate-input"  style="margin-top: 15px;">
						<span class="label-input100">Confirm Password</span>
						<input class="input100" type="password" name="confirm_pass" placeholder="Type your confirm password" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');" id="scpassword">
						<span class="focus-input100" data-symbol="&#xf190;"></span>	
					</div>
					<span id="scpasserr"></span>
					<span class="errorshow"></span>
					<span class="pass-miss"></span>
					
					<div class="container-login100-form-btn" style="margin-top: 20px;">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="button" id="register">
								Sign Up
							</button>
						</div>
					</div>

					<!-- <div class="txt1 text-center p-t-54 p-b-20">
						<span>
							Or Sign Up Using
						</span>
					</div> -->

					<!-- <div class="flex-c-m">
						<a href="{{ url('redirect') }}" class="login100-social-item bg1">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="{{ url('auth/google') }}" class="login100-social-item bg3">
							<i class="fa fa-google"></i>
						</a>

					</div> -->
					<div class="signup-line" style="text-align: center;margin-top: 15px;">Already have account? <a href="{{route('admin.login')}}" id="signup">Signin</a></div>
					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('public/admin/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public/admin/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public/admin/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('public/admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public/admin/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public/admin/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('public/admin/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public/admin/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public/admin/js/main.js') }}"></script>

</body>
@include('admin.layout.admin_script')
</html>