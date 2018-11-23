<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
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

  </section>
  <!-- /.sidebar -->
</aside>