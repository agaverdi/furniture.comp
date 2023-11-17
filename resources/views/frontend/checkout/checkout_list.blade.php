@extends('layouts.frontend')
@section('title',$pages->name)
@section('styles')
    <link rel="icon" type="image/x-icon" href="{{ asset($pages->icon) }}">
@endsection
@section('content')
    @include('frontend.components.search')


    <!-- Main of the Page -->
    <main id="mt-main">
        <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{ asset($pages->url_path) }});">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="text-center">Sifarish tarixcesi</h1>
                        <!-- Breadcrumbs of the Page -->
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{route('frontend.index')}}">Ana sehife <i class="fa fa-angle-right"></i></a></li>
                                <li>Sifarish tarixcesi</li>
                            </ul>
                        </nav>
                        <!-- Breadcrumbs of the Page end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt Process Section of the Page -->
        <div class="mt-process-sec wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="list-unstyled process-list">
                            <li class="active">
                                <span class="counter">01</span>
                                <strong class="title">Shopping Cart</strong>
                            </li>
                            <li class="active">
                                <span class="counter">02</span>
                                <strong class="title">Check Out</strong>
                            </li>
                            <li class="active">
                                <span class="counter">03</span>
                                <strong class="title">Order list</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-product-table wow fadeInUp" data-wow-delay="0.4s">
            <div class="container">
                <div class="row border">
                    <div class="col-xs-12 col-sm-2">
                        <strong class="title">Company</strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="title">Addres</strong>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <strong class="title">Products</strong>
                    </div>
                    <div class="col-xs-12 col-sm-1">
                        <strong class="title">Shipping</strong>
                    </div>
                    <div class="col-xs-12 col-sm-1">
                        <strong class="title">coupon</strong>
                    </div>
                    <div class="col-xs-12 col-sm-1">
                        <strong class="title">Total</strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="title">Date</strong>
                    </div>
                </div>
                @foreach($productData as $item)
                    <div class="row border">
                        <div class="col-xs-12 col-sm-2">
                            <strong class="product-name">{{ $item->company }}</strong>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <strong class="product-name">{{ $item->address }}</strong>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            @foreach ($item->productData as $product)
                                <div style="display: flex;flex-direction: row;align-items: center;">
                                    <img style="width: 33%" height="70" src="{{ asset($product->path1) }}" alt="">
                                    <strong style="padding: 0 0 0 5px;" class="product-name">{{ $product->name }}</strong>
                                </div>

                            @endforeach

                        </div>
                        <div class="col-xs-12 col-sm-1">
                            <strong class="product-name"> {{ $item->subShipping->shipping_name  }}</strong>
                        </div>
                        <div class="col-xs-12 col-sm-1">
                            <strong class="product-name">{!! $item->coupon == 1 ? '<i class="fa-solid fa-check"></i>' : '<i class="fa-solid fa-x"></i>' !!}</strong>

                        </div>
                        <div class="col-xs-12 col-sm-1">
                            <strong class="product-name"><i class="fa-solid fa-manat-sign"></i> {{ $item->total  }}</strong>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <strong class="product-name"> {{$item->created_at->format('d F Y')}}</strong>
                        </div>
                    </div>
                @endforeach

            </div>
        </div><!-- Mt Product Table of the Page end -->

    </main>


@endsection
@section('scripts')

@endsection
