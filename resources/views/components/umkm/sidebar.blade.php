<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('pages.umkm.welcome') }}">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('pages.umkm.welcome') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item">
                <a href="{{ route('pages.umkm.welcome') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">Manajemen Produk</li>
            <li class="nav-item">
                <a href="{{ url('product') }}" class="nav-link">
                    <i class="fas fa-box"></i>
                    <span>Data Produk</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
