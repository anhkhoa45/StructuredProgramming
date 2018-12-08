@extends('customer.layouts.app')

@section('content')
    <main class="py-4 payment">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Đơn hàng {{ $invoice->id }}</h4>
                    <hr>
                    <p>
                        <strong>Họ tên người nhận : </strong> {{ $invoice->receiver }}
                    </p>
                    <p>
                        <strong>Địa chỉ : </strong> {{ $invoice->address }}
                    </p>
                    <p>
                        <strong>Số điện thoại : </strong> {{ $invoice->phone }}
                    </p>
                    <p>
                        <strong>Ngày đặt hàng : </strong> {{ $invoice->created_at }}
                    </p>
                    <p>
                        <strong>Trạng thái : </strong>
                    </p>
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
@endsection
