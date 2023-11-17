@extends('layouts.backend')
@section('title','Edit Permission User')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Permission User</h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.permission.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Permission User</li>

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <form action="{{ route('backend.permission.update', $permission->user_id) }}" method="post">
            @csrf
            @method('PUT')
            <section class="content">
                <div class="row">
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-8">
                        @include('backend.includes.danger')
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                            </div>

                            <div class="card-body ">
                                <div class="form-group d-flex flex-column  align-items-center ">
                                    <div class="form-control text-center font-weight-bold btn btn-success w-25">{{ ucfirst($permission->user->name) }}</div>
                                        <hr>
                                    <div class="form-control text-center font-weight-bold btn btn-success w-25">{{ucfirst($permission->user->email)}}</div>

                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="create" type="checkbox" role="switch" id="flexSwitchCheckCheckedCreate" {{ $permission->create==2?"checked":"" }}>
                                        <label class="form-check-label" for="flexSwitchCheckCheckedCreate">Create </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="read" type="checkbox" role="switch" id="flexSwitchCheckCheckedRead" {{ $permission->read==1?"checked":"" }}>
                                        <label class="form-check-label" for="flexSwitchCheckCheckedRead">Read  </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="update"  type="checkbox" role="switch" id="flexSwitchCheckCheckedUpdate" {{ $permission->update == 3 ? "checked" : "" }}>
                                        <label class="form-check-label" for="flexSwitchCheckCheckedUpdate">Update</label>
                                    </div>
                                </div>
                                @if(auth('admin')->user()->is_admin==4)
                                    <div class="form-group">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="delete"  type="checkbox" role="switch" id="flexSwitchCheckCheckedDelete" {{ $permission->delete==4?"checked":"" }}>
                                            <label class="form-check-label" for="flexSwitchCheckCheckedDelete">Delete</label>
                                        </div>
                                    </div>
                                @endif


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
                        <a href="{{ route('backend.permission.index') }}" class="btn btn-secondary">Cancel</a>
                        <input type="submit" value="Edit Permission User" class="btn btn-success float-right">
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </form>
    </div>
@endsection

@section('scripts')
@endsection
