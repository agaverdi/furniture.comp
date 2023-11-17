@extends('layouts.backend')
@section('title','User Edit')

@section('styles')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.category.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <form action="{{ route('backend.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
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

                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">User Name</label>
                                    <input type="text" id="inputName" value="{{ $user->name }}"  name="name" class="form-control">
                                </div>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <div class="form-group d-flex flex-column align-items-center mt-3">
                                        <label for="inputName">User image</label>
                                        <img src="{{ !is_null($user->user_details) && !is_null($user->user_details->image) ? asset($user->user_details->image) : asset('backend/default/user.jpg') }}" alt="profile photo" class="profile-user-img img-fluid w-25" >
                                    </div>
                                    <input type="file" id="inputName" value=""  name="image" class="form-control">
                                </div>
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">Address</label>
                                    <input type="text" id="inputName" value="{{ isset($user->user_details->address)?$user->user_details->address:'' }}"  name="address" class="form-control">
                                </div>
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">Phone</label>&nbsp;&nbsp;<i>example: +994 50 1234567</i>
                                    <input type="text" id="inputName" value="{{ isset($user->user_details->phone)?$user->user_details->phone:'+994' }}"  name="phone" class="form-control">
                                </div>
                                @error('mobile')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">Mobile</label>&nbsp;&nbsp;<i>example: +994 55 123 45 67</i>
                                    <input type="text" id="inputName" value="{{ isset($user->user_details->mobile)?$user->user_details->mobile:'+994' }}"  name="mobile" class="form-control">
                                </div>
                                @error('position')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">Position</label>
                                    <input type="text" id="inputName" value="{{ isset($user->user_details->position)?$user->user_details->position:'' }}"  name="position" class="form-control">
                                </div>
                                {{--<div class="form-group">
                                    <label for="inputName">User phone</label>
                                    <input type="text" id="inputName" value="{{ $user->name }}"  name="name" class="form-control">
                                </div>
--}}

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
        </form>
    </div>
@endsection

@section('scripts')
@endsection
