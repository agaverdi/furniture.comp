@extends('layouts.frontend')
@section('title', $pages->name)
@section('styles')
<link rel="icon" type="image/x-icon" href="{{ asset($pages->icon) }}">
@endsection
@section('content')
    @include('frontend.components.search')
    <main id="mt-main">
        <!-- Mt Contact Banner of the Page -->
        <section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{ asset($pages->url_path) }});">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>Search</h1>
                        <!-- Breadcrumbs of the Page -->
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="{{ route('frontend.index') }}">Home <i class="fa fa-angle-right"></i></a></li>
                                <li><a href="">Search <i class="fa fa-angle-right"></i></a></li>

                            </ul>
                        </nav>
                        <!-- Breadcrumbs of the Page end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt Contact Banner of the Page end -->

        <!-- Mt Blog Detail of the Page -->
        <div class="mt-blog-detail style2">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 wow fadeInLeft" data-wow-delay="0.4s">
                        @isset($search_products)
                            {{--@dd($search_products)--}}
                            @foreach($search_products as $product)
                                <article class="blog-post">
                                    <div class="img-holder">
                                        <a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug,'level3'=>$product->slug]) }}">
                                            <img src="{{ $product->path1 }}" alt="image description">
                                        </a>
                                    </div>
                                    <time class="time" datetime="2016-02-03 20:00"><strong>25</strong>April</time>
                                    <div class="blog-txt">
                                        <h2><a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug,'level3'=>$product->slug]) }}">{{ $product->name }}</a></h2>
                                        <ul class="list-unstyled blog-nav">
                                            <li> <a href="#"><i class="fa fa-clock-o"></i>{{$product->created_at->format('d F Y')}}</a></li>
                                            <li> <a href="#"><i class="fa fa-list"></i>{{ $product->category->slug }}</a></li>
                                            <li> <a href="#"><i class="fa fa-comment"></i>{{ count($product->comments) }} comments</a></li>
                                        </ul>
                                        <p>{!! substr($product->description, 0, strlen($product->description) / 2) !!}</p>
                                        <a href="{{ route('frontend.product.index', ['level1'=>$product->category->slug, 'level2'=>$product->subCategory->slug,'level3'=>$product->slug]) }}" class="btn-more">Read More</a>
                                    </div>
                                </article>
                            @endforeach
                                <div class="btn-holder">
                                    @if ($search_products->previousPageUrl())
                                        <a href="{{ $search_products->appends(['search'=>old('search')])->previousPageUrl() }}" class="btn-prev"><i class="fa fa-angle-left"></i> PREVIOUS</a>
                                    @endif

                                    @if ($search_products->nextPageUrl())
                                        <a href="{{ $search_products->appends(['search'=>old('search')])->nextPageUrl() }}" class="btn-next">NEXT <i class="fa fa-angle-right"></i></a>
                                    @endif
                                </div>
                        @else
                            <h1>Siz Hec bir axtarish etmemisiniz</h1>
                        @endisset

                    </div>
                    <div class="col-xs-12 col-sm-4 text-right wow fadeInRight" data-wow-delay="0.4s">
                        <!-- Category Widget of the Page -->
                        <section class="widget category-widget">
                            <h3>KATEQORIYALAR</h3>
                            <ul class="list-unstyled widget-nav">
                                @foreach($categories as $cat)

                                <li>
                                    <a href="{{ route('frontend.product.index', ['level1'=>$cat->slug, 'level2'=>$cat->sub_categories->first()->slug]) }}">{{$cat->category_name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </section>
                        <section class="widget tag-widget">
                            <h3>TAGS</h3>
                            <ul class="list-unstyled text-right tags">
                                @foreach($categories as $category)
                                    @foreach($sub_categories as $sub_category)
                                        @if($sub_category->parent_category_id == $category->id)
                                            <li>
                                                <a style="font-weight: bold; color: {{ '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT) }}" href="{{ route('frontend.product.index', ['level1' => $category->slug, 'level2' => $sub_category->slug]) }}">{{ $sub_category->category_name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>
                        </section>
                        <!-- Tag Widget of the Page end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Mt Blog Detail of the Page end -->
    </main>
@endsection

@section('scripts')

@endsection
