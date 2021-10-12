<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <i class="fa fa-dragon ml-2"></i>
        <span class="brand-text font-weight-light ml-2">Awareness Campaign</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item user-panel">
                    <a href="{{ url('/') }}" class="nav-link{{ (request()->is('/')) ? ' active' : '' }}"">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('banners.index') }}" class="nav-link{{ (request()->is('banners*')) ? ' active' : '' }}"">
                        <i class="nav-icon fa fa-image"></i>
                        <p>
                            Banners
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('campaigns.index') }}" class="nav-link{{ (request()->is('campaigns*')) ? ' active' : '' }}"">
                        <i class="nav-icon fa fa-boxes"></i>
                        <p>
                            Campaigns
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link{{ (request()->is('categories*')) ? ' active' : '' }}"">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link{{ (request()->is('users*')) ? ' active' : '' }}"">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('settings.index') }}" class="nav-link{{ (request()->is('settings*')) ? ' active' : '' }}{{ (request()->is('roles*')) ? ' active' : '' }}">
                    <i class="nav-icon fa fa-cog"></i>
                    <p>
                        Settings
                    </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
