@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                   Create Department
                    
                </h2>
                @if ($message = Session::get('error'))
                <!-- <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div> -->
                <script type="text/javascript">alert("{{ $message }}");</script>
                @endif
                @if ($message = Session::get('success'))
                <!-- <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div> -->
                <script type="text/javascript">alert("{{ $message }}");</script>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    Please fill all required fields
                </div>
                @endif
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form id="create-department" method="POST" action="{{route('admin.create.department')}}" enctype="multipart/form-data">
                                @csrf

                                @if(!empty($department->deptCode))
                                <input type="hidden" name="deptCode" value="{{$department->deptCode}}">
                                @endif
                                @if(!empty(Session::get('admin')) && Session::get('admin')->role_name!='Admin')
                                <input type="hidden" name="canteenCode" value="{{Session::get('admin')->canteen_code}}">
                                @else
                                <div class="form-group form-float">
                                    <label class="form-label">Canteen Name <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <select class="form-control" name="canteenCode" required="">
                                            <option value="">Select</option>
                                            @if(!empty($canteendata) && count($canteendata)>0)
                                            @foreach($canteendata as $canteen)
                                            <option value="{{$canteen->canteenCode}}"@if (old('canteenCode') == $canteen->canteenCode) selected="selected"  @elseif(!empty($department) && !empty($department->canteenCode) && $department->canteenCode==$canteen->canteenCode) selected @endif>{{(!empty($canteen) && $canteen->canteenName ? $canteen->canteenName : '') }}</option>
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
                                <div class="form-group form-float">
                                    <label class="form-label">Department Name <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="deptName"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($department->deptName) && $department->deptName ? $department->deptName : old('deptName') )}}" placeholder="Enter Department Name" required="" onkeydown="return /[a-z, ]/i.test(event.key)"  minlength="2" maxlength="50">
                                </div>
                                    @error('deptName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Status <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <select class="form-control" name="flag" required="">
                                            <option value="">Select</option>
                                            <option value="1"@if (old('flag') == 1) selected="selected"  @elseif(!empty($department->flag) && $department->flag!=NULL && $department->flag==1) selected @endif>Active</option>
                                            <option value="0"@if (old('flag') == "0") selected="selected"  @elseif(!empty($department) && $department->flag==0) selected @endif>Inactive</option>
                                        </select>
                                </div>
                                    @error('flag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection