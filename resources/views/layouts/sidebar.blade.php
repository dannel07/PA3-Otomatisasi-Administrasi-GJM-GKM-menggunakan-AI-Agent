<aside class="sidebar bg-primary text-white">
    <div class="sidebar-header p-4 border-bottom border-primary-subtle">
        <div class="d-flex align-items-center mb-3">
            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <i class="bi bi-person-fill text-primary"></i>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->nama_user }}</h6>
                @if(auth()->user()->isGKM())
                    <small class="text-primary-subtle">GKM {{ auth()->user()->dosen->prodi->nama_prodi ?? 'Prodi' }}</small>
                @elseif(auth()->user()->isGJM())
                    <small class="text-primary-subtle">GJM Fakultas Vokasi</small>
                @endif
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        @if(auth()->user()->isGKM())
            <a href="{{ route('gkm.dashboard') }}" class="nav-link @if(request()->routeIs('gkm.dashboard')) active @endif">
                <i class="bi bi-house-door"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('gkm.data-master.index') }}" class="nav-link @if(request()->routeIs('gkm.data-master.*')) active @endif">
                <i class="bi bi-file-earmark-text"></i> <span>Data Master</span>
            </a>
            <a href="{{ route('gkm.monitoring-rps.index') }}" class="nav-link @if(request()->routeIs('gkm.monitoring-rps.*')) active @endif">
                <i class="bi bi-clipboard-check"></i> <span>Monitoring RPS</span>
            </a>
            <a href="{{ route('gkm.monitoring-perkuliahan.index') }}" class="nav-link @if(request()->routeIs('gkm.monitoring-perkuliahan.*')) active @endif">
                <i class="bi bi-bell"></i> <span>Monitoring Perkuliahan</span>
            </a>
            <a href="{{ route('gkm.pelaporan.index') }}" class="nav-link @if(request()->routeIs('gkm.pelaporan.*')) active @endif">
                <i class="bi bi-graph-up"></i> <span>Pelaporan</span>
            </a>
            <a href="{{ route('gkm.reminder-agent.index') }}" class="nav-link @if(request()->routeIs('gkm.reminder-agent.*')) active @endif">
                <i class="bi bi-robot"></i> <span>Reminder Agent</span>
            </a>
        @elseif(auth()->user()->isGJM())
            <a href="{{ route('gjm.dashboard') }}" class="nav-link @if(request()->routeIs('gjm.dashboard')) active @endif">
                <i class="bi bi-house-door"></i> <span>Dashboard</span>
            </a>
            <a href="{{ route('gjm.recap.index') }}" class="nav-link @if(request()->routeIs('gjm.recap.*')) active @endif">
                <i class="bi bi-graph-up"></i> <span>Rekap Laporan</span>
            </a>
            <a href="{{ route('gjm.validasi.index') }}" class="nav-link @if(request()->routeIs('gjm.validasi.*')) active @endif">
                <i class="bi bi-check2-circle"></i> <span>Validasi Laporan</span>
            </a>
            <a href="{{ route('gjm.laporan.index') }}" class="nav-link @if(request()->routeIs('gjm.laporan.*')) active @endif">
                <i class="bi bi-file-earmark-pdf"></i> <span>Laporan GJM</span>
            </a>
        @endif
    </nav>

    <div class="sidebar-footer p-4 mt-auto border-top border-primary-subtle">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</aside>

<style>
.sidebar {
    width: 250px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.sidebar-nav {
    flex: 1;
    padding: 1rem 0;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.5rem;
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.nav-link:hover {
    color: white;
    background-color: rgba(255, 255, 255, 0.1);
}

.nav-link.active {
    color: white;
    background-color: rgba(255, 255, 255, 0.15);
    border-left-color: white;
}

.nav-link i {
    font-size: 1.25rem;
}
</style>
