@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                   Create Employee Category
                    
                </h2>
                @if ($message = Session::get('error'))
                <script type="text/javascript">alert("{{ $message }}");</script>
                @endif
                @if ($message = Session::get('success'))
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
                            <form id="create-employee-category" method="POST" action="{{route('admin.create.empcategory')}}" enctype="multipart/form-data">
                                @csrf

                                @if(!empty($empcategory->empCat_Code))
                                <input type="hidden" name="empCat_Code" value="{{$empcategory->empCat_Code}}">
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
                                            <option value="{{$canteen->canteenCode}}"@if (old('canteenCode') == $canteen->canteenCode) selected="selected"  @elseif(!empty($empcategory) && !empty($empcategory->canteenCode) && $empcategory->canteenCode==$canteen->canteenCode) selected @endif>{{(!empty($canteen) && $canteen->canteenName ? $canteen->canteenName : '') }}</option>
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
                                    <label class="form-label">Employee Category Name <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="empCat_Name"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($empcategory->empCat_Name) && $empcategory->empCat_Name ? $empcategory->empCat_Name : old('empCat_Name') )}}" placeholder="Enter Employee Category Name" required="" onkeydown="return /[a-z, ]/i.test(event.key)"  minlength="4" maxlength="25">
                                </div>
                                    @error('empCat_Name')
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
                                            <option value="1"@if (old('flag') == 1) selected="selected"  @elseif(!empty($empcategory->flag) && $empcategory->flag!=NULL && $empcategory->flag==1) selected @endif>Active</option>
                                            <option value="0"@if (old('flag') == "0") selected="selected"  @elseif(!empty($empcategory) && $empcategory->flag==0) selected @endif>Inactive</option>
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