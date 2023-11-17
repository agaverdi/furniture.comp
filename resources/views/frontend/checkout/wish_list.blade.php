@extends('layouts.frontend')
@section('title',$pages->name)
@section('styles')
    <link rel="icon" type="image/x-icon" href="{{ asset($pages->icon) }}">
    <style>
        .wish-add-to-card {
            font-size: 18px;
            line-height: 20px;
            text-transform: uppercase;
            font-weight: 700;
            font-family: "Montserrat", sans-serif;
            border: none;
            outline: none;
            border-radius: 0;
            display: block;
            text-align: center;
            padding: 16px 10px 13px 7px;
            width: 111px;
            float: left;

            transition: all .25s linear;
            background: #cba233;
            color: #fff;
        }
    </style>
@endsection
@section('content')
    @include('frontend.components.search')
    <!-- Main of the Page -->
    <main id="mt-main">
        <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{ asset($pages->url_path) }});">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="text-center">İstək siyahısı</h1>
                        <!-- Breadcrumbs of the Page -->
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{route('frontend.index')}}">Home <i class="fa fa-angle-right"></i></a></li>
                                <li>İstək siyahısı</li>
                            </ul>
                        </nav>
                        <!-- Breadcrumbs of the Page end -->
                    </div>
                </div>
            </div>
        </section>
        <div class="paddingbootom-md hidden-xs"></div>
        <!-- Mt Product Table of the Page -->
        <div class="mt-product-table wow fadeInUp" data-wow-delay="0.4s">
            <div class="container wish-product">
                    @if($wishes->isEmpty())
                        <div style="font-size: xx-large;height: 100px;background-color: lightgreen;display: flex;align-items: center;justify-content: center;border-radius: 5px;" class="row border wish-item" data-product-id="" data-user-id="{{auth()->id() }}">
                            sizin Istek sehifeniz hal hazirda bosdur
                        </div>
                    @else
                    @foreach($wishes as $wish)

                        <div  class="row border wish-item" data-product-id="{{$wish->wish_product->id}}" data-user-id="{{auth()->id()  }}">
                            <div class="col-xs-12 col-sm-2">
                                <div class="img-holder">
                                    <img src="{{$wish->wish_product->path1}}" alt="image description">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <strong class="product-name">{{$wish->wish_product->name}}</strong>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <strong class="product-name">₼{{$wish->wish_product->price}}</strong>
                            </div>
                            <div class="col-xs-12 col-sm-2">

                                    <fieldset>
                                        <a  class="wish-add-to-card" style="margin-top: 15px;">Karta gonder</a>
                                    </fieldset>

                            </div>
                            <div class="col-xs-12 col-sm-1">
                                <a href="#"><i class="fa fa-close close-wish"></i></a>
                            </div>
                        </div>
                    @endforeach
                @endif


            </div>
        </div><!-- Mt Product Table of the Page end -->
        <div class="paddingbootom-md hidden-xs"></div>
    </main>
    <!-- Main of the Page end here -->
@endsection
@section('scripts')
<script>
    $(document).on('click','.wish-add-to-card',function (event){
        event.preventDefault();
        var $wishItem = $(this).closest('.wish-item');
        var dataProductId = $wishItem.attr('data-product-id');
        var dataUserId = $wishItem.attr('data-user-id');
        $wishItem.remove();
        card_list_add(dataUserId,dataProductId);
        wish_iks(dataUserId,dataProductId);
        if ($('.wish-product .wish-item').length === 0) {
            var wish_product_empty_text = `
                            <div style="font-size: xx-large;height: 100px;background-color: lightgreen;display: flex;align-items: center;justify-content: center;border-radius: 5px;" class="row border wish-item" data-product-id="" data-user-id="{{auth()->id() }}">
                                    sizin Istek sehifeniz hal hazirda bosdur
                            </div>`

            $('.wish-product').append(wish_product_empty_text);
        }
    })


    $(document).on('click', '.close-wish', function (event) {
        event.preventDefault();

        var $wishItem = $(this).closest('.wish-item');
        var dataProductId = $wishItem.attr('data-product-id');
        var dataUserId = $wishItem.attr('data-user-id');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        console.log(dataProductId);
        console.log(dataUserId);
        $.ajax({
            url: '/product/close-wish',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                dataProductId: dataProductId,
                dataUserId: dataUserId,
            },
            success: function (response) {
                if (response.status === 200) {
                    // Remove the specific wish item from the UI
                    $wishItem.remove();
                    wish_iks(dataUserId,dataProductId)
                    if ($('.wish-product .wish-item').length === 0) {
                        var wish_product_empty_text = `
                            <div style="font-size: xx-large;height: 100px;background-color: lightgreen;display: flex;align-items: center;justify-content: center;border-radius: 5px;" class="row border wish-item" data-product-id="" data-user-id="{{auth()->id() }}">
                                    sizin Istek sehifeniz hal hazirda bosdur
                            </div>`

                        $('.wish-product').append(wish_product_empty_text);
                    }
                }
            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            },
        });
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

    function wish_list_append(userId,productId){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/product/wish-list-append',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {
                userId:userId,
                productId:productId,
            },
            success:function (response){
                if (response.status === 200) {
                    $('.wish-product').empty();


                    $.each(response.wishes,function (index, wishes){
                        var html =`
                        <div  class="row border wish-item" data-product-id="${wishes.wish_product.id}" data-user-id="{{auth()->id()  }}">
                            <div class="col-xs-12 col-sm-2">
                                <div class="img-holder">
                                    <img src="{{ asset('${wishes.wish_product.path1}') }}" alt="image description">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <strong class="product-name">${wishes.wish_product.name}</strong>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <strong class="product-name">₼${wishes.wish_product.price}</strong>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                    <fieldset>
                                        <a  class="wish-add-to-card" style="margin-top: 15px;">Karta gonder</a>
                                    </fieldset>
                            </div>
                            <div class="col-xs-12 col-sm-1">
                                <a href="#"><i class="fa fa-close close-wish"></i></a>
                            </div>
                        </div>`;

                        $('.wish-product').append(html);
                    });

                }
            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            },
        })
    }
</script>
@endsection
