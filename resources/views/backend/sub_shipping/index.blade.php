@extends('layouts.backend')
@section('title','Shipping country')
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
                        <h1>Shippings country</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Shippings country</li>
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
                                <a class="btn btn-success" href="{{ route('backend.sub_shipping.create') }}">Create</a>
                                @endif
                            </div>
                            @include('backend.includes.success')                        <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Shipping State Name</th>
                                        <th>Shipping Country Name</th>
                                        <th>Slug</th>
                                        <th>Postal Code</th>
                                        <th>Shipping Price</th>
                                        <th>Shipping is work</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>islem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_shippings as $sub_shipping)
                                    <tr>
                                        <td>{{ $sub_shipping->id }}</td>
                                        <td>{{ $sub_shipping->shipping_name }}</td>
                                        <td>{{ $sub_shipping->sub_shipping_name }}</td>
                                        <td>{{ $sub_shipping->sub_slug }}</td>
                                        <td>{{ $sub_shipping->sub_postal_code }}</td>
                                        <td>{{ $sub_shipping->sub_shipping_price }}</td>
                                        <td>{{ $sub_shipping->sub_is_work }}</td>
                                        <td>{{ $sub_shipping->created_at }}</td>
                                        <td>{{ $sub_shipping->updated_at }}</td>
                                        <td>
                                            @if(auth('admin')->user()->permissions->update==3)
                                            <a class="btn btn-warning" href="{{ route('backend.sub_shipping.edit', [$sub_shipping->sub_slug]) }}" ><i class="fas fa-edit">&nbsp;Edit</i></a>&nbsp;&nbsp;
                                            @endif
                                                @if(auth('admin')->user()->permissions->delete==4)
                                            <form action="{{ route('backend.sub_shipping.destroy' ,$sub_shipping->sub_slug) }}" method="POST">
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
                                        <th>Shipping State Name</th>
                                        <th>Shipping Country Name</th>
                                        <th>Slug</th>
                                        <th>Postal Code</th>
                                        <th>Shipping Price</th>
                                        <th>Shipping is work</th>
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
    <script src="<?=asset('backend/dist/js/adminlte.min.js')?>"></script>

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
