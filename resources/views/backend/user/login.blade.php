@extends('layouts.backend')
@section('title','Login')

@section('styles')

@endsection
@section('content')
    <body class="hold-transition login-page">
    <div class="login-box">
        @include('backend.includes.success')
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('frontend.index') }}" class="h1"><b>Furniture</b>MMC</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('backend.user.login')  }}" method="post">
                    @csrf
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="toggle-password fas fa-lock" data-field="password"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>




                <p class="mb-1">
                    <a href="{{ route('backend.user.forgot') }}">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('backend.user.register') }}" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    </body>

@endsection

@section('scripts')
    <script>
        setTimeout(function() {
            $('#autoCloseAlert').alert('close');
        }, 3000);

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
