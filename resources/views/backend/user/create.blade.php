@extends('layouts.backend')
@section('title','Registration')

@section('styles')

@endsection
@section('content')
    <body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>Furniture</b>MMC</h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new admin</p>

                <form action="{{ route('backend.user.store') }}" method="post">
                    @csrf
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('confirm')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">

                        </div>
                        <!-- /.col -->
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <div class="col-2">

                        </div>
                        <!-- /.col -->
                    </div>
                </form>



                <a href="{{ route('backend.user.login') }}" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->

    </body>
@endsection

@section('scripts')
@endsection
