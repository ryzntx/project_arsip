<div class="sticky">
    <div class="main-menu main-sidebar main-sidebar-sticky side-menu">
        <div class="main-sidebar-header main-container-1 active">
            <div class="sidemenu-logo">
                <a class="main-logo" href="#">
                    <img src="{{ asset('template') }}/img/brand/logo-light.png" class="header-brand-img desktop-logo"
                        alt="logo">
                    <img src="{{ asset('template') }}/img/brand/icon-light.png" class="header-brand-img icon-logo"
                        alt="logo">
                    <img src="{{ asset('template') }}/img/brand/logo.png"
                        class="header-brand-img desktop-logo theme-logo" alt="logo">
                    <img src="{{ asset('template') }}/img/brand/icon.png" class="header-brand-img icon-logo theme-logo"
                        alt="logo">
                </a>
            </div>
            <div class="main-sidebar-body main-body-1">
                <div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
                <ul class="menu-nav nav">
                    <li class="nav-header"><span class="nav-label">Dashboard</span></li>
                    @if (auth()->user()->role=='admin')
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-home sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pencarian">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class=" sidemenu-icon ti-search "></i>
                            <span class="sidemenu-label">Pencarian Dokumen</span>
                        </a>
                    </li>
                    <li class="nav-header"><span class="nav-label">Data Master</span></li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/kelola_user">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="sidemenu-icon fe fe-users "></i>
                            <span class="sidemenu-label">Kelola Data User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/kelola_instansi">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="sidemenu-icon fas fa-building"></i>
                            <span class="sidemenu-label">Kelola Data Instansi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/kelola_kategori">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="sidemenu-icon fe fe-bookmark "></i>
                            <span class="sidemenu-label">Kelola Kategori Dokumen</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/template_dokumen">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="sidemenu-icon fe fe-file-text "></i>
                            <span class="sidemenu-label">Kelola Template Dokumen</span>
                        </a>
                    </li>
                    <li class="nav-header"><span class="nav-label">Kelola Arsip</span></li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/tambah_dokumen">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="sidemenu-icon fe fe-file-plus"></i>
                            <span class="sidemenu-label">Tambah Dokumen</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/arsip_masuk">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="sidemenu-icon fe fe-arrow-down-right "></i>
                            <span class="sidemenu-label">Arsip Dokumen Masuk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/arsip_keluar">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="sidemenu-icon fe fe-arrow-up-left "></i>
                            <span class="sidemenu-label">Arsip Dokumen Keluar</span>
                        </a>
                    </li>
                    <li class="nav-header"><span class="nav-label">Laporan</span></li>
                    <li class="nav-item">
                        <a class="nav-link with-sub" href="/admin/rekap_dokumen">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="sidemenu-icon fas fa-book "></i>
                            <span class="sidemenu-label">Rekap Dokumen
                            </span>
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="/pimpinan/dashboard">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-home sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pencarian">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-search sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">Pencarian Dokumen</span>
                        </a>
                    </li>
                    <li class="nav-header"><span class="nav-label">Data Master</span></li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pimpinan/arsipMasuk">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-home sidemenu-icon fe fe-arrow-down-right "></i>
                            <span class="sidemenu-label">Arsip Dokumen Masuk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pimpinan/arsipKeluar">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-home sidemenu-icon fe fe-arrow-up-left "></i>
                            <span class="sidemenu-label">Arsip Dokumen Keluar</span>
                        </a>
                    </li>
                    <li class="nav-header"><span class="nav-label">Laporan</span></li>
                    <li class="nav-item">
                        <a class="nav-link with-sub" href="/pimpinan/rekapDokumen">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-wallet sidemenu-icon fas fa-book "></i>
                            <span class="sidemenu-label">Rekap Dokumen</span>
                        </a>
                    </li>
                    @endif


                    <div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
            </div>
        </div>
    </div>
</div>
