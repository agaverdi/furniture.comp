<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('backend.dashboard') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('frontend.index') }}" class="nav-link">Furniture Home</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            @switch($is_admin)
                @case(1)
                    <div class="alert alert-dark text-center h6" role="alert">
                        Your Position :  User
                    </div>
                    @break
                @case(2)
                    <div class="alert alert-warning text-center h6" role="alert">
                        Your Position :  Superuser
                    </div>
                    @break
                @case(3)
                    <div class="alert alert-danger  text-center h6" role="alert">
                        Your Position :  Admin
                    </div>
                    @break
                @case(4)
                    <div class="alert alert-success text-center h6" role="alert">
                        Your Position :  SuperAdmin
                    </div>
                    @break
                @default
                    <div class="alert alert-secondary text-center h6" role="alert">
                        Not Role
                    </div>
            @endswitch
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->


        <!-- Messages Dropdown Menu -->

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <form action="{{ route('backend.user.logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger pl-2" type="submit">Logout</button>
            </form>
        </li>
    </ul>
</nav>
