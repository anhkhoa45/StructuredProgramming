<?php use App\Product;?>
@extends('admin.layouts.master')
@section('content')
<section class="content-header">
    <h1>
        {!! trans('admin/product.mg_product') !!}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('admin.home') !!}"><i class="fa fa-dashboard"></i> {!! trans('admin/base.home') !!}</a></li>
        <li><a href="{!! route('admin.setting.invoice.index') !!}">Invoice</a></li>
        <li><a href="{!! route('admin.setting.invoice.show', $invoice->id) !!}">Invoice Detail</a></li>
    </ol>
</section>
<br/>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="avatar">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <h3 class="panel-title text-center"><i class="fa fa-product"></i> {!! trans('admin/invoice.detail') !!}</h3>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td style="width: 20%;">ID</td>
                            <td><span class="label label-info">#{!! $invoice->id!!}</span></td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/invoice.address') !!}</td>
                            <td>{!!$invoice->address  !!}</td>

                        </tr>
                        <tr>
                            <td>{!! trans('admin/invoice.customername') !!}</td>

                            <td>{!! $invoice->user_id .' ' .$invoice->user->name!!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/invoice.customerphone') !!}</td>
                            <td>{!!$invoice->phone  !!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/invoice.status') !!}</td>
                            <td>{!!$invoice->status  !!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/invoice.created_at') !!}</td>
                            <td>{!! $invoice->created_at !!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/invoice.updated_at') !!}</td>
                            <td>{!! $invoice->updated_at !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class='col-md-9'>
            <table class="table">
                <th><a data-field="id" class="laravel-sort">ID</a></th>
                <th><a data-field="user" class="laravel-sort">{!! trans('admin/transaction.quantity') !!}</a></th>
                <th><a data-field="address" class="laravel-sort">{!! trans('admin/product.name') !!}</a></th>
                <th><a data-field="phone" class="laravel-sort">{!! trans('admin/product.image') !!}</a></th>
            @foreach ($invoice->transactions as $transaction)
                    <tr>
                        <td>{{$transaction->id}}</td>
                        <td>{{$transaction->quantity}}</td>
                        <td>{{$transaction->product->name}}</td>
                        <td><img src="{{$transaction->product->getImageUrl()}}" class="product-image img-responsive" style="width:200px" alt="{!! trans('admin/product.image') !!}"></td>
                    </tr>
            @endforeach
            </table>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.section -->
@stop
