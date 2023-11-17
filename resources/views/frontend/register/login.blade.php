@extends('layouts.frontend')
@section('title',$pages->name)
@section('styles')
    <link rel="icon" type="image/x-icon" href="{{ asset($pages->icon) }}">
@endsection
@section('content')
    @include('frontend.components.search')
    <!-- mt search popup start here -->
    @include('frontend.components.search')<!-- mt search popup end here -->
    <!-- Main of the Page -->
    <main id="mt-main">

        <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{ asset($pages->url_path) }});">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Daxil ol</h1>
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{route('frontend.index')}}">home <i class="fa fa-angle-right"></i></a></li>
                                <li>login</li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-about-sec" style="padding-bottom: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="txt">
                            <h2>login</h2>
                            @include('backend.includes.success')
                            <p>Furniture sayt sadece developerin isini gostermek ucun nezerde tutulmusdur burda gorduyunuz her sey sadece goruntudur. Kodlasdirma ucun nezerde tutulmus bu
                                sayti rahatliqla baxa biler isttifade ede bierlsiz
                                <strong>butun kod git repositorimde publik olaraq yerlesdirilib</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-detail-sec toppadding-zero">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-push-2">
                        <div class="holder" style="margin: 0;">
                            <div class="mt-side-widget">
                                <header>
                                    <h2 style="margin: 0 0 5px;">DAXİL OL</h2>
                                    <p>Xosh gelmisiz! Hesabiniza daxil ola bilersiniz. Yoxdursa <a style="color: #1233a1;font-size: large;font-style: italic;font-family: math;" href="{{ route('frontend.register') }}">Registration</a></p>
                                </header>
                                <form action="{{route('frontend.user.login')}}" method="post">
                                    @csrf
                                    <fieldset>
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <input type="email" name="email" placeholder="e-poçt ünvanı" class="input">
                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <input type="password" name="password" placeholder="parol" class="input">
                                        @error('remember')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <div class="form-check">
                                            <input type="checkbox" name="remember" class="form-check-input" id="dropdownCheck">
                                            <label class="form-check-label" for="dropdownCheck">
                                                Remember me
                                            </label>
                                        </div>
                                        <button type="submit" class="btn-type1">Login</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('scripts')
@endsection
