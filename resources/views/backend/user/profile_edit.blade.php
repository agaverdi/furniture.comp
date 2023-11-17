@extends('layouts.backend')
@section('title','Profile Edit')

@section('styles')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.category.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content mb-3">
        <!-- Main content -->
        <form action="{{ route('backend.user.profile_update', auth('admin')->id()) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <section class="content">
                <div class="row">

                    <div class="col-md-12">
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
                                    <label for="inputName">Name</label>
                                    <input type="text" id="inputName" value="{{ $user->name }}"  name="name" class="form-control">
                                </div>
                                <hr>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">image</label>
                                    <input type="file" class="form-control"  id="inputName" name="image">
                                    <div class="form-group d-flex flex-column align-items-center mt-3">
                                        <img src="{{ asset($user->user_details->image) }}" alt="profile photo" class="profile-user-img img-fluid w-25" >
                                    </div>
                                </div>
                                <hr>
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">address</label>
                                    <input type="text" id="inputName" value="{{ isset($user->user_details->address)?$user->user_details->address: '' }}"  name="address" class="form-control">
                                </div>
                                <hr>
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">phone</label>
                                    <input type="text" id="inputName" value="{{ isset($user->user_details->phone)?$user->user_details->phone:'+994' }}"  name="phone" class="form-control">
                                </div>
                                <hr>
                                @error('mobile')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">mobile</label>
                                    <input type="text" id="inputName" value="{{ isset($user->user_details->mobile)?$user->user_details->mobile:'+994' }}"  name="mobile" class="form-control">
                                </div>
                                <hr>
                                @error('position')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">position</label>
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

                    <div class="col-12">
                        <a href="{{ route('backend.user.index') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Edit User" class="btn btn-success float-right">
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </form>
        </section>
    </div>
@endsection

@section('scripts')
@endsection
