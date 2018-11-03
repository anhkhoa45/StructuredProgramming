@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <form action="" method="GET">
                    <ul class="list-group filter-group">
                        <li class="list-group-item list-title"><strong>Loại</strong></li>
                        @foreach($categories as $category)
                        <li class="list-group-item list-group-item-action">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"> {{ $category->name }}
                        </li>
                        @endforeach

                        <li class="list-group-item list-title"><strong>Nam - Nữ</strong></li>
                        <li class="list-group-item list-group-item-action">
                            <input type="radio" name="gender" value="0"> Nam</input>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <input type="radio" name="gender" value="1"> Nữ</input>
                        </li>

                        <li class="list-group-item list-title"><strong>Giá</strong></li>
                        <li class="list-group-item list-group-item-action">
                            <span class="text-price-range" data-price-min="0" data-price-max="500000">0 - 500.000</span>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <span class="text-price-range" data-price-min="500000" data-price-max="1000000">500.000 - 1.000.000</span>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <span class="text-price-range" data-price-min="1000000" data-price-max="2000000">1.000.000 - 2.000.000</span>
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <span class="text-price-range" data-price-min="2000000">> 2.000.000</span>
                        </li>
                        <li class="list-group-item">
                            <form class="form-inline">
                                <input id="priceMin" type="text" class="form-control" name="price_min" placeholder="Từ">
                                <input id="priceMax" type="text" class="form-control" name="price_max" placeholder="Đến">
                            </form>
                        </li>

                        <li class="list-group-item list-title"><strong>Kích cỡ</strong></li>
                        <li class="list-group-item list-group-item-action">
                            <input type="checkbox" name="size[]" value="S"> S
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <input type="checkbox" name="size[]" value="M"> M
                        </li>
                        <li class="list-group-item list-group-item-action">
                            <input type="checkbox" name="size[]" value="L"> L
                        </li>

                        <li class="list-group-item">
                            <button type="submit">Áp dụng</button>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="col-md-9">
                <div class="row slider justify-content-center">
                    <div id="indexSlider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#indexSlider" data-slide-to="0" class="active"></li>
                            <li data-target="#indexSlider" data-slide-to="1"></li>
                            <li data-target="#indexSlider" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="/svg/800x400.svg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/svg/800x400.svg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/svg/800x400.svg" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#indexSlider" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#indexSlider" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="row margin-top-50 card-group">
                    <div class="col-md-4 col-sm-6">
                        <div class="card ">
                            <img class="card-img-top img-fluid" src="/svg/312x180.svg" alt="Card image cap">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Ao so mi 3 lo</h5>
                                    <p><strong>100.000d</strong></p>
                                </div>
                                <div class="btn-group margin-top-10">
                                    <a href="#" class="btn btn-warning">Add to cart</a>
                                    <a href="#" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card ">
                            <img class="card-img-top img-fluid" src="/svg/312x180.svg" alt="Card image cap">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Ao so mi 3 lo</h5>
                                    <p><strong>100.000d</strong></p>
                                </div>
                                <div class="btn-group margin-top-10">
                                    <a href="#" class="btn btn-warning">Add to cart</a>
                                    <a href="#" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card ">
                            <img class="card-img-top img-fluid" src="/svg/312x180.svg" alt="Card image cap">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Ao so mi 3 lo</h5>
                                    <p><strong>100.000d</strong></p>
                                </div>
                                <div class="btn-group margin-top-10">
                                    <a href="#" class="btn btn-warning">Add to cart</a>
                                    <a href="#" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            let priceMinInp = document.getElementById('priceMin');
            let priceMaxInp = document.getElementById('priceMax');

            $('.text-price-range').click(function(){
                priceMinInp.value = $(this).data('price-min');
                priceMaxInp.value = $(this).data('price-max') || '';
            });
        });
    </script>

@endsection
