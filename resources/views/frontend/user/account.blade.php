@extends('layouts.frontend')
@section('title',$pages->name)
@section('styles')
    <link rel="icon" type="image/x-icon" href="{{ asset($pages->icon) }}">
@endsection
@section('content')
    @include('frontend.components.search')
    <main id="mt-main">
        <!-- Mt Contact Banner of the Page -->
        <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{ asset($pages->url_path) }});">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Account</h1>
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{route('frontend.index')}}">Home <i class="fa fa-angle-right"></i></a></li>
                                <li><a href="#">Account</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section><!-- Mt Contact Banner of the Page -->
        <!-- Mt Error Sec of the Page -->
        <section class="mt-error-sec dark">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <div class="mt-side-widget">
                        @include('backend.includes.success')
                        <form action="{{ route('frontend.user.account') }}" style="margin: 0 0 80px;" method="post">
                            @csrf
                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-2"></div>
                                    <div class="col-xs-12 col-sm-8">
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <input style="font: initial" type="text" name="name" value="{{ $user->name }}" placeholder="First Name" class="input">
                                    </div>
                                    <div class="col-xs-12 col-sm-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-2"></div>
                                    <div class="col-xs-12 col-sm-8">
                                        @error('surname')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <input style="font: initial" type="text" name="surname" value="{{ $user->surname }}" placeholder="Last Name" class="input">
                                    </div>
                                    <div class="col-xs-12 col-sm-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-2"></div>
                                    <div class="col-xs-12 col-sm-8">
                                        @error('address')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <input style="font: initial" type="text" name="address" value="{{ $user_details->address }}" placeholder="address" class="input">
                                    </div>
                                    <div class="col-xs-12 col-sm-2"></div>
                                </div>


                                {{--<div class="row">
                                    <div class="col-xs-12 col-sm-2"></div>
                                    <div class="col-xs-12 col-sm-8">
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <input style="font: initial" type="email" name="email" value="{{ $user->email }}"  placeholder="Email" class="input">
                                    </div>
                                    <div class="col-xs-12 col-sm-2"></div>
                                </div>--}}

                                <div class="row">
                                    <div class="col-xs-12 col-sm-2"></div>
                                    <div class="col-xs-12 col-sm-8">
                                        @error('phone')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <input style="font: initial" type="text" name="phone" value="{{ $user_details->phone }}" placeholder="Telephone" class="input">

                                    </div>
                                    <div class="col-xs-12 col-sm-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-2"></div>
                                    <div class="col-xs-12 col-sm-8">
                                        @error('mobile')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <input style="font: initial" type="text" name="mobile" value="{{ $user_details->mobile }}" placeholder="mobile" class="input">
                                        <div class="box">
                                            <a  href="{{ route('frontend.user.changePassword') }}" style="border: solid 1px grey;color: #ebefde;font: 12px/18px 'Oxygen', sans-serif;border-radius: 3px;padding: 4px;background-color: grey;" class="help">Şifrəni dəyişmək</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2"></div>
                                </div>


                                <button type="submit" class="btn-type1">Dəyişiklikləri yadda saxla</button>
                            </fieldset>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- Mt Error Sec of the Page end -->
    </main>

@endsection
@section('scripts')
@endsection
