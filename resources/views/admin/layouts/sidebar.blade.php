<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center text-decoration-none" href="/">
        <div class="sidebar-brand-icon">
            <div
                class="bg-primary p-2 rounded shadow-sm d-flex align-items-center justify-content-center brand-logo-box">
                <svg class="text-white" style="width: 24px; height: 24px;" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
            </div>
        </div>
        <div class="sidebar-brand-text mx-3">
            <span class="font-weight-bold text-dark" style="font-size: 1.2rem; letter-spacing: -0.5px;">
                Gawe<span class="text-white">Dokumen</span>
            </span>
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    @can('isAdmin')
        @include('admin.layouts.sidebarAdmin')
    @else
        @include('admin.layouts.sidebarUser')
    @endcan

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
