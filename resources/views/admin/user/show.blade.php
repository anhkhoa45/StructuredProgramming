@extends('admin.layouts.master')
@section('content')
<section class="content-header">
    <h1>
        {!! trans('admin/user.mg_user') !!}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('admin.home') !!}"><i class="fa fa-dashboard"></i> {!! trans('admin/base.home') !!}</a></li>
        <li><a href="{!! route('admin.setting.user.index') !!}">{!! trans('admin/user.user') !!}</a></li>
        <li><a href="{!! route('admin.setting.user.show', $user->id) !!}">{!! trans('admin/user.detail') !!}</a></li>
    </ol>
</section>
<br/>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="avatar">
                    <img src="{!! $user->getAvatarUrl() !!}" class="user-image img-responsive" alt="{!! trans('admin/user.avatar') !!}">
                </div>
            </div>
            <div class='col-md-9'>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <h3 class="panel-title text-center"><i class="fa fa-user"></i> {!! trans('admin/user.detail') !!}</h3>
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
                                <td>{!! trans('admin/user.name') !!}</td>
                                <td>{!! $user->name!!}</td>
                            </tr>
                            <tr>
                                <td>{!! trans('admin/user.email') !!}</td>
                                <td>{!! $user->email !!}</td>
                            </tr>
                            <tr>
                                <td>{!! trans('admin/user.role_id') !!}</td>
                                <td><span class='label label-info'>{!! $user->roleToString() !!}</span></td>
                            </tr>
                            <tr>
                                <td>{!! trans('admin/user.status') !!}</td>
                                <td><span class='label {!! $user->activeToLbClass() !!}'>{!! $user->activeToString() !!}</span></td>
                            </tr>
                            <tr>
                                <td>{!! trans('admin/user.created_at') !!}</td>
                                <td>{!! $user->created_at !!}</td>
                            </tr>
                            <tr>
                                <td>{!! trans('admin/user.updated_at') !!}</td>
                                <td>{!! $user->updated_at !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 text-center mb-3">
                <a href="{!! route('admin.setting.user.edit', $user->id) !!}" title="Edit" class="btn btn-warning">
                    <i class="fa fa-pencil"></i> {!! trans('admin/base.btn_edit') !!}
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.section -->
@stop
