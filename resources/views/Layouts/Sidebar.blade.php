<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Administrator
                            <span class="user-level">Admin</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item">
                    <a href="">
                        <i class="fas fa-plus"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('user*') ? 'active' : '' }}">
                    <a href="{{ url('/user') }}">
                        <i class="fas fa-user"></i>
                        <p>Pengguna</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('cms-category-complaint*') ? 'active' : '' }}">
                    <a href="{{ url('/cms-category-complaint') }}">
                        <i class="fas fa-list-alt"></i>
                        <p>Kategori Pengaduan</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('cms-complaint*') ? 'active' : '' }}">
                    <a href="{{ url('/cms-complaint') }}">
                        <i class="fas fa-list-alt"></i>
                        <p>Daftar Pengaduan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
