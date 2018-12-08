<ul class="navbar-nav ml-auto shopping-cart" id="shoppingCart">
    <li class="nav-item active">
        <div class="dropdown">
            <button type="button" class="btn btn-lg bg-trans dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="oi oi-cart"><span class="cart-products product-count">0</span></span>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-sm-8 content">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody class="product-list">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <a href="{{ route('payment.get_payment') }}" type="button"  class="btn btn-danger">
                                    Payment ->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
