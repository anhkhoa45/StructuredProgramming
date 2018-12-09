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

                            <!-- form start -->
                            <form class="form-horizontal" method="GET"
                                  action="{!! route('admin.invoices_item_multiple_update') !!}"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <div class="col-sm-4">
                                <input type="hidden" name="invoiceid" value="{{ $invoice->id}}"/>

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


                                    <!-- /.form end -->
                                </div>

                        <div class="col-sm-8">
                                <table class="table" id="invoice_item_table">
                                    <th><a data-field="id" class="laravel-sort">ID</a></th>
                                    <th><a data-field="address"
                                           class="laravel-sort">ID Product</a></th>
                                    <th><a data-field="address"
                                           class="laravel-sort">{!! trans('admin/product.name') !!}</a></th>
                                    <th><a data-field="user"
                                           class="laravel-sort">{!! trans('admin/transaction.quantity') !!}</a></th>

                                    <th><a data-field="phone"
                                           class="laravel-sort">{!! trans('admin/product.image') !!}</a></th>


                                    @foreach ($invoice->invoiceItems as $invoiceitem)
                                        <tr>
                                            <td>{{$invoiceitem->id}}
                                                <input type="hidden" name="transaction_ids[]"
                                                       id="transaction_id-{{$invoiceitem->id}}" value="{{$invoiceitem->id}}"/></td>
                                            <td>{{'#'.$invoiceitem->product->id}}</td>
                                            <td>{{$invoiceitem->product->name}}</td>
                                            <td><input type="text" class="form-control" name="quantities[]"
                                                       id="quantity-{{$invoiceitem->id}}"
                                                       value="{{$invoiceitem->quantity}}"></td>

                                            <td><img src="{{$invoiceitem->product->getImageUrl()}}"
                                                     class="product-image img-responsive" style="width:150px"
                                                     alt="{!! trans('admin/product.image') !!}"></td>
                                            <td>
                                                <div class="btn-group-action">
                                                    <div class="btn-group pull-right">
                                                        <a title="{!! trans('admin/base.btn_delete') !!}"
                                                           class="delete confirm btn btn-default"
                                                           href="{!! route('admin.setting.invoiceitem_destroy', $invoiceitem->id) !!}">
                                                            <i class="fa fa-trash-o"></i>
                                                            {!! trans('admin/base.btn_delete') !!}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-default pull-right custom-button"
                                            >
                                        <i class="fa fa-save"></i> {!! trans('admin/base.btn_save') !!}
                                    </button>
                                    <a href="{!! route('admin.setting.invoice.index') !!}"
                                       class="btn btn-default pull-right btn-default-hover" style="margin-left: 10px;margin-right: 10px">
                                        <i class="fa fa-times"></i> {!! trans('admin/base.btn_cancel') !!}
                                    </a>
                                    <div id="btn_add_new_invoice_item"
                                       class="btn btn-default pull-right btn-default-hover">
                                            <i class="fa fa-plus"></i> {!! trans('admin/invoice.btn_add_invoiceitem') !!}
                                    </div>
                                </div>
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
    <script src="{!! asset('js/btn_add_invoice_item_to_invoice.js') !!}"></script>
    <script src="{!! asset('js/nhn-user.js') !!}"></script>


@stop
