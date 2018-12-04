<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Warranty</li>
      <li><a href=""><i class="fa fa-book"></i> <span>Application</span></a></li>
      
      @if ($checker->permission->can(['admin.product.edit', 'admin.product.create', 'admin.product.destroy']))
        <li class="header">Products</li>
        <li class="treeview {{ $checker->route->isActive(['admin.products.', 'admin.product.', 'admin.categories.', 'admin.types.'], 'menu-open') }}">
          <a href="#">
            <i class="fas fa-boxes"></i> <span> Product Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu {{ $checker->route->isActive(['admin.products.', 'admin.product.', 'admin.categories.', 'admin.types.']) }}">
            <li class="{{ $checker->route->isActive(['admin.products.', 'admin.product.']) }}">
              <a href="{{ route('admin.products.index') }}"><i class="fas fa-boxes"></i> Product</a>
            </li>
            <li class="{{ $checker->route->isActive('admin.categories.') }}">
              <a href="{{ route('admin.categories.index') }}"><i class="fas fa-archive"></i> Product Categories</a>
            </li>
            <li class="{{ $checker->route->isActive('admin.types.') }}">
              <a href="{{ route('admin.types.index') }}"><i class="fas fa-th-large"></i> Product Types</a>
            </li>
          </ul>
        </li>
      @endif

      <li class="header">Content Management</li>
      <li class="treeview {{ $checker->route->isActive(['admin.pages.', 'admin.page-items.'], 'menu-open') }}">
        <a href="#">
          <i class="fas fa-puzzle-piece"></i> <span>Page Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu {{ $checker->route->isActive(['admin.pages.', 'admin.page-items.']) }}">
          <li class="{{ $checker->route->isActive('admin.pages.') }}">
            <a href="{{ route('admin.pages.index') }}"><i class="fas fa-boxes"></i> Page</a>
          </li>
          <li class="{{ $checker->route->isActive('admin.page-items.') }}">
            <a href="{{ route('admin.page-items.index') }}"><i class="fas fa-sitemap"></i> Page Items</a>
          </li>
        </ul>
      </li>
      <li class="treeview">
          <a href="#">
            <i class="fas fa-toolbox"></i> <span> Repair Service</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu {{ $checker->route->isActive('admin.request', 'menu-open') }}">
            <li class="{{ $checker->route->isActive('admin.request') }}"><a href="{{ route('admin.request') }}"><i class="fas fa-hammer"></i> Repair Request</a></li>
            <li><a href=""><i class="fas fa-history"></i> History</a></li>
          </ul>
        </li>
        <li><a href=""><i class="fa fa-book"></i> <span>Repair Man</span></a></li>
      <li><a href=""><i class="fa fa-book"></i> <span>Application</span></a></li>
      <li class="header">SECURITY</li>
      <li class="active treeview menu-open">
      <li class="{{ $checker->route->isActive('admin.carousel.') }}">
        <a href="{{ route('admin.carousel.index') }}"><i class="fas fa-images"></i> Carousels</a>
      </li>

      <li class="header">Security</li>
      <li class="treeview {{ $checker->route->isActive(['admin.administrator', 'admin.role'], 'menu-open') }}">
        <a href="#">
          <i class="fas fa-shield-alt"></i> <span>Access control</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu {{ $checker->route->isActive(['admin.administrator.', 'admin.role']) }}">
          <li class="{{ $checker->route->isActive('admin.administrator') }}">
            <a href="{{ route('admin.administrator') }}"><i class="fas fa-user-shield"></i> Administrator</a>
          </li>
          <li class="{{ $checker->route->isActive(['admin.role']) }}">
            <a href="{{ route('admin.roles') }}"><i class="fas fa-id-card-alt"></i> Roles &amp; Permissions</a>
          </li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>