 @extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Manage Transaction Reports</h2>
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
                            <form method="post" action="{{route('admin.manage.user.meal')}}">
                           @csrf
                          <div class="row">
                              <div class="col-md-3">
                                <label>Search By Employee Category</label>
                               <select class="form-control" name="category" id="category_id">
                                    <option value="">Select Employee Category</option>
                                   <?php 
                                      if(!empty($category) && count($category)>0)
                                      {
                                        foreach($category as $key=>$obj)
                                        {
                                      ?>
                                    <option value="<?=$obj->empCat_Name?>"<?php if (!empty($data['category']) && $data['category'] == $obj->empCat_Name) { echo 'selected="true"';}?>><?=$obj->empCat_Name?></option>
                                    <?php } } ?>
                                </select>
                              </div>
                              <div class="col-md-3">
                                <label>Search By Employee Id</label>
                                 <input type="number" name="empid" class="form-control" placeholder="Search By Employee Id" min="0" value="{{!empty($data['empid']) ? $data['empid'] : ''}}">
                              </div>
                              <div class="col-md-3">
                                <label>Search From Date</label>
                                 <input type="date" name="from" class="form-control" value="{{!empty($data['from']) ? $data['from'] : ''}}">
                              </div>
                              <div class="col-md-3">
                                <label>Search To Date</label>
                                 <input type="date" name="to" class="form-control" value="{{!empty($data['to']) ? $data['to'] : ''}}">
                              </div>
                              <div class="col-md-3" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-primary">Search</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        @php
                        $user=\Session::get('admin'); 
                        $permission=DB::table('roles_permissions')->where('role_id',$user->role_id)->where('title','EmployeeMeal')->first();
                        @endphp
                        <div class="body" style="overflow: scroll;">
                            <table class="table table-bordered table-striped table-hover js-basic-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Id</th>
                                        <th>Employee Category</th>
                                        <th>Canteen Name</th>
                                        <th>Employee Name</th>
                                        <th>Breakfast Quantity</th>
                                        <th>Lunch Quantity</th>
                                        <th>Evening Snacks Quantity</th>
                                        <th>Dinner Quantity</th>
                                        <th>Breakfast Amount</th>
                                        <th>Lunch Amount</th>
                                        <th>Evening Snacks Amount</th>
                                        <th>Dinner Amount</th>
                                        <th>Total Amount</th>
                                        <th>Total Company Contribution</th>
                                        <th>Total Employee Contribution</th>
                                        @if(!empty($user) && !empty($permission) && ($permission->edit_permission==1 || $permission->delete_permission==1) || $user->role_id==3)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $bquantity=0;
                                    $lquantity=0;
                                    $evquantity=0;
                                    $dquantity=0;
                                    $bamount=0;
                                    $lamount=0;
                                    $evamount=0;
                                    $damount=0;
                                    $totalamount=0;
                                    $totalcmpdamount=0;
                                    $totalempdamount=0;
                                    @endphp
                                    @foreach($employeemeal as $key=>$meal)
                                    @php
                                    $item=DB::table('item_master')->where('item_id',$meal->food_type)->first();
                                    $canteen=DB::table('canteen_master')->where('canteenCode',$item->canteenCode)->first();
                                    $username=DB::table('card_inventory_master')->where('empId',$meal->empid)->first();
                                    if(!empty($item->cmp_contribution && $item->emp_contribution))
                                    {
                                        $itemrate=$item->cmp_contribution+$item->emp_contribution;
                                    }else
                                    {
                                        $itemrate=0;
                                    }
                                    
                                    if($item->item_desc=='Breakfast')
                                    {
                                        $itemtype=DB::table('item_master')->where('item_desc','Breakfast')->first();
                                        $meal=DB::table('employee_meal')->where('food_type',$itemtype->item_id)->first();
                                        $bquantity+=$meal->food_type;
                                        $bamount+=$itemtype->cmp_contribution+$itemtype->emp_contribution;
                                        $totalamount+=$bamount;
                                        $totalcmpdamount+=$itemtype->cmp_contribution;
                                        $totalempdamount+=$itemtype->emp_contribution;
                                    }
                                    if($item->item_desc=='Lunch')
                                    {
                                        $itemtype=DB::table('item_master')->where('item_desc','Lunch')->first();
                                        $meal=DB::table('employee_meal')->where('food_type',$itemtype->item_id)->first();
                                        $lquantity+=$meal->food_type;
                                        $lamount+=$itemtype->cmp_contribution+$itemtype->emp_contribution;
                                        $totalamount+=$lamount;
                                        $totalcmpdamount+=$itemtype->cmp_contribution;
                                        $totalempdamount+=$itemtype->emp_contribution;
                                    }
                                    if($item->item_desc=='Evening Snacks')
                                    {
                                        $itemtype=DB::table('item_master')->where('item_desc','Evening Snacks')->first();
                                        $meal=DB::table('employee_meal')->where('food_type',$itemtype->item_id)->first();
                                        $evquantity+=$meal->food_type;
                                        $evamount+=$itemtype->cmp_contribution+$itemtype->emp_contribution;
                                        $totalamount+=$evamount;
                                        $totalcmpdamount+=$itemtype->cmp_contribution;
                                        $totalempdamount+=$itemtype->emp_contribution;
                                    }
                                    if($item->item_desc=='Dinner')
                                    {
                                        $itemtype=DB::table('item_master')->where('item_desc','Dinner')->first();
                                        $meal=DB::table('employee_meal')->where('food_type',$itemtype->item_id)->first();
                                        $dquantity+=$meal->food_type;
                                        $damount+=$itemtype->cmp_contribution+$itemtype->emp_contribution;
                                        $totalamount+=$damount;
                                        $totalcmpdamount+=$itemtype->cmp_contribution;
                                        $totalempdamount+=$itemtype->emp_contribution;
                                    }
                                     
                                    @endphp
                                    <tr>
                                        <td scope="row">{{$key+1}}</td>
                                        <td>{{ ($meal->empid ? $meal->empid : '')}}</td>
                                        <td>{{ ($meal->empcategory ? $meal->empcategory : '')}}</td>
                                        <td>{{ ($canteen->canteenName ? $canteen->canteenName : '')}}</td>
                                        <td>{{ ($username->empName ? $username->empName : '')}}</td>
                                        <td>{{ (!empty($employee['bquantity']) ? $employee['bquantity'] : '')}}</td>
                                        <td>{{ (!empty($employee['lquantity']) ? $employee['lquantity'] : '')}}</td>
                                        <td>{{ (!empty($employee['evquantity']) ? $employee['evquantity'] : '')}}</td>
                                        <td>{{ (!empty($employee['dquantity']) ? $employee['dquantity'] : '')}}</td>
                                        <td>{{ (!empty($employee['bamount']) ? $employee['bamount'] : '')}}</td>
                                        <td>{{ (!empty($employee['lamount']) ? $employee['lamount'] : '')}}</td>
                                        <td>{{ (!empty($employee['evamount']) ? $employee['evamount'] : '')}}</td>
                                        <td>{{ (!empty($employee['damount']) ? $employee['damount'] : '')}}</td>
                                        <td>{{ (!empty($employee['totalamount']) ? $employee['totalamount'] : '')}}</td>
                                        <td>{{ (!empty($employee['totalcmpdamount']) ? $employee['totalcmpdamount'] : '')}}</td>
                                        <td>{{ (!empty($employee['totalempdamount']) ? $employee['totalempdamount'] : '')}}</td>
                                        
                                        @if(!empty($user) && !empty($permission) && ($permission->edit_permission==1 || $permission->delete_permission) || $user->role_id==3)
                                        <td>
                                            @if(!empty($user) && !empty($permission) && $permission->delete_permission==1 || $user->role_id==3)
                                            <a href="{{url('admin/delete-employee-meal/'.$meal->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" id="del{{$key+1}}" style="margin-top: 5px;"><i class="fa fa-trash" style="padding-right: 3px;"></i>Delete</a>
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