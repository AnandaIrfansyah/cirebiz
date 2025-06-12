<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ Request::is('pages.admin.welcome') ? 'active' : '' }}">
                <a href="{{ route('pages.admin.welcome') }}" class="nav-link">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="menu-header">Data Pengguna</li>
            <li class="nav-item {{ Request::is('approvedumkm') ? 'active' : '' }}">
                <a href="{{ url('approvedumkm') }}" class="nav-link">
                    <i class="fas fa-check-circle"></i> <span>Approved UMKM</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('accountuser') ? 'active' : '' }}">
                <a href="{{ url('accountuser') }}" class="nav-link">
                    <i class="fas fa-users"></i> <span>Data Pengguna</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-menu">
            <li class="menu-header">Pengelolaan Data</li>
            <li class="nav-item {{ Request::is('kategori') ? 'active' : '' }}">
                <a href="{{ url('kategori') }}" class="nav-link">
                    <i class="fas fa-tags"></i> <span>Data Kategori</span>
                </a>
            </li>
        </ul>

    </aside>
</div>
