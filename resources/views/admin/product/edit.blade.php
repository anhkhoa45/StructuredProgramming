@extends('admin.layouts.master')
@section('content')
<section class="content-header">
    <h1>
        {!! trans('admin/product.mg_product') !!}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('admin.home') !!}"><i class="fa fa-dashboard"></i> {!! trans('admin/base.home') !!}</a></li>
        <li><a href="{!! route('admin.setting.product.index') !!}">{!! trans('admin/product.product') !!}</a></li>
        <li><a href="{!! route('admin.setting.product.edit', $product->id) !!}">{!! trans('admin/product.edit_product') !!}</a></li>
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
                        <h3 class="box-title">{!! trans('admin/product.edit_product') !!}</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <!-- form start -->
                    <form class="form-horizontal" method="POST" action="{!! route('admin.setting.product.update', $product->id) !!}" enctype= "multipart/form-data">
                        <input type="hidden" name="_method" value="PUT"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="box-body">
                            <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label">
                                    <span class="required">*</span> {!! trans('admin/product.name') !!}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name"
                                           value="{!! old('name') ?: $product->name !!}">
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label">
                                    {!! trans('admin/product.description') !!}
                                </label>
                                <div class="col-sm-9">
                                    <textarea autocomplete="off" type="text" class="form-control" name="description"
                                              value="{!! old('description') ?: $product -> description !!}"></textarea>
                                    {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {!! $errors->has('price') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label">
                                    <span class="required">*</span> {!! trans('admin/product.price') !!}
                                </label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" type="text" class="form-control" name="price"
                                           value="{!! old('price') ?: $product->price !!}">
                                    {!! $errors->first('price', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {!! $errors->has('gender') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label">
                                    <span class="required">*</span> {!! trans('admin/product.gender') !!}
                                </label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" type="text" class="form-control" name="gender"
                                           value="{!! old('gender') ?: $product->size !!}">
                                    {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {!! $errors->has('size') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label">
                                    <span class="required">*</span> {!! trans('admin/product.size') !!}
                                </label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" type="text" class="form-control" name="size"
                                           value="{!! old('size') ?: $product->size !!}">
                                    {!! $errors->first('size', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {!! $errors->has('quantity') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label">
                                    <span class="required">*</span> {!! trans('admin/product.quantity') !!}
                                </label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" type="text" class="form-control" name="quantity"
                                           value="{!! old('quantity') ?: $product->quantity !!}">
                                    {!! $errors->first('quantity', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label">{!! trans('admin/product.image') !!}</label>
                                <div class="col-sm-9">

                                    <div class="image-preview-wrapper">
                                        <div class="image-preview"
                                             @if($product->image != '') style="background-image: url('{!! $product->getImageUrl() !!}'); background-position:  center center; background-size: cover" @endif>
                                            <label for="image-input" class="image-label" style="display: none;">Change File</label>
                                            <input type="file" name="image" class="image-input">
                                        </div>
                                    </div>
                                </div>
                                {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit"class="btn btn-default pull-right custom-button">
                                <i class="fa fa-save"></i> {!! trans('admin/base.btn_save') !!}
                            </button>
                            <a href="{!! route('admin.setting.product.index') !!}" class="btn btn-default btn-default-hover">
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
