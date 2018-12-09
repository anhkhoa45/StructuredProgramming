@extends('customer.layouts.app')

@php
    $prodImg = file_exists(public_path().'/storage/'."$product->id/".$product->image) ?
                      '/storage/'."$product->id/".$product->image :
                      '/storage/products/default.jpg';
@endphp

@section('content')
    <div class="container product-detail">
        <div class="row">
            <div class="col-md-4 left-box">
                <div class="image-container">
                    <img class="img-fluid" src={{ "/image/" . $product->image }} alt="">
                </div>
            </div>
            <div class="col-md-8 right-box">
                <div class="row name-container">
                    <div class="col-md-12">
                        <h1 class="prod-name">{{ $product->name }}</h1>
                    </div>
                </div>
                <div class="row detail-container">
                    <div class="col-md-12">
                        <p class="price">Giá tiền:  {{ $product->price }}</p>
                    </div>
                    <div class="col-md-12">
                        <ul>
                            <li><strong>Mô tả:</strong>  {{ $product->description }}</li>
                            <li><strong>Kích cỡ:</strong>  {{ $product->size }}</li>
                        </ul>
                    </div>
                </div>
                <div class="row btn-container p-3">
                    <div class="col-md-12">
                        <button class="btn btn-warning" type="button"
                                onclick="shoppingCart.addProduct({
                                    id: {{ $product->id }},
                                    thumbnail: '{{ $prodImg }}',
                                    name: '{{ $product->name }}',
                                    price: {{ $product->price }},
                                    quantity: 1
                                    })">
                            Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
