@extends('layouts.frontend')
@section('title',$pages->name)
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset($pages->icon) }}">
@endsection
@section('content')

    @include('frontend.components.search')<!-- mt search popup end here -->
    <!-- Main of the Page -->
    <main id="mt-main">
        <!-- Mt Content Banner of the Page -->
        <section class="mt-contact-banner" style="background-image: url({{asset($pages->url_path)}});">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>register</h1>
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{ route('frontend.index') }}">home <i class="fa fa-angle-right"></i></a></li>
                                <li>register</li>
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
                            <h2>register</h2>
                            <p>Furniture sayt sadece developerin isini gostermek ucun nezerde tutulmusdur burda gorduyunuz her sey sadece goruntudur. Kodlasdirma ucun nezerde tutulmus bu
                                sayti rahatliqla baxa biler isttifade ede bierlsiz
                                <strong>butun kod git repositorimde publik olaraq yerlesdirilib</strong></p>
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
                    <div class="col-xs-12 col-sm-10 col-sm-push-1">
                        <div class="holder" style="margin: 0;">
                            <div class="mt-side-widget">

                                @if(auth()->check())
                                    @include('backend.includes.success')
                                    <fieldset>

                                        <div class="row">

                                            <div class="col-xs-12 col-sm-8">
                                                <ul class="list-group list-group-flush">
                                                    <a href="" class="list-group-item list-group-item-action h3">Hesab məlumatları</a>
                                                    <a href="#" class="list-group-item list-group-item-action h3">Şifrəni dəyiş</a>
                                                    <a href="#" class="list-group-item list-group-item-action h3">Arzu siyahısı</a>
                                                    <a href="#" class="list-group-item list-group-item-action h3">Sifariş tarixçəsi</a>

                                                </ul>
                                            </div>
                                            <div class="col-xs-12 col-sm-2"></div>
                                            <div class="col-xs-12 col-sm-2"></div>
                                        </div>

                                    </fieldset>
                                @else
                                    <header>
                                        <h2 style="margin: 0 0 5px;">register</h2>
                                        <p><a href="{{ route('frontend.login') }}">Artıq hesabınız var?</a></p>
                                    </header>
                                    <form action="{{ route('frontend.user.store') }}" style="margin: 0 0 80px;" method="post">
                                        @csrf
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-2"></div>
                                                <div class="col-xs-12 col-sm-8">
                                                    @error('name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="First Name" class="input">
                                                </div>
                                                <div class="col-xs-12 col-sm-2"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-2"></div>
                                                <div class="col-xs-12 col-sm-8">
                                                    @error('surname')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <input type="text" name="surname" value="{{ old('surname') }}" placeholder="Last Name" class="input">
                                                </div>
                                                <div class="col-xs-12 col-sm-2"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-2"></div>
                                                <div class="col-xs-12 col-sm-8">
                                                    @error('email')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <input type="email" name="email" value="{{ old('email') }}"  placeholder="Email" class="input">
                                                </div>
                                                <div class="col-xs-12 col-sm-2"></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-2"></div>
                                                <div class="col-xs-12 col-sm-8">
                                                    @error('tel')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <input type="text" name="tel" value="{{ old('tel') }}" placeholder="Telephone" class="input">
                                                </div>
                                                <div class="col-xs-12 col-sm-2"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-2"></div>
                                                <div class="col-xs-12 col-sm-8">
                                                    @error('address')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <input type="text" name="address" value="{{ old('address') }}" placeholder="address" class="input">
                                                </div>
                                                <div class="col-xs-12 col-sm-2"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-2"></div>
                                                <div class="col-xs-12 col-sm-8">
                                                    @error('password')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <input type="password" name="password" placeholder="Password" class="input">
                                                </div>
                                                <div class="col-xs-12 col-sm-2"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-2"></div>
                                                <div class="col-xs-12 col-sm-8">
                                                    @error('confirm')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="input">
                                                </div>
                                                <div class="col-xs-12 col-sm-2"></div>
                                            </div>
                                            <div class="box">
                                                <a href="#" class="help">Help?</a>
                                            </div>
                                            <button type="submit" class="btn-type1">Register Me</button>
                                        </fieldset>
                                    </form>
                                    <header>
                                        <h2 style="margin: 0 0 5px;">register with social</h2>
                                        <p>Create an account using social</p>
                                    </header>
                                    <ul class="mt-socialicons">
                                        <li class="mt-facebook"><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li class="mt-twitter"><a href="#"><i class="fa-brands  fa-twitter"></i></a></li>
                                        <li class="mt-linkedin"><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                        <li class="mt-dribbble"><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
                                        <li class="mt-pinterest"><a href="#"><i class="fa-brands fa-openid"></i></a></li>
                                        <li class="mt-youtube"><a href="#"><i class="fa-brands fa-youtube-play"></i></a></li>
                                    </ul>
                                @endif

                            </div>
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
    </main><!-- Main of the Page end -->
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@endsection
