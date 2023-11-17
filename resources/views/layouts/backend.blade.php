<!DOCTYPE html>
<html lang="en">
<head>
        @include('backend.includes.meta')
        @include('backend.includes.styles')
        @yield('styles')
</head>
@if(request()->is('admin/register') || request()->is('admin/login') || request()->is('admin/forgot_password') || request()->is('admin/recover_password'))
    @yield('content')
    @include('backend.includes.scripts')
    @yield('scripts')
@else
<body class="hold-transition sidebar-mini ">
    <div class="wrapper">
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="<?=asset('backend/dist/img/AdminLTELogo.png')?>" alt="AdminLTELogo" height="60" width="60">
            </div>
            @include('backend.includes.navbar')
            @include('backend.includes.sidebar')
            @yield('content')
            @include('backend.includes.footer')
            <aside class="control-sidebar control-sidebar-dark">
            </aside>
</div>
    @include('backend.includes.scripts')
    @yield('scripts')
</body>
@endif

</html>
