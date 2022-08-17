<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{asset('images/favicon.png')}}">

<title>Canteen Management System</title>	
	
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
	
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">	
	
<!-- Owl Stylesheets -->
<link rel="stylesheet" href="{{asset('public/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('public/css/owl.theme.default.min.css')}}">	
	
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
	
<link rel="stylesheet" href="{{asset('public/css/custom.css')}}" type="text/css" />
	
</head>
<body>
@if(!empty(Session::get('user')) || Auth::user())
@php 
$user= Session::get('user');
 @endphp
<header class="main-header">
	<div class="container">
<div class="row align-items-center">
	
<div class="col-lg-9">	
	<div class="logo-search">
	<div class="main-logo">
		<a href="{{url('/')}}"><img src="{{asset('public/images/logo.png')}}" alt=""> <span>IF YOU WERE...<i>MAKING THE WORLD A BETTER PLACE</i></span></a>
	</div>
	
	<div class="top-search">
		<form class="main-search-form" name="cform" method="post">
			<div class="form-group">
			<input type="text" class="form-control" name="name" id="name" placeholder="Search..." required="">
			</div>
			<button type="submit" class="search-ico"><i class="la la-search"></i></button>	
		</form>
	</div>
	</div>
</div>
	
<div class="col-lg-3">
	<div class="top-noti-user">
		
	  <div class="top-create-icon">
		<a href="javascript:void" data-toggle="tooltip" title="Create Post"><i class="las la-plus-circle"></i></a>
	   </div>	
		
	   <div class="top-commu-icon">
		<a href="javascript:void" data-toggle="tooltip" title="All Communities"><i class="las la-user-friends"></i></a>
	   </div>
		
	  <div class="top-user-profile">
	 <a href="javascript:void" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('public/images/user.png')}}" alt="">
	 <p><small>Welcome</small>@if(!empty(Session::get('user'))) {{$user->name}} @else {{ Auth::user()->name }} @endif</p>	</a>
		
	 <ul class="dropdown-menu">
		  <li><a href="{{url('create-post')}}">Create Post</a></li>
		  <li><a href="javascript:void">Create Community</a></li> 
		  <li><a href="javascript:void">My Communities</a></li>
		  <li><a href="javascript:void">Setting</a></li>
		  <li><a href="javascript:void">Invite Friends</a></li>
		  <li><a href="{{route('user.logout')}}">Logout</a></li>
		</ul>	
		
	</div>
	
   </div>	
</div>
	
</div>	
	
</div>
</header>
@else
<header class="main-header">
	<div class="container">
<div class="row align-items-center">
	
<div class="col-lg-9">	
	<div class="logo-search">
	<div class="main-logo">
		<a href="index.html"><img src="{{asset('public/images/logo.png')}}" alt=""> <span>IF YOU WERE...<i>MAKING THE WORLD A BETTER PLACE</i></span></a>
	</div>
	
	<div class="top-search">
		<form class="main-search-form" name="cform" method="post">
			<div class="form-group">
			<input type="text" class="form-control" name="name" id="name" placeholder="Search..." required="">
			</div>
			<button type="submit" class="search-ico"><i class="la la-search"></i></button>	
		</form>
	</div>
	</div>
</div>
	
<div class="col-lg-3">
	<div class="top-noti-user">
	
	<div class="login-btns">
		<div class="common-btn common-btn-border login-btn" data-toggle="modal" data-target="#login-modal"><i class="las la-user"></i> Sign In</div>
		<div class="common-btn signup-btn" data-toggle="modal" data-target="#signup-modal"><i class="las la-user-plus"></i> Sign Up</div>
	</div>
	
   </div>	
</div>
	
</div>	
	
</div>
</header>
@endif
	
404 Not Found	
	
	
<footer>
 <div class="container">
	<div class="row">
	  <div class="col-md-4">
		 <div class="footer-links">
		   <ul>
			<li><a href="{{url('about-us')}}">About Us</a></li>
			<li><a href="{{url('contact-us')}}">Contact Us</a></li> 
			<li><a href="javascript:void">Help</a></li> 
			<li><a href="{{url('faq')}}">FAQs</a></li> 
			<li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li> 
			<li><a href="{{url('terms-of-use')}}">Terms of Use</a></li>    
		   </ul> 
		  
		 </div>
	  </div>
		
	  <div class="col-md-4">
		<div class="footer-appcol">
		  <div class="footer-title">DOWNLOAD THE APP ON</div>
		  <div class="app-btns">
			  <a href="javascript:void"><img src="{{asset('public/images/app-apple-btn.png')}}" alt=""></a>
			  <a href="javascript:void"><img src="{{asset('public/images/app-play-btn.png')}}" alt=""></a>
			</div>
		</div>
	  </div>
		
	  <div class="col-md-4">
		<div class="footer-social">
		  <div class="footer-title">Follow Us</div>
		  <div class="social-icobtns">
			  <a href="javascript:void"><i class="lab la-facebook-f"></i></a>
			  <a href="javascript:void"><i class="lab la-twitter"></i></a>
			  <a href="javascript:void"><i class="lab la-instagram"></i></a>
			</div>
		</div>
	  </div>	
		
	 
	</div>
 </div>
	
<div class="copyright">
	<div class="container">
		<p>If you were © 2021 | All rights reserved <span>Site Developed by <a href="https://www.binarymetrix.com/" target="_blank" rel="nofollow">BinaryMetrix Technologies</a></span></p>
	</div>
</div>
</footer>	



<!--Modal: Name-->	
	
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{asset('public/js/owl.carousel.js')}}"></script>
<script src="{{asset('public/js/honey-custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@include('user.layout.script')	
</body>
</html>
