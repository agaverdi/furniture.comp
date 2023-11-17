@extends('layouts.frontend')
@section('title',$pages->name)
@section('styles')
    <link rel="icon" type="image/x-icon" href="{{ asset($pages->icon) }}">
@endsection
@section('content')
    @include('frontend.components.search')
    <!-- Main of the Page -->
    <main id="mt-main">
        <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{ asset($pages->url_path) }});">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="text-center">CHECK OUT</h1>
                        <!-- Breadcrumbs of the Page -->
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{route('frontend.index')}}">Home <i class="fa fa-angle-right"></i></a></li>
                                <li>Check Out</li>
                            </ul>
                        </nav>
                        <!-- Breadcrumbs of the Page end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt Process Section of the Page -->
        <div class="mt-process-sec wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Process List of the Page -->
                        <ul class="list-unstyled process-list">
                            <li class="active">
                                <span class="counter">01</span>
                                <strong class="title">Shopping Cart</strong>
                            </li>
                            <li class="active">
                                <span class="counter">02</span>
                                <strong class="title">Check Out</strong>
                            </li>
                            <li>
                                <span class="counter">03</span>
                                <strong class="title">Order Complete</strong>
                            </li>
                        </ul>
                        <!-- Process List of the Page end -->
                    </div>
                </div>
            </div>
        </div><!-- Mt Process Section of the Page end -->
        <!-- Mt Detail Section of the Page -->
        <section class="mt-detail-sec toppadding-zero wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <h2>BILLING DETAILS</h2>
                        <!-- Bill Detail of the Page -->
                        <form action="{{ route('frontend.checkout') }}" method="POST" class="bill-detail bill-input">
                            <fieldset>
                                @csrf
                                <div class="form-group">
                                    <select  class="form-control" name="country">
                                        @error('country')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <option value="{{$products_shipping->shipping->id}}">{{$products_shipping->shipping->shipping_name}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <div class="col">
                                        <input  type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="Name">
                                    </div>
                                    @error('lastname')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <div class="col">
                                        <input type="text" class="form-control" value="{{$user->surname}}" name="lastname" placeholder="Last Name">
                                    </div>
                                </div>
                                @error('company')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <input type="text" class="form-control" name="company" value="{{ old('company') }}" placeholder="Company Name">
                                </div>
                                @error('Address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <textarea class="form-control"  name="address" placeholder="Address">{{$user_details->address}}</textarea>
                                </div>
                                @error('city')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <input type="text" class="form-control" name="city" value="{{$products_shipping->shipping_name }}" placeholder=" Your State / Country">
                                    <input type="hidden" name="sub_shipping_id" value="{{ $products_shipping->id }}">
                                </div>
                                <div class="form-group">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <div class="col">
                                        <input type="email" class="form-control" value="{{$user->email}}"  name="email" placeholder="Email Address">
                                    </div>
                                    @error('phone')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <div class="col">
                                        <input type="text" id="fourth-phone" value="{{$user_details->phone}}" name="phone" class="form-control fourth-phone" placeholder="+994-__-__-____" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox"> Ship to a different address?
                                </div>
                                @error('order_text')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <textarea class="form-control" name="order_text" placeholder="Order Notes">{{ old('order_text') }}</textarea>
                                </div>


                                <div class="block-holder">
                                    <input type="checkbox" checked> I’ve read &amp; accept the <a href="#">terms &amp; conditions</a>
                                </div>
                                <button style="border: none"  type="submit" class="process-btn">PROCEED TO CHECKOUT <i class="fa fa-check"></i></button>
                            </fieldset>
                        </form>
                        <!-- Bill Detail of the Page end -->
                    </div>


                    <div class="col-xs-12 col-sm-6">
                        <div class="holder">
                            <h2>YOUR ORDER</h2>
                            <ul class="list-unstyled block">
                                <li>
                                    <div class="txt-holder">

                                        <div class="text-wrap pull-left">
                                            <strong class="title">FURNITURE</strong>

                                            @isset($products_and_quantities)
                                                @foreach($products_and_quantities as $item)
                                                    <span>{{ $item->product->name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->quantity }}x</span>
                                                @endforeach
                                            @else
                                                <p>No products and quantities available.</p>
                                            @endisset
                                        </div>
                                        <div class="text-wrap txt text-right pull-right">
                                            <strong class="title">TOTALS</strong>
                                            @isset($products_and_quantities)
                                                @foreach($products_and_quantities as $item)
                                                    <span><i class="fa-solid fa-manat-sign"></i>  {{ $item->price_and_qty}} </span>
                                                @endforeach
                                            @else
                                                <p>No products and quantities available.</p>
                                            @endisset
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="txt-holder">
                                        <strong class="title sub-title pull-left">CART SUBTOTAL</strong>
                                        <div class="txt pull-right">
                                            <span><i class="fa-solid fa-manat-sign"></i> {{ $products_subtotal!=null?$products_subtotal:''  }}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="txt-holder">
                                        <strong class="title sub-title pull-left">SHIPPING</strong>
                                        <div class="txt pull-right">
                                            <span><i class="fa-solid fa-manat-sign"></i>{{ $products_shipping->shipping_price!=null?$products_shipping->shipping_price:'secilmeyib' }}</span>
                                        </div>
                                    </div>
                                </li>
                                <li style="border-bottom: none;">
                                    <div class="txt-holder">
                                        <strong class="title sub-title pull-left">ORDER TOTAL</strong>
                                        <div class="txt pull-right">
                                            <span><i class="fa-solid fa-manat-sign"></i>{{ $products_subtotal!=null?$products_subtotal+$products_shipping->shipping_price:'' }}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <h2>PAYMENT METHODS</h2>
                            <!-- Panel Group of the Page -->
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <!-- Panel Panel Default of the Page -->
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                PAYPAL
                                                <span class="check"><i class="fa fa-check"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">
                                            <p>Make your payment directly into our bank account. Please use your order id as the payment reference. Your order wont be shippided until the funds have cleared in our account</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Panel Panel Default of the Page end -->
                            </div>
                            <!-- Panel Group of the Page end -->
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <!-- Mt Detail Section of the Page end -->
    </main><!-- Main of the Page end here -->

@endsection
@section('scripts')



    <!-- Required for using jQuery maskedinput plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            $(".fourth-phone").mask("+999-99-999-9999");
        });


        $(document).ready(function () {
            var productIds = []; // Create an empty array to collect the IDs
            var product_total=0;
            @foreach($products_and_quantities as $item)
            productIds.push({{ $item->product->id }}); // Push each ID to the array
            var productIdsString = productIds.join(',');
            productIds.push({{ $item->quantity }})
            var productIdsString = productIds.join(',');
            product_total+=parseFloat({{$item->product->price*$item->quantity}})
            @endforeach
            var hiddenInput = $('<input type="hidden" name="product_ids" value="' + productIdsString + '">');
            var hiddenInput2 = $('<input type="hidden" name="product_total" value="' + product_total + '">');
            $('.bill-input').append(hiddenInput);
            $('.bill-input').append(hiddenInput2);
            // Now you have an array 'productIds' containing all the IDs
            console.log(productIds);
            console.log(product_total);
        });

    </script>

@endsection
