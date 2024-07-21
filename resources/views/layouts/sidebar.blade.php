<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item navbar-brand-mini-wrapper mt-3">
            <a class="nav-link navbar-brand" href="/"><img src="{{ asset('assets/images/logorsnuuu.png') }}"
                    alt="logo" width="30" /></a>
        </li>
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{ asset('assets/images/user-1.png') }}"
                        alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name">{{ Auth::user()->name }}</p>
                    <p class="designation">{{ Auth::user()->email }}</p>
                </div>
            </a>
        </li>

        @if (auth()->user()->role == 'admin')
            <li class="nav-item nav-category"><span class="nav-link">Dashboard</span></li>

            <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <span class="menu-title">Dashboard</span>
                    <i class="icon-screen-desktop menu-icon"></i>
                </a>
            </li>

            <li class="nav-item nav-category"><span class="nav-link">Master Data</span></li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('setting-users.index') }}">
                    <span class="menu-title">Setting User</span>
                    <i class="icon-user menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('patients.index') }}">
                    <span class="menu-title">Pasien</span>
                    <i class="icon-people menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('criterias.index') }}">
                    <span class="menu-title">Kriteria</span>
                    <i class="icon-grid menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('subcriterias.index') }}">
                    <span class="menu-title">Sub Kriteria</span>
                    <i class="icon-layers menu-icon"></i>
                </a>
            </li>

            <li class="nav-item nav-category"><span class="nav-link">Perhitungan</span></li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('electre') }}">
                    <span class="menu-title">Electre</span>
                    <i class="icon-calculator menu-icon"></i>
                </a>
            </li>
        @else
            <li class="nav-item nav-category"><span class="nav-link">Data</span></li>
        @endif
    </ul>
</nav>
