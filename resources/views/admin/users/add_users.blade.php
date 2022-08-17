@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Add Users
                    
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
                @if ($errors->any())
                @php 
                $errorsall=$errors->all(); @endphp
                            
                
                @endif
            </div>
            
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form id="add-users" method="POST" action="{{route('admin.add.users')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                @if(!empty(Session::get('admin')) && Session::get('admin')->role_name!='Admin')
                                <input type="hidden" class="form-control" name="canteenCode" value="{{Session::get('admin')->canteen_code}}" readonly>
                                <div class="form-group form-float">
                                <label class="form-label">Canteen Name <span style="color: red;">*</span></label>
                                <div class="form-line">
                                <input type="text" class="form-control" value="{{Session::get('admin')->canteenName}}" readonly disabled>
                                </div>
                                </div>
                                @else
                                <div class="form-group form-float">
                                    <label class="form-label">Canteen Name <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <select class="form-control" name="canteenCode" required="">
                                            <option value="">Select</option>
                                            @if(!empty($canteendata) && count($canteendata)>0)
                                            @foreach($canteendata as $canteen)
                                            <option value="{{$canteen->canteenCode}}"@if (old('canteenCode') == $canteen->canteenCode) selected="selected"  @elseif(!empty($division) && !empty($division->canteenCode) && $division->canteenCode==$canteen->canteenCode) selected @endif>{{(!empty($canteen) && $canteen->canteenName ? $canteen->canteenName : '') }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('canteenCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @endif
                                </div>
                                <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">User Name <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="username"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('username') }}" placeholder="Enter User Name" required="" onkeydown="return /[a-z, ]/i.test(event.key)"  minlength="4" maxlength="20">
                                        
                                    </div>
                                    @if($errors->has('username'))
                                            <span style="color: red;">{{ $errors->first('username') }}</span>
                                    @enderror
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">User Email <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('name') }}" placeholder="Enter User Email" required="" id="user-email">
                                        
                                    </div>
                                    <span id="email-error"></span>
                                    @if($errors->has('name'))
                                            <span style="color: red;">{{ $errors->first('name') }}</span>
                                    @enderror
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">User Type <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="type"  value="{{old('type')}}" required="" placeholder="Enter User Type" onkeydown="return /[a-z]/i.test(event.key)"  minlength="4" maxlength="10">
                                        <!-- <select class="form-control" name="type" required>
                                            <option value="">Select</option>
                                            @if(!empty($empcategory) && count($empcategory)>0)
                                            @foreach($empcategory as $empcat)
                                            <option value="{{$empcat->empCat_Name}}"@if (old('type') == $empcat->empCat_Name) selected="selected"  @elseif(!empty($carditem) && !empty($carditem->type) && $carditem->type==$empcat->empCat_Name) selected @endif>{{(!empty($empcat) && $empcat->empCat_Name ? $empcat->empCat_Name : old('type')) }} </option>
                                            @endforeach
                                            @endif
                                        </select> -->
                                        
                                    </div>
                                    @if($errors->has('type'))
                                            <span style="color: red;">{{ $errors->first('type') }}</span>
                                        @enderror
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">Password <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="password"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('password') }}" id="password" required="" placeholder="Enter Password">
                                        <span toggle="#password" class="fa fa-fw field-icon toggle-password fa-eye pass" style="float: right;margin-top: -20px;"></span>
                                        
                                    </div>
                                    <span class="errorshow"></span>
                                    @if($errors->has('password'))
                                        <span style="color: red;">{{ $errors->first('password') }}</span>
                                        @enderror
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">Confirm Password <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="confirm_password"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('confirm_password') }}" id="confirmpassword" placeholder="Enter Confirm Password" required="">
                                        <span toggle="#confirmpassword" class="fa fa-fw field-icon toggle-password fa-eye pass" style="float: right;margin-top: -20px;"></span>
                                    </div>
                                    <span id="pass-conpass-error"></span>
                                    @if($errors->has('confirm_password'))
                                            <span style="color: red;">{{ $errors->first('confirm_password') }}</span>
                                    @enderror
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">Template Name</label>
                                    <div class="form-line">
                                         <input type="text" class="form-control" name="template"  readonly onfocus="this.removeAttribute('readonly');" value="{{ old('template') }}" placeholder="Enter Template Name" onkeydown="return /[a-z]/i.test(event.key)"  minlength="4" maxlength="15">
                                    </div>
                                     @if($errors->has('template'))
                                            <span style="color: red;">{{ $errors->first('template') }}</span>
                                    @enderror
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">User Role<span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <select class="form-control" name="role_id" required>
                                            <option value="">Select</option>
                                            @if(!empty($roles) && count($roles)>0)
                                            @foreach($roles as $role)
                                            @if($role->role_name!='Admin')
                                            <option value="{{$role->id}}"@if(old('role_id') == $role->id) selected="selected" @endif>{{ucfirst($role->role_name)}}</option>
                                            @endif
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @if($errors->has('role_id'))
                                            <span style="color: red;">{{ $errors->first('role_id') }}</span>
                                    @enderror
                                </div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit" id="user-add">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection