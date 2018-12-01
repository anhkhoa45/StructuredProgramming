@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            {!! trans('admin/invoice.mg_invoice') !!}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('admin.home') !!}"><i class="fa fa-dashboard"></i> {!! trans('admin/base.home') !!}
                </a></li>
            <li><a href="{!! route('admin.setting.invoice.index') !!}">{!! trans('admin/invoice.invoice') !!}</a></li>
            <li>
                <a href="{!! route('admin.setting.invoice.edit', $invoice->id) !!}">{!! trans('admin/invoice.edit_invoice') !!}</a>
            </li>
        </ol>
    </section>
    <section class="content" id="product-wrap">
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
                            <h3 class="box-title">{!! trans('admin/invoice.edit_invoice') !!}</h3>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body no-padding">
                        <div class="col-sm-4">
                            <!-- form start -->
                            <form class="form-horizontal" method="POST"
                                  action="{!! route('admin.setting.invoice.update', $invoice->id) !!}"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT"/>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <div class="box-body">

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            <span class="required">*</span> {!! trans('admin/invoice.customername') !!}
                                        </label>
                                        <div class="col-sm-9">
                                            <h4 class="" name="user">
                                                {{$invoice->user->id.' '.$invoice->user->name}}
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="form-group {!! $errors->has('address') ? 'has-error' : '' !!} ">
                                        <label class="col-sm-2 control-label">
                                            <span class="required">*</span> {!! trans('admin/invoice.address') !!}
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="address"
                                                   value="{!! old('address') ?: $invoice->address !!}">
                                            {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {!! $errors->has('phone') ? 'has-error' : '' !!} ">
                                        <label class="col-sm-2 control-label">
                                            <span class="required">*</span> {!! trans('admin/invoice.customerphone') !!}
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="phone"
                                                   value="{!! old('phone') ?: $invoice->phone !!}">
                                            {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {!! $errors->has('status') ? 'has-error' : '' !!} ">
                                        <label class="col-sm-2 control-label">
                                            <span class="required">*</span> {!! trans('admin/invoice.status') !!}
                                        </label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status">
                                                @foreach(["cancel","finish"," sending","return"] as $status_type)
                                                    <option value="{{$status_type}}" {{ $invoice->status==$status_type?"selected":""}}>{{$status_type}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            <span class="required">*</span> {!! trans('admin/invoice.created_at') !!}
                                        </label>
                                        <div class="col-sm-9">
                                            <h4 class="" name="user">
                                                {{$invoice->created_at}}
                                            </h4>
                                        </div>
                                    </div>


                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-default pull-right custom-button"
                                            style="margin-left: 10px">
                                        <i class="fa fa-save"></i> {!! trans('admin/base.btn_save') !!}
                                    </button>
                                    <a href="{!! route('admin.setting.invoice.index') !!}"
                                       class="btn btn-default pull-right btn-default-hover">
                                        <i class="fa fa-times"></i> {!! trans('admin/base.btn_cancel') !!}
                                    </a>
                                </div>
                            </form>

                            <!-- /.form end -->
                        </div>
                        <div class="col-sm-8">
                            <form class="form-horizontal" method="GET"
                                  action="{!! route('admin.transactions_multiple_update') !!}">
                                <table class="table">
                                    <th><a data-field="id" class="laravel-sort">ID</a></th>
                                    <th><a data-field="user"
                                           class="laravel-sort">{!! trans('admin/transaction.quantity') !!}</a></th>
                                    <th><a data-field="address"
                                           class="laravel-sort">{!! trans('admin/product.name') !!}</a></th>
                                    <th><a data-field="phone"
                                           class="laravel-sort">{!! trans('admin/product.image') !!}</a></th>


                                    @foreach ($invoice->transactions as $transaction)
                                        <tr>
                                            <td>{{$transaction->id}}
                                                <input type="hidden" name="transaction_ids[]"
                                                       id="transaction_id-{{$transaction->id}}" value="{{$transaction->id}}"/></td>
                                            <td><input type="text" class="form-control" name="quantities[]"
                                                       id="quantity-{{$transaction->id}}"
                                                       value="{{$transaction->quantity}}"></td>
                                            <td>{{'#'.$transaction->product->id.'  '.$transaction->product->name}}</td>
                                            <td><img src="{{$transaction->product->getImageUrl()}}"
                                                     class="product-image img-responsive" style="width:150px"
                                                     alt="{!! trans('admin/product.image') !!}"></td>
                                            <td>
                                                <div class="btn-group-action">
                                                    <div class="btn-group pull-right">
                                                        <a href="{!! route('admin.setting.invoice.show', $invoice->id) !!}"
                                                           title="{!! trans('admin/base.btn_edit') !!}"
                                                           class="edit btn btn-default">
                                                            {!! trans('admin/base.btn_edit') !!}
                                                        </a>
                                                        <button class="btn btn-default dropdown-toggle"
                                                                data-toggle="dropdown">
                                                            <i class="fa fa-caret-down"></i>&nbsp;
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <form method="POST"
                                                                      action="{!! route('admin.setting.transaction.destroy', $transaction->id) !!}"
                                                                      class="form-destroy">
                                                                    <input type="hidden" name="_method" value="DELETE"/>
                                                                    <input type="hidden" name="_token"
                                                                           value="{{ csrf_token() }}">
                                                                    <input type="submit" class="hidden">
                                                                </form>
                                                                <a title="{!! trans('admin/base.btn_delete') !!}"
                                                                   class="delete confirm">
                                                                    <i class="fa fa-trash-o"></i> {!! trans('admin/base.btn_delete') !!}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-default pull-right custom-button"
                                            style="margin-left: 10px">
                                        <i class="fa fa-save"></i> {!! trans('admin/base.btn_save') !!}
                                    </button>
                                    <a href="{!! route('admin.setting.invoice.index') !!}"
                                       class="btn btn-default pull-right btn-default-hover">
                                        <i class="fa fa-times"></i> {!! trans('admin/base.btn_cancel') !!}
                                    </a>
                                </div>
                            </form>


                        </div>
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
