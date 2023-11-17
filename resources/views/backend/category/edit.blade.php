@extends('layouts.backend')
@section('title','Category Create')

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
        <section class="content">
        <!-- Main content -->
        <form action="{{ route('backend.category.update', $category->slug) }}" method="post" enctype="multipart/form-data">
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
                                @include('backend.includes.success')
                                @error('category_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Category Name</label>
                                    <input type="text" id="inputName" value="{{ $category->category_name }}"  name="name" class="form-control">
                                </div>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <div class="form-group d-flex flex-column align-items-center mt-3">
                                        <label for="inputName">Category image</label>
                                        <img src="{{ asset($category->image) }}" alt="Category photo" class="profile-user-img img-fluid w-25" >
                                    </div>
                                    <input type="file" id="inputName" value=""  name="image" class="form-control">
                                </div>

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
                        <a href="{{ route('backend.category.index') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Edit Category" class="btn btn-success float-right">
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
