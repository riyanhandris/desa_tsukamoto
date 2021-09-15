<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sistem <sup>Rekomendasi</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="{{ request()->is('dashboard') ? 'nav-item active' : 'nav-item' }}">
        <a href="/dashboard" class="nav-link">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        DATA
    </div>

 <!-- Nav Item - Data Warga -->
 <li class="{{ request()->is('warga') ? 'nav-item active' : 'nav-item' }}">
    <a class="nav-link" href="{{ route('warga') }}">
        <i class="fas fa-user-friends nav-icon"></i>
        <span>Data Warga</span></a>
</li>

<!-- Nav Item - Data Kriteria -->
<li class="{{ request()->is('kriteria') ? 'nav-item active' : 'nav-item' }}">
    <a class="nav-link" href="{{ route('kriteria') }}">
        <i class="fas fa-fw fa-chart-area nav-icon"></i>
        <span>Data Kriteria</span></a>
</li>

<!-- Nav Item - Data Petugas -->
@if (Auth()->user()->id==2)
<li class="{{ request()->is('petugas') ? 'nav-item active' : 'nav-item' }}">
    <a class="nav-link" href="{{ route('petugas') }}">
        <i class="fas fa-chalkboard-teacher nav-icon"></i>
        <span>Data Petugas</span></a>
</li>    
@endif


<!-- Nav Item - Penilaian -->
<li class="{{ request()->is('penilaian') ? 'nav-item active' : 'nav-item' }}">
    <a class="nav-link" href="{{ route('nilai') }}">
        <i class="fas fa-pencil-alt nav-icon"></i>
        <span>Penilaian</span></a>
</li>


    <!-- Divider -->
    <hr class="sidebar-divider">

   
    @if (Auth()->user()->id==2)
     <!-- Heading -->
     <div class="sidebar-heading">
        HASIL
    </div>
    <!-- Nav Item - Rekomendasi -->
    <li class="{{ request()->is('rekomendasi') ? 'nav-item active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('rekomendasi') }}">
        <i class="fa fa-book nav-icon"></i>
        <span>Rekomendasi</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    @endif
    

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>