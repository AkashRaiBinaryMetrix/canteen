@extends('admin.layout.app')
@section('content')
<style type="text/css">
      cursor: pointer;
    }
   .avatar-wrapper:hover .profile-pic {
     opacity: 0.5;
    }
   .avatar-wrapper .profile-pic {
     height: 100%;
     width: 100%;
      transition: all 0.3s ease;
    }
   .avatar-wrapper .profile-pic:after {
      font-family:'Line Awesome Free';
      font-weight: 900;
  }
 
.avatar-wrapper .upload-button {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    cursor: pointer;
}

</style>
<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
            
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>
                               @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                        <strong>{{ $message }}</strong>
                                </div>
                                @endif
                                @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                        <strong>{{ $message }}</strong>
                                </div>
                                @endif  
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab"><b>Change Password</b></a></li>
                                </ul>

                                <div class="tab-content">
                        
                                    <div role="tabpanel" class="tab-pane fade in active" id="change_password_settings">
                                        <form class="form-horizontal" method="post" action="{{route('admin.profile_password')}}" id="change-password-form">
                                            @csrf
                                            <div class="form-group">
                                                <label for="OldPassword" class="col-sm-3 control-label">Old Password <span style="color: red;">*</span></label>
                                                <input type="hidden" name="id" value="{{$admin->id}}">
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="OldPassword" name="oldpassword" placeholder="Old Password" required>
                                                        <span toggle="#OldPassword" class="fa fa-fw field-icon toggle-password fa-eye pass" style="float: right;margin-top: -20px;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPassword" class="col-sm-3 control-label">New Password <span style="color: red;">*</span></label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPassword" name="newpassword" placeholder="New Password" required>
                                                        <span toggle="#NewPassword" class="fa fa-fw field-icon toggle-password fa-eye pass" style="float: right;margin-top: -20px;"></span>
                                                        <span class="errorshow"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm) <span style="color: red;">*</span></label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="NewPasswordConfirm" name="newpasswordConfirm" placeholder="New Password (Confirm)" required>
                                                        <span toggle="#NewPasswordConfirm" class="fa fa-fw field-icon toggle-password fa-eye pass" style="float: right;margin-top: -20px;"></span>
                                                        <span id="pass-conpass-error"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-danger">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
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