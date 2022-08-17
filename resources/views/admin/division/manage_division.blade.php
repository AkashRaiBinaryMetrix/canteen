@extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Manage Division</h2>
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
            <!-- Basic Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                           
                        </div>
                        @php
                         $user=\Session::get('admin'); 
                         $permission=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','Division')->first();
                        @endphp
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Canteen Name</th>
                                        <th>Division</th>
                                        <th>Status</th>
                                        @if(!empty($user) && !empty($permission) && ($permission->edit_permission==1 || $permission->delete_permission==1) || $user->role_id==3)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                     @if(count($divisiondata)>0)
                                    @foreach($divisiondata as $key=>$division)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$division->canteenName}}</td>
                                        <td>{{$division->divName}}</td>
                                        <td>
                                            @if($division->flag==1)
                                            Active
                                            @else
                                            Inactive
                                            @endif
                                        </td>
                                        @if(!empty($user) && !empty($permission) && ($permission->edit_permission==1 || $permission->delete_permission) || $user->role_id==3)
                                        <td>
                                            @if(!empty($user) && !empty($permission) && $permission->edit_permission==1 || $user->role_id==3)
                                             <a href="{{route('admin.edit.division',encrypt($division->divCode))}}" class="btn btn-success"><i class="fa fa-edit" style="padding-right: 3px;"></i>Edit</a>
                                             @endif
                                            @if(!empty($user) && !empty($permission) && $permission->delete_permission==1 || $user->role_id==3)
                                            <a href="{{route('admin.delete.division',encrypt($division->divCode))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" ><i class="fa fa-trash" style="padding-right: 3px;"></i>Delete</a> 
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