@extends('customer.layouts.app')

@section('content')
    <main class="py-4 payment">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Đơn hàng {{ $invoice->id }}</h4>
                    <hr>
                </div>
                <div class="col-md-6">
                    <div id="info">
                        <p>
                            <strong>Họ tên người nhận : </strong> {{ $invoice->receiver }}
                        </p>
                        <p>
                            <strong>Địa chỉ : </strong> {{ $invoice->address }}
                        </p>
                        <p>
                            <strong>Số điện thoại : </strong> {{ $invoice->phone }}
                        </p>
                    </div>
                    @if($invoice->canBeEdited())
                        <button id="editBtn" class="btn btn-warning">Sửa</button>
                        <form id="editForm" action="{{ route('invoice.edit', ['id' => $invoice->id]) }}" method="POST"
                              class="form-horizontal border p-3" style="display: none">
                            @csrf
                            <div class="form-group row">
                                <label for="receiver" class="col-lg-4 control-label visible-lg-block">
                                    Họ tên <span class="text-bold text-danger">*</span>
                                </label>
                                <div class="col-lg-8 input-wrap">
                                    <input type="text" class="form-control {{ $errors->has('receiver') ? 'is-invalid' : '' }}"
                                           name="receiver" value="{{ $invoice->receiver }}" placeholder="Nhập họ tên">
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
                                           name="phone" value="{{ $invoice->phone }}" placeholder="Nhập số điện thoại">
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
                                           name="address" value="{{ $invoice->address }}" placeholder="Nhập địa chỉ giao hàng">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <button id="saveBtn" type="submit" class="btn btn-danger ml-3">Lưu</button>
                                    <button id="cancelBtn" type="button" class="btn btn-primary ml-3">Hủy</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="col-md-6">
                    <p>
                        <strong>Ngày đặt hàng : </strong> {{ $invoice->created_at }}
                    </p>
                    <p>
                        <strong>Tình trạng thanh toán :</strong>
                        {{ $invoice->paid ? 'Đã thanh toán' : 'Thanh toán khi nhận hàng' }}
                    </p>
                    <p>
                        <strong>Trạng thái : </strong> {{ $invoice->getStatusString() }}
                    </p>
                    @if($invoice->status != 'canceled')
                    <div class="container">
                        <div class="row bs-wizard" style="border-bottom:0;">
                            <div class="col-md-4 bs-wizard-step {{ $invoice->completeOrdered() ? 'complete' : '' }}">
                                <div class="text-center bs-wizard-stepnum">Bước 1</div>
                                <div class="progress"><div class="progress-bar"></div></div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center">Đặt hàng</div>
                            </div>

                            <div class="col-md-4 bs-wizard-step {{ $invoice->completeDelivering() ? 'complete' : 'disabled' }}">
                                <div class="text-center bs-wizard-stepnum">Bước 2</div>
                                <div class="progress"><div class="progress-bar"></div></div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center">Đang giao hàng</div>
                            </div>

                            <div class="col-md-4 bs-wizard-step {{ $invoice->completeDelivered() ? 'complete' : 'disabled' }}">
                                <div class="text-center bs-wizard-stepnum">Bước 3</div>
                                <div class="progress"><div class="progress-bar"></div></div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center">Nhận hàng</div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row margin-top-30">
                <div class="col-md-12">
                    <h4>Danh sách mặt hàng</h4>
                    <table class="product-table table">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody id="prodList">
                        @php $total = 0 @endphp
                        @foreach($invoice->invoiceItems as $invoiceItem)
                            @php $total += $invoiceItem->product->price * $invoiceItem->quantity @endphp
                            <tr>
                                <td>
                                    <img class="max-width-100"
                                         src="{{  $invoiceItem->product->getImageUrl() }}"
                                         alt="{{ $invoiceItem->product->name }}">
                                </td>
                                <td>{{ $invoiceItem->product->name }}</td>
                                <td>{{ $invoiceItem->quantity }}</td>
                                <td>{{ $invoiceItem->product->price }}</td>
                                <td>{{ $invoiceItem->product->price * $invoiceItem->quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tr>
                            <td class="text-center" colspan="4"><strong>Total</strong></td>
                            <td><strong>{{ $total }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
            @if($invoice->canBeCanceled())
            <div class="row margin-top-30">
                <div class="col-md-12">
                    <a href="{{ route('invoice.cancel', ['id' => $invoice->id]) }}">Hủy đơn hàng này</a>
                </div>
            </div>
            @endif
        </div>
    </main>
@endsection

@section('script')
    @if(isset($clearCart) && $clearCart)
        <script>
            $(document).ready(function(){
                window.shoppingCart.clearCart();
            });
        </script>
    @endif

    @if($invoice->canBeEdited())
        <script>
            $('#editBtn').click(function(){
                $('#info').css('display', 'none');
                $('#editBtn').css('display', 'none');
                $('#editForm').css('display', 'block');
            });

            $('#cancelBtn').click(function(){
                $('#info').css('display', 'block');
                $('#editBtn').css('display', 'block');
                $('#editForm').css('display', 'none');
            });
        </script>
    @endif
@endsection
