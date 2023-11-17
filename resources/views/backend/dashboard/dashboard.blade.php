@extends('layouts.backend')
@section('title', 'Admin')

@section('styles')

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $users }}</h3>

                                <p>Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('backend.user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $products }}</h3>

                                <p>Products</p>
                            </div>
                            <div class="icon">
                                <i class="ion  ion-bag"></i>
                            </div>
                            <a href="{{ route('backend.product.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $categories }}</h3>

                                <p>Categories</p>
                            </div>
                            <div class="icon">
                                <i class="ion  ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('backend.category.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $subCategories }}</h3>

                                <p>Sub Category</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('backend.category.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gradient-dark">
                            <div class="inner">
                                <h3>{{ $setProducts }}</h3>

                                <p>Set Products</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-load-d"></i>
                            </div>
                            <a href="{{ route('backend.set_product.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gradient-fuchsia">
                            <div class="inner">
                                <h3>{{ $shipping }}</h3>

                                <p>Shipping</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-cash"></i>
                            </div>
                            <a href="{{ route('backend.shipping.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gradient-indigo">
                            <div class="inner">
                                <h3>{{ $sub_shipping }}</h3>

                                <p>Sub Shipping</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-calculator"></i>
                            </div>
                            <a href="{{ route('backend.sub_shipping.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gradient-orange">
                            <div class="inner">
                                <h3>{{ $contact }}</h3>
                                <p>Contact</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-contrast"></i>
                            </div>
                            <a href="{{ route('backend.contact.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Xeberdarliq</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('backend.includes.success') profiliniz tam hazir deyil . telefon nomresi, profil wekili  ve s. kimi xanalar doldurulmalidir
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">daha sonra etmek</button>
                    <a href="{{ route('backend.user.profile_edit', auth('admin')->id()) }}" class="btn btn-primary" > Profili tamamla</a>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <?php if (auth('admin')->user()->user_details->phone==''  || auth('admin')->user()->user_details->position==''){?>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#exampleModalCenter').modal('show');
        });
    </script>
    <?php
    }?>

@endsection
