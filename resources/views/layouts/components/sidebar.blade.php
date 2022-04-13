<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li id="dashboardLink"><a class="nav-link" href="{{route('home')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>

            <li class="menu-header">Manajemen Data</li>
            <li class="nav-item dropdown" id="masterLink">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li id="jenisBukuLink"><a class="nav-link" href="{{route('jenis_buku.index')}}">Data Jenis Buku</a></li>
                    <li id="bukuLink"><a class="nav-link" href="{{route('buku.index')}}">Data Buku</a></li>
                    <li id="siswaLink"><a class="nav-link" href="{{route('siswa.index')}}">Data Siswa</a></li>
                </ul>
            </li>
           
            <li id="transaksiLink"><a class="nav-link" href="{{route('transaksi.index')}}"><i class="fas fa-recycle"></i> <span>Transaksi</span></a></li>
        </ul>
    </aside>
</div>