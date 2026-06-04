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

    <div class="sidebar-heading">Interface</div>

    <li class="nav-item {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.blog.index') }}">
            <i class="fas fa-fw fa-blog"></i>
            <span>Blog</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Template & Tools</div>

    <li class="nav-item {{ request()->routeIs('admin.cv.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.cv.index') }}">
            <i class="fas fa-fw fa-file-invoice"></i>
            <span>CV</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.tulis.tangan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.tulis.tangan') }}">
            <i class="fas fa-fw fa-pen-nib"></i>
            <span>Tulisan Tangan</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.downloads.analytic') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.downloads.analytic') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Analitik Dokumen</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.loker.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.loker.index') }}">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Loker Index</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Affiliate</div>

    @php
        $isAffiliateActive =
            request()->routeIs('admin.platforms.*') ||
            request()->routeIs('admin.categories.*') ||
            request()->routeIs('admin.affiliate-ads.*');
    @endphp

    <li class="nav-item {{ $isAffiliateActive ? 'active' : '' }}">
        <a class="nav-link {{ $isAffiliateActive ? '' : 'collapsed' }}" href="#" data-toggle="collapse"
            data-target="#collapseAffiliate" aria-expanded="{{ $isAffiliateActive ? 'true' : 'false' }}"
            aria-controls="collapseAffiliate">
            <i class="fas fa-fw fa-share-alt"></i>
            <span>Iklan Affiliate</span>
        </a>
        <div id="collapseAffiliate" class="collapse {{ $isAffiliateActive ? 'show' : '' }}"
            aria-labelledby="headingAffiliate" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manajemen Link:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.affiliate-ads.*') ? 'active' : '' }}"
                    href="{{ route('admin.affiliate-ads.index') }}">Data Iklan</a>
                <a class="collapse-item {{ request()->routeIs('admin.platforms.*') ? 'active' : '' }}"
                    href="{{ route('admin.platforms.index') }}">Platform</a>
                <a class="collapse-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                    href="{{ route('admin.categories.index') }}">Kategori</a>
                <a class="collapse-item {{ request()->routeIs('admin.affiliate.analytic') ? 'active' : '' }}"
                    href="{{ route('admin.affiliate.analytic') }}">Analytic</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
