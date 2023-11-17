<!-- include jQuery-->

<script src="{{asset('frontend/js/jquery.js')}}"></script>
<!-- include jQuery -->
<script src="{{asset('frontend/js/plugins.js')}}"></script>
<!-- include jQuery -->
<script src="{{asset('frontend/js/jquery.main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    // Set the alert to automatically close after 5 seconds (5000 milliseconds)
    setTimeout(function() {
        $('#autoCloseAlert').hide();
    }, 5000);

    $(document).on('click','.icon-change',function (event){
        event.preventDefault();
        var $iconElement = $(this).find('i');
        var userId = $(this).attr("data-user-id");
        var productId = $(this).attr("data-product-id");
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if (userId === null || userId === "") {
            // Show the dynamic modal
            $(".aviso-login").show();

            // Hide and remove the dynamic modal after 3 seconds
            setTimeout(function () {
                $(".aviso").hide();
            }, 5000);
        }
        else{
            if($iconElement.hasClass('fa-regular fa-heart')) {
                var iconClass = 'fa-regular';
                $.ajax({
                    url: '/product/icon-change',
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    data: {
                        userId:userId,
                        productId:productId,
                        iconClass:iconClass,
                    },
                    success:function (response){

                        if (response.status === 200) {
                            if(response.active){
                                $(".aviso-in-cart").show();
                                setTimeout(function () {
                                    $(".aviso").hide();
                                }, 5000);
                            }
                            else{
                                $iconElement.removeClass('fa-regular fa-heart').addClass('fa-solid fa-heart');
                                wish_add_and_delete_single(userId);
                                updateLiClass(userId,productId,1);
                            }


                        }
                    },
                    error: function (xhr,status,error){
                        console.log("Error:", error);
                    },
                })
            }
            else{
                var iconClass = 'fa-solid';
                $.ajax({
                    url: '/product/icon-change',
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    data: {
                        userId: userId,
                        productId: productId,
                        iconClass:iconClass,

                    },
                    success: function (response) {
                        if (response.status === 200) {
                            // Toggle the icon classes
                            $iconElement.removeClass('fa-solid fa-heart').addClass('fa-regular fa-heart');
                            wish_add_and_delete_single(userId);
                            updateLiClass(userId,productId,0);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("Error:", error);
                    },
                });
            }

        }

    })

    $(document).on('click', '.add_to_card_single', function (event) {
        event.preventDefault();

        // Get the values of data-product-id and data-user-id
        var productId = $(this).attr('data-product-id');
        var userId = $(this).attr('data-user-id');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if (userId === null || userId === "") {
            // Show the dynamic modal
            $(".aviso-login").show();

            // Hide and remove the dynamic modal after 3 seconds
            setTimeout(function () {
                $(".aviso").hide();
            }, 5000);
        }
        else{
            card_list_add(userId,productId,csrfToken);
        }

    });

    $(document).on('click', '.cart_add_wishes',function (event){
        event.preventDefault();
        var userId = $(this).attr('data-user-id');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if (userId === null || userId === "") {
            // Show the dynamic modal
            $(".aviso-login").show();

            // Hide and remove the dynamic modal after 3 seconds
            setTimeout(function () {
                $(".aviso").hide();
            }, 5000);
        }
        else{
            wish_list_clear(userId, csrfToken);

        }
    });

    $(document).on('click','.wish-iks',function (event){
        event.preventDefault();
        var userId = $(this).attr("data-user-id");
        var productId = $(this).attr("data-product-id");
        if (userId === null || userId === "") {
            // Show the dynamic modal
            $(".aviso-login").show();

            // Hide and remove the dynamic modal after 3 seconds
            setTimeout(function () {
                $(".aviso").hide();
            }, 5000);
        }
        else {
            wish_iks(userId, productId);
            updateLiClass(userId,productId,0);
        }
    })

    $(document).on('click','.card-iks',function (event){
        event.preventDefault();
        var userId = $(this).attr("data-user-id");
        var productId = $(this).attr("data-product-id");
        if (userId === null || userId === "") {
            // Show the dynamic modal
            $(".aviso-login").show();

            // Hide and remove the dynamic modal after 3 seconds
            setTimeout(function () {
                $(".aviso").hide();
            }, 5000);
        }
        else {
            card_iks(userId, productId);
            updateLiClass(userId,productId,1);
            //bezi sehifelerde bu functioni bezi sehifelerde  ehtiyac yoxdur ona gore error verir!
            console.log(productId)
            card_product_delete(userId,productId);
        }
    })


    //arzular blokunun temizlenmesi
    function wish_list_clear(userId){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/product/wish-list-clear',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {
                userId:userId,
            },
            success:function (response){
                if (response.status === 200) {

                    var html = `<div class="cart-row card-body-wishes">
                                    <h3>istek siyahiniz hal hazirda bosdur</h3>
                                </div>
                                <div class="cart-row-total">
                                    <span class="mt-total">istek siyahisina bax</span>
                                    <span class="mt-total-txt"><a href="{{ route('frontend.user.wish') }}" class="btn-type2">Istek siyahisi</a></span>
                                </div>`;
                    var a_tag_html = `<a href="" class="process-btn" id="checkout-btn">PROCEED TO CHECKOUT <i class="fa fa-check"></i></a>`

                    //wish-list sehifesinde isteklerin olmadiqini gosterir
                    var wish_product_empty_text = `
                    <div style="font-size: xx-large;height: 100px;background-color: lightgreen;display: flex;align-items: center;justify-content: center;border-radius: 5px;" class="row border wish-item" data-product-id="" data-user-id="{{auth()->id() }}">
                            sizin Istek sehifeniz hal hazirda bosdur
                    </div>`
                    $('.wish-product').empty();
                    $('.wish-product').append(wish_product_empty_text);
                    $('.wishes_list').empty();
                    $('.wishes_list').append(html);
                    $('.wish_num').empty();
                    $('.wish_num').append(0);
                    $('.a-tag-visible').empty();
                    $('.a-tag-visible').append(a_tag_html)
                    cart_add_wishes_all(userId)
                    @if(request()->is('order-shopping-cart'))
                        cart_add_wishes_all_copy(userId);
                    @endif

                }
            },
            error: function (xhr,status,error){
                console.log("Error:", error);
            },
        })
    }
    //arzular blokuna tek elave
    function wish_add_and_delete_single(userId){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/product/wish-add-and-delete-single-list',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {
                userId:userId,
            },
            success:function (response){
                if (response.status === 200) {
                    $('.wishes_list').empty();
                    $('.wish_num').empty();
                    var wishesCount = response.wishesCount;
                    $('.wish_num').append(wishesCount);
                    var html2 = `<div class="cart-row-total">
                                    <span class="mt-total">Hamisini elave et</span>
                                    <span  class="mt-total-txt"><a href="#" data-user-id="{{auth()->id()}}" class="btn-type2 cart_add_wishes">Karta elave et</a></span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                <div class="cart-row-total">
                                    <span class="mt-total">istek siyahisina bax</span>
                                    <span class="mt-total-txt"><a href="{{ route('frontend.user.wish') }}" class="btn-type2">Istek siyahisi</a></span>
                                </div>`;
                    $.each(response.wishes,function (index, wishes){
                        var html1 = `
                            <div class="cart-row  card-body-wishes" id="wish-item-${wishes.wish_product.id}">
                                <a href="" class="img">
                                    <img width="74" height="74" src="{{ asset('${wishes.wish_product.path1}') }}" alt="image" class="img-responsive">
                                </a>
                                <div class="mt-h">
                                    <span class="mt-h-title"><a href="#">${wishes.wish_product.name}</a></span>
                                    <span class="price"><i class="fa fa-eur" aria-hidden="true"></i> ${wishes.wish_product.price}</span>
                                </div>
                                <a href="#" data-product-id="${wishes.wish_product.id}" data-user-id="{{auth()->id()}}" class="close fa fa-times wish-iks"></a>

                            </div>`;
                        $('.wishes_list').append(html1);
                    });
                    $('.wishes_list').append(html2);
                }
            },
            error: function (xhr,status,error){
                console.log("Error:", error);
            },
        })
    }
    //card blokuna tek elave
    function card_list_add(userId,productId){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/product/card-list-add',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {
                userId:userId,
                productId:productId,
            },
            success:function (response){
                if (response.status === 200) {
                    $('.card-wishes').empty();
                    var wishesTotalDiscount  = response.wishesTotalDiscount;
                    var wishesTotalPrice     = response.wishesTotalPrice;
                    var wishesCount          = response.wishesCount;
                    $('.cart_num').empty();
                    $('.cart_num').append(wishesCount);
                    var html2 = $(`
                        <div class="cart-row-total">
                            <span class="mt-total">Sub Total</span>
                            <span class="mt-total-txt  card-total-sum"><i class="fa fa-eur" aria-hidden="true"></i> ${wishesTotalPrice}</span>
                        </div>
                        <!-- cart row total end here -->
                        <div class="cart-btn-row">
                            <a href="{{ route('frontend.user.cart') }}" class="btn-type2">VIEW CART</a>
                            <a href="{{ route('frontend.user.cart_to_checkout')  }}" class="btn-type3">CHECKOUT</a>
                        </div>
                        `);
                    $.each(response.wishes_to_card,function (index, wishes){

                        var html1 = `
                            <div class="cart-row  cart-wishes" id="card-item-${wishes.wish_product.id}">
                                <a href="" class="img">
                                    <img width="74" height="74" src="{{ asset('${wishes.wish_product.path1}') }}" alt="image" class="img-responsive">
                                </a>
                                <div class="mt-h">
                                    <span class="mt-h-title"><a href="#">${wishes.wish_product.name}</a></span>
                                    <span class="price"><i class="fa fa-eur" aria-hidden="true"></i> ${wishes.wish_product.price}</span>
                                </div>
                                <a href="#" data-product-id="${wishes.wish_product.id}" data-user-id="{{auth()->id()}}" class="close fa fa-times card-iks"></a>
                                <span class="mt-h-title">Qty: 1</span>
                                </div>
                            `;

                        $('.card-wishes').append(html1);
                    });

                    $('.card-wishes').append(html2);
                    wish_list_refresh(userId);
                }
                if (response.status === 900){
                    $(".aviso-exist-cart").show();

                    // Hide and remove the dynamic modal after 3 seconds
                    setTimeout(function () {
                        $(".aviso-exist-cart").hide();
                    }, 5000);
                }
            },
            error: function (xhr,status,error){
                console.log("Error:", error);
            },
        })
    }
    //card blokuna toplu elave
    function cart_add_wishes_all(userId){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/product/cart-add-wishes-all',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {
                userId:userId,
            },
            success:function (response){
                if (response.status === 200) {
                    $('.card-wishes').empty();
                    var wishesTotalDiscount  = response.wishesTotalDiscount;
                    var wishesTotalPrice     = response.wishesTotalPrice;
                    var wishesCount          = response.wishesCount;
                    $('.cart_num').empty();
                    $('.cart_num').append(wishesCount);
                    console.log('first');
                    var html2 = $(`
                        <div class="cart-row-total">
                            <span class="mt-total">Sub Total</span>
                            <span class="mt-total-txt  card-total-sum"><i class="fa fa-eur" aria-hidden="true"></i> ${wishesTotalPrice}</span>
                        </div>
                        <!-- cart row total end here -->
                        <div class="cart-btn-row">
                            <a href="{{ route('frontend.user.cart') }}" class="btn-type2">VIEW CART</a>
                            <a href="{{ route('frontend.user.cart_to_checkout')  }}" class="btn-type3">CHECKOUT</a>
                        </div>
                        `);
                    $.each(response.cart_all_data,function (index, wishes){

                        var html1 = `
                            <div class="cart-row  cart-wishes" id="card-item-${wishes.wish_product.id}">
                                <a href="" class="img">
                                    <img width="74" height="74" src="{{ asset('${wishes.wish_product.path1}') }}" alt="image" class="img-responsive">
                                </a>
                                <div class="mt-h">
                                    <span class="mt-h-title"><a href="#">${wishes.wish_product.name}</a></span>
                                    <span class="price"><i class="fa fa-eur" aria-hidden="true"></i> ${wishes.wish_product.price}</span>
                                </div>
                                <a href="#" data-product-id="${wishes.wish_product.id}" data-user-id="{{auth()->id()}}" class="close fa fa-times card-iks"></a>
                                <span class="mt-h-title">Qty: 1</span>
                                </div>
                            `;

                        $('.card-wishes').append(html1);
                    });

                    $('.card-wishes').append(html2);
                }
            },
            error: function (xhr,status,error){
                console.log("Error:", error);
            },
        })
    }
    //wish blokunda iks ile silinme
    function wish_iks(userId,productId){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        console.log(userId);
        console.log(productId);
        $.ajax({
            url: '/product/wish-iks',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {
                userId:userId,
                productId:productId,
            },
            success:function (response){
                if (response.status === 200) {

                    var cartItemId = 'wish-item-' + productId;
                    console.log("Attempting to remove:", cartItemId);
                    $('#' + cartItemId).remove();
                    console.log('#' + cartItemId);
                    $('.wish_num').empty();
                    var wishesCount = response.wishesCount;
                    $('.wish_num').append(wishesCount);
                }
            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            },
        })
    }
    //card blokunda iks ile silinme
    function card_iks(userId,productId){

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        console.log(userId);
        console.log(productId);
        $.ajax({
            url: '/product/card-iks',
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

                    $('.card-total-sum').empty();
                    $('.card-total-sum').append(wishesTotalPrice);
                    wish_list_append(userId,productId);
                    wish_add_and_delete_single(userId);
                }
            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            },
        })
    }
    //butun urekleri deyisir
    function updateLiClass(userId, productId, isWished) {
        var $liElement = $('li[data-user-id="' + userId + '"][data-product-id="' + productId + '"]');
        var $iconElement = $liElement.find('i');

        if (isWished) {
            $iconElement.removeClass('fa-regular fa-heart').addClass('fa-solid fa-heart');
            $(".aviso-success").show();
            setTimeout(function () {
                    $(".aviso").hide();
                }, 5000);
        } else {
            $iconElement.removeClass('fa-solid fa-heart').addClass('fa-regular fa-heart');
            $(".aviso-delete").show();
            setTimeout(function () {
                $(".aviso").hide();
            }, 5000);
        }
    }
    //arzular blokunun yenilenmesi
    function wish_list_refresh(userId){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/product/wish-list-refresh',
            method: "POST",
            headers: {'X-CSRF-TOKEN': csrfToken},
            data: {
                userId:userId,
            },
            success:function (response){
                if (response.status === 200) {

                    $('.wishes_list').empty();
                    $('.wish_num').empty();
                    var wishesCount = response.wishesCount;
                    $('.wish_num').append(wishesCount);

                    var html2 = `<div class="cart-row-total">
                                    <span class="mt-total">Hamisini elave et</span>
                                    <span  class="mt-total-txt"><a href="#" data-user-id="{{auth()->id()}}" class="btn-type2 cart_add_wishes">Karta elave et</a></span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                <div class="cart-row-total">
                                    <span class="mt-total">istek siyahisina bax</span>
                                    <span class="mt-total-txt"><a href="{{ route('frontend.user.wish') }}" class="btn-type2">Istek siyahisi</a></span>
                                </div>`;
                    $.each(response.wishes,function (index, wishes){
                        var html1 = `
                            <div class="cart-row  card-body-wishes" id="wish-item-${wishes.wish_product.id}">
                                <a href="" class="img">
                                    <img width="74" height="74" src="{{ asset('${wishes.wish_product.path1}') }}" alt="image" class="img-responsive">
                                </a>
                                <div class="mt-h">
                                    <span class="mt-h-title"><a href="#">${wishes.wish_product.name}</a></span>
                                    <span class="price"><i class="fa fa-eur" aria-hidden="true"></i> ${wishes.wish_product.price}</span>
                                </div>
                                <a href="#" data-product-id="${wishes.wish_product.id}" data-user-id="{{auth()->id()}}" class="close fa fa-times wish-iks"></a>
                            </div>`;
                        $('.wishes_list').append(html1);
                    });
                    $('.wishes_list').append(html2);
                }
                if (response.status === 909){
                    $('.wishes_list').empty();
                    $('.wish_num').empty();
                    var wishesCount = response.wishesCount;
                    $('.wish_num').append(wishesCount);
                    console.log('asdasdasd')
                    var html1 = `<div class="cart-row card-body-wishes">
                        <h3>istek siyahiniz hal hazirda bosdur</h3>
                    </div>
                    <div class="cart-row-total">
                        <span class="mt-total">istek siyahisina bax</span>
                        <span class="mt-total-txt"><a href="{{ route('frontend.user.wish') }}" class="btn-type2">Istek siyahisi</a></span>
                    </div>`
                    $('.wishes_list').append(html1);
                }

            },
            error: function (xhr,status,error){
                console.log("Error:", error);
            },
        })
    }

    function in_cart(active){
        if(active){
            $(".aviso-in-cart").show();
            setTimeout(function () {
                $(".aviso").hide();
            }, 5000);
            return 1;
        }
        else{
            return 0;
        }
    }
    //WISHLIST SEHIFESININ ICINDEN COPY GOTURMUSEM 2 DENEDIR BUNDAN
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

