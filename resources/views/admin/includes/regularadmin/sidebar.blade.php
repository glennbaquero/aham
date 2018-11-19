<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fas fa-boxes"></i> <span> Product Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('regular.products.index') }}"><i class="fas fa-boxes"></i> Product</a></li>
            <li><a href="{{ route('regular.categories.index') }}"><i class="fas fa-archive"></i> Product Categories</a></li>
            <li><a href="{{ route('regular.types.index') }}"><i class="fas fa-user-shield"></i>Product Types</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  </section>
  <!-- /.sidebar -->
</aside>