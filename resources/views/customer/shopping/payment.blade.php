@extends('customer.layouts.logo_only')

@section('content')
    <main class="py-4 payment">
        <div class="container">
            <form id="checkoutForm" action="{{ route('payment.pay') }}" method="POST" class="margin-top-10">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h4>Địa chỉ giao hàng</h4>
                        <div class="form-horizontal border p-3">
                            <div class="form-group row">
                                <label for="receiver" class="col-lg-4 control-label visible-lg-block">
                                    Họ tên <span class="text-bold text-danger">*</span>
                                </label>
                                <div class="col-lg-8 input-wrap">
                                    <input type="text" class="form-control {{ $errors->has('receiver') ? 'is-invalid' : '' }}"
                                           name="receiver" value="{{ old('receiver') }}" placeholder="Nhập họ tên">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('receiver') }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-lg-4 control-label visible-lg-block">
                                    Điện thoại di động <span class="text-bold text-danger">*</span>
                                </label>
                                <div class="col-lg-8 input-wrap">
                                    <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                           name="phone" value="{{ old('phone') }}" placeholder="Nhập số điện thoại">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-lg-4 control-label visible-lg-block">
                                    Địa chỉ <span class="text-bold text-danger">*</span>
                                </label>
                                <div class="col-lg-8 input-wrap">
                                    <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                           name="address" value="{{ old('address') }}" placeholder="Nhập địa chỉ giao hàng">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Chọn hình thức thanh toán</h4>
                        <div class="form-horizontal border p-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="method" value="cash" checked />
                                <label class="form-check-label" for="method_cash">
                                    Thanh toán tiền mặt khi nhận hàng
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="method" value="stripe" />
                                <label class="form-check-label" for="method_cash">
                                    Thanh toán bằng thẻ quốc tế Visa, Master, JCB
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row margin-top-30">
                    <div class="col-md-12">
                        <h4>Danh sách mặt hàng</h4>
                        <table class="product-table table">
                            <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng</th>
                            </tr>
                            </thead>
                            <tbody id="prodList">

                            </tbody>
                        </table>
                        <div id="prodInp"></div>
                    </div>
                </div>
                <div class="row margin-top-30">
                    <div class="col-md-12 align-content-center">
                        <button type="submit" class="btn btn-success">Thanh toán</button>
                    </div>
                </div>
            </form>
            <div id="alertCartEmpty" class="row" style="display: none">
                <div class="col-md-12">
                    <div class="alert-danger p-3">
                        Không có hàng trong giỏ, vui lòng thêm hàng vào giỏ trước khi thanh toán!
                    </div>
                    <div class="pl-3 mt-3">
                        <a href="{{ route('index') }}">Quay về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var products = JSON.parse(localStorage.getItem('shoppingCart'));
            if(!products) {
                alert('Đã có lỗi xảy ra, vui lòng thử lại sau!');
                window.history.back();
            }
            if(products.length === 0) {
                $('#checkoutForm').css('display', 'none');
                $('#alertCartEmpty').css('display', 'block');
                return;
            }

            var prodListElm = $('#prodList');
            var prodInpElm = $('#prodInp');
            var total = 0;
            products.forEach(function(p, index) {
                total += p.price * p.quantity;
                prodListElm.append(`
                    <tr>
                        <td><img class="max-width-100" src="${  p.thumbnail }" alt="${ p.name }"></td>
                        <td>${ p.name }</td>
                        <td>${ p.quantity }</td>
                        <td>${ p.price }</td>
                        <td>${ p.price * p.quantity }</td>
                    </tr>
               `);

                prodInpElm.append(`
                    <input type="hidden" name="products[${index}][id]" value="${ p.id }"/>
                    <input type="hidden" name="products[${index}][quantity]" value="${ p.quantity }"/>
               `);
            });

            prodListElm.append(`
                <tr>
                    <td class="text-center" colspan="4"><b>Tổng cộng</b></td>
                    <td><b>${ total }</b></td>
                </tr>
            `);

            prodInpElm.append(`
                <input type="hidden" name="total" value="${ total }"/>
            `);
        });
    </script>
@endsection
