 @extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Manage Users</h2>
                 <a href="{{route('admin.add.users')}}" class="btn btn-success" style="margin: 12px;float: right;"><i class="fa fa-plus" style="padding-right: 3px;"></i>Add New User</a>
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
                @endif
            </div>
            @php
            $userid=\Session::get('admin'); 
            $permission=DB::table('roles_permissions')->where('role_id',$userid->role_id)->where('title','ManageUsers')->first();
            
            @endphp
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        <div class="header">

                            <h2>
                                All Users
                            </h2>


                            <!-- <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                        </div>
                        <div class="body" style="overflow: scroll;">

                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead> 
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Password</th>
                                        <th>Canteen</th>
                                        <th>User Type</th>
                                        <th>Template Name</th>
                                        @if(!empty($userid) && !empty($permission) && ($permission->edit_permission==1 || $permission->delete_permission) || $userid->role_id==3)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $key=>$user)
                                    @php
                                    $status1=encrypt('reject');
                                    $status2=encrypt('deactive');
                                    $status3=encrypt('approve');
                                    $status4=encrypt('active');
                                    $canteen=DB::table('canteen_master')->where('canteenCode',$user->canteen_code)->first();
                                    @endphp
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$user->opr_id}}</td>
                                        <td>{{$user->password}}</td>
                                        <td>{{$canteen->canteenName ?? ''}}</td>
                                        <td>{{$user->userType}}</td> 
                                        <td>{{$user->templateName}}</td>

                                        @if(!empty($user) && !empty($permission) && ($permission->edit_permission==1 || $permission->delete_permission) || $user->role_id==3)
                                        <td>
                                            @if(!empty($userid) && !empty($permission) && $permission->edit_permission==1 || $userid->role_id==3)
                                            <a href="{{route('admin.edit.users',encrypt($user->id))}}" class="btn btn-success"><i class="fa fa-edit" style="padding-right: 3px;"></i>Edit</a>
                                            @endif
                                            @if(!empty($userid) && !empty($permission) && $permission->delete_permission==1 || $userid->role_id==3)
                                            <a href="{{url('admin/delete-users/'.$user->opr_id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" id="del{{$key+1}}" style="margin-top: 5px;"><i class="fa fa-trash" style="padding-right: 3px;"></i>Delete</a>
                                             @endif
                                        </td>
                                        @endif
                                        
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
</section>

@endsection