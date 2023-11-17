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
                        <h1 class="text-center">SHOPPING CART</h1>
                        <!-- Breadcrumbs of the Page -->
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{route('frontend.index')}}">Home <i class="fa fa-angle-right"></i></a></li>
                                <li>Shopping Cart</li>
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
                        <ul class="list-unstyled process-list">
                            <li class="active">
                                <span class="counter">01</span>
                                <strong class="title">Shopping Cart</strong>
                            </li>
                            <li>
                                <span class="counter">02</span>
                                <strong class="title">Check Out</strong>
                            </li>
                            <li>
                                <span class="counter">03</span>
                                <strong class="title">Order Complete</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- Mt Process Section of the Page end -->
        <!-- Mt Product Table of the Page -->
        <div class="mt-product-table wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="alert">
                    @if($check_cart_to_checkout)
                        <div class="container" style="text-align: center;">
                            <h3>Sizin tamamlanmamış sifarişiniz var. Tamamlamaq üçün kecid edin</h3>
                            <div class="container" style="display: flex;justify-content: space-between;">
                                <a class="btn btn-success float-left" href="{{ route('frontend.user.cart_to_checkout') }}">Kecid edin</a>
                                <form action="{{ route('frontend.user.checkout_delete') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger float-left " >Silin</button>
                                </form>
                            </div>
                        </div>
                    @else
                        @if($card_products->count() != 0)
                            <div class="row border">
                                @include('backend.includes.success')
                                <div class="col-xs-12 col-sm-6">
                                    <strong class="title">PRODUCT</strong>
                                </div>
                                <div class="col-xs-12 col-sm-2">
                                    <strong class="title">PRICE</strong>
                                </div>
                                <div class="col-xs-12 col-sm-2">
                                    <strong class="title">QUANTITY</strong>
                                </div>
                                <div class="col-xs-12 col-sm-2">
                                    <strong class="title">TOTAL</strong>
                                </div>
                            </div>
                            <div class="row-border-cart-product">
                                @foreach($card_products as $prd)
                                    <div class="row border" id="card-product-{{$prd->wish_product->id}}">
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="img-holder">
                                                <img src="{{ asset($prd->wish_product->path1) }}" alt="image description">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <strong class="product-name">{{ $prd->wish_product->name }}</strong>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <strong class="price cart-product-price-{{$prd->wish_product->id}}"><i class="fa-solid fa-manat-sign"></i> {{ $prd->wish_product->price }}</strong>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <form action="#" class="qyt-form">
                                                <fieldset>
                                                    <select data-product-price="{{$prd->wish_product->price}}" data-product-id="{{$prd->wish_product->id}}" name="product_qty"  class="cart-product-qty">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                    </select>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <strong class="price">
                                                <i class="fa-solid fa-manat-sign"></i> {{ $prd->wish_product->price }}
                                            </strong>
                                            <a href="#">
                                                <i data-product-id="{{$prd->wish_product->id}}" data-user-id="{{auth()->id()}}" class="fa fa-close  card-iks-checkout"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <form action="#" class="coupon-form">
                                        <fieldset>
                                            <div class="mt-holder">
                                                <input type="text" class="form-control" placeholder="Your Coupon Code">
                                                <button type="submit">APPLY</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        @else
                            @include('backend.includes.success')
                            <div class="row-border-cart-product">
                                <div class="row border" style="text-align: center;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xs-12">
                                            <h3>Sizin Kartınız hal hazirda bosdur. Yeni bir məhsul əlavə etmək üçün
                                                <strong>
                                                    <a style="text-decoration: underline" href="{{ route('frontend.index') }}">Ana səhifəyə  qayıdın</a>
                                                </strong>
                                            </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div><!-- Mt Product Table of the Page end -->
        <!-- Mt Detail Section of the Page -->
        <section class="mt-detail-sec style1 wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <h2>CALCULATE SHIPPING</h2>
                        <form action="#" class="bill-detail">
                            <fieldset>
                                <div class="form-group">
                                    <select class="form-control" id="shipping" name="shipping_state">
                                        <option value="0">Olke secin</option>
                                        @foreach($shipping_state as $state)
                                            <option value="{{$state->id}}">{{ $state->shipping_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="sub_shipping"  name="sub_shipping_id">
                                        <option  value="0">Olke / seher</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="postal_code" name="postal_code">
                                        <option value="0">Zip / Postal kod</option>
                                    </select>
                                </div>
                                @if(!$check_cart_to_checkout)
                                <div class="form-group">
                                    <button class="update-btn update-cart-total" >ÜMUMİ MƏBLƏGİ YENİLƏ<i class="fa fa-refresh"></i></button>
                                </div>
                                @endif
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-6 cart-shopping-total">
                        <h2>CART TOTAL</h2>
                        <ul class="list-unstyled block cart">
                            <li>
                                <div class="txt-holder">
                                    <strong class="title sub-title pull-left">CART SUBTOTAL</strong>
                                    <div class="txt pull-right">
                                        <span><i class="fa-solid fa-manat-sign cart-subtotal"> {{ $check_cart_to_checkout!=0 ? 0: $cardsTotalPrice }}</i></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="txt-holder">
                                    <strong class="title sub-title pull-left">SHIPPING</strong>
                                    <div class="txt pull-right">
                                        <strong class="shipping-price"  data-price="0" >Çatdırılma qiyməti seçilməyib</strong>
                                    </div>
                                </div>
                            </li>
                            <li style="border-bottom: none;">
                                <div class="txt-holder">
                                    <strong class="title sub-title pull-left">CART TOTAL</strong>
                                    <div class="txt pull-right">
                                        <span><i class="fa-solid fa-manat-sign cart-total"> {{ $check_cart_to_checkout!=0 ? 0: $cardsTotalPrice }}</i></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="a-tag-visible">
                            @if(!$check_cart_to_checkout && $card_products->count() != 0)
                                <a href="" class="process-btn" id="checkout-btn">PROCEED TO CHECKOUT <i class="fa fa-check"></i></a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt Detail Section of the Page end -->
    </main>
    <!-- Main of the Page end here -->

@endsection
@section('scripts')
<script>
    $(document).on('change','#shipping' , function (){
        let value = $(this).val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/product/shipping',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {'value': value},
            success: function(data){
                $("#sub_shipping option").remove();
                $("#sub_shipping").append('<option selected value="0">Seçiniz</option>');
                $("#postal_code option").remove();
                $("#postal_code").append('<option  value="0">Zip / Postal kod</option>');
                $.each(data.sub_shipping, function (index, value) {

                    let sub_shipping_name = value.shipping_name;
                    let sub_shipping_id = value.id;
                    console.log(sub_shipping_name);
                    $("#sub_shipping").append('<option value="'+sub_shipping_id+'">'+sub_shipping_name+'</option>');
                });

            }
        });
    });

    $(document).on('change', '#sub_shipping',function (){
        let value = $(this).val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/product/sub_shipping',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {'value': value},
            success: function(data){
                console.log(data);
                console.log(data.postal_code);
                $("#postal_code option").remove();
                $("#postal_code").append('<option value="'+data.postal_code.id+'">'+data.postal_code.postal_code+'</option>');
            }
        });
    });

    $(document).on('click','.update-cart-total', function (event){
        event.preventDefault();
        var subShipping = $('#sub_shipping').val();
        console.log(subShipping);
        if(subShipping=="0")
        {
            alert('siz seheri qeyd etmemisiniz? xahis edirik qeyd  edin');
        }
        else{
            shipping_price(subShipping);
        }
    });

    $(document).on('click','.card-iks-checkout',function (event){
        event.preventDefault();
        var userId = $(this).attr("data-user-id");
        var productId = $(this).attr("data-product-id");
        if (userId === null || userId === "") {
            // Show the dynamic modal
            $(".aviso").show();

            // Hide and remove the dynamic modal after 3 seconds
            setTimeout(function () {
                $(".aviso").hide();
            }, 5000);
        }
        else {
            card_iks_checkout(userId, productId);
            card_product_delete(userId,productId);
            updateLiClass(userId,productId,1);
        }
    });

    $(document).on('click','.update-cart-total',function (event){
        event.preventDefault();
        // Calculate the new cart subtotal
        var newSubtotal = 0;

        // Iterate through all .cart-product-qty elements
        $('.cart-product-qty').each(function () {
            var selectedQty = parseInt($(this).val());
            var productPrice = parseFloat($(this).data('product-price'));
            var subtotal = selectedQty * productPrice;
            newSubtotal += subtotal;
        });

        // Update the cart subtotal
        $('.cart-subtotal').text(newSubtotal.toFixed(2));


        var shipping_data_price = parseFloat($('.shipping-price').data('price'));
        shipping_data_price = shipping_data_price.toFixed(2);

        // Calculate the total price
        var totalPrice = newSubtotal + shipping_data_price;

        // Update the total price display
        $('.cart-total').text(parseFloat(totalPrice).toFixed(2));
    });

    $(document).on('change', '.cart-product-qty', function (event){
       event.preventDefault();
        var newSubtotal = 0;

        // Iterate through all .cart-product-qty elements
        $('.cart-product-qty').each(function () {
            var selectedQty = parseInt($(this).val());
            var productPrice = parseFloat($(this).data('product-price'));
            var subtotal = selectedQty * productPrice;
            newSubtotal += subtotal;
        });

        // Update the cart subtotal
        $('.cart-subtotal').text(newSubtotal.toFixed(2));
        var shipping_data_price = parseFloat($('.shipping-price').attr('data-price'));
        console.log(shipping_data_price);
        if(shipping_data_price===0){
            $('.cart-total').text(newSubtotal.toFixed(2));
        }
        else{
            var newtotal = newSubtotal+shipping_data_price;
            $('.cart-total').text(newtotal.toFixed(2));
        }
    });

    $(document).on('click','#checkout-btn', function (e){
        e.preventDefault();

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var productIds = [];
        var quantities = {};

        $('.cart-product-qty').each(function () {
            var productId = $(this).data('product-id');
            var quantity = $(this).val();
            productIds.push(productId);
            quantities[productId] = quantity;
        });
        var shipping_data_price = parseFloat($('.shipping-price').attr('data-price'));
        if(shipping_data_price===0){
            $(".aviso-ship-price").show();

            // Hide and remove the dynamic modal after 3 seconds
            setTimeout(function () {
                $(".aviso").hide();
            }, 5000);
        }
        else{
            var sub_shipping_id = $('#sub_shipping').val();
            $.ajax({
                url: "/cart-to-checkout",
                method: "POST",
                headers: {'X-CSRF-TOKEN': csrfToken},
                data: {
                    quantities:quantities,
                    productIds:productIds,
                    sub_shipping_id:sub_shipping_id,
                },
                success: function(data){
                    if (data.status === 200) {
                        window.location.href = '{{ route('frontend.user.cart_to_checkout') }}'
                    }
                }
            })
        }
    });

    //shopping sehifesinde toplu productun deyerinin hesablanmasi
    function card_iks_checkout(userId,productId){

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        console.log(userId);
        console.log(productId);
        $.ajax({
            url: '/product/card-iks-checkout',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {
                userId:userId,
                productId:productId,
            },
            success:function (response){

                if (response.status === 200) {
                    var wishesTotalDiscount  = response.wishesTotalDiscount;
                    var wishesTotalPrice     = response.wishesTotalPrice;
                    var cartItemId = 'card-item-' + productId;
                    console.log("Attempting to remove:", cartItemId);
                    $('#' + cartItemId).remove();
                    console.log('#' + cartItemId);
                    $('.cart_num').empty();

                    var wishesCount = response.wishesCount;
                    $('.cart_num').append(wishesCount);

                    var newSubtotal = 0;

                    // Iterate through all .cart-product-qty elements
                    $('.cart-product-qty').each(function () {
                        var selectedQty = parseInt($(this).val());
                        var productPrice = parseFloat($(this).data('product-price'));
                        var subtotal = selectedQty * productPrice;
                        newSubtotal += subtotal;
                    });

                    // Update the cart subtotal
                    $('.cart-subtotal').text(newSubtotal.toFixed(2));
                    var shipping_data_price = parseFloat($('.shipping-price').attr('data-price'));
                    console.log(shipping_data_price);
                    if(shipping_data_price===0){
                        $('.cart-total').text(newSubtotal.toFixed(2));
                    }
                    else{
                        var newtotal = newSubtotal+shipping_data_price;
                        $('.cart-total').text(newtotal.toFixed(2));
                    }
                    if ($('.card-wishes .cart-wishes').length === 0) {
                        $('.a-tag-visible').empty();
                        console.log('afdafaaa')
                    }
                    wish_add_and_delete_single(userId);
                }

            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            },
        })
    }
    //shopping sehifesinde card-product silme
    function card_product_delete(userId, productId){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/product/card-product-delete',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {
                userId:userId,
                productId:productId,
            },
            success:function (response){
                if (response.status === 200) {
                    var cartsTotalDiscount  = response.cartsTotalDiscount;
                    var cartsTotalPrice     = response.cartsTotalPrice;
                    var cartItemId = 'card-product-' + productId;
                    var ship_price = parseFloat($('.shipping-price').attr('data-price'));
                    console.log("Attempting to remove:", cartItemId);
                    $('#' + cartItemId).remove();
                    console.log('#' + cartItemId);
                    $('.cart_num').empty();

                    var cartsCount = response.cartsCount;
                    $('.cart_num').append(cartsCount);

                    $('.cart-subtotal').empty();
                    $('.cart-subtotal').append('&nbsp;'+cartsTotalPrice);
                    $('.cart-total').empty();
                    $('.cart-total').append('&nbsp;'+(cartsTotalPrice+ship_price));
                    if ($('.card-wishes .cart-wishes').length === 0) {
                        $('.a-tag-visible').empty();

                    }

                }
            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            },
        })
    }
    //shopping sehifesinde card-product elave etme bir sorgu uzerinden
    function cart_add_wishes_all_copy(userId){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/product/cart-add-wishes-all-copy',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {
                userId:userId,
            },
            success:function (response){
                if (response.status === 200) {

                    var wishesTotalDiscount  = response.wishesTotalDiscount;
                    var wishesTotalPrice     = response.wishesTotalPrice;
                    var wishesCount          = response.wishesCount;

                    $('.cart_num').empty();
                    $('.cart_num').append(wishesCount);
                    $('.row-border-cart-product').empty();
                    console.log('ikinci');

                    $.each(response.cart_all_data,function (index, wishes){

                        var html = `<div class="row border" id="card-product-${wishes.wish_product.id}">
                            <div class="col-xs-12 col-sm-2">
                                <div class="img-holder">
                                    <img src="{{ asset('${wishes.wish_product.path1}') }}" alt="image description">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <strong class="product-name">${wishes.wish_product.name}</strong>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <strong class="price">
                                <i class="fa-solid fa-manat-sign"></i> ${wishes.wish_product.price}</strong>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <form action="#" class="qyt-form">
                                    <fieldset>
                                        <select data-product-price="${wishes.wish_product.price}" data-product-id="${wishes.wish_product.id}" class="cart-product-qty">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>

                                        </select>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <strong class="price">
                                    <i class="fa-solid fa-manat-sign"></i> ${wishes.wish_product.price}
                                </strong>
                                <a href="#">
                                    <i data-product-id="${wishes.wish_product.id}" data-user-id="{{auth()->id()}}" class="fa fa-close  card-iks-checkout"></i>
                                </a>
                            </div>
                        </div>`;
                        var ship_price = parseFloat($('.shipping-price').attr('data-price'));
                        $('.row-border-cart-product').append(html);
                        $('.cart-subtotal').empty();
                        $('.cart-subtotal').append('&nbsp;'+wishesTotalPrice);
                        $('.cart-total').empty();
                        $('.cart-total').append('&nbsp;'+(wishesTotalPrice+ship_price));
                        console.log('ucuncu');
                    });

                }
            },
            error: function (xhr,status,error){
                console.log("Error:", error);
            },
        })
    }
    //gedis pulunu tapmaq
    function shipping_price(subShipping){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/product/shipping-price',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data:{subshipping:subShipping},
            success:function (data){
                console.log(data);
                console.log(data.shipping_price.shipping_price)
                let shipping_price = data.shipping_price.shipping_price;

                $(".shipping-price").text("₼"+shipping_price);

                $('.shipping-price').attr('data-price', shipping_price);


                let cart_total = parseInt($(".cart-subtotal").text(), 10);
                cart_total = cart_total + parseInt(shipping_price);

                $(".cart-total").text(cart_total);
            }
        })
    }


</script>
@endsection
