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
