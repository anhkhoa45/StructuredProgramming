<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ABC Wear') }}</title>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/open-iconic-bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'ABC Wear') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <form id="checkoutForm" action="{{ route('payment.pay') }}" method="POST" class="margin-top-10">
                @csrf
                <div class="col-md-6">
                    <h4>Địa chỉ giao hàng</h4>
                    <div class="form-horizontal border p-3">
                        <div class="form-group row" role="form">
                            <label for="full_name" class="col-lg-4 control-label visible-lg-block">Họ tên </label>
                            <div class="col-lg-8 input-wrap">
                                <input type="text" name="full_name" class="form-control address" placeholder="Nhập họ tên">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-lg-4 control-label visible-lg-block">Điện thoại di động </label>
                            <div class="col-lg-8 input-wrap">
                                <input type="text" name="phone" class="form-control address" placeholder="Nhập số điện thoại">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-lg-4 control-label visible-lg-block">Địa chỉ </label>
                            <div class="col-lg-8 input-wrap">
                                <input type="text" name="address" class="form-control address" placeholder="Nhập địa chỉ giao hàng">
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
                            <input class="form-check-input" type="radio" name="method" value="cash" checked />
                            <label class="form-check-label" for="method_cash">
                                Thanh toán bằng thẻ quốc tế Visa, Master, JCB
                            </label>
                        </div>

                        <form id="cardPaymentForm">
                            <div class="form-row">
                                <label for="card-element">
                                    Credit or debit card
                                </label>
                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display Element errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>

                            <button>Submit Payment</button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <footer class="pt-4 my-md-5 pt-md-5 border-top container-fluid">
        <div class="row">
            <div class="col-12 col-md">

            </div>
            <div class="col-6 col-md">
                <h5>Features</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Cool stuff</a></li>
                    <li><a class="text-muted" href="#">Random feature</a></li>
                    <li><a class="text-muted" href="#">Team feature</a></li>
                    <li><a class="text-muted" href="#">Stuff for developers</a></li>
                    <li><a class="text-muted" href="#">Another one</a></li>
                    <li><a class="text-muted" href="#">Last time</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Resource</a></li>
                    <li><a class="text-muted" href="#">Resource name</a></li>
                    <li><a class="text-muted" href="#">Another resource</a></li>
                    <li><a class="text-muted" href="#">Final resource</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Team</a></li>
                    <li><a class="text-muted" href="#">Locations</a></li>
                    <li><a class="text-muted" href="#">Privacy</a></li>
                    <li><a class="text-muted" href="#">Terms</a></li>
                </ul>
            </div>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/shopping_cart.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>
    $(document).ready(function () {
        var stripe = Stripe('pk_test_X8HFOCggUXjDyPecM4982d6W');
        var elements = stripe.elements();

        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('cartPaymentForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the customer that there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    });
</script>
</body>
</html>
