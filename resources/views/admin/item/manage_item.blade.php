@extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Manage Item</h2>
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
             $permission=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','Item')->first();
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
                                        <th>Item Description</th>
                                        <th>Employee Contribution</th>
                                        <th>Company Contribution</th>
                                        <th>Total Rate</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <!-- <th>Status</th> -->
                                        <th>Create Date</th>
                                        @if(!empty($user) && !empty($permission) && ($permission->edit_permission==1 || $permission->delete_permission==1) || $user->role_id==3)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                     @if(count($itemdata)>0)
                                    @foreach($itemdata as $key=>$item)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$item->canteenName}}</td>
                                        <td>{{$item->empCategory}}</td>
                                        <td>{{$item->item_desc}}</td>
                                        <td>{{$item->emp_contribution}}</td>
                                        <td>{{$item->cmp_contribution}}</td>
                                        <td>{{$item->rate}}</td>
                                        <td>{{ date('h:i A',strtotime($item->Start_Time)) }}</td>
                                        <td>{{ date('h:i A',strtotime($item->End_Time)) }}</td>
                                        <!-- <td>
                                            @if($item->status==1)
                                            Active
                                            @else
                                            Inactive
                                            @endif
                                        </td> -->
                                        <td>{{ (!empty($item->created_at) ? date('d-m-Y h:m:i A',strtotime($item->created_at)) : '')}}</td>

                                        @if(!empty($user) && !empty($permission) && ($permission->edit_permission==1 || $permission->delete_permission) || $user->role_id==3)
                                        <td>
                                            @if(!empty($user) && !empty($permission) && $permission->edit_permission==1 || $user->role_id==3)
                                             <a href="{{route('admin.edit.item',encrypt($item->item_id))}}" class="btn btn-success"><i class="fa fa-edit" style="padding-right: 3px;"></i>Edit</a>
                                            @endif
                                            @if(!empty($user) && !empty($permission) && $permission->delete_permission==1 || $user->role_id==3)
                                            <a href="{{route('admin.delete.item',encrypt($item->item_id))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" ><i class="fa fa-trash" style="padding-right: 3px;"></i>Delete</a>
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