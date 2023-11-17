@extends('layouts.backend')
@section('title','SubCategory Edit')

@section('styles')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Sub Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Sub Category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <form action="{{ route('backend.sub_category.update', $sub_category->slug) }}" method="post" enctype="multipart/form-data">
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
                                @error('parent_category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Category Name</label>
                                    <select class="custom-select rounded-0" name="parent_category_id" id="exampleSelectRounded0">
                                        @foreach($categories as $category)
                                            <option value="<?=$category->id?>"  <?php echo $category->id==$sub_category->parent_category_id ?"selected":"" ?> ><?=$category->category_name?></option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Sub Category Name</label>
                                    <input type="text" id="inputName" value="{{ $sub_category->category_name }}"  name="name" class="form-control">
                                </div>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <div class="form-group d-flex flex-column align-items-center mt-3">
                                        <label for="inputName">Sub Category image</label>
                                        <img src="{{ asset($sub_category->image) }}" alt="Category photo" class="profile-user-img img-fluid w-25" >
                                    </div>
                                    <input type="file" id="inputName" value=""  name="image" class="form-control">
                                </div>
                                @error('is_set')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Set</label>
                                    <select class="custom-select rounded-0" name="is_set" id="exampleSelectRounded0">
                                        <option value="1" <?php echo $sub_category->is_set==1?"selected":""?> >yes</option>
                                        <option value="0" <?php echo $sub_category->is_set==0?"selected":""?> >no</option>
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
                        <a href="{{ route('backend.sub_category.index') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Edit Sub Category" class="btn btn-success float-right">
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </form>
    </div>
@endsection

@section('scripts')
@endsection
