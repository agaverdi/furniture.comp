@extends('layouts.frontend')
@section('title','Order Tracking')
@section('styles')
@endsection
@section('content')
    @include('frontend.components.search')
    <!-- Main of the Page -->
    <main id="mt-main">
        <!-- Mt Content Banner of the Page -->
        <section class="mt-contact-banner" style="background-image: url(http://placehold.it/1920x205);">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>order tracking</h1>
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{route('frontend.index')}}">home <i class="fa fa-angle-right"></i></a></li>
                                <li>order tracking</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt Content Banner of the Page end -->
        <!-- Mt About Section of the Page -->
        <section class="mt-about-sec" style="padding-bottom: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="txt">
                            <h2>track your order?</h2>
                            <p>Morbi in erat malesuada, sollicitudin massa at, tristique nisl. Maecenas id eros scelerisque, vulputate tortor quis, efficitur arcu sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Umco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit sse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <strong>Vestibulum sit amet metus euismod, condimentum lectus id, ultrices sem.</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt About Section of the Page -->
        <!-- Mt Detail Section of the Page -->
        <section class="mt-detail-sec toppadding-zero">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-push-2">
                        <div class="holder" style="margin: 0px;">
                            <h2>track ORDER</h2>
                            <!-- Bill Detail of the Page -->
                            <form action="#" class="bill-detail" style="width: 100%;">
                                <fieldset>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Town / City">
                                    </div>
                                    <a href="#" class="process-btn">track now</a>
                                </fieldset>
                            </form>
                            <!-- Bill Detail of the Page end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt Detail Section of the Page end -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- banner frame start here -->
                    <div class="banner-frame toppadding-zero">
                        <!-- banner 5 white start here -->
                        <div class="banner-5 white wow fadeInLeft" data-wow-delay="0.4s">
                            <img src="http://placehold.it/590x565" alt="image description">
                            <div class="holder">
                                <div class="texts">
                                    <strong class="title">FURNITURE DESIGNS IDEAS</strong>
                                    <h3><strong>New</strong> Collection</h3>
                                    <p>Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
                                    <span class="price-add">$ 79.00</span>
                                </div>
                            </div>
                        </div><!-- banner 5 white end here -->
                        <!-- banner 6 white start here -->
                        <div class="banner-6 white wow fadeInRight" data-wow-delay="0.4s">
                            <img src="http://placehold.it/275x565" alt="image description">
                            <div class="holder">
                                <strong class="sub-title">SOFAS &amp; ARMCHAIRS</strong>
                                <h3>3 Seater Leather Sofa</h3>
                                <span class="offer">
                      <span class="price-less">$ 659.00</span>
                      <span class="prices">$ 499.00</span>
                    </span>
                                <a href="product-detail.html" class="btn-shop">
                                    <span>shop now</span>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div><!-- banner 5 white end here -->
                        <!-- banner box two start here -->
                        <div class="banner-box two">
                            <!-- banner 7 right start here -->
                            <div class="banner-7 right wow fadeInUp" data-wow-delay="0.4s">
                                <img src="http://placehold.it/295x275" alt="image description">
                                <div class="holder">
                                    <h2><strong>ACRYLIC FABRIC <br>BEAN BAG</strong></h2>
                                    <ul class="mt-stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="price-tag">
                                        <span class="price">$ 99.00</span>
                                        <a class="shop-now" href="product-detail.html">SHOP NOW</a>
                                    </div>
                                </div>
                            </div><!-- banner 7 right end here -->
                            <!-- banner 8 start here -->
                            <div class="banner-8 wow fadeInDown" data-wow-delay="0.4s">
                                <img src="http://placehold.it/295x275" alt="image description">
                                <div class="holder">
                                    <h2><strong>CHAIR WITH <br>ARMRESTS</strong></h2>
                                    <ul class="mt-stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <div class="price-tag">
                                        <span class="price-off">$ 129.00</span>
                                        <span class="price">$ 99.00</span>
                                        <a class="btn-shop" href="product-detail.html">
                                            <span>HURRY UP!</span>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- banner 8 start here -->
                        </div>
                    </div><!-- banner frame end here -->
                </div>
            </div>
        </div>
        <!-- Mt Workspace Section of the Page -->
        <section class="mt-workspace-sec wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row paddingtop-md">
                    <div class="col-xs-12">
                        <h2>OUR WORKSPACE</h2>
                    </div>
                </div>
            </div>
            <!-- Work Slider of the Page -->
            <ul class="list-unstyled work-slider">
                <li>
                    <div class="img-holder">
                        <img src="http://placehold.it/545x545" alt="image description">
                    </div>
                    <div class="img-holder">
                        <div class="coll1">
                            <img src="http://placehold.it/245x310" alt="image description">
                        </div>
                        <div class="coll2">
                            <img src="http://placehold.it/385x310" alt="image description">
                        </div>
                        <div class="coll3">
                            <img src="http://placehold.it/640x220" alt="image description">
                        </div>
                    </div>
                </li>
                <li>
                    <div class="img-holder">
                        <img src="http://placehold.it/545x545" alt="image description">
                    </div>
                    <div class="img-holder">
                        <div class="coll1">
                            <img src="http://placehold.it/245x310" alt="image description">
                        </div>
                        <div class="coll2">
                            <img src="http://placehold.it/385x310" alt="image description">
                        </div>
                        <div class="coll3">
                            <img src="http://placehold.it/640x220" alt="image description">
                        </div>
                    </div>
                </li>
                <li>
                    <div class="img-holder">
                        <img src="http://placehold.it/545x545" alt="image description">
                    </div>
                    <div class="img-holder">
                        <div class="coll1">
                            <img src="http://placehold.it/245x310" alt="image description">
                        </div>
                        <div class="coll2">
                            <img src="http://placehold.it/385x310" alt="image description">
                        </div>
                        <div class="coll3">
                            <img src="http://placehold.it/640x220" alt="image description">
                        </div>
                    </div>
                </li>
            </ul>
            <!-- Work Slider of the Page end -->
        </section>
        <!-- Mt Workspace Section of the Page -->
    </main><!-- Main of the Page end -->
@endsection
@section('scripts')
@endsection
