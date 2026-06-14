<div class="sidebar-heading">Loker</div>

<li class="nav-item {{ request()->routeIs('dashboard.saved-jobs.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.saved-jobs.index') }}">
        <i class="fas fa-fw fa-bookmark"></i>
        <span>Loker Tersimpan</span>
    </a>
</li>
