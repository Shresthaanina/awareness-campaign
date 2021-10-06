<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>

    <strong class="ml-3">Admin</strong>

    <strong class="ml-auto"></strong>

    <!-- Right navbar links -->
    <ul class="navbar-nav">
      <!-- User Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
          <span class="hidden-xs ml-2 mr-2">{{ ucwords(Auth::user()->name) }}</span>
          <i class="right fa fa-angle-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ config('custom.company_name') }}</span>
          <div class="dropdown-divider"></div>
          <a href="{{ url('password/change') }}" class="dropdown-item">
            <i class="fas fa-lock mr-2"></i> Change Password
          </a>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item dropdown-footer bg-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-power-off mr-2"></i> {{ __('Logout') }}
          </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      </li>
    </ul>
</nav>
