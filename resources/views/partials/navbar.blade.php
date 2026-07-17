<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-3">

    <!-- Tombol Sidebar -->
    <button class="btn btn-outline-dark me-3" id="toggleSidebar">
        <i class="bi bi-list fs-4"></i>
    </button>

    <!-- Judul -->
    <h4 class="mb-0 fw-bold text-dark">
        GS ADMIN
    </h4>

    <!-- Search -->
    <form class="d-none d-md-flex ms-4" style="width:350px;">
        <div class="input-group">

            <span class="input-group-text bg-light border-end-0">
                <i class="bi bi-search"></i>
            </span>

            <input
                type="text"
                class="form-control border-start-0"
                placeholder="Cari data...">

        </div>
    </form>
    <!-- Bagian Kanan -->
    <div class="ms-auto d-flex align-items-center">
        <!-- Jam -->
        <div class="me-4 text-end">
            <small class="text-muted">
                <span id="tanggal"></span>
            </small>
            <br>
            <strong id="jam"></strong>
        </div>
        <!-- Notifikasi -->
        <div class="dropdown me-4">
            <button class="btn btn-light position-relative" data-bs-toggle="dropdown">
                <i class="bi bi-bell-fill fs-5"></i>
                @if($jumlahNotifikasi > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $jumlahNotifikasi }}
                </span>
                @endif
            </button>
            <div class="dropdown-menu dropdown-menu-end shadow p-0" style="width:370px;border-radius:15px;overflow:hidden;">
                <div class="bg-primary text-white p-3">
                    <h6 class="mb-0">
                        🔔 Notifikasi
                    </h6>
                    <small>
                        {{ $jumlahNotifikasi }} Notifikasi
                    </small>
                </div>
                <div style="max-height:350px;overflow-y:auto;">
                    @forelse($notifikasi as $item)
                    <a href="{{ $item['link'] }}" class="dropdown-item py-3 border-bottom">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="bi {{ $item['icon'] }} fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-bold">
                                    {{ $item['judul'] }}
                                </div>
                                <small class="text-muted">
                                    {{ $item['pesan'] }}
                                </small>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="text-center p-4 text-muted">
                        <i class="bi bi-bell-slash fs-1"></i>
                        <br>
                        Tidak ada notifikasi
                    </div>
                    @endforelse
                </div>
                <div class="text-center border-top">
                    <a href="{{ route('laporan.dashboard') }}" class="dropdown-item fw-bold text-primary">
                        Lihat Semua
                    </a>
                </div>
            </div>
        </div>
        <!-- Profil -->
        <div class="dropdown">
            <button class="btn btn-light d-flex align-items-center" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name=Admin&background=7c3aed&color=fff" class="rounded-circle me-2" width="40" height="40">
                <div class="text-start">
                    <strong>Admin</strong>
                    <br>
                    <small class="text-muted">
                        Administrator
                    </small>
                </div>
                <i class="bi bi-chevron-down ms-3"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li>
                    <a class="dropdown-item" href="{{ route('profil.index') }}">
                        <i class="bi bi-person-circle"></i>
                        Profil Saya
                    </a>
                </li>
                <!-- <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-gear"></i>
                        Pengaturan
                    </a>
                </li> -->
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="/">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
function updateClock(){
    const now = new Date();
    document.getElementById('jam').innerHTML =
        now.toLocaleTimeString('id-ID');
    document.getElementById('tanggal').innerHTML =
        now.toLocaleDateString('id-ID',{
            weekday:'long',
            day:'numeric',
            month:'long',
            year:'numeric'
        });
}

setInterval(updateClock,1000);
updateClock();
</script>