@extends('layouts.app')

@section('content')
    <div class="container product-detail">
        <div class="row">
            <div class="col-md-4 left-box">
                <div class="image-container">
                    <img class="img-fluid" src="/image/iphone.jpg" alt="">
                </div>
            </div>
            <div class="col-md-8 right-box">
                <div class="row name-container">
                    <div class="col-md-12">
                        <h1 class="prod-name">Iphan</h1>
                    </div>
                </div>
                <div class="row detail-container">
                    <div class="col-md-12">
                        <p class="price">100.000d</p>
                    </div>
                    <div class="col-md-12">
                        <ul>
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, tempora?</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, </li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing </li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, tempora?</li>
                        </ul>
                    </div>
                </div>
                <div class="row btn-container">
                    <div class="col-md-12">
                        <button class="btn btn-warning" type="button">Add to cart</button>
                        <button class="btn btn-danger" type="button">Buy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
