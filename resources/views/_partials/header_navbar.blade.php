    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            @include('_partials.header_navbar_message')
          </li>
          <!-- /.messages-menu -->
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            @include('_partials.header_navbar_notification')
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            @include('_partials.header_navbar_task')
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            @include('_partials.header_navbar_user')
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>