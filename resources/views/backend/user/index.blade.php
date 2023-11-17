@extends('layouts.backend')
@section('title','User')
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
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                                {{--<a class="btn btn-success" href="{{ route('backend.user.login') }}">Create</a>--}}
                            </div>
                            @include('backend.includes.success')                        <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>image</th>
                                        <th>position</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        @if(auth('admin')->user()->is_admin)
                                            <th>islem</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                    <tr>

                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <img class="profile-user-img" src="{{ !is_null($user->user_details) && !is_null($user->user_details->image) ? asset($user->user_details->image) : asset('backend/default/user.jpg') }}" alt="image" width="110" height="110" data-toggle="modal" data-target="#exampleModalCenter{{ $user->id }}">
                                        </td>
                                        <td>
                                            @switch($user->is_admin)
                                                @case(1)
                                                    <div class="alert alert-dark text-center h6" role="alert">
                                                        User
                                                    </div>
                                                    @break
                                                @case(2)
                                                    <div class="alert alert-warning text-center h6" role="alert">
                                                        Superuser
                                                    </div>
                                                    @break
                                                @case(3)
                                                    <div class="alert alert-danger  text-center h6" role="alert">
                                                        Admin
                                                    </div>
                                                    @break
                                                @case(4)
                                                    <div class="alert alert-success text-center h6" role="alert">
                                                        SuperAdmin
                                                    </div>
                                                    @break
                                                @default
                                                    <div class="alert alert-secondary text-center h6" role="alert">
                                                        Not Role
                                                    </div>
                                            @endswitch
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        @if(auth('admin')->user()->is_admin)
                                        <td>
                                            @if(auth('admin')->user()->permissions->update==3)
                                            <a class="btn btn-warning" href="{{ route('backend.user.edit', [$user->id]) }}" ><i class="fas fa-edit">&nbsp;Edit</i></a>&nbsp;&nbsp;
                                            @endif
                                                @if(auth('admin')->user()->permissions->delete==4)
                                                <form action="{{ route('backend.user.destroy' ,$user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" onclick="alert('Useri silmek uzeresiz.eminsiniz?')" type="submit"><i class="fa fa-trash">&nbsp;Delete</i></button>
                                            </form>
                                                @endif
                                        </td>
                                        @endif
                                    </tr>
                                    <div class="modal fade" id="exampleModalCenter{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Profile Photo</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img class="profile-user-img img-fluid  w-auto" src="{{ !is_null($user->user_details) && !is_null($user->user_details->image) ? asset($user->user_details->image) : asset('backend/default/user.jpg') }}" alt="">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>image</th>
                                        <th>position</th>
                                        <th>Created</th>
                                        <th>Updated</th>
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
