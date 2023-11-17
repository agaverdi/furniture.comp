@extends('layouts.frontend')
@section('title',$product_details->name)

@section('styles')
    <link rel="icon"  type="image/x-icon" href="{{ asset($product_details->path1) }}" >
    <style>

        *{
            color: #4d4b4b;
        }
        .qty-container{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .qty-container .input-qty{
            text-align: center;
            padding: 6px 10px;
            border: 1px solid #d4d4d4;
            max-width: 80px;
            font: caption;
            color: black;
        }
        .qty-container .qty-btn-minus,
        .qty-container .qty-btn-plus{
            border: 1px solid #d4d4d4;
            padding: 10px 13px;
            font-size: 10px;
            height: 38px;
            width: 38px;
            transition: 0.3s;
        }
        .qty-container .qty-btn-plus{
            margin-left: -1px;
        }
        .qty-container .qty-btn-minus{
            margin-right: -1px;
        }


        /*---------------------------*/
        .btn-cornered,
        .input-cornered{
            border-radius: 4px;
        }
        .btn-rounded{
            border-radius: 50%;
        }
        .input-rounded{
            border-radius: 50px;
        }
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            visibility: hidden;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
    </style>
@endsection
@section('content')
    @include('frontend.components.search')
    <main id="mt-main">
        <!-- Mt Product Detial of the Page -->
        <section class="mt-product-detial wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Slider of the Page -->
                        <div class="slider">
                            <!-- Comment List of the Page -->
                            <ul class="list-unstyled comment-list">
                                <li><a href="#"><i class="fa fa-heart"></i>{{ $heart_count->count() }}</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i>{{ $comments_count->count() }}</a></li>
                                <li><a href="#"><i class="fa fa-share-alt"></i>14</a></li>
                            </ul>

                            <!-- Comment List of the Page end -->
                            <!-- Product Slider of the Page -->
                            <div class="product-slider">
                                @for($i=1; $i<=6; $i++)
                                    @if($product_details->{'path'.$i})
                                        <div class="slide">
                                            <img src="{{ asset($product_details->{'path'.$i}) }}" alt="image descrption">
                                        </div>

                                    @endif
                                @endfor
                            </div>
                            <!-- Product Slider of the Page end -->
                            <!-- Pagg Slider of the Page -->
                            <ul class="list-unstyled slick-slider pagg-slider">
                                @for($i=1; $i<=6; $i++)
                                    @if($product_details->{'path'.$i})
                                        <li><div class="img"><img src="{{ asset($product_details->{'path'.$i}) }}" alt="image description"></div></li>
                                    @endif
                                @endfor


                            </ul>
                            <!-- Pagg Slider of the Page end -->
                        </div>
                        <!-- Slider of the Page end -->
                        <!-- Detail Holder of the Page -->
                        <div class="detial-holder">
                            <!-- Breadcrumbs of the Page -->
                            <ul class="list-unstyled breadcrumbs">
                                <li><a href="{{  route('frontend.product.index', ['level1'=>$category->slug,'level2'=>$sub_category->slug])  }}">{{ $sub_category->category_name }} <i class="fa fa-angle-right"></i></a></li>
                                <li>{{ $product_details->name }}</li>
                            </ul>
                            <!-- Breadcrumbs of the Page end -->
                            <h2>{{ $product_details->name }}</h2>
                            <!-- Rank Rating of the Page -->
                            <div class="rank-rating">

                                <ul class="list-unstyled rating-list">
                                    @for($i=1;$i<=5;$i++)
                                        <li><a href="#"><i class="fa {{ $i <= $product_details->stars ? 'fa-star' : 'fa-star-o' }}"></i></a></li>
                                    @endfor

                                </ul>
                                <span class="total-price">Komentlər (12)</span>
                            </div>
                            <!-- Rank Rating of the Page end -->
                            <ul class="list-unstyled list">
                                <li><a href="#"><i class="fa fa-share-alt"></i>Paylaş</a></li>

                                <li data-user-id="{{ auth()->id() }}" data-product-id="{{ $product_details->id }}" class="icon-change">
                                    <a href="#">
                                        <i class="{{ $product_details->userWishList(auth()->id(), $product_details->id) == true ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}" style="color: #e52a3c;"></i>                                                        </a>
                                    Istək siyahısına əlavə et
                                    </a>
                                </li>

                            </ul>
                            <div class="txt-wrap">
                                {!! $product_details->description !!}
                            </div>

                            @if($product_details->discount_price)
                                <div class="text-holder">
                                    <span class="price total-discount">₼ {{$product_details->discount_price}} </span>
                                    <del class="total-price" style="font-size: x-large;">₼ {{$product_details->price}}</del>
                                </div>
                            @else
                                <div class="text-holder">
                                    <span class="price total-price">₼ {{$product_details->price}} </span>
                                </div>
                            @endif

                            <!-- Product Form of the Page -->
                            <div  class="product-form">

                                <fieldset>
                                    {{--<div class="row-val">
                                        <input type="number" name="product_qty" data-price-qty="{{ $product_details->price }}" data-discount-qty="{{ $product_details->discount_price }}" class="start-qty" id="qty" placeholder="1">
                                    </div>--}}
                                    <div class="row-val">
                                        <button data-product-id="{{ $product_details->id }}" class="one-product-add" >Karta əlavə et</button>
                                    </div>
                                </fieldset>
                            </div>
                            <!-- Product Form of the Page end -->
                        </div>
                        <!-- Detail Holder of the Page end -->
                    </div>
                </div>
            </div>
        </section><!-- Mt Product Detial of the Page end -->
        <div class="product-detail-tab wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="mt-tabs text-center text-uppercase">
                            @if(!$product_details->set_products->isEmpty())
                                <li><a href="#tab1" class="active">Ümumi əşyaların sayı və qiymətləri</a></li>
                                <li><a href="#tab2" >Istifadə olunan materiallar</a></li>
                                <li><a href="#tab3">Komentlər ({{ $comments_count->count() }})</a></li>
                            @else
                                <li><a href="#tab2" class="active">Istifadə olunan materiallar</a></li>
                                <li><a href="#tab3">Komentlər ({{ $comments_count->count() }})</a></li>
                            @endif

                        </ul>
                        <div class="tab-content">
                            @if(!$product_details->set_products->isEmpty())
                            <div id="tab1">
                                <h1>basliq</h1>
                                <hr>


                                @foreach($product_details->set_products as $set_product)
                                <div class="row" data-set-key="{{ $set_product->set_key }}">
                                    <div class="col-md-3">

                                        <div class="mt-product4">
                                            <strong>{{ $set_product->set_name }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-product4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <strong class="first-discount{{ $set_product->set_key }}">{{ $set_product->set_discount }}</strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <del class="first-price{{ $set_product->set_key }}">{{ $set_product->set_price }}</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="qty-container">
                                            <button onclick="minus({{ $set_product->set_key }})" class="qty-btn-minus btn-primary btn-rounded mr-1 btn-minus{{ $set_product->set_key }}" type="button"><i class="fa fa-chevron-left"></i></button>&nbsp;&nbsp;
                                            <input type="text" name="qty" value="{{ $set_product->count }}" class="input-qty input-rounded set_key{{ $set_product->set_key }}">&nbsp;&nbsp;
                                            <button onclick="plus({{ $set_product->set_key }})" class="qty-btn-plus btn-primary btn-rounded ml-1 btn-plus{{ $set_product->set_key }}" type="button"><i class="fa fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-product4 " style="float: right">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <strong class="set-discount{{ $set_product->set_key }}">{{ number_format($set_product->set_discount*$set_product->count,2) }}</strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <del class="set-price{{ $set_product->set_key }}">{{ number_format($set_product->set_price*$set_product->count,2) }}</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <hr>
                                @endforeach
                            </div>
                            @else
                                <div id="tab1"></div>
                            @endif
                            <div id="tab2">
                                <p>{!! substr($product_details->description, 0, strlen($product_details->description) / 2) !!}</p>
                                <p>{!! substr($product_details->description,  strlen($product_details->description) / 2) !!}</p>
                            </div>
                            <div id="tab3">
                                <div class="product-comment comments-side">

                                </div>
                                <div class="">
                                    <form class="p-commentform">
                                        <fieldset>
                                            <h2>Add  Comment</h2>
                                            <div class="error-container">

                                            </div>

                                            <div class="mt-row">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control coment_name">
                                            </div>
                                            <div class="mt-row">
                                                <label>E-Mail</label>
                                                <input type="text" name="email" class="form-control coment_email">
                                            </div>
                                            <div class="mt-row">
                                                <label>Review</label>
                                                <textarea class="form-control coment_text" name="comment"></textarea>
                                            </div>
                                            <div class="form-group" >

                                                <label >Rating</label>
                                                <ul  style="height: 31px;">
                                                    <div class="rate" style="margin-left: -54px;">
                                                        <input type="radio" id="star5" name="rate" value="5" />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input type="radio" id="star4" name="rate" value="4" />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input type="radio" id="star3" name="rate" value="3" />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input type="radio" id="star2" name="rate" value="2" />
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input type="radio" id="star1" name="rate" value="1" />
                                                        <label for="star1" title="text">1 star</label>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="mt-row">
                                                <button type="submit" class="btn-type4">ADD REVIEW</button>
                                            </div>

                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- related products start here -->
        <div class="related-products wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Oxşar Məhsullar</h2>
                        <div class="row">
                            <div class="col-xs-12">
                                @foreach($related_products as $related_product)
                                <!-- mt product1 center start here -->
                                <div class="mt-product1 mt-paddingbottom20">
                                    <div class="box">
                                        <div class="b1">
                                            <div class="b2">
                                                <a href="product-detail.html"><img src="{{ asset($related_product->path1) }}" alt="image description"></a>
                                                <span class="caption">
                                                    <span class="off">15% endirim</span>
                                                    <span class="new">Yeni</span>
                                                </span>
                                                <ul class="mt-stars" >
                                                    @for($i=1;$i<=5;$i++)
                                                        <li><a href="#"><i class="fa {{ $i <= $related_product->stars ? 'fa-star' : 'fa-star-o' }}"></i></a></li>
                                                    @endfor

                                                </ul>
                                                <ul class="links">
                                                    <li><a href="#"><i class="icon-handbag"></i><span>Karta əlavə et</span></a></li>
                                                    <li data-user-id="{{ auth()->id() }}" data-product-id="" class="icon-change"><a href="#"><i class="fa-regular fa-heart" style="color: #e52a3c;"></i></a></li>
                                                    <li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="txt">
                                        <strong class="title">

                                        </strong>
                                        <strong class="title"><a href="product-detail.html">{{ $related_product->name }}</a></strong>
                                        <span class="price"><span>{{ $related_product->discount_price }}</span> <del>{{ $related_product->price }}</del></span>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- related products end here -->
        </div>
    </main><!-- mt main end here -->
@endsection
@section('scripts')
<script>
    $(document).ready(function() {

        function fetchComments() {
            $.ajax({
                type: 'GET',
                url: '/get-comments',
                data:{'slug': '{{ $product_details->slug }}'},
                success: function(response) {
                    if (response.status === 200) {
                        var comments = response.comments;
                            console.log(comments);
                        // Clear the existing comments
                        $('.comments-side').empty();

                        // Iterate over the comments and append them to the HTML structure
                        comments.forEach(function(comment) {
                            var starRatingHTML = '';

                            for (var i = 1; i <= 5; i++) {
                                var starIconClass = i <= comment.rating ? 'fa fa-star' : 'fa-regular fa-star';
                                starRatingHTML += '<li><a href="#"><i style="color: #e9aa3e;" class="' + starIconClass + '"></i></a></li>';
                            }

                            var commentHTML = `
                                    <div class="mt-box">
                                        <div class="mt-hold">
                                            <ul class="mt-star">
                                                ${starRatingHTML}
                                            </ul>
                                            <span class="name" style="color: #cc6161;">${comment.name}</span>
                                            <time datetime="${comment.created_at}">${comment.created_at}</time>
                                        </div>
                                        <p>${comment.comment}</p>
                                    </div>
                                `;

                            $('.product-comment').append(commentHTML);
                        });
                    }
                },
                error: function(error) {
                    console.log('Error fetching comments data');
                }
            });
        }

        fetchComments();


        $('.p-commentform').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            // Retrieve form values
            var rating = $('input[name="rate"]:checked').val();
            var name = $('.coment_name').val();
            var email = $('.coment_email').val();
            var comment = $('.coment_text').val();

            // Create an object with the form data
            var formData = {
                rating: rating,
                name: name,
                email: email,
                comment: comment,
                slug: '{{$product_details->slug}}',
                product_id: {{ $product_details->id }},
            };

            // Send the form data to the server using AJAX
            $.ajax({
                type: 'GET',
                url: '/product/comment', // Replace with the actual URL to submit the data
                data: formData,
                success: function(response) {
                    console.log(response);
                    // Handle the success response from the server
                    console.log('Data submitted successfully');
                    $('.error-container').empty(); // Clear any existing error messages
                    // Reset the form fields if needed
                    $('.p-commentform')[0].reset();
                    $('.error-container').append('<p style="color: #f4f4f4;background: darkcyan;padding: 5px; border-radius: 3px;">şərhiniz paylaşıldı</p>');
                    setTimeout(function() {
                        $('.error-container').fadeOut('slow', function() {
                            $(this).empty().show();
                        });
                    }, 4000);
                    fetchComments();
                },
                error: function(xhr) {
                    // Handle the error response from the server
                    console.log('Error submitting data');
                    var errors = xhr.responseJSON.errors;

                    if (errors) {
                        $('.error-container').empty(); // Clear any existing error messages

                        Object.keys(errors).forEach(function(field) {
                            errors[field].forEach(function(message) {
                                $('.error-container').append('<p style="color: red;">' + message + '</p>');
                            });
                        });
                    }
                }
            });
        });
    });

    var discounts = {};
    var prices = {};

    function plus(key) {
        var $n = $(".set_key" + key);
        var amount = Number($n.val());

        // Check if the discount and price values are available in the variables
        if (!discounts[key]) {
            discounts[key] = parseFloat($('.first-discount' + key).text());
            prices[key] = parseFloat($('.first-price' + key).text());
        }

        if (amount >= 0) {
            $n.val(amount + 1);
            $('.set-discount' + key).html((discounts[key] * (amount + 1)).toFixed(2));
            $('.set-price' + key).html((prices[key] * (amount + 1)).toFixed(2));
        }
    }

    function minus(key) {
        var $n = $(".set_key" + key);
        var amount = Number($n.val());

        // Check if the discount and price values are available in the variables
        if (!discounts[key]) {
            discounts[key] = parseFloat($('.first-discount' + key).text());
            prices[key] = parseFloat($('.first-price' + key).text());
        }

        if (amount > 0) {
            $n.val(amount - 1);
            $('.set-discount' + key).html((discounts[key] * (amount - 1)).toFixed(2));
            $('.set-price' + key).html((prices[key] * (amount - 1)).toFixed(2));
        }
    }
    $(document).on('click', '.one-product-add', function (event){
        event.preventDefault();
        var userId = '{{ auth()->id() }}';
        var productId = $(this).attr("data-product-id");
        if (userId === null || userId === "") {
            // Show the dynamic modal
            $(".aviso-login").show();

            // Hide and remove the dynamic modal after 3 seconds
            setTimeout(function () {
                $(".aviso").hide();
            }, 5000);
        }
        else{
            //bunun icinde refresh functionu varki hansi ki o wish blokunu refresh edir
            card_list_add(userId,productId);


        }
    });


    @isset($set_product)
        var totaldiscount = 0;
        var totalprice= 0;

        for(var i=1;i<={{$set_product->set_key}};i++){
            var discount = $('.set-discount' + i).text();
            var price = $('.set-price' + i).text();

            discount = parseFloat(discount.replace(/,/g, ""));
            price = parseFloat(price.replace(/,/g, ""));


            totalprice = totalprice + price;
            totaldiscount = totaldiscount +discount;

        }

        $(document).on('click','.qty-btn-plus', function (){
        var totaldiscount = 0;
        var totalprice= 0;
        for(var i=1;i<={{$set_product->set_key}};i++){
            var discount = $('.set-discount' + i).text();
            var price = $('.set-price' + i).text();

            discount = parseFloat(discount.replace(/,/g, ""));
            price = parseFloat(price.replace(/,/g, ""));


            totalprice = totalprice + price;
            totaldiscount = totaldiscount +discount;

        }

        $('.total-price').html(totalprice.toFixed(2));
        $('.total-discount').html("₼ " +totaldiscount.toFixed(2));
        console.log(totalprice);
        console.log(totaldiscount)

    })

        $(document).on('click','.qty-btn-minus', function (){
        var totaldiscount = 0;
        var totalprice= 0;
        for(var i=1;i<={{$set_product->set_key}};i++){
            var discount = $('.set-discount' + i).text();
            var price = $('.set-price' + i).text();

            discount = parseFloat(discount.replace(/,/g, ""));
            price = parseFloat(price.replace(/,/g, ""));


            totalprice = totalprice + price;
            totaldiscount = totaldiscount +discount;
        }

        $('.total-price').html(totalprice.toFixed(2));
        $('.total-discount').html("₼ " +totaldiscount.toFixed(2));

    })

    @endisset

    $(document).on('change', '.start-qty', function (){
        var val = $('.start-qty').val();
        var data_price_qty = $('.start-qty').data('price-qty');
        var data_discount_qty = $('.start-qty').data('discount-qty');

        data_price_qty = parseFloat(data_price_qty.replace(/,/g, ""));
        data_discount_qty = parseFloat(data_discount_qty.replace(/,/g, ""));

        var total_data_price_qty = data_price_qty*val;
        var total_data_discount_qty = data_discount_qty*val;

        $('.total-price').html("₼ " +total_data_price_qty.toFixed(2));
        $('.total-discount').html("₼ " +total_data_discount_qty.toFixed(2));
        console.log(total_data_price_qty);
        console.log(total_data_discount_qty);

    });

</script>
@endsection
