@extends('layouts.backend')
@section('title','Sub Shipping Create')

@section('styles')

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sub Shipping Add</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sub Shipping Add</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <form action="{{ route('backend.sub_shipping.store') }}" method="post">
            @csrf
            <section class="content">
                <div class="row">
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Shipping create</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @error('parent_shipping_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Shipping State Name</label>
                                    <select class="custom-select rounded-0" name="parent_shipping_id" id="exampleSelectRounded0">
                                        @foreach($shippings as $shipping)
                                            <option value="<?=$shipping->id?>"><?=$shipping->shipping_name?></option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Shipping Country Name</label>
                                    <input type="text" id="inputName" value="{{ old('name') }}"  name="name" class="form-control">
                                </div>
                                @error('postal_code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Shipping postal_code</label>
                                    <input type="text" id="inputName"  name="postal_code" value="{{ old('postal_code') }}" class="form-control">
                                </div>
                                @error('shipping_price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Shipping price</label>
                                    <input  type="number" id="inputName" step="any"  value="{{ old('shipping_price') }}" name="shipping_price" class="form-control price-enabled">
                                </div>
                                @error('is_work')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Is Work</label>
                                    <select class="custom-select rounded-0" name="is_work" id="exampleSelectRounded0">
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
                        <a href="{{ route('backend.shipping.index') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Create new Sub Shipping" class="btn btn-success float-right">
                    </div>
                </div>
            </section>
        <!-- /.content -->
        </form>
    </div>
@endsection

@section('scripts')
@endsection
