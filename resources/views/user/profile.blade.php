@extends('layouts.app')

@section('content')
<div class="container bootstrap snippet">
        {{-- @if(!is_null(Session::get('success')))
        <div class="col-xs-12">
            <div class='alert alert-success alert-dismissible'>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>{!! Session::get('success') !!}</h4>
            </div>
        </div>
        @endif --}}
    <div class="row col-sm-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="row">
    <div class="col-sm-3">
      <div class="text-center">
        <div class="col-sm-10"><h2>Your Profile</h2></div>
        <img src="/storage/avatars/{{ $user->avatar }}" class="avatar img-circle img-thumbnail" alt="avatar" style="height:250px;">
      </div></hr><br>

        </div><!--/col-3-->
    	<div class="col-sm-9">
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                  <form class="form" method="post" id="updateForm" action="{{ url('user/update') }}" enctype="multipart/form-data">
                    <input type='hidden' value="{{ csrf_token() }}" name='_token' />
                      <div class="form-group">
                        <div class="col-xs-6">
                              <label for="profile_username"><h4>Username</h4></label>
                              <input type="text" class="form-control" name="profile_username" id="profile_username" value={{ $user->name }} title="enter your user name">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="profile_email"><h4>Email</h4></label>
                              <div type="email" class="form-control" name="profile_email" id="profile_email">{{ $user->email }}</div>
                          </div>
                      </div>
                      
                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="profile_password"><h4>Password</h4></label>
                              <input type="password" class="form-control" name="profile_password" id="profile_password" title="enter your password.">
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-xs-6">
                            <label for="profile_password2"><h4>Verify</h4></label>
                              <input type="password" class="form-control" name="profile_password2" id="profile_password2" title="enter your password2.">
                          </div>
                      </div>
                      <div class="form-group">
                            <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                        </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button id="submit-button" class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	{{-- <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button> --}}
                            </div>
                      </div>
              	</form>
            </div><!--/tab-content-->
        </div><!--/col-9-->
    </div><!--/row-->

    <script src="{{ asset('js/profile.js') }}"></script>
@endsection