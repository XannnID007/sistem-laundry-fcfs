<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="purple">
        <!-- Logo Brand -->
        <a href="{{ route('manajer.dashboard') }}" class="logo">
            <div class="navbar-brand">

                <span class="text-white fw-bold ms-2">RedDoorz Laundry</span>
            </div>
        </a>
        <!-- Navbar Toggler -->
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="purple">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <!-- data user login -->
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="javascript:void(0)"
                        aria-expanded="false">
                        <div class="avatar-sm-top mt-1">
                            <img src="{{ asset('assets/img/avatar-1.png') }}" alt="image profile"
                                class="avatar-img rounded-circle">
                            <i class="fas fa-angle-down avatar-title"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img src="{{ asset('assets/img/avatar-2.png') }}"
                                        alt="image profile" class="avatar-img rounded"></div>
                                <div class="u-text pt-1">
                                    <h4>{{ Auth::user()->username }}</h4>
                                    <p class="text-muted">{{ ucfirst(Auth::user()->role) }}</p>
                                </div>
                            </div>
                        </li>
                        <!-- menu user -->
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user-lock mr-1"></i> Ubah Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalLogout">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
