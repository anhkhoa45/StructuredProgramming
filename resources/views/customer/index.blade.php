@extends('customer.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <form action="" method="GET">
                    @if($searchData['name'])
                    <input type="hidden" value="{{ $searchData['name'] }}" name="name">
                    @endif
                    <ul class="list-group filter-group">
                        <li class="list-group-item list-title"><strong>Loại</strong></li>
                        @foreach($categories as $category)
                        <li class="list-group-item list-group-item-action">
                            <input type="checkbox" name="categories[]"
                                   value="{{ $category->id }}"
                                   @if($searchData['categories'] && in_array($category->id, $searchData['categories']))
                                       checked
                                   @endif>
                            {{ $category->name }}
                        </li>
                        @endforeach

                        <li class="list-group-item list-title"><strong>Nam - Nữ</strong></li>
                        <li class="list-group-item list-group-item-action">
                            <input type="checkbox" name="gender[]" value="0"
                                   @if($searchData['gender'] && in_array(0, $searchData['gender'])) checked @endif/> Nam
                            <input type="checkbox" name="gender[]" value="1" class="ml-2"
                                   @if($searchData['gender'] && in_array(1, $searchData['gender'])) checked @endif/> Nữ
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
                                <input id="priceMin" type="text" class="form-control" name="price_min"
                                       placeholder="Từ" value="@if(isset($searchData['price_min'])) {{ $searchData['price_min'] }} @endif">
                                <input id="priceMax" type="text" class="form-control" name="price_max"
                                       placeholder="Đến" value="@if(isset($searchData['price_max'])) {{ $searchData['price_max'] }} @endif">
                            </form>
                        </li>

                        <li class="list-group-item list-title"><strong>Kích cỡ</strong></li>
                        <li class="list-group-item list-group-item-action">
                            <input type="checkbox" name="size[]" value="XS"
                                   @if($searchData['size'] && in_array('XS', $searchData['size'])) checked @endif/> XS
                            <input type="checkbox" name="size[]" value="S" class="ml-2"
                                   @if($searchData['size'] && in_array('S', $searchData['size'])) checked @endif/> S
                            <input type="checkbox" name="size[]" value="M" class="ml-2"
                                   @if($searchData['size'] && in_array('M', $searchData['size'])) checked @endif/> M
                            <input type="checkbox" name="size[]" value="L" class="ml-2"
                                   @if($searchData['size'] && in_array('L', $searchData['size'])) checked @endif> L
                            <input type="checkbox" name="size[]" value="XL" class="ml-2"
                                   @if($searchData['size'] && in_array('XL', $searchData['size'])) checked @endif/> XL
                        </li>

                        <li class="list-group-item">
                            <button type="submit" class="btn btn-success btn-sm">Áp dụng</button>
                            <a href="/" class="btn btn-danger btn-sm" >Đặt lại</a>
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
                    @foreach($products as $product)
                    <div class="col-md-4 col-sm-6 margin-top-10">
                        <div class="card ">
                            <img class="card-img-top img-fluid"
                                 src="{{  file_exists(public_path().'/storage/'."$product->id/".$product->image) ?
                                          '/storage/'."$product->id/".$product->image :
                                          '/storage/products/default.jpg'
                                      }}"
                                 alt="Card image cap">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p><strong>{{ $product->price }}</strong></p>
                                </div>
                                <div class="margin-top-10">
                                    <button type="button" class="btn btn-warning">Add to cart</button>
                                    <a href="{{ url('customer/product/detail/'.$product->id) }}"><button type="button" class="btn btn-primary">Detail</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row margin-top-30 justify-content-center">
                    {{ $products->appends($_GET)->links() }}
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
