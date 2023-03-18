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
                <a href="/dashboard" class="nav-link"><i
                        class="icon bi bi-speedometer2 ml-1"></i><span>Dashboard</span></a>
            </li>
            <li
                class="dropdown {{ $active === 'Petugas' ? 'active' : '' }} {{ $active === 'administrator' ? 'active' : '' }} {{ $active === 'wali-murid' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="icon bi bi-people ml-1"></i><span>Manajemen
                        Users</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $active === 'administrator' ? 'active' : '' }}"><a class="nav-link ml-2"
                            href="/administrator"> Administrator</a></li>
                    <li class="{{ $active === 'Petugas' ? 'active' : '' }}"><a class="nav-link ml-2" href="/petugas">
                            Petugas</a></li>
                    <li class="{{ $active === 'wali-murid' ? 'active' : '' }}"><a class="nav-link ml-2"
                            href="/wali-murid">
                            Wali Murid</a></li>
                </ul>
            </li>
            <li class="dropdown {{ $active === 'siswa' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="icon bi bi-person-badge ml-1"></i><span>Manajemen
                        Siswa</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $active === 'siswa' ? 'active' : '' }}"><a class="nav-link ml-2"
                            href="/siswa">siswa</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
