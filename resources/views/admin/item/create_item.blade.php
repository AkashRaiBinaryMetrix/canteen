@extends('admin.layout.app')
@section('content')
<style>
/*input[type=time]::-webkit-datetime-edit-ampm-field {
display: none;
}*/

input[type="time"]::-webkit-calendar-picker-indicator {
    /*background: none;*/
}
</style>
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
                            <form id="create-item" method="POST" action="{{route('admin.create.item')}}" enctype="multipart/form-data">
                                @csrf
                                @if(!empty($item->item_id))
                                <input type="hidden" name="item_id" value="{{$item->item_id}}">
                                @endif
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
                                        <select class="form-control" name="canteenCode" required>
                                            <option value="">Select</option>
                                            @if(!empty($canteendata) && count($canteendata)>0)
                                            @foreach($canteendata as $canteen)
                                            <option value="{{$canteen->canteenCode}}"@if (old('canteenCode') == $canteen->canteenCode) selected="selected"  @elseif(!empty($item) && !empty($item->canteenCode) && $item->canteenCode==$canteen->canteenCode) selected @endif>{{(!empty($canteen) && $canteen->canteenName ? $canteen->canteenName : old('canteenCode')) }}</option>
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
                                    <label class="form-label">Employee Category <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <select class="form-control" name="empCategory" required>
                                            <option value="">Select</option>
                                            @if(!empty($empcategory) && count($empcategory)>0)
                                            @foreach($empcategory as $empcat)
                                            <option value="{{$empcat->empCat_Name}}"@if (old('empCategory') == $empcat->empCat_Name) selected="selected"  @elseif(!empty($item) && !empty($item->empCategory) && $item->empCategory==$empcat->empCat_Name) selected @endif>{{(!empty($empcat) && $empcat->empCat_Name ? $empcat->empCat_Name : old('empCategory')) }}</option>
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">Item Name <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <!-- <input type="text" class="form-control" name="item_desc"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($item->item_desc) && $item->item_desc ? $item->item_desc : old('item_desc') )}}" placeholder="Enter Item Name" required=""> -->
                                        <select class="form-control" name="item_name" required>
                                        <option value="">Select</option>
                                        <option value="Breakfast"@if (old('item_name') == "Breakfast") selected="selected"  @elseif(!empty($item) && $item->item_desc!=NULL && $item->item_desc=="Breakfast") selected @endif>Breakfast</option>
                                        <option value="Lunch"@if (old('item_name') == "Lunch") selected="selected"  @elseif(!empty($item) && $item->item_desc!=NULL && $item->item_desc=="Lunch") selected @endif>Lunch</option>
                                        <option value="Evening Snacks"@if (old('item_name') == "Evening Snacks") selected="selected"  @elseif(!empty($item) && $item->item_desc!=NULL && $item->item_desc=="Evening Snacks") selected @endif>Evening Snacks</option>
                                        <option value="Dinner"@if (old('item_name') == "Dinner") selected="selected"  @elseif(!empty($item) && $item->item_desc!=NULL && $item->item_desc=="Dinner") selected @endif>Dinner</option>
                                        </select>
                                    </div>
                                    @error('item_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">Item Rate <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="item_rate"  readonly onfocus="this.removeAttribute('readonly');" value="{{ (!empty($item->rate) && $item->rate ? $item->rate : old('item_rate') )}}" placeholder="Enter Item Rate"  id="item-rate" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="" maxlength="3" minlength="2">
                                    </div>
                                    @error('item_rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">Employee Contribution <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="emp_contribution" value="{{ (!empty($item->emp_contribution) && $item->emp_contribution ? $item->emp_contribution : old('emp_contribution') )}}" placeholder="Enter Employee Contribution"  id="empl-rate" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="" maxlength="3" minlength="2">

                                    </div>
                                    <p id="employ-rate-error"></p>
                                    @error('emp_contribution')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">Company Contribution <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <input type="hidden" class="form-control" name="cmp_contribution"  value="{{ (!empty($item->cmp_contribution) && $item->cmp_contribution ? $item->cmp_contribution : old('cmp_contribution') )}}" placeholder="Enter Company Contribution" id="company-rate-max">
                                        <input type="text" class="form-control" readonly  value="{{ (!empty($item->cmp_contribution) && $item->cmp_contribution ? $item->cmp_contribution : old('cmp_contribution') )}}" placeholder="Enter Company Contribution" id="company-rate" maxlength="3" minlength="2" disabled>
                                    </div>
                                    @error('cmp_contribution')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @php
                            $currentdatetime=\Carbon\Carbon::now();
                            $time=date('H:i',strtotime($currentdatetime));
                            $start=strtotime('00:00');
                            $end=strtotime('23:59');
                            $timeinterval=15;  
                            @endphp
                                <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">Start Time <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <div class='input-group date' id='' >
                                       <!-- <input type='time' class="form-control"  name="Start_Time" value="{{(!empty($item->Start_Time) && $item->Start_Time) ? $item->Start_Time : ((old('Start_Time') ? old('Start_Time') : $time))}}" placeholder="Enter Start Time" required/> -->
                                       <select class="form-control" style="" name="Start_Time" placeholder="Select Start Time" required>
                                       <?php for ($i=$start;$i<=$end;$i = $i + $timeinterval*60)
                                            { ?>
                                            <option value="<?php echo date('H:i',$i) ?>"><?php echo date('g:i A',$i) ?></option>
                                            <?php } ?>  
                                        </select> 
                                   
                                    </div>
                                    </div>
                                    
                                    @error('Start_Time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                </div>
                            
                                <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">End Time <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <div class='input-group date' id=''>
                                           
                                                <select class="form-control" style="" name="End_Time" placeholder="Select End Time" required>
                                                    <?php for ($i=$start;$i<=$end;$i = $i + $timeinterval*60)
                                            { ?>
                                            <option value="<?php echo date('H:i',$i) ?>"><?php echo date('g:i A',$i) ?></option>
                                            <?php } ?>   
                                             </select>
                                          <!--  <input type='time' class="form-control"  name="End_Time" value="{{ (!empty($item->End_Time) && $item->End_Time) ? $item->End_Time: ((old('End_Time') ? old('End_Time') : $time))}}" placeholder="Enter End Time" required/> -->
                                           
                                         
                                        </div>
                                    </div>
                                    @error('End_Time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                </div>
                           <!--  <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">Status <span style="color: red;">*</span></label>
                                    <div class="form-line">
                                        <select class="form-control" name="status" required>
                                            <option value="">Select</option>
                                            <option value="1"@if (old('status') == "1") selected="selected"  @elseif(!empty($item->status) && $item->status!=NULL && $item->status==1) selected @endif>Active</option>
                                            <option value="0"@if (old('status') == "0") selected="selected"  @elseif(!empty($item) && $item->status=="0") selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
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