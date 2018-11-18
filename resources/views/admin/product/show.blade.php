@extends('admin.layouts.master')
@section('content')
<section class="content-header">
    <h1>
        {!! trans('admin/product.mg_product') !!}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('admin.home') !!}"><i class="fa fa-dashboard"></i> {!! trans('admin/base.home') !!}</a></li>
        <li><a href="{!! route('admin.setting.product.index') !!}">{!! trans('admin/product.product') !!}</a></li>
        <li><a href="{!! route('admin.setting.product.show', $product->id) !!}">{!! trans('admin/product.detail') !!}</a></li>
    </ol>
</section>
<br/>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="avatar">
                <img src="{!! $product->getImageUrl() !!}" class="product-image img-responsive" alt="{!! trans('admin/product.image') !!}">
            </div>
        </div> 
        <div class='col-md-9'>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <h3 class="panel-title text-center"><i class="fa fa-product"></i> {!! trans('admin/product.detail') !!}</h3>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">ID</td>
                            <td><span class="label label-info">#{!! $product->id!!}</span></td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/product.name') !!}</td>
                            <td>{!! $product->name!!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/product.description') !!}</td>
                            <td>{!! $product->description !!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/product.size') !!}</td>
                            <td><span class='label label-info'>{!! $product->size !!}</span></td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/product.quantity') !!}</td>
                            <td>{!! $product->quantity !!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/product.price') !!}</td>
                            <td>{!! $product->price !!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/product.created_at') !!}</td>
                            <td>{!! $product->created_at !!}</td>
                        </tr>
                        <tr>
                            <td>{!! trans('admin/product.updated_at') !!}</td>
                            <td>{!! $product->updated_at !!}</td>
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
