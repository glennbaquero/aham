<header class="main-header">
  <!-- Logo -->
  <a href="{{ route('admin.dashboard') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>{{ $headerAcronym }}</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>{{ config('app.name') }}</b></span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="fas fa-align-justify"></span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li>
          <a href="#"><i class="fa fa-bell"></i></a>
        </li>
        @auth('admin')
          <li>
            <a href="#">{{ \Auth::guard('admin')->user()->renderFullname() }}</a>
          </li>
          <li>
            <a href="{{ route('admin.logout') }}">Logout</a>
          </li>
        @endauth
      </ul>
    </div>
  </nav>

</header>