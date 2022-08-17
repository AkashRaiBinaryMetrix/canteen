@extends('admin.layout.app')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                   Create Canteen
                    
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
                            <form id="create-canteen" method="POST" action="{{route('admin.create.canteen')}}" enctype="multipart/form-data">
                                @csrf

                                @if(!empty($canteen->canteenCode))
                                <input type="hidden" name="canteen_code" value="{{$canteen->canteenCode}}">
                                @endif
                                <div class="form-group form-float">
                                    <label class="form-label">Canteen Name <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="title"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($canteen) && $canteen->canteenName ? $canteen->canteenName : old('title') )}}" placeholder="Enter Canteen Name" required="" minlength="4" maxlength="50">  
                                </div>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Canteen Location</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="location"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($canteen) && $canteen->location ? $canteen->location : old('location') )}}" placeholder="Enter Canteen Location"  minlength="4" maxlength="50">
                                </div>
                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Canteen Address</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="address"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($canteen) && $canteen->address ? $canteen->address : old('address') ) }}" placeholder="Enter Canteen Address" minlength="4" maxlength="30">
                                    </div>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group form-float">
                                    <label class="form-label">Status <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <select class="form-control" name="status" required="">
                                            <option value="">Select</option>
                                            <option value="1"@if (old('status') == 1) selected="selected"  @elseif(!empty($canteen) && $canteen->status!=NULL && $canteen->status==1) selected @endif>Active</option>
                                            <option value="0"@if (old('status') == "0") selected="selected"  @elseif(!empty($canteen) && $canteen->status!=NULL && $canteen->status==0) selected @endif>Inactive</option>
                                        </select>
                                </div>
                                    @error('status')
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