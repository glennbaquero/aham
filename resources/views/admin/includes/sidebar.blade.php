<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      @if ($checker->permission->can(['admin.application.edit', 'admin.application.create', 'admin.application.destroy']))
      <li class="header">Warranty</li>
      <li><a href="{{ route('admin.application') }}"><i class="fa fa-book"></i> <span>Application</span></a></li>
      @endif
      @if ($checker->permission->can(['admin.discount.edit', 'admin.discount.create', 'admin.discount.destroy']))
      <li><a href="{{ route('admin.discounts') }}"><i class="fa fa-book"></i> <span>Discount</span></a></li>
      @endif
      @if ($checker->permission->can(['admin.request.edit', 'admin.request.create', 'admin.request.destroy']))
      <li class="treeview {{ $checker->route->isActive(['admin.request'], 'menu-open') }}">
        <a href="#">
          <i class="fas fa-toolbox"></i> <span> Repair Service</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu {{ $checker->route->isActive('admin.request') }}">
          <li class="{{ $checker->route->isActive('admin.request') }}"><a href="{{ route('admin.request') }}"><i class="fas fa-hammer"></i> Repair Request</a></li>
          <li><a href=""><i class="fas fa-history"></i> History</a></li>
        </ul>
      </li>
      @endif
      
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
      
      @if ($checker->permission->can(['admin.carousel.edit', 'admin.carousel.create', 'admin.carousel.destroy', 'admin.page-items.edit', 'admin.page-items.create', 'admin.page-items.destroy']))
      <li class="header">Content Management</li>
      <li class="treeview {{ $checker->route->isActive(['admin.pages.', 'admin.page-items.', 'admin.carousel.', 'admin.locations.', 'admin.contact'], 'menu-open') }}">
        <a href="#">
          <i class="fas fa-puzzle-piece"></i> <span>Page Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu {{ $checker->route->isActive(['admin.pages.', 'admin.page-items.', 'admin.carousel.', 'admin.faqs', 'admin.locations.', 'admin.contact']) }}">
          <li class="{{ $checker->route->isActive('admin.pages.') }}">
            <a href="{{ route('admin.pages.index') }}"><i class="fas fa-boxes"></i> Page</a>
          </li>
          <li class="{{ $checker->route->isActive('admin.page-items.') }}">
            <a href="{{ route('admin.page-items.index') }}"><i class="fas fa-sitemap"></i> Page Items</a>
          </li>
          <li class="{{ $checker->route->isActive('admin.carousel.') }}">
            <a href="{{ route('admin.carousel.index') }}"><i class="fas fa-images"></i> Slider</a>
          </li>
          <li class="{{ $checker->route->isActive('admin.faqs.') }}">
            <a href="{{ route('admin.faqs.index') }}"><i class="fas fa-question"></i> FAQ</a>
          </li>
          <li class="{{ $checker->route->isActive('admin.contacts.') }}">
            <a href="{{ route('admin.contacts.index') }}"><i class="fas fa-phone"></i> Contact Us</a>
          </li>
          <li class="{{ $checker->route->isActive('admin.locations.') }}">
            <a href="{{ route('admin.locations.index') }}"><i class="fas fa-map"></i> Locations</a>
          </li>
        </ul>
      </li>
      @endif
      
      @if ($checker->permission->can(['admin.roles.edit', 'admin.roles.create', 'admin.roles.destroy']))
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
      <li class="{{ $checker->route->isActive('admin.activity-logs.') }}"><a href="{{ route('admin.activity-logs.index') }}"><i class="fa fa-clipboard-list"></i> <span>Activity Logs</span></a></li>
      @endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>