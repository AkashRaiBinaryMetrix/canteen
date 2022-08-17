@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                   Create item
                    
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
                            <form id="create-card" method="POST" action="{{route('admin.create.card')}}" enctype="multipart/form-data">
                                @csrf
                                @if(!empty($carditem->cardId))
                                <input type="hidden" name="cardId" value="{{$carditem->cardId}}">
                                @endif
                                <div class="form-group form-float">
                                    <label class="form-label">Canteen Name <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <select class="form-control" name="canteenCode" required>
                                            <option value="">Select</option>
                                            @if(!empty($canteendata) && count($canteendata)>0)
                                            @foreach($canteendata as $canteen)
                                            <option value="{{$canteen->canteenCode}}"@if (old('canteenCode') == $canteen->canteenCode) selected="selected"  @elseif(!empty($carditem) && !empty($carditem->canteenCode) && $carditem->canteenCode==$canteen->canteenCode) selected @endif>{{(!empty($canteen) && $canteen->canteenName ? $canteen->canteenName : old('canteenCode')) }}</option>
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
                                <div class="form-group form-float">
                                    <label class="form-label">Employee Category</label>
                                    <div class="form-line">
                                        <select class="form-control" name="empCategory" required>
                                            <option value="">Select</option>
                                            @if(!empty($empcategory) && count($empcategory)>0)
                                            @foreach($empcategory as $empcat)
                                            <option value="{{$empcat->empCat_Name}}"@if (old('empCategory') == $empcat->empCat_Name) selected="selected"  @elseif(!empty($carditem) && !empty($carditem->empCategory) && $carditem->empCategory==$empcat->empCat_Name) selected @endif>{{(!empty($empcat) && $empcat->empCat_Name ? $empcat->empCat_Name : old('empCategory')) }} </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('empCategory')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Department</label>
                                    <div class="form-line">
                                        <select class="form-control" name="department" required>
                                            <option value="">Select</option>
                                            @if(!empty($department) && count($department)>0)
                                            @foreach($department as $dep)
                                            <option value="{{$dep->deptName}}"@if (old('department') == $dep->deptName) selected="selected"  @elseif(!empty($carditem) && !empty($carditem->department) && $carditem->department==$dep->deptName) selected @endif>{{(!empty($dep) && $dep->deptName ? $dep->deptName : old('department')) }} </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Division</label>
                                    <div class="form-line">
                                        <select class="form-control" name="division" required>
                                            <option value="">Select</option>
                                            @if(!empty($division) && count($division)>0)
                                            @foreach($division as $div)
                                            <option value="{{$div->divName}}"@if (old('division') == $div->divName) selected="selected"  @elseif(!empty($carditem) && !empty($carditem->division) && $carditem->division==$div->divName) selected @endif>{{(!empty($div) && $div->divName ? $div->divName : old('division')) }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('division')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                               
                                <div class="form-group form-float">
                                    <label class="form-label">Employee Id</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="empId"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($carditem->empId) && $carditem->empId ? $carditem->empId : old('empId') )}}" placeholder="Enter Employee Id" maxlength="7" minlength="3" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    </div>
                                    @error('empId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Employee Name</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="empName"   value="{{ (!empty($carditem->empName) && $carditem->empName ? $carditem->empName : old('empName') )}}" placeholder="Enter Employee Name" required onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
                                    </div>
                                    @error('empName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Mobile</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mobile" value="{{ (!empty($carditem->mobile) && $carditem->mobile ? $carditem->mobile : old('mobile') )}}" placeholder="Enter Mobile Number" maxlength="10" minlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern="((\+*)((0[ -]+)*|(91 )*)(\d{12}+|\d{10}+))|\d{5}([- ]*)\d{6}" id="user-mobile">
                                    </div>
                                    <span id="mobile-error"></span>
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Email</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="email"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($carditem->email) && $carditem->email ? $carditem->email : old('email') )}}" placeholder="Enter Email">
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <!-- <div class="row">
                                <div class="col-md-12">
                                <div class="form-group form-float">
                                    <label class="form-label">Card Status</label>
                                    <div class="form-line">
                                        <select class="form-control" name="status" required>
                                            <option value="">Select</option>
                                            <option value="1"@if (old('status') == 1) selected="selected"  @elseif(!empty($carditem->status) && $carditem->status!=NULL && $carditem->status==1) selected @endif>Active</option>
                                            <option value="0"@if(!empty($carditem) && $carditem->status=="0") selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                    
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                </div>
                                </div> -->
                                <div class="row">
                                <div class="col-md-12">
                                <div class="form-group form-float">
                                    <label class="form-label">Password</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="password"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($carditem->password) && $carditem->password ? $carditem->password : old('password') )}}" placeholder="Enter Password"  required>
                                    </div>
                                    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                <div class="form-group form-float">
                                    <label class="form-label">Card Type</label>
                                    <div class="form-line">
                                        <select class="form-control" name="cardType" required>
                                            <option value="">Select</option>
                                            <option value="1"@if (old('cardType') == 1) selected="selected"  @elseif(!empty($carditem->cardType) && $carditem->cardType!=NULL && $carditem->cardType==1) selected @endif>Active</option>
                                            <option value="0"@if(!empty($carditem) && $carditem->cardType==0) selected @endif>Inactive</option>
                                        </select>
                                       
                                    </div>
                                    
                                    @error('cardType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                </div>
                                </div>
                                <!-- <div class="row">
                                <div class="col-md-12">
                                <div class="form-group form-float">
                                    <label class="form-label">Remarks</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="remarks"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($carditem->remarks) && $carditem->remarks ? $carditem->remarks : old('remarks') )}}" placeholder="Enter Remarks" >
                                    </div>
                                    
                                    @error('remarks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                </div>
                                </div> -->
                                <!-- <div class="form-group form-float">
                                    <label class="form-label">Flag</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="flag2"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($carditem->flag2) && $carditem->flag2 ? $carditem->flag2 : old('flag2') )}}" placeholder="Enter Flag" > 
                                    </div>
                                    @error('flag2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> -->
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection