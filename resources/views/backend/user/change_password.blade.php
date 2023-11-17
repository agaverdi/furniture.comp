@extends('layouts.backend')
@section('title','Change Password')

@section('styles')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Change Password</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.category.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="row">



                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Change password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('backend.user.change_password') }}" class="form-horizontal" method="post">
                            @csrf
                            <div class="card-body">
                                @include('backend.includes.success')
                                @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="old_password" class="form-control" id="inputEmail3" placeholder="Old Password">
                                    </div>
                                </div>
                                @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new_password" class="form-control" id="inputPassword3" placeholder="New Password">
                                    </div>
                                </div>
                                @error('new_password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new_password_confirmation" class="form-control" id="inputPassword3" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Change Password</button>
                                <a href="{{ route('backend.user.show', auth('admin')->id()) }}" class="btn btn-secondary float-right">Cancel</a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>

            </div>
        </section>
        <!-- Main content -->
        {{--<form action="{{ route('backend.user.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <section class="content">
                <div class="row">
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @error('category_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">User Name</label>
                                    <input type="text" id="inputName" value="{{ $user->name }}"  name="name" class="form-control">
                                </div>
                                --}}{{--<div class="form-group">
                                    <label for="inputName">User phone</label>
                                    <input type="text" id="inputName" value="{{ $user->name }}"  name="name" class="form-control">
                                </div>
--}}{{--

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-1">

                    </div>
                    <div class="col-8">
                        <a href="{{ route('backend.user.index') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Edit User" class="btn btn-success float-right">
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </form>--}}
    </div>
@endsection

@section('scripts')
    <script>
        // Set the alert to automatically close after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            $('#autoCloseAlert').alert('close');
        }, 3000);
    </script>
@endsection
