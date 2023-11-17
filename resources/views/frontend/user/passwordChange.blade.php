@extends('layouts.frontend')
@section('title',$pages->name)
@section('styles')
    <link rel="icon" type="image/x-icon" href="{{ asset($pages->icon) }}">
@endsection
@section('content')
    <div class="mt-search-popup">
        <div class="mt-holder">
            <a href="#" class="search-close"><span></span><span></span></a>
            <div class="mt-frame">
                <form action="#">
                    <fieldset>
                        <input type="text" placeholder="Search...">
                        <span class="icon-microphone"></span>
                        <button class="icon-magnifier" type="submit"></button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <main id="mt-main">
        <!-- Mt Content Banner of the Page -->
        <section class="mt-contact-banner" style="background-image: url({{ asset($pages->url_path) }});">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1 style="color:#aa2121;">Change Password</h1>
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a style="color: #dc0e0e" href="{{route('frontend.index')}}">home <i class="fa fa-angle-right"></i></a></li>
                                <li style="color: #dc0e0e">Change Password</li>
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
                    <div class="col-xs-12 col-sm-8 col-sm-push-2">
                        <div class="holder" style="margin: 0;">
                            <div class="mt-side-widget">
                                <header>
                                    <h2 style="margin: 0 0 5px;">Change Password </h2>
                                    <p>Change your Password safety</p>
                                    @include('backend.includes.success')
                                </header>
                                <form action="{{ route('frontend.user.changePassword') }}" method="post">
                                    @csrf
                                    <fieldset>
                                        @error('old_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group" style="display: flex;align-items: baseline;">
                                            <input type="password" name="old_password" placeholder="Old Password" class="input">
                                            <i style="position: relative;right: 23px;" class="toggle-password fa-solid fa-lock" data-field="old_password"></i>
                                        </div>
                                        @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group" style="display: flex;align-items: baseline;">
                                            <input type="password" name="new_password" placeholder="New password" class="input">
                                            <i style="position: relative;right: 23px;" class="toggle-password fa-solid fa-lock" data-field="new_password"></i>
                                        </div>
                                        @error('new_password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group" style="display: flex;align-items: baseline;">
                                            <input type="password" name="new_password_confirmation" placeholder="Confirm" class="input">
                                            <i style="position: relative;right: 23px;" class="toggle-password fa-solid fa-lock" data-field="new_password_confirmation"></i>
                                        </div>
                                        <div class="box">
                                            <a href="#" class="help">Help?</a>
                                        </div>
                                        <button type="submit" class="btn-type1">Change</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Mt Detail Section of the Page end -->
        <i class="fa-solid fa-unlock"></i>
    </main><!-- Main of the Page end -->
@endsection
@section('scripts')
    <script>
        const toggleIcons = document.querySelectorAll(".toggle-password");

        toggleIcons.forEach(icon => {
            icon.addEventListener("click", () => {
                const fieldId = icon.getAttribute("data-field");
                const field = document.querySelector(`[name="${fieldId}"]`);

                if (field.type === "password") {
                    field.type = "text";
                    icon.classList.remove("fa-lock");
                    icon.classList.add("fa-unlock");
                } else {
                    field.type = "password";
                    icon.classList.remove("fa-unlock");
                    icon.classList.add("fa-lock");
                }
            });
        });
    </script>
@endsection
