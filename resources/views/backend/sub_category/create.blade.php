@extends('layouts.backend')
@section('title','SubCategory Create')

@section('styles')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sub Category Add</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sub Category Add</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <form action="{{ route('backend.sub_category.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <section class="content">
                <div class="row">
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Category create</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @error('parent_category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Category Name</label>
                                    <select class="custom-select rounded-0" name="parent_category_id" id="exampleSelectRounded0">
                                        @foreach($categories as $category)
                                            <option value="<?=$category->id?>"><?=$category->category_name?></option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Sub Category Name</label>
                                    <input type="text" id="inputName"  name="name" class="form-control">
                                </div>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">İmage</label>
                                    <input type="file" id="inputName"  name="image" class="form-control">
                                </div>
                                @error('is_set')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Set</label>
                                    <select class="custom-select rounded-0" name="is_set" id="exampleSelectRounded0">
                                        <option value="1">yes</option>
                                        <option value="0">no</option>
                                    </select>
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
                        <input type="submit" value="Create new Sub Category" class="btn btn-success float-right">
                    </div>
                </div>
            </section>
        <!-- /.content -->
        </form>
    </div>
@endsection

@section('scripts')
@endsection
