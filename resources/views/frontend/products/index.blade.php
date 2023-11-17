@extends('layouts.frontend')
@section('title',strtoupper($sub_category->category_name))
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
    <link rel="icon" href="{{ asset($category->image) }}" type="image/x-icon">
    <!--jQuery-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?php
    /*mb_substr(mb_substr(strip_tags($product->description),0,220),0,mb_strrpos(mb_substr(strip_tags($product->description),0,220),' '))*/
    function truncateCKEditorContent($content, $length) {
        // Remove any existing PHP or HTML tags to prevent broken HTML
        $text = strip_tags($content);

        // Check if the text needs truncation
        if (mb_strlen($text) <= $length) {
            return $content;
        }

        // Truncate the text
        $truncatedText = mb_substr($text, 0, $length);

        // Find the last space in the truncated text to avoid cutting off words
        $lastSpacePos = mb_strrpos($truncatedText, ' ');

        // Append "..." if the text was truncated, else use the original content
        $finalText = $lastSpacePos !== false ? mb_substr($truncatedText, 0, $lastSpacePos) . '...' : $content;

        return $finalText;
    }
    ?>
@endsection
@section('content')
    @include('frontend.components.search')
    <main id="mt-main">
        <!-- Mt Contact Banner of the Page -->

        <section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{asset($sub_category->image)}}); background-repeat: no-repeat;background-size: inherit;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>{{ strtoupper($sub_category->category_name) }}</h1>
                        <!-- Breadcrumbs of the Page -->
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{route('frontend.index')}}">Home <i class="fa fa-angle-right"></i></a></li>
                                <li><a href="{{ route('frontend.product.index', ['level1'=>$category->slug]) }}">{{$category->category_name}} <i class="fa fa-angle-right"></i></a></li>
                                <li>{{ $sub_category->category_name }}</li>
                            </ul>
                        </nav><!-- Breadcrumbs of the Page end -->
                    </div>
                </div>
            </div>
        </section><!-- Mt Contact Banner of the Page end -->
        <div class="container">
            <div class="row">
                <!-- sidebar of the Page start here -->
                <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
                    <!-- shop-widget filter-widget of the Page start here -->
                    <section style="padding: 36px 17px 48px 11px; " class="shop-widget filter-widget bg-grey">
                        <h2>FILTER</h2>
                        {{--<span class="sub-title">Filter by Brands</span>--}}
                        <!-- nice-form start here -->
                       {{-- <ul class="list-unstyled nice-form">
                            <li>
                                <label for="check-1">
                                    <input id="check-1" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Casali</span>
                                </label>
                                <span class="num">2</span>
                            </li>
                            <li>
                                <label for="check-2">
                                    <input id="check-2" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Decar</span>
                                </label>
                                <span class="num">12</span>
                            </li>
                            <li>
                                <label for="check-3">
                                    <input id="check-3" checked="checked" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Fantini</span>
                                </label>
                                <span class="num">4</span>
                            </li>
                            <li>
                                <label for="check-4">
                                    <input id="check-4" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Flamentstyle</span>
                                </label>
                                <span class="num">4</span>
                            </li>
                            <li>
                                <label for="check-5">
                                    <input id="check-5" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Heerenhuis</span>
                                </label>
                                <span class="num">6</span>
                            </li>
                            <li>
                                <label for="check-6">
                                    <input id="check-6" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Hoffmann</span>
                                </label>
                                <span class="num">10</span>
                            </li>
                            <li>
                                <label for="check-7">
                                    <input id="check-7" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Italfloor</span>
                                </label>
                                <span class="num">3</span>
                            </li>
                        </ul>--}}<!-- nice-form end here -->
                        <span class="sub-title">Filter by Price</span>
                        <div class="price-range" style="overflow: inherit;">

                            <input type="text" class="js-range-slider" name="my_range" value="" />

                            <a id="sendDataBtn" class="filter-btn mt-1">Filter</a>
                        </div>
                    </section><!-- shop-widget filter-widget of the Page end here -->
                    <!-- shop-widget of the Page start here -->
                    <section class="shop-widget">
                        <h2>KATEQORIYALAR</h2>
                        <!-- category list start here -->
                        <ul class="list-unstyled category-list">
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('frontend.product.index', ['level1'=>$cat->slug, 'level2'=>$cat->sub_categories->first()->slug]) }}">
                                        <span class="name">{{$cat->category_name}}</span>
                                        <span class="num">{{ $cat->products->count() }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul><!-- category list end here -->
                    </section><!-- shop-widget of the Page end here -->
                    <!-- shop-widget of the Page start here -->
                    <div class="mt-smallproducts">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm wow fadeInLeft" data-wow-delay="0.4s">
                                    <h3 class="heading">İsti satışlar</h3>
                                    @foreach($products_for_banner as $product)
                                            @if($product->product_details->contains('hot_sale_items', 1) && $loop->iteration <= 4)
                                                <!-- Display the product information here -->
                                                <!-- mt product4 start here -->
                                                <div class="mt-product4 mt-paddingbottom20">
                                                    <div class="img">
                                                        <a href="{{ route('frontend.product.index', ['level1'=>$category->slug, 'level2'=>$sub_category->slug, 'level3'=>$product->slug]) }}"><img alt="image description" src="{{ asset($product->path1) }}"></a>
                                                    </div>
                                                    <div class="text">
                                                        <div class="frame">
                                                            <strong><a href="{{ route('frontend.product.index', ['level1'=>$category->slug, 'level2'=>$sub_category->slug, 'level3'=>$product->slug]) }}">{{ $product->name }}</a></strong>
                                                            <ul class="mt-stars">
                                                                @for($i=1;$i<=5;$i++)
                                                                    <li class="{{ $i <= $product->stars ? 'active' : '' }}"><a href="#"><i class="fa {{ $i <= $product->stars ? 'fa-star' : 'fa-star-o' }}"></i></a></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                        <del class="off">{{ $product->price }}</del>
                                                        <span class="price">{{ $product->discount_price }} ₼</span>
                                                    </div>
                                                </div><!-- mt product4 end here -->
                                                <!-- Add other product details you want to display -->
                                            @endif
                                        @endforeach
                                    <!-- mt product4 start here -->
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm wow fadeInLeft" data-wow-delay="0.4s">
                                    <h3 class="heading">Seçilmişlər</h3>
                                    <!-- mt product4 start here -->
                                    @foreach($products_for_banner as $product)
                                        @if($product->product_details->contains('feature_items', 1) && $loop->iteration <= 4)
                                            <!-- Display the product information here -->
                                            <!-- mt product4 start here -->
                                            <div class="mt-product4 mt-paddingbottom20">
                                                <div class="img">
                                                    <a href="{{ route('frontend.product.index', ['level1'=>$category->slug, 'level2'=>$sub_category->slug, 'level3'=>$product->slug]) }}"><img alt="image description" src="{{ asset($product->path1) }}"></a>
                                                </div>
                                                <div class="text">
                                                    <div class="frame">
                                                        <strong><a href="{{ route('frontend.product.index', ['level1'=>$category->slug, 'level2'=>$sub_category->slug, 'level3'=>$product->slug]) }}">{{ $product->name }}</a></strong>
                                                        <ul class="mt-stars">
                                                            @for($i=1;$i<=5;$i++)
                                                                <li class="{{ $i <= $product->stars ? 'active' : '' }}"><a href="#"><i class="fa {{ $i <= $product->stars ? 'fa-star' : 'fa-star-o' }}"></i></a></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                    <del class="off">{{ $product->price }}</del>
                                                    <span class="price">{{ $product->discount_price }} ₼</span>
                                                </div>
                                            </div><!-- mt product4 end here -->
                                            <!-- Add other product details you want to display -->
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs wow fadeInRight" data-wow-delay="0.4s">
                                    <h3 class="heading">Satış Məhsulları</h3>
                                    <!-- mt product4 start here -->
                                    @foreach($products_for_banner as $product)
                                        @if($product->product_details->contains('slider', 1) && $loop->iteration <= 4)

                                            <div class="mt-product4 mt-paddingbottom20">
                                                <div class="img">
                                                    <a href="{{ route('frontend.product.index', ['level1'=>$category->slug, 'level2'=>$sub_category->slug, 'level3'=>$product->slug]) }}"><img alt="image description" src="{{ asset($product->path1) }}"></a>
                                                </div>
                                                <div class="text">
                                                    <div class="frame">
                                                        <strong><a href="{{ route('frontend.product.index', ['level1'=>$category->slug, 'level2'=>$sub_category->slug, 'level3'=>$product->slug]) }}">{{ $product->name }}</a></strong>
                                                        <ul class="mt-stars">
                                                            @for($i=1;$i<=5;$i++)
                                                                <li class="{{ $i <= $product->stars ? 'active' : '' }}"><a href="#"><i class="fa {{ $i <= $product->stars ? 'fa-star' : 'fa-star-o' }}"></i></a></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                    <del class="off">{{ $product->price }}</del>
                                                    <span class="price">{{ $product->discount_price }} ₼</span>
                                                </div>
                                            </div><!-- mt product4 end here -->
                                            <!-- Add other product details you want to display -->
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3 wow fadeInRight" data-wow-delay="0.4s">
                                    <h3 class="heading">yüksək qiymətlənənlər</h3>
                                    <!-- mt product4 start here -->
                                    @foreach($products_for_banner as $product)
                                        @if($product->product_details->contains('discount_items', 1) && $loop->iteration <= 4)
                                            <!-- Display the product information here -->
                                            <!-- mt product4 start here -->
                                            <div class="mt-product4 mt-paddingbottom20">
                                                <div class="img">
                                                    <a href="{{ route('frontend.product.index', ['level1'=>$category->slug, 'level2'=>$sub_category->slug, 'level3'=>$product->slug]) }}"><img alt="image description" src="{{ asset($product->path1) }}"></a>
                                                </div>
                                                <div class="text">
                                                    <div class="frame">
                                                        <strong><a href="{{ route('frontend.product.index', ['level1'=>$category->slug, 'level2'=>$sub_category->slug, 'level3'=>$product->slug]) }}">{{ $product->name }}</a></strong>
                                                        <ul class="mt-stars">
                                                            @for($i=1;$i<=5;$i++)
                                                                <li class="{{ $i <= $product->stars ? 'active' : '' }}"><a href="#"><i class="fa {{ $i <= $product->stars ? 'fa-star' : 'fa-star-o' }}"></i></a></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                    <del class="off">{{ $product->price }}</del>
                                                    <span class="price">{{ $product->discount_price }} ₼</span>
                                                </div>
                                            </div><!-- mt product4 end here -->
                                            <!-- Add other product details you want to display -->
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div><!-- shop-widget of the Page end here -->
                </aside><!-- sidebar of the Page end here -->
                <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">
                    <!-- mt shoplist header start here -->
                    <header class="mt-shoplist-header">
                        <!-- btn-box start here -->
                        <div class="btn-box">
                            <ul class="list-inline">
                                <li>
                                    <a href="#" class="drop-link">
                                        Çeşidləmə <i aria-hidden="true" class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="drop">
                                        <ul class="list-unstyled">
                                            <li><a class="ajax-link" href="#" data-url="/product/sort" data-sort-option="asc">A - Z ardicilliqi</a></li>
                                            <li><a class="ajax-link" href="#" data-url="/product/sort" data-sort-option="dsc">Z - A ardicilliqi</a></li>
                                            <li><a class="ajax-link" href="#" data-url="/product/sort" data-sort-option="price-asc">qiymete gore ucuz</a></li>
                                            <li><a class="ajax-link" href="#" data-url="/product/sort" data-sort-option="price-dsc">qiymete gore bahali</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- btn-box end here -->
                        <!-- mt-textbox start here -->
                        <div class="mt-textbox">

                            <p>Showing  <strong>1–{{ count($products)==0?'':$products->links()->paginator->perPage() }}</strong> of  <strong>{{ count($products)==0?'':$products->links()->paginator->total() }}</strong> results</p>
                            <p>View   <a href="#">9</a> / <a href="#">18</a> / <a href="#">27</a> / <a href="#">All</a></p>
                        </div><!-- mt-textbox end here -->
                    </header><!-- mt shoplist header end here -->

                    <div class="range-product">
                        @if(count($products)>0)
                            @foreach($products as $product)
                                <div class="product-post">
                                    <div class="img-holder">
                                        <img src="{{ asset($product->path1) }}" alt="image description">
                                    </div>
                                    <div class="txt-holder">
                                        <div class="align-left">
                                            <strong class="title"><a href="{{ route('frontend.product.index', ['level1'=>$category->slug,'level2'=>$sub_category->slug,'level3'=>$product->slug,]) }}">{{ $product->name }}</a></strong>

                                            <span class="price">
                                        @if($product->discount_price==null)

                                                    ₼  {{ $product->price }}
                                                @else
                                                    <del class="off" style="color: #a29696;">
                                                ₼ {{ $product->price }}
                                            </del>&nbsp;&nbsp;&nbsp;&#8594; &nbsp;
                                                    ₼  {{ $product->discount_price }}
                                                @endif

                                    </span>
                                            <p > {!! mb_substr(mb_substr(strip_tags($product->description), 0, 220),0,mb_strrpos(mb_substr(strip_tags($product->description), 0, 220), ' ')); !!}...  </p>
                                        </div>
                                        <div class="align-right">
                                            <ul class="list-unstyled rating-list">
                                                @for($i=1;$i<=5;$i++)
                                                    <li class="{{ $i <= $product->stars ? 'active' : '' }}"><a href="#"><i class="fa {{ $i <= $product->stars ? 'fa-star' : 'fa-star-o' }}"></i></a></li>
                                                @endfor
                                                <li>Reviews (12)</li>
                                            </ul>
                                            <a href="#" data-user-id="{{ auth()->id() }}" data-product-id="{{ $product->id }}" class="btn-cart add_to_card_single">ADD TO CART</a>

                                            <ul class="list-unstyled nav">

                                                <li data-user-id="{{ auth()->id() }}" data-product-id="{{ $product->id }}" class="icon-change">
                                                    <a href="#">
                                                        <i class="{{ $product->userWishList(auth()->id(), $product->id) == true ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}" style="color: #e52a3c;"></i>ADD TO WISHLIST
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fa fa-exchange"></i> COMPARE
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                <!-- mt pagination start here -->
                                <nav class="mt-pagination">
                                    <ul class="list-inline">
                                        @if ($products->onFirstPage())
                                            <li class="disabled"><span>&laquo;</span></li>
                                        @else
                                            <li><a href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                                        @endif

                                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                                            <li {{ $i == $products->currentPage() ? "class=active style=background-color:red " : '' }}">
                                                <a href="{{ $products->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        @if ($products->hasMorePages())
                                            <li><a href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a></li>
                                        @else
                                            <li class="disabled"><span>&raquo;</span></li>
                                        @endif
                                    </ul>
                                </nav><!--mt pagination end here -->



                        @else
                            <h1>hal hazırda bu tip üzrə heç bir məhsul yoxdur</h1>
                        @endif

                    </div>



                </div>
            </div>
        </div>
    </main><!-- mt main end here -->
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>
        $(".js-range-slider").ionRangeSlider({
            type: "double",
            min: 0,
            max: 10000,
            from: 200,
            to: 500,
            grid: true,
        });

        function sendData(fromValue,toValue,product_sub_category_id,product_category_id){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            console.log(product_sub_category_id);
            $.ajax({
                url: '/product/range',
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    from:fromValue,
                    to:toValue,
                    product_sub_category_id:product_sub_category_id,
                    product_category_id:product_category_id,
                },

                success:function (response){
                    if (response.status === 200) {
                        var products = response.products;
                        $('.range-product').empty();
                        if (response.products.length === 0){
                             var empty_value = `<div style="display: flex;flex-direction: column;align-items: center;">
                                                    <h1 >bu axtarışa uyğun məhsul yoxdur</h1>
                                                    <img  style="width: 24% " height="150" src="https://media.tenor.com/4pm5MYEoWh0AAAAd/jim-carrey-unfortunately.gif" alt="kasibciliq">
                                                </div>`
                            $('.range-product').append(empty_value);
                        }
                        $.each(response.products.data,function (index, product){
                            console.log(product)
                            var productDescription = product.description==null ? product.description.substring(0, 220) : 'elave detallar ucun daxil olun';
                            var html = `
                            <div class="product-post">
                                    <div class="img-holder">
                                        <img src="{{ asset('${product.path1}') }}" alt="image description">
                                    </div>
                                    <div class="txt-holder">
                                        <div class="align-left">
                                            <strong class="title"><a href="${product.category_slug}/${product.slug}">${product.name}</a></strong>
                                            <span class="price">
                                                ${product.discount_price == null ?
                                                `₼  ${product.price}` :
                                                `₼  ${product.price}&nbsp;&nbsp;&nbsp;&#8594; &nbsp;₼  ${product.discount_price}`}
                                            </span>
                                            <p>${productDescription}...</p>
                                        </div>
                                        <div class="align-right">
                                            <ul class="list-unstyled rating-list">
                                                ${getRatingStars(product.stars)}
                                                <li>Reviews (12)</li>
                                            </ul>
                                            <a href="#" class="btn-cart">ADD TO CART</a>
                                            <ul class="list-unstyled nav">
                                                <li><a href="#"><i class="fa fa-heart"></i> ADD TO WISHLIST</a></li>
                                                <li><a href="#"><i class="fa fa-exchange"></i> COMPARE</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>`;
                            $('.range-product').append(html);
                        });
                        var pagination = `
                                <nav class="mt-pagination">
                                    <ul class="list-inline">
                                        ${Array.from({ length: response.lastPage }, (_, i) => `
                                            <li class="${i + 1 === response.currentPage ? 'active' : ''}">
                                                <a href="${response.sub_category_name.slug}?page=${i + 1}" data-page="${i + 1}">${i + 1}</a>
                                            </li>
                                        `).join('')}
                                    </ul>
                                </nav>`;
                        $('.range-product').append(pagination)
                    }

                },

                error: function (xhr,status,error){
                    console.log("Error:", error);
                },
            })
        }

        $("#sendDataBtn").on('click', function (){
            let my_range = $(".js-range-slider").data("ionRangeSlider");
            var fromValue = my_range.result.from;
            var toValue = my_range.result.to;
            var product_sub_category_id = <?=$sub_category->id?>;
            var product_category_id  = <?=$category->id?>;
            sendData(fromValue, toValue,product_sub_category_id,product_category_id);
        });

        function getRatingStars(stars) {
            var ratingHTML = '';
            for (var i = 1; i <= 5; i++) {
                ratingHTML += `<li class="${i <= stars ? 'active' : ''}"><a href="#"><i class="fa ${i <= stars ? 'fa-star' : 'fa-star-o'}"></i></a></li>`;
            }
            return ratingHTML;
        }

        $(document).on('click', '.ajax-link', function (event) {
            event.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var url = $(this).data('url'); // Get the URL from the data-url attribute
            var sortOption = $(this).data('sort-option'); // Get the sorting option from the data-sort-option attribute
            console.log(url);
            console.log(sortOption);

            $.ajax({
                url: url, // Use the URL from the data-url attribute
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    sort_option: sortOption, // Send the sorting option
                    category_id: {{ $category->id }},
                    sub_category_id : {{ $sub_category->id }}
                },
                success: function (data) {
                    $('.range-product').empty();
                    if (data.products.data.length === 0) {
                        var h1 =`<h1>hal hazirda bu tip uzre hec bir mebel yoxdur</h1>`;
                        $('.range-product').append(h1);
                    }
                    else{


                        $.each(data.products.data, function (index, value) {


                            var isWishlisted = data.product_is_wish.includes(value.id);

                            // Determine the class based on whether the product is wishlisted
                            var heartClass = isWishlisted ? 'fa-solid fa-heart' : 'fa-regular fa-heart';

                            // Create the HTML for the wishlist icon
                            var wishlistIcon = `<i class="${heartClass}" style="color: #e52a3c;"></i>ADD TO WISHLIST`;

                            var productImagePath = value.path1; // You need to set the correct image path here
                            var productRoute = `/${value.category.slug}/${value.sub_category.slug}/${value.slug}`; // You need to set the correct route here

                            var productDescription = value.description ? value.description.substring(0, 220) : 'elave detallar ucun daxil olun';
                            console.log(value.description)
                            var html = `
                                <div class="product-post">
                                    <div class="img-holder">
                                        <img src="{{asset('${productImagePath}')}}" alt="image description">
                                    </div>
                                    <div class="txt-holder">
                                        <div class="align-left">
                                            <strong class="title">
                                                <a href="${productRoute}">${value.name}</a>
                                            </strong>
                                            <span class="price">
                                                ${value.discount_price == null ? `₼ ${value.price}` : `
                                                    <del class="off" style="color: #a29696;">
                                                        ₼ ${value.price}
                                                    </del>&nbsp;&nbsp;&nbsp;&#8594; &nbsp;
                                                    ₼ ${value.discount_price}`}
                                            </span>
                                            <p>${productDescription}...</p>
                                        </div>
                                        <div class="align-right">
                                            <ul class="list-unstyled rating-list">
                                                ${Array.from({ length: 5 }, (_, i) => `
                                                    <li class="${i < value.stars ? 'active' : ''}">
                                                        <a href="#"><i class="fa ${i < value.stars ? 'fa-star' : 'fa-star-o'}"></i></a>
                                                    </li>`).join('')}
                                                <li>Reviews (12)</li>
                                            </ul>
                                            <a href="#" data-user-id="{{ auth()->id()==true?auth()->id():null }}" data-product-id="${value.id}" class="btn-cart add_to_cart_single">ADD TO CART</a>
                                            <ul class="list-unstyled nav">
                                                <li data-user-id="{{ auth()->id() }}" data-product-id="${value.id}" class="icon-change">
                                                    <a href="#">
                                                        ${wishlistIcon}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="fa fa-exchange"></i> COMPARE</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>`;

                            $('.range-product').append(html);
                        });
                        var pagination = `
                                <nav class="mt-pagination">
                                    <ul class="list-inline">
                                        ${Array.from({ length: data.lastPage }, (_, i) => `
                                            <li class="${i + 1 === data.currentPage ? 'active' : ''}">
                                                <a href="${data.sub_category_name}?page=${i + 1}" data-page="${i + 1}">${i + 1}</a>
                                            </li>
                                        `).join('')}
                                    </ul>
                                </nav>`;

                        $('.range-product').append(pagination)
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors here
                }
            });
        });
    </script>
@endsection
