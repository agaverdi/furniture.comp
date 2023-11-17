@extends('layouts.frontend')
@section('title',$pages->name)
@section('styles')
    <link rel="icon" type="image/x-icon" href="{{ asset($pages->icon) }}">
@endsection
@section('content')
    @include('frontend.components.search')
    <main id="mt-main">
        <!-- Mt Contact Banner of the Page -->
        <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{ asset($pages->url_path) }});">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>CONTACT</h1>
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{ route('frontend.index') }}">Home <i class="fa fa-angle-right"></i></a></li>
                                <li><a href="">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section><!-- Mt Contact Banner of the Page -->
        <!-- Mt Contact Detail of the Page -->
        <section class="mt-contact-detail content-info wow fadeInUp" data-wow-delay="0.4s">
            <div class="container-fluid">
                <div class="row">
                    @include('backend.includes.success')
                    <div class="col-xs-12 col-sm-8">
                        <div class="txt-wrap">
                            <h1>Furniture.comp Agaverdiyev</h1>
                            <p> Elave problemlerle uzlesirsinizse  <br>
                                bunlari message bolmesinde qeyd edib hemcinin subject bolmesinde  <br>
                                problemin movzusunda qeyd etmekle gondere bilersiniz </p>
                        </div>
                        <ul class="list-unstyled contact-txt">
                            <li>
                                <strong>Address</strong>
                                <address> Baki seheri <br>Albali usaq baxcasi  <br>Yasamal rayonu</address>
                            </li>
                            <li>
                                <strong>Telefon</strong>
                                <a href="#">+994 (50) 999 55 97</a>
                            </li>
                            <li>
                                <strong>E_mail</strong>
                                <a href="mailto:adilagaverdiyev@gmail.com">adilagaverdiyev@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <h2>Have a question?</h2>
                        <!-- Contact Form of the Page -->
                        <form action="{{ route('frontend.contact.send') }}" method="post" class="contact-form">
                            @csrf

                            <fieldset>
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <input type="text" class="form-control" value="{{ old("name") }}"  name="name" placeholder="Name">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <input type="email" class="form-control" value="{{ old("email") }}" name="email" placeholder="E-Mail">
                                @error('subject')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <input type="text" class="form-control" value="{{ old("subject") }}" name="subject" placeholder="Subject">
                                @error('message')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <textarea class="form-control" name="message" placeholder="Message">{{ old("Message") }}</textarea>
                                <button class="btn-type3" type="submit">Send</button>
                            </fieldset>
                        </form>
                        <!-- Contact Form of the Page end -->
                    </div>
                </div>
            </div>
        </section><!-- Mt Contact Detail of the Page end -->
        <!-- Mt Map Holder of the Page -->
        <div class="mt-map-holder wow fadeInUp" data-wow-delay="0.4s" data-lat="40.387829522198274," data-lng="49.78793879967261" data-zoom="12">
            <div class="map-info">
                <h2>Yasamal</h2>
                <p>Albali usaq Baxcasi</p>
            </div>
        </div><!-- Mt Map Holder of the Page end -->
    </main>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
        setTimeout(function() {
            $('#autoCloseAlert').alert('close');
        }, 3000);
    </script>

@endsection
