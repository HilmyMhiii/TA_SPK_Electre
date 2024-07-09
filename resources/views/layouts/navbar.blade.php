<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="/">
            <img src="{{ asset('assets/images/logo_spk_electre.png') }}" alt="logo" class="img-fluid">
        </a>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome {{ Auth::user()->name }}!</h5>
        <ul class="navbar-nav navbar-nav-right">
            {{-- <form class="search-form d-none d-md-block" action="#">
                <i class="icon-magnifier"></i>
                <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form> --}}

            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img class="img-xs rounded-circle ms-2" src="{{ asset('assets/images/user-1.png') }}"
                        alt="Profile image"> <span class="font-weight-normal">{{ auth()->user()->name }}</span></a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header">
                        <p class="mb-1 mt-3">{{ auth()->user()->name }}</p>
                        <p class="font-weight-light text-muted mb-0">{{ auth()->user()->email }}</p>
                    </div>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                            class="dropdown-item-icon icon-user text-primary"></i> My Profile</a>
                    <a href="#" class="dropdown-item has-icon text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
