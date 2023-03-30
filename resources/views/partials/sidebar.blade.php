<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand logo-sidebar">
            <img src="{{ asset('img/logo 16.png') }}" alt="">
        </div>
        <div class="sidebar-brand sidebar-brand-sm logo-side">
            <img src="{{ asset('img/logo 13.png') }}" alt="">
        </div>
        <ul class="sidebar-menu">
            <li class="{{ $active === 'Dashboard' ? 'active' : '' }}">
                <a href="/wali-dashboard" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            @can('wali')
                <li class="{{ $active === 'Anak' ? 'active' : '' }}">
                    <a href="/anak" class="nav-link"><i class="fas fa-user-graduate"></i><span>Data Siswa</span></a>
                </li>
            @endcan

            @can('administrator')
                <li class="dropdown {{ $active1 === 'users' ? 'active' : '' }} ">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-tie "></i><span>Manajemen
                            Users</span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="nav-link ml-2 {{ $active === 'administrator' ? 'text-info' : '' }}"
                                href="/administrator">Data Administrator</a></li>
                        <li class=""><a class="nav-link ml-2 {{ $active === 'Petugas' ? 'text-info' : '' }}"
                                href="/petugas">
                                Data Petugas</a></li>
                        <li class=""><a class="nav-link ml-2 {{ $active === 'wali-murid' ? 'text-info' : '' }}"
                                href="/wali-murid">
                                Data Wali Murid</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ $active1 === 'siswa' ? 'active' : '' }} ">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-graduate "></i>
                        <span>Manajemen
                            Siswa</span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="nav-link ml-2 {{ $active === 'siswa' ? 'text-info' : '' }}"
                                href="/siswa">Data Siswa</a>
                        </li>
                        <li class=""><a class="nav-link ml-2 {{ $active === 'kelas' ? 'text-info' : '' }}"
                                href="/kelas">Data Kelas</a>
                        </li>
                        <li class=""><a class="nav-link ml-2 {{ $active === 'wali-kelas' ? 'text-info' : '' }}"
                                href="/wali-kelas">Data Wali Kelas</a>
                        </li>
                        <li class=""><a
                                class="nav-link ml-2 {{ $active === 'konsentrasi-keahlian' ? 'text-info' : '' }}"
                                href="/konsentrasi-keahlian">Data Jurusan</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown {{ $active1 === 'pembayaran' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-credit-card "></i>
                        <span>Pembayaran</span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a
                                class="nav-link ml-2 {{ $active === 'transaksi-pembayaran' ? 'text-info' : '' }}"
                                href="/pembayaran/create">Transaksi Pembayaran </a>
                        </li>
                        <li class=""><a class="nav-link ml-2 {{ $active === 'pembayaran' ? 'text-info' : '' }}"
                                href="/pembayaran">Data Pembayaran </a>
                        </li>
                        <li class=""><a class="nav-link ml-2 {{ $active === 'biaya' ? 'text-info' : '' }}"
                                href="/biaya">Jenis Pembayaran </a>
                        </li>
                        <li class=""><a class="nav-link ml-2 {{ $active === 'tagihan' ? 'text-info' : '' }}"
                                href="/tagihan">Data Tagihan</a>
                        </li>
                    </ul>
                </li>
            @endcan
        </ul>
    </aside>
</div>
