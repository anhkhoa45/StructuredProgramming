@extends('admin.layouts.master')
@section('content')
<section class="content-header">
    <h1>
        {!! trans('admin/user.mg_user') !!}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('admin.home') !!}"><i class="fa fa-dashboard"></i> {!! trans('admin/base.home') !!}</a></li>
        <li><a href="{!! route('admin.setting.user.index') !!}">{!! trans('admin/user.user') !!}</a></li>
        <li><a href="{!! route('admin.setting.user.create') !!}">{!! trans('admin/user.add_user') !!}</a></li>
    </ol>
</section>
<section class="content" id="user-wrap">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h3 class="box-title">{!! trans('admin/user.add_user') !!}</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <!-- form start -->
                    <form class="form-horizontal" method="POST" action="{!! route('admin.setting.user.store') !!}" enctype= "multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!} " >
                            <label class="col-sm-2 control-label"><span class="required">*</span>{!! trans('admin/user.name') !!}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{!! old('name') !!}">
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!} " >
                            <label class="col-sm-2 control-label"><span class="required">*</span> {!! trans('admin/user.email') !!}</label>
                            <div class="col-sm-9">
                                <input autocomplete="off" type="text" class="form-control" name="email" value="{!! old('email') !!}">
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!} " >
                            <label class="col-sm-2 control-label"><span class="required">*</span> {!! trans('admin/user.password') !!}</label>
                            <div class="col-sm-9">
                                <input autocomplete="off" type="password" class="form-control" name="password" value="{!! old('password') !!}">
                                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {!! $errors->has('password_confirmation') ? 'has-error' : '' !!} " >
                            <label class="col-sm-2 control-label"><span class="required">*</span> {!! trans('admin/user.password_confirmation') !!}</label>
                            <div class="col-sm-9">
                                <input autocomplete="off" type="password" class="form-control" name="password_confirmation"/>
                                {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {!! $errors->has('role_id') ? 'has-error' : '' !!} " >
                            <label class="col-sm-2 control-label"><span class="required">*</span> {!! trans('admin/user.role_id') !!}</label>
                            <div class="col-sm-9">
                                <select class="form-control select2"name="role_id" style="width: 100%">
                                    @foreach($roleArr as $key => $r)
                                    <option value="{!! $key !!}">{!! $r !!}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('role_id', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {!! $errors->has('active') ? 'has-error' : '' !!} " >
                            <label class="col-sm-2 control-label"> {!! trans('admin/user.active') !!}</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="active" />
                                {!! $errors->first('active', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {!! $errors->has('avatar') ? 'has-error' : '' !!} " >
                            <label class="col-sm-2 control-label"> {!! trans('admin/user.avatar') !!}</label>
                            <div class="col-sm-9">
                                <div class="image-preview-wrapper">
                                    <div class="image-preview">
                                        <label for="image-input" class="image-label">Choose File</label>
                                        <input type="file" name="avatar" class="image-input"/>
                                    </div>
                                </div>
                                {!! $errors->first('avatar', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit"class="btn btn-default pull-right custom-button">
                                <i class="fa fa-save"></i> {!! trans('admin/base.btn_save') !!}
                            </button>
                            <a href="{!! route('admin.setting.user.index') !!}" class="btn btn-default btn-default-hover">
                                <i class="fa fa-times"></i> {!! trans('admin/base.btn_cancel') !!}
                            </a>
                        </div>
                    </form>
                    <!-- /.form end -->
                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col-xs-12 -->
</section>
<!-- /.section -->
@stop
@section('script')
@parent
<script src="{!! asset('js/nhn-user.js') !!}"></script>
@stop
