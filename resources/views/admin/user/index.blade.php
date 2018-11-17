@extends('admin.layouts.master')
@section('content')
<section class="content-header">
    <h1>
        {!! trans('admin/user.mg_user') !!}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('admin/base.home') !!}</a></li>
        <li><a href="{!! route('admin.setting.user.index') !!}">{!! trans('admin/user.user') !!}</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        @if(!is_null(Session::get('success')))
        <div class="col-xs-12">
            <div class='alert alert-success alert-dismissible'>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>{!! Session::get('success') !!}</h4>
            </div>
        </div>
        @endif
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <a href="{!! route('admin.setting.user.create') !!}" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="{!! trans('admin/base.add_new') !!}"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <!-- /.box-header -->
                @include('admin.layouts.__search', ['fields' => ['id' => 'ID', 'name' => trans('admin/user.name'), 'email' => trans('admin/user.email')]])
                <div class="box-body no-padding">
                    <table class="table table-hover table-responsive">
                        <tbody>
                            <tr>
                                <th><a data-field="id" class="laravel-sort">ID</a></th>
                                <th><a data-field="role_id" class="laravel-sort">{!! trans('admin/user.role_id') !!}</a></th>
                                <th><a data-field="name" class="laravel-sort">{!! trans('admin/user.name') !!}</a></th>
                                <th><a data-field="email" class="laravel-sort">{!! trans('admin/user.email') !!}</a></th>
                                <th><a data-field="active" class="laravel-sort">{!! trans('admin/user.status') !!}</th>
                                <th></th>
                            </tr>
                            @if (sizeof($users) == 0)
                            <tr><td colspan="6">{!! trans('admin/base.no_result') !!}</td></tr>
                            @else
                            @foreach ($users as $user)
                            <tr>
                                <td><span class="label label-info">#{!! $user->id !!}</span></td>
                                <td><span class="label label-info">{!! $user->roleToString()  !!}</span></td>
                                <td><div class="break-word max-with-300">{!! $user->name !!}</div></td>
                                <td>{!! $user->email  !!}</td>
                                <td><span class="label {!! $user->activeToLbClass() !!}">{!! $user->activeToString() !!}</span></td>
                                <td class="text-right">
                                    <div class="btn-group-action">				
                                        <div class="btn-group pull-right">
                                            <a href="{!! route('admin.setting.user.show', $user->id) !!}" title="{!! trans('admin/base.btn_show') !!}" class="edit btn btn-default">
                                                <i class='fa fa-info'></i> {!! trans('admin/base.btn_show') !!}
                                            </a>
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-caret-down"></i>&nbsp;
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{!! route('admin.setting.user.edit', $user->id) !!}" title="Edit">
                                                        <i class="fa fa-pencil"></i> {!! trans('admin/base.btn_edit') !!}
                                                    </a>
                                                </li>
                                                @if($user->id != $user::CAN_NOT_DELETE)
                                                <li>
                                                    <form method="POST" action="{!! route('admin.setting.user.destroy', $user->id) !!}" id="form-destroy">
                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="hidden">
                                                    </form>
                                                    <a title="{!! trans('admin/base.btn_delete') !!}" class="delete confirm">
                                                        <i class="fa fa-trash-o"></i> {!! trans('admin/base.btn_delete') !!}
                                                    </a>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>				
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <ul class="pagination pagination-sm inline pull-right">
                    {!! $users->appends(request()->input())->render() !!}
                </ul>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col-xs-12 -->
    </div>
    <!-- /.row -->
</section>
<!-- /.section -->
@stop
@section('script')
@parent 
<script>
    $(function () {
        $('.laravel-sort').laravelSort();
    });
</script>
@stop