@extends('layouts.backend')
@section('title','Shipping Edit')

@section('styles')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Shipping</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.shipping.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Shipping</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
        <!-- Main content -->
        <form action="{{ route('backend.shipping.update', $shipping->slug) }}" method="post" enctype="multipart/form-data">
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
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Shipping Name</label>
                                    <input type="text" id="inputName" value="{{ $shipping->shipping_name }}"  name="name" class="form-control">
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
                        <a href="{{ route('backend.shipping.index') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Edit Shipping" class="btn btn-success float-right">
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
