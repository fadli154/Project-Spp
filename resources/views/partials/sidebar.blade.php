<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">e-spp</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <img src="{{ asset('img/logo-spp.webp') }}" alt="">
        </div>
        <ul class="sidebar-menu">
            <li class="{{ $active === 'Dashboard' ? 'active' : '' }}">
                <a href="/dashboard" class="nav-link"><i class="icon fas bi-speedometer2"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown {{ $active === 'Petugas' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="icon fas bi-person-lines-fill"></i><span>Manajemen
                        Users</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="/petugas">Petugas</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="icon fas bi-person-badge"></i><span>Manajemen
                        Siswa</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="index-0.html">Dashboard</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
