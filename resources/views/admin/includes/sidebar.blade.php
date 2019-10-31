<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.application', 'admin.application.approve', 'admin.application.destroy']))
        <li class="header">Warranty</li>
        <li><a href="{{ route('admin.application') }}"><i class="fa fa-book"></i> <span>Application</span></a></li>
      @endif

      @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.discounts', 'admin.discount.create', 'admin.discount.edit', 'admin.discount.destroy']))
        <li><a href="{{ route('admin.discounts') }}"><i class="fa fa-book"></i> <span>Discount</span></a></li>
      @endif

      @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.request', 'admin.request.create', 'admin.request.edit', 'admin.request.destroy']))
        <li class="treeview {{ $checker->route->isActive(['admin.request'], 'menu-open') }}">
          <a href="#">
            <i class="fas fa-toolbox"></i> <span> Repair Service</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu {{ $checker->route->isActive('admin.request') }}">
            <li class="{{ $checker->route->isActive('admin.request') }}"><a href="{{ route('admin.request') }}"><i class="fas fa-hammer"></i> Repair Request</a></li>
            {{-- <li><a href=""><i class="fas fa-history"></i> History</a></li> --}}
          </ul>
        </li>
      @endif
      
      @if (auth()->user()->hasRole('Super Admin') ||  $checker->permission->can(['admin.products.index', 'admin.product.create', 'admin.product.edit', 'admin.product.destroy', 'admin.categories.index', 'admin.categories.create', 'admin.categories.edit', 'admin.categories.destroy', 'admin.types.index', 'admin.types.create', 'admin.types.edit', 'admin.types.destroy']))

        <li class="header">Products</li>
        <li class="treeview {{ $checker->route->isActive(['admin.products.', 'admin.product.', 'admin.categories.', 'admin.types.'], 'menu-open') }}">
          <a href="#">
            <i class="fas fa-boxes"></i> <span> Product Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu {{ $checker->route->isActive(['admin.products.', 'admin.product.', 'admin.categories.', 'admin.types.']) }}">
            @if (auth()->user()->hasRole('Super Admin') ||  $checker->permission->can(['admin.products.index', 'admin.product.create', 'admin.product.edit', 'admin.product.destroy']))
              <li class="{{ $checker->route->isActive(['admin.products.', 'admin.product.']) }}">
                <a href="{{ route('admin.products.index') }}"><i class="fas fa-boxes"></i> Product</a>
              </li>
            @endif
            
            @if (auth()->user()->hasRole('Super Admin') ||  $checker->permission->can(['admin.categories.index', 'admin.categories.create', 'admin.categories.edit', 'admin.categories.destroy']))
              <li class="{{ $checker->route->isActive('admin.categories.') }}">
                <a href="{{ route('admin.categories.index') }}"><i class="fas fa-archive"></i> Product Categories</a>
              </li>
            @endif

            @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.types.index', 'admin.types.create', 'admin.types.edit', 'admin.types.destroy']))
              <li class="{{ $checker->route->isActive('admin.types.') }}">
                <a href="{{ route('admin.types.index') }}"><i class="fas fa-th-large"></i> Product Types</a>
              </li>
            @endif
          </ul>
        </li>
      @endif
      
      @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.pages.index', 'admin.pages.create', 'admin.pages.edit', 'admin.pages.destroy', 'admin.page-items.index', 'admin.page-items.create', 'admin.page-items.edit', 'admin.page-items.destroy', 'admin.carousel.index', 'admin.carousel.create', 'admin.carousel.edit', 'admin.carousel.destroy', 'admin.faqs.index', 'admin.faqs.create', 'admin.faqs.edit', 'admin.faqs.destroy', 'admin.faqs.index', 'admin.contacts.index', 'admin.contacts.create', 'admin.contacts.edit', 'admin.contacts.destroy', 'admin.locations.index', 'admin.locations.create', 'admin.locations.edit', 'admin.locations.destroy']))

      <li class="header">Content Management</li>
      <li class="treeview {{ $checker->route->isActive(['admin.pages.', 'admin.page-items.', 'admin.carousel.', 'admin.locations.', 'admin.contact', 'admin.faqs.'], 'menu-open') }}">
        <a href="#">
          <i class="fas fa-puzzle-piece"></i> <span>Page Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu {{ $checker->route->isActive(['admin.pages.', 'admin.page-items.', 'admin.carousel.', 'admin.faqs', 'admin.locations.', 'admin.contact']) }}">

          @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.pages.index', 'admin.pages.create', 'admin.pages.edit', 'admin.pages.destroy']))
            <li class="{{ $checker->route->isActive('admin.pages.') }}">
              <a href="{{ route('admin.pages.index') }}"><i class="fas fa-boxes"></i> Page</a>
            </li>
          @endif

          @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.page-items.index', 'admin.page-items.create', 'admin.page-items.edit', 'admin.page-items.destroy']))
            <li class="{{ $checker->route->isActive('admin.page-items.') }}">
              <a href="{{ route('admin.page-items.index') }}"><i class="fas fa-sitemap"></i> Page Items</a>
            </li>
          @endif

          @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.carousel.index', 'admin.carousel.create', 'admin.carousel.edit', 'admin.carousel.destroy']))
            <li class="{{ $checker->route->isActive('admin.carousel.') }}">
              <a href="{{ route('admin.carousel.index') }}"><i class="fas fa-images"></i> Slider</a>
            </li>
          @endif

          @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.faqs.index', 'admin.faqs.create', 'admin.faqs.edit', 'admin.faqs.destroy']))
          <li class="{{ $checker->route->isActive('admin.faqs.') }}">
            <a href="{{ route('admin.faqs.index') }}"><i class="fas fa-question"></i> FAQ</a>
          </li>
          @endif

          @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.contacts.index', 'admin.contacts.create', 'admin.contacts.edit', 'admin.contacts.destroy']))
            <li class="{{ $checker->route->isActive('admin.contacts.') }}">
              <a href="{{ route('admin.contacts.index') }}"><i class="fas fa-phone"></i> Contact Us</a>
            </li>

          @endif

          @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.locations.index', 'admin.locations.create', 'admin.locations.edit', 'admin.locations.destroy']))
          <li class="{{ $checker->route->isActive('admin.locations.') }}">
            <a href="{{ route('admin.locations.index') }}"><i class="fas fa-map"></i> Locations</a>
          </li>
          @endif
        </ul>
      </li>
      @endif
      
      @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.administrator', 'admin.administrator.edit', 'admin.administrator.create', 'admin.administrator.destroy', 'admin.roles', 'admin.roles', 'admin.roles.edit', 'admin.roles.create', 'admin.roles.destroy']))
      <li class="header">Security</li>
      <li class="treeview {{ $checker->route->isActive(['admin.administrator', 'admin.role'], 'menu-open') }}">
        <a href="#">
          <i class="fas fa-shield-alt"></i> <span>Access control</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu {{ $checker->route->isActive(['admin.administrator.', 'admin.role']) }}">
          
          @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.administrator', 'admin.administrator.edit', 'admin.administrator.create', 'admin.administrator.destroy']))
          <li class="{{ $checker->route->isActive('admin.administrator') }}">
            <a href="{{ route('admin.administrator') }}"><i class="fas fa-user-shield"></i> Administrator</a>
          </li>
          @endif

          @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.roles', 'admin.roles.edit', 'admin.roles.create', 'admin.roles.destroy']))
            <li class="{{ $checker->route->isActive(['admin.role']) }}">
              <a href="{{ route('admin.roles') }}"><i class="fas fa-id-card-alt"></i> Roles &amp; Permissions</a>
            </li>
          @endif

        </ul>
      </li>
      @endif
      
      @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.users.index', 'admin.users.create']))
        <li class="{{ $checker->route->isActive('admin.users.') }}">
          <a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i>
            Users
          </a>
        </li>
        <li class="{{ $checker->route->isActive('admin.employee.') }}">
          <a href="{{ route('admin.employee.index') }}"><i class="fa fa-users"></i>
            Employee
          </a>
        </li>
      @endif

      @if (auth()->user()->hasRole('Super Admin') || $checker->permission->can(['admin.activity-logs.index']))
        <li class="{{ $checker->route->isActive('admin.activity-logs.') }}">
          <a href="{{ route('admin.activity-logs.index') }}">
            <i class="fa fa-clipboard-list"></i>
            <span>Activity Logs</span>
          </a>
        </li>
      @endif

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>