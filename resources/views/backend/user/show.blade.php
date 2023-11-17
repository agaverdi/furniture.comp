@extends('layouts.backend')
@section('title','User Profile')

@section('styles')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.category.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <div class="text-center">

                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ asset(auth('admin')->user()->user_details->image) }}"
                                     alt="User profile picture" data-toggle="modal" data-target="#exampleModalCenter">
                            </div>

                            <h3 class="profile-username text-center">{{ ucfirst(auth('admin')->user()->name)}}</h3>

                            <p class="text-muted text-center">{{ auth('admin')->user()->is_admin?'Admin':'User' }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <p class="float-right mr-3">{{ auth('admin')->user()->email }}</p>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone</b> <p class="float-right mr-3">{{ auth('admin')->user()->user_details->phone }}</p>
                                </li>
                                <li class="list-group-item">
                                    <b>Mobile</b> <p class="float-right mr-3">{{ auth('admin')->user()->user_details->mobile }}</p>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <p class="float-right mr-3">{{ ucfirst(auth('admin')->user()->user_details->address) }}</p>
                                </li>
                                <li class="list-group-item">
                                    <b>Position</b>
                                     <p class="float-right mr-3">{{ ucfirst(auth('admin')->user()->user_details->position) }}</p>
                                </li>
                            </ul>
                            <a href="{{ route('backend.user.profile_edit', auth('admin')->id()) }}" class="btn btn-primary btn-block"><b>Profilini yenile</b></a>
                            <a href="{{ route('backend.user.change_password') }}" class="btn btn-primary btn-block"><b>parolunuzu deyismek</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Profile Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="profile-user-img img-fluid  w-auto" src="{{ asset(auth('admin')->user()->user_details->image) }}" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
