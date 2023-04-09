<div class="navbar-bg bg-info"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if (auth()->user()->foto)
                    <img alt="image {{ auth()->user()->username }}" src="{{ asset('storage/' . auth()->user()->foto) }}"
                        class="rounded-circle mr-1 ">
                @else
                    <img alt="image {{ auth()->user()->username }}" src="{{ asset('img/avatar/avatar-1.png') }}"
                        class="rounded-circle mr-1 ">
                @endif
                <div class="d-sm-none d-lg-inline-block capitalize">{{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">halo, {{ auth()->user()->name }}</div>
                <a href="/" class="dropdown-item has-icon">
                    <i class="fas fa-home"></i> Beranda
                </a>
                <a href="/profile" class="dropdown-item has-icon">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="/change-password" class="dropdown-item has-icon">
                    <i class="fas fa-key"></i> Ubah Password
                </a>
                <div class="dropdown-divider"></div>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item has-icon text-danger text-center"><a
                            class="dropdown-item has-icon text-danger"><i
                                class="fas fa-sign-out-alt"></i><span>Logout</span></a></button>
                </form>
            </div>
        </li>
    </ul>
</nav>
