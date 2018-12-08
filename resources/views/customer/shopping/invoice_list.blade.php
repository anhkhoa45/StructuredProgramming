@extends('customer.layouts.app')

@section('content')
    <main class="py-4 payment">
        <div class="container">
            <div class="row margin-top-30">
                <div class="col-md-12">
                    <h4>Danh sách đơn hàng</h4>
                    <table class="product-table table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày mua</th>
                            <th>Sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody id="prodList">
                        @foreach($invoices as $invoice)
                            @php $total = 0; @endphp
                            <tr>
                                <td>
                                    <a href="{{ route('invoice.show', ['id' => $invoice->id]) }}">{{ $invoice->id }}</a>
                                </td>
                                <td>{{ $invoice->created_at }}</td>
                                <td>
                                    @foreach($invoice->invoiceItems as $index=>$invoiceItem)
                                        @if($index == 5) @break @endif
                                        <p>
                                            {{ $invoiceItem->product->name }} -
                                            {{ substr($invoiceItem->product->description, 0, 40) . '...' }}
                                        </p>
                                        @php $total += $invoiceItem->product->price * $invoiceItem->quantity; @endphp
                                    @endforeach
                                </td>
                                <td>{{ $total }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
