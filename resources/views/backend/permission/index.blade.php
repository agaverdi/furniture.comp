@extends('layouts.backend')
@section('title','Permissions')
@section('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="<?=asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="<?=asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permissions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Permissions</li>
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

                                @switch( auth('admin')->user()->is_admin)
                                    @case(1)
                                        <div class="alert alert-dark text-center h3" role="alert">
                                             Your Position :  User
                                        </div>
                                        @break
                                    @case(2)
                                        <div class="alert alert-warning text-center h3" role="alert">
                                            Your Position :  Superuser
                                        </div>
                                        @break
                                    @case(3)
                                        <div class="alert alert-danger  text-center h3" role="alert">
                                            Your Position :  Admin
                                        </div>
                                        @break
                                    @case(4)
                                        <div class="alert alert-success text-center h3" role="alert">
                                            Your Position :  SuperAdmin
                                        </div>
                                        @break
                                    @default
                                        <div class="alert alert-secondary text-center h3" role="alert">
                                            Not Role
                                        </div>
                                @endswitch

                            </div>
                            @include('backend.includes.success')
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Create</th>
                                        <th>Read</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                        <th>position</th>
                                        <th>Created</th>
                                        @if(auth('admin')->user()->is_admin)
                                            <th>islem</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($permissions as $permission)
                                    <tr>

                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->user->name }}</td>
                                        <td>{{ $permission->user->email }}</td>
                                        <td>{!! $permission->create==2 ? '<i class="fa-sharp fa-solid fa-square-check fa-2xl fa-beat" style="color: #217d2c;"></i>' : '<i class="fa-sharp fa-solid fa-square-xmark fa-2xl fa-spin" style="color: #da0b0b;"></i>' !!}</td>
                                        <td>{!! $permission->read==1 ? '<i class="fa-sharp fa-solid fa-square-check fa-2xl fa-beat" style="color: #217d2c;"></i>'   : '<i class="fa-sharp fa-solid fa-square-xmark fa-2xl fa-spin" style="color: #da0b0b;"></i>' !!}</td>
                                        <td>{!! $permission->update==3 ? '<i class="fa-sharp fa-solid fa-square-check fa-2xl fa-beat" style="color: #217d2c;"></i>' : '<i class="fa-sharp fa-solid fa-square-xmark fa-2xl fa-spin" style="color: #da0b0b;"></i>' !!}</td>
                                        <td>{!! $permission->delete==4 ? '<i class="fa-sharp fa-solid fa-square-check fa-2xl fa-beat" style="color: #217d2c;"></i>' : '<i class="fa-sharp fa-solid fa-square-xmark fa-2xl fa-spin" style="color: #da0b0b;"></i>' !!}</td>
                                        <td>
                                            @switch($permission->user->is_admin)
                                                @case(1)
                                                    <div class="alert alert-dark" role="alert">
                                                        User
                                                    </div>
                                                    @break
                                                @case(2)
                                                    <div class="alert alert-warning" role="alert">
                                                        Superuser
                                                    </div>
                                                    @break
                                                @case(3)
                                                    <div class="alert alert-danger" role="alert">
                                                        Admin
                                                    </div>
                                                    @break
                                                @case(4)
                                                    <div class="alert alert-success" role="alert">
                                                        SuperAdmin
                                                    </div>
                                                    @break
                                                @default
                                                    <div class="alert alert-secondary " role="alert">
                                                        Not Role
                                                    </div>
                                            @endswitch
                                        </td>
                                        <td>{{ $permission->created_at }}</td>
                                        @if(auth('admin')->user()->permissions->read==1)
                                        <td>
                                            @if(auth('admin')->user()->permissions->update==3)
                                                <a class="btn btn-warning" href="{{ route('backend.permission.edit', [$permission->user_id]) }}" ><i class="fas fa-edit">&nbsp;Edit</i></a>&nbsp;
                                            @endif
                                            &nbsp;@if(auth('admin')->user()->permissions->delete==4)
                                                <form action="{{ route('backend.permission.destroy' ,$permission->user_id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="alert('Istifadəcinin bütün səlahiyyətlərini  silmək üzeresiz .eminsiniz?')" type="submit"><i class="fa fa-trash">&nbsp;Delete</i></button>
                                                </form>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Create</th>
                                        <th>Read</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                        <th>position</th>
                                        <th>Created</th>
                                        @if(auth('admin')->user()->is_admin)
                                            <th>islem</th>
                                        @endif
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
