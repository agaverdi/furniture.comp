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
                        <h1>Edit Sub Shipping</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Sub Shipping</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <form action="{{ route('backend.sub_shipping.update', $sub_shipping->slug) }}" method="post" enctype="multipart/form-data">
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
                                @error('parent_shipping_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Shipping Name</label>
                                    <select class="custom-select rounded-0" name="parent_shipping_id" id="exampleSelectRounded0">
                                        @foreach($shippings as $shipping)
                                            <option value="<?=$shipping->id?>"  <?php echo $shipping->id==$sub_shipping->parent_shipping_id ?"selected":"" ?> ><?=$shipping->shipping_name?></option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Sub Shipping Name</label>
                                    <input type="text" id="inputName" value="{{ $sub_shipping->shipping_name }}"  name="name" class="form-control">
                                </div>
                                @error('postal_code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Sub Shipping Name</label>
                                    <input type="text" id="inputName" value="{{ $sub_shipping->postal_code }}"  name="postal_code" class="form-control">
                                </div>
                                @error('shipping_price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">

                                    <label for="inputName">Shipping country Price*</label>
                                    <input  type="number" id="inputName" step="any"  value="{{ $sub_shipping->shipping_price }}" name="shipping_price" class="form-control price-enabled">
                                </div>

                                @error('is_work')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Set</label>
                                    <select class="custom-select rounded-0" name="is_work" id="exampleSelectRounded0">
                                        <option value="1" <?php echo $sub_shipping->is_work==1?"selected":""?> >yes</option>
                                        <option value="0" <?php echo $sub_shipping->is_work==0?"selected":""?> >no</option>
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
                        <a href="{{ route('backend.sub_shipping.index') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Edit Sub Shipping" class="btn btn-success float-right">
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </form>
    </div>
@endsection

@section('scripts')
@endsection
