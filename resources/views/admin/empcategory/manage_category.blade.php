@extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Manage Employee Category</h2>
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
             $user=\Session::get('admin'); 
             $permission=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','EmployeeCategory')->first();
             @endphp
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                           
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Canteen Name</th>
                                        <th>Employee Category Name</th>
                                        <th>Status</th>
                                        @if(!empty($user) && !empty($permission) && ($permission->edit_permission==1 || $permission->delete_permission==1) || $user->role_id==3)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                     @if(count($empcategorydata)>0)
                                    @foreach($empcategorydata as $key=>$empcat)
                                    
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$empcat->canteenName}}</td>
                                        <td>{{$empcat->empCat_Name}}</td>
                                        <td>
                                            @if($empcat->flag==1)
                                            Active
                                            @else
                                            Inactive
                                            @endif
                                        </td>
                                        @if(!empty($user) && !empty($permission) && ($permission->edit_permission==1 || $permission->delete_permission) || $user->role_id==3)
                                        <td>
                                            @if(!empty($user) && !empty($permission) && $permission->edit_permission==1 || $user->role_id==3)
                                             <a href="{{route('admin.edit.empcategory',encrypt($empcat->empCat_Code))}}" class="btn btn-success"><i class="fa fa-edit" style="padding-right: 3px;"></i>Edit</a>
                                            @endif
                                            @if(!empty($user) && !empty($permission) && $permission->delete_permission==1 || $user->role_id==3)
                                            <a href="{{route('admin.delete.empcategory',encrypt($empcat->empCat_Code))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" ><i class="fa fa-trash" style="padding-right: 3px;"></i>Delete</a> 
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
</section>
@endsection