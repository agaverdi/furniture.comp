<div class="banner-frame">
    <!-- banner-1 start here -->
    <div class="banner-1 wow fadeInLeft" data-wow-delay="0.4s">
        <img alt="image description" height="580" src="{{asset($leastExpensiveFeatureProduct->path1)}}">
        <div class="holder">
            <h2 style="color: gray;">{{$leastExpensiveFeatureProduct->name}}</h2>
            <div class="txts">
                <a class="btn-shop" href="{{ route('frontend.product.index', ['level1'=>$leastExpensiveFeatureProduct->category->slug, 'level2'=>$leastExpensiveFeatureProduct->subCategory->slug, 'level3'=>$leastExpensiveFeatureProduct->slug]) }}">
                    <span>shop now</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <div class="discount">
                    <span>-20%</span>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-1 end here -->

    <!-- banner-box first start here -->
    <div class="banner-box first">
        <!-- banner-2 start here -->
        <div class="banner-2 wow fadeInUp" data-wow-delay="0.4s">
            <img alt="image description" src="{{asset($leastExpensiveHotSaleProduct->path1)}}">
            <div class="holder">
                <h2 style="color: white;">{{$leastExpensiveHotSaleProduct->name}}</h2>
                <span style="color: white;" class="price"><i class="fa-solid fa-manat-sign"></i> &nbsp;&nbsp;&nbsp;{{$leastExpensiveHotSaleProduct->price}}</span>
                <a style="color: white;" href="{{ route('frontend.product.index', ['level1'=>$leastExpensiveHotSaleProduct->category->slug, 'level2'=>$leastExpensiveHotSaleProduct->subCategory->slug, 'level3'=>$leastExpensiveHotSaleProduct->slug]) }}" class="shop">SHOP NOW</a>
            </div>
        </div>
        <!-- banner-2 end here -->

        <!-- banner-3 start here -->
        <div class="banner-3 right wow fadeInDown" data-wow-delay="0.4s">
            <img alt="image description" src="{{ $leastExpensiveProduct->path1 }}">
            <div class="holder">
                <h2>{{ $leastExpensiveProduct->name }}</h2>
                <span class="price"><i class="fa-solid fa-manat-sign"></i> &nbsp;&nbsp;&nbsp;{{ $leastExpensiveProduct->price }}</span>
                <a href="{{ route('frontend.product.index', ['level1'=>$leastExpensiveProduct->category->slug, 'level2'=>$leastExpensiveProduct->subCategory->slug, 'level3'=>$leastExpensiveProduct->slug]) }}" class="shop">SHOP NOW</a>
            </div>
        </div>
        <!-- banner-3 end here -->
    </div>
    <!-- banner-box first end here -->

    <!-- banner-4 start here -->
    <div class="banner-4 hidden-sm wow fadeInRight" data-wow-delay="0.4s">
        <img height="580" alt="image description" src="{{asset($leastExpensiveDiscountProduct->path1)}}">
        <div class="holder">
            <h2>{{$leastExpensiveDiscountProduct->name}}</h2>
            <span class="price"><i class="fa-solid fa-manat-sign"></i> &nbsp;&nbsp;&nbsp;{{ $leastExpensiveDiscountProduct->name }}</span>
            <a class="btn-shop add" href="{{ route('frontend.product.index', ['level1'=>$leastExpensiveDiscountProduct->category->slug, 'level2'=>$leastExpensiveDiscountProduct->subCategory->slug, 'level3'=>$leastExpensiveDiscountProduct->slug]) }}">
                <span>shop now</span>
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <!-- banner-4 end here -->
</div>
