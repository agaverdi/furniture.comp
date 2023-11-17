@extends('layouts.frontend')
@section('title',$pages->name)
@section('styles')
    <link rel="icon" type="image/x-icon" href="{{ asset($pages->icon) }}">
@endsection
@section('content')
    @include('frontend.components.search')
    <main id="mt-main">
        <!-- Mt Content Banner of the Page -->
        <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{ asset($pages->url_path) }});">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>ABOUT US</h1>
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{route('frontend.index')}}">home <i class="fa fa-angle-right"></i></a></li>
                                <li>About Us</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt Content Banner of the Page end -->
        <!-- Mt About Section of the Page -->
        <section class="mt-about-sec wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="txt">
                            <h2>WHO WE ARE?</h2>
                            <p>Morbi in erat malesuada, sollicitudin massa at, tristique nisl. Maecenas id eros scelerisque, vulputate tortor quis, efficitur arcu sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Umco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit sse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <strong>Vestibulum sit amet metus euismod, condimentum lectus id, ultrices sem.</strong></p>
                            <p>Fusce mattis nunc lacus, vulputate facilisis dui efficitur ut. Vestibulum sit amet metus euismod, condimentum lectus id, ultrices sem. Morbi in erat malesuada, sollicitudin massa at, </p>
                        </div>
                        <div class="mt-follow-holder">
                            <span class="title">Follow Us</span>
                            <!-- Social Network of the Page -->
                            <ul class="list-unstyled social-network">
                                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                <li><a href="https://linkedin.com/in/adil-agaverdiyev-1445ba200"><i class="fa-brands fa-linkedin"></i></a></li>
                                <li><a href="https://wa.me/+994509995597"><i class="fa-brands fa-whatsapp"></i></a></li>
                            </ul>
                            <!-- Social Network of the Page end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- Main of the Page end -->
@endsection
@section('scripts')

@endsection
