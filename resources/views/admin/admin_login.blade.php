<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('public/admin/images/favicon.ico') }}" style="width: 50px;height:50px;" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/admin/vendor/bootstrap/css/bootstrap.min.css') }}">
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<style type="text/css">
	.pass
	{
    float: right;
    margin-top: -27px;
	}
</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{asset('public/admin/vendor/images/splash.jpg')}}');">
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
				<form class="login100-form validate-form" method="post" action="{{route('admin.login')}}" id="loginform">
					<span class="login100-form-title p-b-49">
						Login
					</span>
					@csrf
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Canteen is reauired">
						<span class="label-input100">Select Canteen <span style="color: red;">*</span></span>
						<select class="form-control" id="canteen" name="canteen_code">
							<option value="">Select Canteen</option>
							@if(!empty($canteen) && count($canteen)>0)
							@foreach($canteen as $val)
							<option value="{{$val->canteenCode}}"@if (old('canteen_code') == $val->canteenCode) selected="selected" @endif>{{$val->canteenName}}</option>
							@endforeach
							@endif
						</select>
						
					</div>
					<span id="canteen-err"></span>
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Username <span style="color: red;">*</span></span>
						<input class="input100" type="text" name="email" value="{{ old('email') }}" placeholder="Type your username" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');" id="emaillogin"  >
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<span id="emailloginerr"></span>
					<span id="emailerr"></span>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password <span style="color: red;">*</span></span>
						<input class="input100" type="password" name="password" placeholder="Type your password" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');" id="passlogin" value="{{ Request::old('password') }}" ><span toggle="#passlogin" class="fa fa-fw field-icon toggle-password fa-eye pass"></span>
						
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<span id="passlerr"></span>
					<!-- <div class="text-left">
						<input type="checkbox" class="" onclick="showpass()">
						 Show Password
					</div> -->
					<!-- <div class="text-right p-t-8 p-b-31">
						<a href="{{route('admin.forgot.password')}}">
							Forgot password?
						</a>
					</div> -->
					<input type="submit" hidden="true" />
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn submit_on_enter" type="button" id="loginbtn">
								Login
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
					<!-- <div class="signup-line" style="text-align: center;margin-top: 15px;">Don’t have an Account? <a href="{{route('admin.signup')}}" id="signup">Sign Up</a></div> -->
					
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
	<script src="{{ asset('public/admin/vendor/countdowntime/countdowntime.js') }}"></script>


</body>
@include('admin.layout.admin_script')
</html>