@extends('admin.layout.app')
 @section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Manage Canteen</h2>
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
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Canteen Name</th>
                                        <th>Department</th>
                                        <th>Division</th>
                                        <th>Card ID.</th>
                                        <th>Card UID.</th>
                                        <th>Card No.</th>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Card Status</th>
                                        <th>Employee Category</th>
                                        <th>Registration Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($carddata)>0)
                                    @foreach($carddata as $key=>$card)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$card->canteenName}}</td>
                                        <td>{{$card->department}}</td>
                                        <td>{{$card->division}}</td>
                                        <td>{{$card->cardId}}</td>
                                        <td>{{$card->cardUid}}</td>
                                        <td>{{$card->cardNo}}</td>
                                        <td>{{$card->empId}}</td>
                                        <td>{{$card->empName}}</td>
                                        <td>{{$card->email}}</td>
                                        <td>{{$card->mobile}}</td>
                                        <td>{{$card->cardStatus}}</td>
                                        <td>{{$card->empCategory}}</td>
                                        <td>{{$card->registrationDate}}</td>
                                        <td>
                                             <a href="{{route('admin.edit.card',encrypt($card->cardId))}}" class="btn btn-success"><i class="fa fa-edit" style="padding-right: 3px;"></i>Edit</a>
                                            <a href="{{route('admin.delete.card',encrypt($card->cardId))}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" ><i class="fa fa-trash" style="padding-right: 3px;"></i>Delete</a> 
                                        </td>
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