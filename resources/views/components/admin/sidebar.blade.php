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
            <li class="nav-item">
                <a href="{{ route('pages.admin.welcome') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">Data Pengguna</li>
            <li class="nav-item">
                <a href="{{ url('approvedumkm') }}" class="nav-link"><i class="fas fa-fire"></i><span>Approved
                        UMKM</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ url('accountuser') }}" class="nav-link"><i class="fas fa-fire"></i><span>Data User</span></a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">Pengelolaan Data</li>
            <li class="nav-item">
                <a href="{{ url('kategori') }}" class="nav-link"><i class="fas fa-fire"></i><span>Data
                        Kategori</span></a>
            </li>
        </ul>

    </aside>
</div>
