@extends('admin.layouts.master')
@section('content')

<section class="content-header">
    <h1>
        {!! trans('admin/product.mg_product') !!}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('admin.home') !!}"><i class="fa fa-dashboard"></i> {!! trans('admin/base.home') !!}</a></li>
        <li><a href="{!! route('admin.setting.invoice.index') !!}">{!! trans('Invoice') !!}</a></li>
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
                        <a href="{!! route('admin.setting.product.create') !!}" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="{!! trans('admin/base.add_new') !!}"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <!-- /.box-header -->
                @include('admin.invoice.__search', ['fields' => ['id' => 'ID', 'name' => trans('admin/product.name')]])
                <div class="box-body no-padding">
                    <table class="table table-hover table-responsive">
                        <tbody>
                        <tr>
                            <th><a data-field="id" class="laravel-sort">ID</a></th>
                            <th><a data-field="user" class="laravel-sort">User</a></th>
                            <th><a data-field="address" class="laravel-sort">Address</a></th>
                            <th><a data-field="phone" class="laravel-sort">User Phone</a></th>
                            <th><a data-field="status" class="laravel-sort">Order Date</a></th>
                            <th><a data-field="status" class="laravel-sort">Status</a></th>
                            <th></th>
                        </tr>
                        @if (sizeof($invoices) == 0)
                            <tr><td colspan="6">{!! trans('admin/base.no_result') !!}</td></tr>
                        @else
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>#{!! $invoice->id  !!}</td>
                                    <td>{!! $invoice->user_id .' ' .$invoice->user->name!!}</td>
                                    <td>{!!$invoice->address  !!}</td>
                                    <td>{!!$invoice->phone  !!}</td>
                                    <td>{!!$invoice->created_at  !!}</td>
                                    <td>{!!$invoice->status  !!}</td>
                                    <td class="text-right">
                                        <div class="btn-group-action">
                                            <div class="btn-group pull-right">
                                                <a href="{!! route('admin.setting.invoice.show', $invoice->id) !!}" title="{!! trans('admin/base.btn_show') !!}" class="edit btn btn-default">
                                                    {!! trans('admin/base.btn_show') !!}
                                                </a>
                                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-caret-down"></i>&nbsp;
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{!! route('admin.setting.invoice.edit', $invoice->id) !!}" title="Edit">
                                                            <i class="fa fa-pencil"></i> {!! trans('admin/base.btn_edit') !!}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form method="POST" action="{!! route('admin.setting.invoice.destroy', $invoice->id) !!}" class="form-destroy">
                                                            <input type="hidden" name="_method" value="DELETE"/>
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="submit" class="hidden">
                                                        </form>
                                                        <a title="{!! trans('admin/base.btn_delete') !!}" class="delete confirm">
                                                            <i class="fa fa-trash-o"></i> {!! trans('admin/base.btn_delete') !!}
                                                        </a>
                                                    </li>
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
                    {!! $invoices->appends(request()->input())->render() !!}
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
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

@stop
