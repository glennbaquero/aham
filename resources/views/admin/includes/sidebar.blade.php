<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="treeview">
        <a href="#">
          <i class="fas fa-boxes"></i> <span> Product Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('admin.products.index') }}"><i class="fas fa-boxes"></i> Product</a></li>
          <li><a href="{{ route('admin.categories.index') }}"><i class="fas fa-archive"></i> Product Categories</a></li>
          <li><a href="{{ route('admin.types.index') }}"><i class="fas fa-user-shield"></i> Product Types</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fas fa-puzzle-piece"></i> <span>Content Management</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('admin.pages.index') }}"><i class="fas fa-boxes"></i> Page</a></li>
          <li><a href="{{ route('admin.page-items.index') }}"><i class="fas fa-sitemap"></i> Page Items</a></li>
          <li><a href="{{ route('admin.carousel.index') }}"><i class="fas fa-images"></i> Carousels</a></li>
        </ul>
      </li>
      <li><a href=""><i class="fa fa-book"></i> <span>Application</span></a></li>
      <li class="header">SECURITY</li>
      <li class="active treeview menu-open">
        <a href="#">
          <i class="fas fa-shield-alt"></i> <span>Access control</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('admin.administrator') }}"><i class="fas fa-user-shield"></i> Administrator</a></li>
          <li><a href="{{ route('admin.roles') }}"><i class="fas fa-id-card-alt"></i> Roles</a></li>
          <li><a href=""><i class="fas fa-shield-alt"></i> Permission</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>