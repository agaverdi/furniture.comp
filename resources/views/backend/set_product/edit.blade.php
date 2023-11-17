@extends('layouts.backend')
@section('title','Set product Edit')

@section('styles')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Set product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Set product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->

        <form action="{{ route('backend.set_product.update', $set_product->set_slug) }}" method="post">
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

                                @error('set_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Set Name</label>
                                    <input type="text" id="inputName" value="{{ $set_product->set_name }}"  name="set_name" class="form-control">
                                </div>
                                @error('set_price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Set price</label>
                                    <input type="text" id="inputName" value="{{ $set_product->set_price }}"  name="set_price" class="form-control">
                                </div>
                                @error('count')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Set count</label>
                                    <input type="text" id="inputName" value="{{ $set_product->count }}"  name="count" class="form-control">
                                </div>
                                @error('set_discount')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="inputName">Set discount</label>
                                    <input type="text" id="inputName" value="{{ $set_product->set_discount }}"  name="set_discount" class="form-control">
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
                        <a href="{{ route('backend.set_product.index') }}" class="btn btn-secondary">Cancel</a>
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
