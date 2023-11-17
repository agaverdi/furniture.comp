@extends('layouts.frontend')
@section('title', 'Home')

@section('styles')
    <link rel="icon" type="image/x-icon" href="{{ asset('\frontend\pages\icons\home.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/carousel.css') }}">

@endsection

@section('content')
    @include('frontend.components.search')
    <!-- mt search popup end here -->
    <!-- mt main slider start here -->
    <div class="mt-main-slider">
        <!-- slider banner-slider start here -->
        <div class="slider banner-slider">
            @foreach($categories as $category)
                <div class="holder text-center" style="background-image: url({{$category->image}});">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="text centerize">
                                    <strong class="title">Mebel dəstləri</strong>
                                    <h1 style="color: #823030;">{{ $category->category->category_name }} </h1>
                                    <h2 style="color: #ffffff;">{{$category->category_name}}</h2>

                                    <a  style="color: #ffffff;" href="{{ route('frontend.product.index', ['level1'=>$category->category->slug, 'level2'=>$category->slug]) }}" class="shop">shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
    <main id="mt-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- banner frame start here -->
                    @include('frontend.banners.top_banner_home')
                    <!-- banner frame end here -->
                    <div  class="slider banner-slider">
                        <div  class="container">

                            <div  class="container container-carousel">
                                <div class="hs__wrapper">
                                    <div class="hs__header">
                                        <h2 class="hs__headline">Xüsusi Seçilənlər
                                        </h2>
                                        <div class="hs__arrows"><a style="color: gray" class="arrow disabled arrow-prev"></a><a style="color: gray" class="arrow arrow-next"></a></div>
                                    </div>
                                    <ul class="hs">
                                        @foreach($products as $product)
                                            @if($product->product_details->contains('feature_items', 1) )
                                                <li class="hs__item" style="border-radius: 10px;padding: 4px;background-color: #b19d85;">
                                                    <a style="width: 100%" href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">
                                                        <div class="hs__item__image__wrapper">
                                                            <img class="hs__item__image" style="border-radius: 10px;" src="{{ asset($product->path1) }}" alt=""/>
                                                        </div>
                                                    </a>
                                                    <a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">
                                                        <div class="hs__item__description">
                                                            <span class="hs__item__title">{{ $product->name }}</span>
                                                            <span class="hs__item__subtitle">{{$product->subCategory->slug }}</span>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="hs__wrapper">
                                    <div class="hs__header">
                                        <h2 class="hs__headline">Ən son yenilər
                                        </h2>
                                        <div class="hs__arrows"><a style="color: gray" class="arrow disabled arrow-prev"></a><a style="color: gray" class="arrow arrow-next"></a></div>
                                    </div>
                                    <ul class="hs">
                                        @foreach($products as $product)
                                            @if($product->product_details->contains('new_items', 1) )
                                                <li class="hs__item" style="border-radius: 10px;padding: 4px;background-color: #b19d85;">
                                                <a style="width: 100%" href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">
                                                    <div class="hs__item__image__wrapper">
                                                        <img class="hs__item__image" style="border-radius: 10px;" src="{{ asset($product->path1)==null?asset($product->path2):asset($product->path1) }}" alt=""/>
                                                    </div>
                                                </a>
                                                <a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">
                                                    <div class="hs__item__description">
                                                        <span class="hs__item__title">{{ $product->name }}</span>
                                                        <span class="hs__item__subtitle">{{$product->subCategory->slug }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                            @endif
                                        @endforeach


                                    </ul>
                                </div>
                                <div class="hs__wrapper">
                                    <div class="hs__header">
                                        <h2 class="hs__headline">Ən çox satanlar
                                        </h2>
                                        <div class="hs__arrows"><a style="color: gray" class="arrow disabled arrow-prev"></a><a style="color: gray" class="arrow arrow-next"></a></div>
                                    </div>
                                    <ul class="hs">
                                        @foreach($products as $product)
                                            @if($product->product_details->contains('hot_sale_items', 1) )
                                                <li class="hs__item" style="border-radius: 10px;padding: 4px;background-color: #b19d85;">
                                                    <a style="width: 100%" href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">
                                                        <div class="hs__item__image__wrapper">
                                                            <img class="hs__item__image" style="border-radius: 10px;" src="{{ asset($product->path1)==null?asset($product->path2):asset($product->path1) }}" alt=""/>
                                                        </div>
                                                    </a>
                                                    <a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">
                                                        <div class="hs__item__description">
                                                            <span class="hs__item__title">{{ $product->name }}</span>
                                                            <span class="hs__item__subtitle">{{$product->subCategory->slug }}</span>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- mt producttabs start here -->
                    <div class="mt-producttabs wow fadeInUp" data-wow-delay="0.4s">
                        <!-- producttabs start here -->

                        <!-- producttabs end here -->

                    </div>
                    <!-- mt producttabs end here -->
                </div>
            </div>
        </div>
        <!-- mt bestseller start here -->
        <div class="mt-bestseller bg-grey text-center wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 mt-heading text-uppercase">
                        <h2 class="heading">ən çox satılan məhsullarr</h2>
                        <p>EXCEPTEUR SINT OCCAECAT</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bestseller-slider">
                        @foreach($products as $product)
                            @if($product->product_details->contains('hot_sale_items', 1))
                            <div class="slide">
                                <!-- mt product1 center start here -->
                                <div class="mt-product1 large">
                                    <div class="box">
                                        <div class="b1">
                                            <div class="b2">
                                                <a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">
                                                    <img style="width: 215px;height: 215px;" src="{{asset($product->path1)}}" alt="image description"></a>
                                                <span class="caption">
															<span class="best-price">Best Price</span>
														</span>
                                                <ul class="links add">
                                                    <li><a href="#"><i class="icon-handbag"></i></a></li>
                                                    <li data-user-id="{{ auth()->id() }}" data-product-id="{{ $product->id }}" class="icon-change">
                                                        <a href="#">
                                                            <i class="{{ $product->userWishList(auth()->id(), $product->id) == true ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}" style="color: #e52a3c;"></i>                                                        </a>
                                                    </li>
                                                    <li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="txt">
                                        <strong class="title"><a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">{{ $product->name }}</a></strong>
                                        <span class="price"><span>{{ $product->discount_price == null ? $product->price : $product->discount_price }} ₼</span></span>
                                    </div>
                                </div><!-- mt product1 center end here -->
                            </div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mt bestseller start here -->
        <div class="mt-smallproducts wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">

                    <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
                        <h3 class="heading">Hot Sale</h3>
                        @foreach($hotSaleProducts as $product)


                                <!-- Display the product information here -->
                                <!-- mt product4 start here -->
                                <div class="mt-product4 mt-paddingbottom20">
                                    <div class="img">
                                        <a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}"><img alt="image description" src="{{ asset($product->path1) }}"></a>
                                    </div>
                                    <div class="text">
                                        <div class="frame">
                                            <strong><a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">{{ $product->name }}</a></strong>
                                            <ul class="mt-stars">
                                                @for($i=1;$i<=5;$i++)
                                                    <li class="{{ $i <= $product->stars ? 'active' : '' }}"><a href="#"><i class="fa {{ $i <= $product->stars ? 'fa-star' : 'fa-star-o' }}"></i></a></li>
                                                @endfor
                                            </ul>
                                        </div>
                                        <del class="off">{{ $product->price }}</del>
                                        <span class="price">{{ $product->discount_price == null ? $product->price : $product->discount_price }} ₼</span>
                                    </div>
                                </div><!-- mt product4 end here -->
                                <!-- Add other product details you want to display -->

                        @endforeach
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
                        <h3 class="heading">Seçilmiş Məhsullar</h3>
                        <!-- mt product4 start here -->
                        @foreach($featureProducts as $product)

                                <!-- Display the product information here -->
                                <!-- mt product4 start here -->
                                <div class="mt-product4 mt-paddingbottom20">
                                    <div class="img">
                                        <a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}"><img alt="image description" src="{{ asset($product->path1) }}"></a>
                                    </div>
                                    <div class="text">
                                        <div class="frame">
                                            <strong><a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">{{ $product->name }}</a></strong>
                                            <ul class="mt-stars">
                                                @for($i=1;$i<=5;$i++)
                                                    <li class="{{ $i <= $product->stars ? 'active' : '' }}"><a href="#"><i class="fa {{ $i <= $product->stars ? 'fa-star' : 'fa-star-o' }}"></i></a></li>
                                                @endfor
                                            </ul>
                                        </div>
                                        <del class="off">{{ $product->price }}</del>
                                        <span class="price">{{ $product->discount_price == null ? $product->price : $product->discount_price }} ₼</span>
                                    </div>
                                </div><!-- mt product4 end here -->
                                <!-- Add other product details you want to display -->

                        @endforeach
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs">
                        <h3 class="heading">Satış Məhsulları</h3>
                        <!-- mt product4 start here -->
                        @foreach($sliderProducts as $product)

                                <!-- Display the product information here -->
                                <!-- mt product4 start here -->
                                <div class="mt-product4 mt-paddingbottom20">
                                    <div class="img">
                                        <a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}"><img alt="image description" src="{{ asset($product->path1) }}"></a>
                                    </div>
                                    <div class="text">
                                        <div class="frame">
                                            <strong><a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">{{ $product->name }}</a></strong>
                                            <ul class="mt-stars">
                                                @for($i=1;$i<=5;$i++)
                                                    <li class="{{ $i <= $product->stars ? 'active' : '' }}"><a href="#"><i class="fa {{ $i <= $product->stars ? 'fa-star' : 'fa-star-o' }}"></i></a></li>
                                                @endfor
                                            </ul>
                                        </div>
                                        <del class="off">{{ $product->price }}</del>
                                        <span class="price">{{ $product->discount_price == null ? $product->price : $product->discount_price }} ₼</span>
                                    </div>
                                </div><!-- mt product4 end here -->
                                <!-- Add other product details you want to display -->

                        @endforeach
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <h3 class="heading">yüksək qiymətlənən</h3>
                        <!-- mt product4 start here -->
                        @foreach($discountProducts as $product)

                                <!-- Display the product information here -->
                                <!-- mt product4 start here -->
                                <div class="mt-product4 mt-paddingbottom20">
                                    <div class="img">
                                        <a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}"><img alt="image description" src="{{ asset($product->path1) }}"></a>
                                    </div>
                                    <div class="text">
                                        <div class="frame">
                                            <strong>
                                                <a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug, 'level3'=>$product->slug]) }}">{{ $product->name }}</a>
                                            </strong>
                                            <ul class="mt-stars">
                                                @for($i=1;$i<=5;$i++)
                                                    <li class="{{ $i <= $product->stars ? 'active' : '' }}"><a href="#"><i class="fa {{ $i <= $product->stars ? 'fa-star' : 'fa-star-o' }}"></i></a></li>
                                                @endfor
                                            </ul>
                                        </div>
                                        <del class="off">{{ $product->price }}</del>
                                        <span class="price">{{ $product->discount_price == null ? $product->price : $product->discount_price }} ₼</span>
                                    </div>
                                </div>
                                <!-- mt product4 end here -->
                                <!-- Add other product details you want to display -->


                        @endforeach
                    </div>
                </div>
            </div>
        </div><!-- mt bestseller end here -->
    </main><!-- mt main end here -->
@endsection

@section('scripts')

    <script src="{{ asset('frontend/js/carousel.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
@endsection
