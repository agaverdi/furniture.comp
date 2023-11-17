@extends('layouts.backend')
@section('title','Product')
@section('styles')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="<?=asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="<?=asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                @if(auth('admin')->user()->permissions->create==2)
                                    <a class="btn btn-success" href="{{ route('backend.product.create') }}">Create</a>
                                @endif
                            </div>
                            @include('backend.includes.success')
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Product Name</th>
                                        <th>Slug</th>
                                        <th>Category Name</th>
                                        <th>Sub Category Name</th>
                                        <th>Image 1</th>
                                        <th>Image 2</th>
                                        <th>Image 3</th>
                                        <th>Image 4</th>
                                        <th>Image 5</th>
                                        <th>Image 6</th>
                                        <th>Price</th>
                                        <th>Discount Price</th>
                                        <th>Stars</th>
                                        <th>Is stock</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>islem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->slug }}</td>
                                            <td>{{ $product->category_name }}</td>
                                            <td>{{ $product->sub_category_name }}</td>
                                            <td><img width="80" height="100" src="{{ asset($product->path1) }}" alt=""></td>
                                            @for ($i = 2; $i <= 6; $i++)
                                                <td>{!! isset($product->{'path'.$i}) ? "<img width='80' height='100' src='".asset($product->{'path'.$i})."' alt='photo'>" : 'bosh' !!}</td>
                                            @endfor
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->discount_price }} ₼</td>
                                            <td>{{ $product->stars }}</td>
                                            <td>{{ $product->is_stock==1? "yes":"no" }}</td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>{{ $product->updated_at }}</td>
                                            <td>
                                                @if(auth('admin')->user()->permissions->update==3)
                                                <a class="btn btn-warning" href="{{ route('backend.product.edit', $product->slug) }}" ><i class="fas fa-edit">&nbsp;Edit</i></a>&nbsp;&nbsp;
                                                @endif
                                                    @if(auth('admin')->user()->permissions->delete==4)
                                                        <form action="{{ route('backend.product.destroy', $product->slug) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash">&nbsp;Delete</i></button>
                                                        </form>
                                                    @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>id</th>
                                        <th>Product Name</th>
                                        <th>Slug</th>
                                        <th>Category Name</th>
                                        <th>Sub Category Name</th>
                                        <th>Image 1</th>
                                        <th>Image 2</th>
                                        <th>Image 3</th>
                                        <th>Image 4</th>
                                        <th>Image 5</th>
                                        <th>Image 6</th>
                                        <th>Price</th>
                                        <th>Discount Price</th>
                                        <th>Stars</th>
                                        <th>Is stock</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>islem</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('scripts')
    <script>
        // Set the alert to automatically close after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            $('#autoCloseAlert').alert('close');
        }, 3000);
    </script>
    <script src="<?=asset('backend/plugins/jquery/jquery.min.js')?>"></script>
    <script src="<?=asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?=asset('backend/plugins/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?=asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?=asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
    <script src="<?=asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
    <script src="<?=asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
    <script src="<?=asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
    <script src="<?=asset('backend/plugins/jszip/jszip.min.js')?>"></script>
    <script src="<?=asset('backend/plugins/pdfmake/pdfmake.min.js')?>"></script>
    <script src="<?=asset('backend/plugins/pdfmake/vfs_fonts.js')?>"></script>
    <script src="<?=asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
    <script src="<?=asset('backend/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
    <script src="<?=asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script>
    <!-- AdminLTE App -->
    <!--bunu aciq qoyanda baglanmir sidebar-->
    {{--<script src="<?=asset('backend/dist/js/adminlte.min.js')?>"></script>--}}

    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
