<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="../assets/img/profile2.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            @auth
                                {{ auth()->user()->name }}
                            @endauth
                            @auth
                                <span class="user-level">{{ auth()->user()->agency }}</span>
                            @endauth

                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('cms-dashboard*') ? 'active' : '' }}">
                    <a href="{{ url('/cms-dashboard') }}">
                       <i class="fas fa-home"></i>
                       <p>Dashboard</p>
                    </a>
                </li>
               <li class="nav-item {{ request()->is('cms-complaint*') || request()->is('cms-complaint-done*')  ? 'active' : '' }}" aria-expanded="{{ request()->is('cms-complaint*') || request()->is('cms-complaint-done*')  ? 'true' : 'false' }}">
                    <a data-toggle="collapse" href="#sidebarLayouts" class="collapsed ">
                        <i class="fas fa-list"></i>
                        <p>Daftar Pengaduan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('cms-complaint*') || request()->is('cms-complaint-done*')  ? 'show' : '' }}" id="sidebarLayouts" style="">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ request()->is('cms-complaint') ? 'active' : '' }}">
                                <a href="{{ url('/cms-complaint') }}">
                                    <span class="sub-item">Belum Ditinjau</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('cms-complaint-done') ? 'active' : '' }}">
                                <a href="{{ url('/cms-complaint-done') }}">
                                    <span class="sub-item">Sudah Ditinjau</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ request()->is('cms-category-complaint*') ? 'active' : '' }}">
                    <a href="{{ url('/cms-category-complaint') }}">
                        <i class="fas fa-list-alt"></i>
                        <p>Kategori Pengaduan</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('cms-user*') ? 'active' : '' }}">
                    <a href="{{ url('/cms-user') }}">
                        <i class="fas fa-user"></i>
                        <p>Pengguna</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
