@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Manage Permission
                </h2>
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
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="mypost-col" id="">
                           <!-- <div class="mypost-pic"><a href="#"><img src="{{asset('public/images/gaming-Department-1.jpg') }}" alt=""></a></div> -->
                          <div class="mypost-content">
                              <div class="mypost-title">
                               <h2 style="text-align: center;">Role- {{$userrole->role_name}}</h2>
                              </div>
                                <div class="mypost-title">
                                  <div class="body table-responsive">
                                     <form method="post" action="{{route('admin.manage.user.perssion',$userrole->role_name)}}">
                                                @csrf
                                    <input type="hidden" name="role_id" value="{{$userrole->id}}">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>View Permission 
                                                    <input type="checkbox" name="" id="selectallview">
                                                    <label for="selectallview" style="display: block;"></label>
                                                </th>
                                                <th>Add Permission
                                                    <input type="checkbox" name="" id="selectalladd">
                                                    <label for="selectalladd" style="display: block;"></label>
                                                </th>
                                                <th>Manage Permission
                                                    <input type="checkbox" name="" id="selectallmanage">
                                                    <label for="selectallmanage" style="display: block;"></label>
                                                </th>
                                                <th>Edit Permission
                                                    <input type="checkbox" name="" id="selectalledit">
                                                    <label for="selectalledit" style="display: block;"></label>
                                                </th>
                                                <th>Delete Permission
                                                    <input type="checkbox" name="" id="selectalldelete">
                                                    <label for="selectalldelete" style="display: block;"></label>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Home</td>
                                                <input type="hidden" name="Home[name]" value="Home">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxallview" name="Home[view_permission]" id="view_permission1" value="1"@if(!empty($home) && $home->view_permission==1) checked @endif>
                                                    <label for="view_permission1"></label>
                                                    
                                                </td>
                                                 <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Canteen Master</td>
                                                <input type="hidden" name="Canteen[name]" value="Canteen">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxallview" name="Canteen[view_permission]]" value="1"@if(!empty($Canteen) && $Canteen->view_permission==1) checked @endif id="view_permission2">
                                                    <label class="custom-control-label" for="view_permission2"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Canteen[add_permission]" class="custom-control-input checkboxalladd" value="1"@if(!empty($Canteen) && $Canteen->add_permission==1) checked @endif id="add_permission1">
                                                    <label class="custom-control-label" for="add_permission1"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Canteen[manage_permission]" class="custom-control-input checkboxallmanage" value="1"@if(!empty($Canteen) && $Canteen->manage_permission==1) checked @endif id="manage_permission1">
                                                    <label class="custom-control-label" for="manage_permission1"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Canteen[edit_permission]" class="custom-control-input checkboxalledit" value="1"@if(!empty($Canteen) && $Canteen->edit_permission==1) checked @endif id="edit_permission1">
                                                    <label class="custom-control-label" for="edit_permission1"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Canteen[delete_permission]" class="custom-control-input checkboxalldelete" value="1"@if(!empty($Canteen) && $Canteen->delete_permission==1) checked @endif id="delete_permission1">
                                                    <label class="custom-control-label" for="delete_permission1"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Department Master</td>
                                                <input type="hidden" name="Department[name]" value="Department">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxallview" name="Department[view_permission]]" value="1"@if(!empty($Department) && $Department->view_permission==1) checked @endif id="view_permission3">
                                                    <label class="custom-control-label" for="view_permission3"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Department[add_permission]" class="custom-control-input checkboxalladd" value="1"@if(!empty($Department) && $Department->add_permission==1) checked @endif id="add_permission2">
                                                    <label class="custom-control-label" for="add_permission2"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Department[manage_permission]" class="custom-control-input checkboxallmanage" value="1"@if(!empty($Department) && $Department->manage_permission==1) checked @endif id="manage_permission2">
                                                    <label class="custom-control-label" for="manage_permission2"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Department[edit_permission]" class="custom-control-input checkboxalledit" value="1"@if(!empty($Department) && $Department->edit_permission==1) checked @endif id="edit_permission2">
                                                    <label class="custom-control-label" for="edit_permission2"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Department[delete_permission]" class="custom-control-input checkboxalldelete" value="1"@if(!empty($Department) && $Department->delete_permission==1) checked @endif id="delete_permission2">
                                                    <label class="custom-control-label" for="delete_permission2"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>Division Master</td>
                                                <input type="hidden" name="Division[name]" value="Division">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxallview" name="Division[view_permission]]" value="1"@if(!empty($Division) && $Division->view_permission==1) checked @endif  id="view_permission4">
                                                    <label class="custom-control-label" for="view_permission4"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Division[add_permission]" class="custom-control-input checkboxalladd" value="1"@if(!empty($Division) && $Division->add_permission==1) checked @endif  id="add_permission3">
                                                    <label class="custom-control-label" for="add_permission3"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Division[manage_permission]" class="custom-control-input checkboxallmanage" value="1"@if(!empty($Division) && $Division->manage_permission==1) checked @endif  id="manage_permission3">
                                                    <label class="custom-control-label" for="manage_permission3"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Division[edit_permission]" class="custom-control-input checkboxalledit" value="1"@if(!empty($Division) && $Division->edit_permission==1) checked @endif  id="edit_permission3">
                                                    <label class="custom-control-label" for="edit_permission3"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Division[delete_permission]" class="custom-control-input checkboxalldelete" value="1"@if(!empty($Division) && $Division->delete_permission==1) checked @endif  id="delete_permission3">
                                                    <label class="custom-control-label" for="delete_permission3"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td>Employee Category Master</td>
                                                <input type="hidden" name="EmployeeCategory[name]" value="EmployeeCategory">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxallview" name="EmployeeCategory[view_permission]]" value="1"@if(!empty($EmployeeCategory) && $EmployeeCategory->view_permission==1) checked @endif id="view_permission5">
                                                    <label class="custom-control-label" for="view_permission5"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="EmployeeCategory[add_permission]" class="custom-control-input checkboxalladd" value="1"@if(!empty($EmployeeCategory) && $EmployeeCategory->add_permission==1) checked @endif id="add_permission4">
                                                    <label class="custom-control-label" for="add_permission4"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="EmployeeCategory[manage_permission]" class="custom-control-input checkboxallmanage" value="1"@if(!empty($EmployeeCategory) && $EmployeeCategory->manage_permission==1) checked @endif id="manage_permission4">
                                                    <label class="custom-control-label" for="manage_permission4"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="EmployeeCategory[edit_permission]" class="custom-control-input checkboxalledit" value="1"@if(!empty($EmployeeCategory) && $EmployeeCategory->edit_permission==1) checked @endif id="edit_permission4">
                                                    <label class="custom-control-label" for="edit_permission4"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="EmployeeCategory[delete_permission]" class="custom-control-input checkboxalldelete" value="1"@if(!empty($EmployeeCategory) && $EmployeeCategory->delete_permission==1) checked @endif id="delete_permission4">
                                                    <label class="custom-control-label" for="delete_permission4"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">6</th>
                                                <td>Item Master</td>
                                                <input type="hidden" name="Item[name]" value="Item">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxallview" name="Item[view_permission]]" value="1"@if(!empty($Item) && $Item->view_permission==1) checked @endif id="view_permission6">
                                                    <label class="custom-control-label" for="view_permission6"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Item[add_permission]" class="custom-control-input checkboxalladd" value="1"@if(!empty($Item) && $Item->add_permission==1) checked @endif id="add_permission5">
                                                    <label class="custom-control-label" for="add_permission5"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Item[manage_permission]" class="custom-control-input checkboxallmanage" value="1"@if(!empty($Item) && $Item->manage_permission==1) checked @endif id="manage_permission5">
                                                    <label class="custom-control-label" for="manage_permission5"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Item[edit_permission]" class="custom-control-input checkboxalledit" value="1"@if(!empty($Item) && $Item->edit_permission==1) checked @endif id="edit_permission5">
                                                    <label class="custom-control-label" for="edit_permission5"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="Item[delete_permission]" class="custom-control-input checkboxalldelete" value="1"@if(!empty($Item) && $Item->delete_permission==1) checked @endif id="delete_permission5">
                                                    <label class="custom-control-label" for="delete_permission5"></label>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <th scope="row">7</th>
                                                <td>Card Inventory Master</td>
                                                <input type="hidden" name="CardInventory[name]" value="CardInventory">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxall" name="CardInventory[view_permission]]" value="1"@if(!empty($CardInventory) && $CardInventory->view_permission==1) checked @endif id="view_permission7">
                                                    <label class="custom-control-label" for="view_permission7"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="CardInventory[add_permission]" class="form-control" value="1"@if(!empty($CardInventory) && $CardInventory->add_permission==1) checked @endif id="add_permission6">
                                                    <label class="custom-control-label" for="add_permission6"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="CardInventory[manage_permission]" class="form-control" value="1"@if(!empty($CardInventory) && $CardInventory->manage_permission==1) checked @endif id="manage_permission6">
                                                    <label class="custom-control-label" for="manage_permission6"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="CardInventory[edit_permission]" class="form-control" value="1"@if(!empty($CardInventory) && $CardInventory->edit_permission==1) checked @endif id="edit_permission6">
                                                    <label class="custom-control-label" for="edit_permission6"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="CardInventory[delete_permission]" class="form-control" value="1"@if(!empty($CardInventory) && $CardInventory->delete_permission==1) checked @endif id="delete_permission6">
                                                    <label class="custom-control-label" for="delete_permission6"></label>
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <th scope="row">7</th>
                                                <td>Employee Meal</td>
                                                <input type="hidden" name="EmployeeMeal[name]" value="EmployeeMeal">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxallview" name="EmployeeMeal[view_permission]]" value="1"@if(!empty($EmployeeMeal) && $EmployeeMeal->view_permission==1) checked @endif id="view_permission9">
                                                    <label class="custom-control-label" for="view_permission9"></label>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="EmployeeMeal[manage_permission]" class="custom-control-input checkboxallmanage" value="1"@if(!empty($EmployeeMeal) && $EmployeeMeal->manage_permission==1) checked @endif  id="manage_permission9">
                                                    <label class="custom-control-label" for="manage_permission9"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                   <input type="checkbox" name="EmployeeMeal[delete_permission]" class="custom-control-input checkboxalldelete" value="1"@if(!empty($EmployeeMeal) && $EmployeeMeal->delete_permission==1) checked @endif id="edit_permission9">
                                                    <label class="custom-control-label" for="edit_permission9"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">8</th>
                                                <td>Users</td>
                                                <input type="hidden" name="ManageUsers[name]" value="ManageUsers">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxallview" name="ManageUsers[view_permission]]" value="1"@if(!empty($ManageUsers) && $ManageUsers->view_permission==1) checked @endif  id="view_permission10">
                                                    <label class="custom-control-label" for="view_permission10"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="ManageUsers[add_permission]" class="custom-control-input checkboxalladd" value="1"@if(!empty($ManageUsers) && $ManageUsers->add_permission==1) checked @endif id="add_permission10">
                                                    <label class="custom-control-label" for="add_permission10"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="ManageUsers[manage_permission]" class="custom-control-input checkboxallmanage" value="1"@if(!empty($ManageUsers) && $ManageUsers->manage_permission==1) checked @endif  id="manage_permission10">
                                                    <label class="custom-control-label" for="manage_permission10"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="ManageUsers[edit_permission]" class="custom-control-input checkboxalledit" value="1"@if(!empty($ManageUsers) && $ManageUsers->edit_permission==1) checked @endif id="edit_permission10">
                                                    <label class="custom-control-label" for="edit_permission10"></label>
                                                </td>
                                                <td>
                                                   <input type="checkbox" name="ManageUsers[delete_permission]" class="custom-control-input checkboxalldelete" value="1"@if(!empty($ManageUsers) && $ManageUsers->delete_permission==1) checked @endif id="delete_permission10">
                                                    <label class="custom-control-label" for="delete_permission10"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">9</th>
                                                <td>User Role</td>
                                                <input type="hidden" name="UserRole[name]" value="UserRole">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxallview" name="UserRole[view_permission]]" value="1"@if(!empty($UserRole) && $UserRole->view_permission==1) checked @endif id="view_permission8">
                                                    <label class="custom-control-label" for="view_permission8"></label>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="UserRole[add_permission]" class="custom-control-input checkboxalladd" value="1"@if(!empty($UserRole) && $UserRole->add_permission==1) checked @endif id="add_permission7">
                                                    <label class="custom-control-label" for="add_permission7"></label>
                                                </td>
                                                <td>
                                                    
                                                    <input type="checkbox" name="UserRole[manage_permission]" class="custom-control-input checkboxallmanage" value="1"@if(!empty($UserRole) && $UserRole->manage_permission==1) checked @endif id="manage_permission7">
                                                    <label class="custom-control-label" for="manage_permission7"></label>
                                                
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="UserRole[edit_permission]" class="custom-control-input checkboxalledit" value="1"@if(!empty($UserRole) && $UserRole->edit_permission==1) checked @endif id="edit_permission7">
                                                    <label class="custom-control-label" for="edit_permission7"></label>
                                                </td>
                                               
                                                <td>
                                                    <input type="checkbox" name="UserRole[delete_permission]" class="custom-control-input checkboxalldelete" value="1"@if(!empty($UserRole) && $UserRole->delete_permission==1) checked @endif id="delete_permission7">
                                                    <label class="custom-control-label" for="delete_permission7"></label>
                                                </td>
                                               
                                            </tr>
                                            <tr>
                                                <th scope="row">10</th>
                                                <td>User Permission</td>
                                                <input type="hidden" name="UserPermission[name]" value="UserPermission">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxallview" name="UserPermission[view_permission]]" value="1"@if(!empty($UserPermission) && $UserPermission->view_permission==1) checked  @endif id="view_permission7">
                                                    <label class="custom-control-label" for="view_permission7"></label>
                                                </td>
                                                <td>
                                                   <!--  <input type="checkbox" name="UserPermission[add_permission]" class="custom-control-input checkboxalladd" value="1"@if(!empty($UserPermission) && $UserPermission->add_permission==1) checked @endif id="add_permission8">
                                                    <label class="custom-control-label" for="add_permission8"></label> -->
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="UserPermission[manage_permission]" class="custom-control-input checkboxallmanage" value="1"@if(!empty($UserPermission) && $UserPermission->manage_permission==1) checked @endif id="manage_permission8">
                                                    <label class="custom-control-label" for="manage_permission8"></label>
                                                </td>
                                                <td>
                                                    <!-- <input type="checkbox" name="UserPermission[edit_permission]" class="custom-control-input checkboxalledit" value="1"@if(!empty($UserPermission) && $UserPermission->edit_permission==1) checked @endif id="edit_permission8">
                                                    <label class="custom-control-label" for="edit_permission8"></label> -->
                                                </td>
                                                <td>
                                                    <!-- <input type="checkbox" name="UserPermission[delete_permission]" class="custom-control-input checkboxalldelete" value="1"@if(!empty($UserPermission) && $UserPermission->delete_permission==1) checked @endif id="delete_permission8">
                                                    <label class="custom-control-label" for="delete_permission8"></label> -->
                                                </td>
                                            </tr>
                                             

                                            <!-- <tr>
                                                <th scope="row">12</th>
                                                <td>Departments Report</td>
                                                <input type="hidden" name="report[name]" value="Department report">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxall" name="report[view_permission]]" value="1"@if(!empty($Departmentreport) && $Departmentreport->view_permission==1) checked @endif id="view_permission12">
                                                    <label class="custom-control-label" for="view_permission12"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="report[manage_permission]" class="form-control" value="1"@if(!empty($Departmentreport) && $Departmentreport->manage_permission==1) checked @endif id="manage_permission12">
                                                    <label class="custom-control-label" for="manage_permission12"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="report[delete_permission]" class="form-control" value="1"@if(!empty($Departmentreport) && $Departmentreport->delete_permission==1) checked @endif id="delete_permission12">
                                                    <label class="custom-control-label" for="delete_permission12"></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">13</th>
                                                <td>Comments Report</td>
                                                <input type="hidden" name="comment[name]" value="comment report">
                                                <td>
                                                    <input type="checkbox" class="custom-control-input checkboxall" name="comment[view_permission]]" value="1"@if(!empty($commentreport) && $commentreport->view_permission==1) checked @endif id="view_permission13">
                                                    <label class="custom-control-label" for="view_permission13"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="comment[manage_permission]" class="form-control" value="1"@if(!empty($commentreport) && $commentreport->manage_permission==1) checked @endif id="manage_permission13">
                                                    <label class="custom-control-label" for="manage_permission13"></label>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="comment[delete_permission]" class="form-control" value="1"@if(!empty($commentreport) && $commentreport->delete_permission==1) checked @endif id="delete_permission13">
                                                    <label class="custom-control-label" for="delete_permission13"></label>
                                                </td>
                                            </tr>
                                             <tr>
                                                <th scope="row">13</th>
                                                <td>User Messages</td>
                                                <input type="hidden" name="message[name]" value="user messages">
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <input type="checkbox" name="message[manage_permission]" class="form-control" value="1"@if(!empty($usermsg) && $usermsg->manage_permission==1) checked @endif id="manage_permission14">
                                                    <label class="custom-control-label" for="manage_permission14"></label>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>  -->
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                        </div>
                              </div>
                              
                             
                          </div>
                       </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection