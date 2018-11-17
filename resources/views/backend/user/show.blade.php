@extends('backend.layouts.master')
@section('content')
<section class="content-header">
    <h1>
        {!! trans('backend/user.mg_user') !!}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('backend') !!}"><i class="fa fa-dashboard"></i> {!! trans('backend/base.home') !!}</a></li>
        <li><a href="{!! route('backend.setting.user.index') !!}">{!! trans('backend/user.user') !!}</a></li>
        <li><a href="{!! route('backend.setting.user.show', $user->id) !!}">{!! trans('backend/user.detail') !!}</a></li>
    </ol>
</section>
<br/>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="avatar">
                <img src="{!! $user->getAvatarUrl() !!}" class="user-image img-responsive" alt="{!! trans('backend/user.avatar') !!}">
            </div>
        </div> 
        <div class='col-md-9'>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <h3 class="panel-title text-center"><i class="fa fa-user"></i> {!! trans('backend/user.detail') !!}</h3>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">ID</td>
                            <td><span class="label label-info">#{!! $user->id!!}</span></td>
                        </tr>
                        <tr>
                            <td>{!! trans('backend/user.name') !!}</td>
                            <td>{!! $user->name!!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('backend/user.email') !!}</td>
                            <td>{!! $user->email !!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('backend/user.role_id') !!}</td>
                            <td><span class='label label-info'>{!! $user->roleToString() !!}</span></td>
                        </tr>
                        <tr>
                            <td>{!! trans('backend/user.status') !!}</td>
                            <td><span class='label {!! $user->activeToLbClass() !!}'>{!! $user->activeToString() !!}</span></td>
                        </tr>
                        <tr>
                            <td>{!! trans('backend/user.created_at') !!}</td>
                            <td>{!! $user->created_at !!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('backend/user.updated_at') !!}</td>
                            <td>{!! $user->updated_at !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.section -->
@stop
