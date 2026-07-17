<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="logo">
        <img src="{{ asset('images/logo.jpeg') }}"
            alt="Logo"
            class="logo-img">
        <span class="logo-text">Geulis Sandhangan</span>
    </div>
    <!-- Menu -->
    <ul class="menu">
        <li>
            <a href="/DashboardAdmin" class="{{ request()->is('DashboardAdmin') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('produk.index') }}" class="{{ request()->is('produk*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Produk</span>
            </a>
        </li>
        <li>
            <a href="{{ route('kategori.index') }}" class="{{ request()->is('kategori*') ? 'active' : '' }}">
                <i class="bi bi-tags-fill"></i>
                <span>Kategori</span>
            </a>
        </li>
        <li>
            <a href="{{ route('stok.admin') }}" class="{{ request()->is('admin/stok') ? 'active' : '' }}">
                <i class="bi bi-boxes"></i>
                <span>Stok</span>
            </a>
        </li>
        <!-- <li>
            <a href="{{ route('pelanggan.index') }}"
                class="{{ request()->is('pelanggan*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Pelanggan</span>
            </a>
        </li> -->
        <li>
            <a href="{{ route('pesanan.index') }}" class="{{ request()->is('pesanan*') ? 'active' : '' }}">
                <i class="bi bi-cart-fill"></i>
                <span>Pesanan</span>
            </a>
        </li>
        <li>
            <a href="{{ route('transaksi.laporan') }}" class="{{ request()->is('laporan-transaksi*') ? 'active' : '' }}">
                <i class="bi bi-cash-stack"></i>
                <span>Transaksi</span>
            </a>
        </li>
        <li>
            <a href="{{ route('laporan.dashboard') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph-fill"></i>
                <span>Laporan</span>
            </a>
        </li>
    </ul>
    <!-- Footer Sidebar -->
    <!-- <div class="sidebar-footer">
        <a href="/" class="logout">
            <i class="bi bi-box-arrow-left"></i>
            <span>Keluar</span>
        </a>
    </div> -->
</div>