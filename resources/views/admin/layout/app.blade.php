<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="view_permissionport">
    <title>Welcome To Admin Panel</title>
    <!-- Favicon-->
    <!-- <link rel="icon" href="favicon.ico" type="{{asset('public/images/favicon.png')}}"> -->
    <!-- <link rel="shortcut icon" href="{{asset('public/images/favicon.png')}}"> -->
    <link rel="icon" type="image/png" href="{{ asset('public/admin/images/favicon.ico') }}" style="width: 50px;height:50px;" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- Bootstrap Core Css -->
    <link href="{{ asset('public/admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('public/admin/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('public/admin/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('public/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('public/admin/css/themes/all-themes.css') }}" rel="stylesheet" />
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <!-- <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div> -->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @php
     $user=\Session::get('admin');
     
     if(!empty($user))
     {
        $email=DB::table('login_master')->where('opr_id',$user->opr_id)->first();
     }else
     {
        $email='';
     }
    @endphp
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="javascript:void(0)">Canteen Management System</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <!-- <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="{{route('admin.profile')}}" class="btn btn-warning" style="padding: 11px;">
                            <i class="fa fa-lock">Change Password</i>
                        </a>
                       </li>
                       <li class="dropdown">
                        <a href="{{route('admin.logout')}}" class="btn btn-warning" style="padding: 11px;">
                            <i class="fa fa-sign-out">Logout</i>
                        </a>
                       </li>
                   </ul>
               </div>
            </div>
            
        </div>
    </nav>
    <!-- #Top Bar -->
    
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <!-- <div class="user-info">
                <div class="image">
                    <img src="{{ asset('public/user.png') }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$email->opr_id}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right"> -->
                            <!-- <li><a href="{{route('admin.profile')}}"><i class="material-icons">person</i>Profile</a></li> -->
                            <!-- <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li> -->
                           <!--  <li role="separator" class="divider"></li>
                            <li><a href="{{route('admin.logout')}}"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                   
                    <!-- <li class="header">MAIN NAVIGATION</li> -->
                   
                    <li class="@if(\Request::route()->getName()=='admin.home') active @endif">
                        <a href="{{route('admin.home')}}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    @php 
                    $permissionCommunity=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','Canteen')->first();
                    @endphp
                     @if(!empty($user) && !empty($permissionCommunity) && $permissionCommunity->view_permission==1 || $user->role_id==3)
                   <li class="@if(\Request::route()->getName()=='admin.create.canteen' || \Request::route()->getName()=='admin.manage.canteen') active @endif">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Canteen Master</span>
                        </a>
                        <ul class="ml-menu">
                            @if(!empty($user) && !empty($permissionCommunity) && $permissionCommunity->add_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.create.canteen') active @endif">
                                <a href="{{route('admin.create.canteen')}}">Create Canteen</a>
                            </li>
                            @endif
                            @if(!empty($user) && !empty($permissionCommunity) && $permissionCommunity->manage_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.manage.canteen') active @endif">
                                <a href="{{route('admin.manage.canteen')}}">Manage Canteen</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @php 
                    $permissionPost=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','Department')->first();
                    @endphp
                    @if(!empty($user) && !empty($permissionPost) && $permissionPost->view_permission==1 || $user->role_id==3)
                    <li class="@if(\Request::route()->getName()=='admin.create.department' || \Request::route()->getName()=='admin.manage.department') active @endif">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pages</i>
                            <span>Department Master</span>
                        </a>
                        <ul class="ml-menu">
                            @if(!empty($user) && !empty($permissionPost) && $permissionPost->add_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.create.department') active @endif">
                                <a href="{{route('admin.create.department')}}">Create Department</a>
                            </li>
                            @endif
                            @if(!empty($user) && !empty($permissionPost) && $permissionPost->manage_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.manage.department') active @endif">
                                <a href="{{route('admin.manage.department')}}">Manage Department</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                     @endif
                    @php 
                    $permissionCategory=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','Division')->first();
                    @endphp
                    @if(!empty($user) && !empty($permissionCategory) && $permissionCategory->view_permission==1 || $user->role_id==3)
                     <li class="@if(\Request::route()->getName()=='admin.create.division' || \Request::route()->getName()=='admin.manage.division') active @endif">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Division Master</span>
                        </a>
                        <ul class="ml-menu">
                            @if(!empty($user) && !empty($permissionCategory) && $permissionCategory->add_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.create.division') active @endif">
                                <a href="{{route('admin.create.division')}}">Create Division</a>
                            </li>
                            @endif
                             @if(!empty($user) && !empty($permissionCategory) && $permissionCategory->manage_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.manage.division') active @endif">
                                <a href="{{route('admin.manage.division')}}">Manage Division</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @php 
                    $permissionsubcategory=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','EmployeeCategory')->first();
                    @endphp
                    @if(!empty($user) && !empty($permissionsubcategory) && $permissionsubcategory->view_permission==1 || $user->role_id==3)
                    <li class="@if(\Request::route()->getName()=='admin.create.empcategory' || \Request::route()->getName()=='admin.manage.empcategory') active @endif">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>Employee Category Master</span>
                        </a>
                        <ul class="ml-menu">
                            @if(!empty($user) && !empty($permissionsubcategory) && $permissionsubcategory->add_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.create.empcategory') active @endif">
                                <a href="{{route('admin.create.empcategory')}}">Create Employee Category</a>
                            </li>
                            @endif
                            @if(!empty($user) && !empty($permissionsubcategory) && $permissionsubcategory->manage_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.manage.empcategory') active @endif">
                                <a href="{{route('admin.manage.empcategory')}}">Manage Employee Category</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @php 
                    $permissionVideos=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','Item')->first();
                    @endphp
                    @if(!empty($user) && !empty($permissionVideos) && $permissionVideos->view_permission==1 || $user->role_id==3)
                    <li class="@if(\Request::route()->getName()=='admin.create.item' || \Request::route()->getName()=='admin.manage.item' || \Request::route()->getName()=='admin.edit.item') active @endif">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_copy</i>
                            <span>Item Master</span>
                        </a>
                        <ul class="ml-menu">
                            @if(!empty($user) && !empty($permissionVideos) && $permissionVideos->add_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.create.item') active @endif">
                                <a href="{{route('admin.create.item')}}">Create Item</a>
                            </li>
                            @endif
                            @if(!empty($user) && !empty($permissionVideos) && $permissionVideos->manage_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.manage.item') active @endif">
                                <a href="{{route('admin.manage.item')}}">Manage Item</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                     @endif
                   
                    <!-- <li class="@if(\Request::route()->getName()=='admin.create.card' || \Request::route()->getName()=='admin.manage.card') active @endif">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pages</i>
                            <span>Card Inventory Master</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="@if(\Request::route()->getName()=='admin.create.card') active @endif">
                                <a href="{{route('admin.create.card')}}">Create Card</a>
                            </li>
                            <li class="@if(\Request::route()->getName()=='admin.manage.card') active @endif">
                                <a href="{{route('admin.manage.card')}}">Manage Card</a>
                            </li>
                        </ul>
                    </li> -->
                    @php 
                    $permissionPoll=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','EmployeeMeal')->first();
                    @endphp
                    @if(!empty($user) && !empty($permissionPoll) && $permissionPoll->view_permission==1 || $user->role_id==3)
                    <li class="@if(\Request::route()->getName()=='admin.manage.user.meal') active @endif">
                        <a href="{{route('admin.manage.user.meal')}}">
                            <i class="material-icons">room_service</i>
                            <span>Manage Transactions</span>
                        </a>
                    </li>
                    @endif
                    @php 
                    $permissionContent=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','ManageUsers')->first();
                    @endphp
                    @if(!empty($user) && !empty($permissionContent) && $permissionContent->view_permission==1 || $user->role_id==3)
                    <li class="@if(\Request::route()->getName()=='admin.add.users' || \Request::route()->getName()=='admin.manage.users' || \Request::route()->getName()=='admin.edit.users') active @endif">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>Manage Users</span>
                        </a>
                        <ul class="ml-menu">
                             @if(!empty($user) && !empty($permissionContent) && $permissionContent->add_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.add.users') active @endif">
                                <a href="{{route('admin.add.users')}}">Add User</a>
                            </li>
                            @endif
                            @if(!empty($user) && !empty($permissionContent) && $permissionContent->manage_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.manage.users') active @endif">
                                <a href="{{route('admin.manage.users')}}">Manage User</a>
                            </li>
                            @endif
                            </ul>
                        
                    </li>
                    @endif
                    @php 
                    $permissionemail=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','UserRole')->first();
                    @endphp
                    @if(!empty($user) && !empty($permissionemail) && $permissionemail->view_permission==1 || $user->role_id==3)
                    <li class="@if(\Request::route()->getName()=='admin.users.role.add' || \Request::route()->getName()=='admin.users.role.manage' || \Request::route()->getName()=='admin.users.role.edit') active @endif">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>User Roles</span>
                        </a>
                        <ul class="ml-menu">
                            @if(!empty($user) && !empty($permissionemail) && $permissionemail->add_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.users.role.add') active @endif">
                                <a href="{{route('admin.users.role.add')}}">Add User Role</a>
                            </li>
                            @endif
                            @if(!empty($user) && !empty($permissionemail) && $permissionemail->manage_permission==1 || $user->role_id==3)
                            <li class="@if(\Request::route()->getName()=='admin.users.role.manage') active @endif">
                                <a href="{{route('admin.users.role.manage')}}">Manage User Role</a>
                            </li>
                            @endif
                            </ul>
                        
                    </li>
                    @endif
                    @php 
                    $permissionemail=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','UserPermission')->first();
                    @endphp
                    @if(!empty($user) && !empty($permissionemail) && $permissionemail->view_permission==1 || $user->role_id==3)
                    <li class="@if(\Request::route()->getName()=='admin.users.permission') active @endif">
                        <a href="{{route('admin.users.permission') }}">
                            <i class="material-icons">update</i>
                            <span>Manage User Permission</span>
                        </a>
                       
                    </li>
                    @endif
                    
                  
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
           
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

   @yield('content')

    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('public/admin/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('public/admin/plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('public/admin/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('public/admin/js/admin.js') }}"></script>
    <script src="{{ asset('public/admin/js/pages/tables/jquery-datatable.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('public/admin/js/demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</body>
@include('admin.layout.admin_script')
</html>
