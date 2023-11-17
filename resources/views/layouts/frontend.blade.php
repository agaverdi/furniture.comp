<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.includes.meta');z
    @include('frontend.includes.styles');
    @yield('styles');
</head>
<body>
<div id="wrapper">
    <div id="pre-loader" class="loader-container">
        <div class="loader">
            <img src="<?=asset('frontend/images/svg/rings.svg')?>" alt="loader">

        </div>
    </div>
    <div class="w1">
            @include('frontend.includes.header');
            @yield('content');
            @include('frontend.includes.footer');
    </div>
    <span id="back-top" class="fa fa-arrow-up"></span>
</div>
@include('frontend.includes.scripts')
@yield('scripts')
</body>
</html>
