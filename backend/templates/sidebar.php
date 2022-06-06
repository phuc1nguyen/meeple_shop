  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link" target="_blank">
      <img src="../public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Meeple Shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <!-- Products -->
          <li class="nav-item <?php isRoute(['prod_index.php', 'prod_create.php'], 'menu-open') ?>">
            <a href="#" class="nav-link <?php isRoute(['prod_index.php', 'prod_create.php', 'prod_edit.php'], 'active') ?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/backend/prod_index.php" class="nav-link <?php isRoute(['prod_index.php'], 'active') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/backend/prod_create.php" class="nav-link <?php isRoute(['prod_create.php'], 'active') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Product</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Slider -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>Slider
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/slider_index.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách Slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/slider_create.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Slider</p>
                </a>
              </li>
            </ul>
          </li> -->

          <!-- Users -->
          <li class="nav-item <?php isRoute(['user_index.php', 'user_create.php'], 'menu-open') ?>">
            <a href="#" class="nav-link <?php isRoute(['user_index.php', 'user_create.php', 'user_edit.php'], 'active') ?>">
              <i class="nav-icon bx bxs-user"></i> 
              <p>Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/backend/user_index.php" class="nav-link <?php isRoute(['user_index.php'], 'active') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users List</p>
                </a>
              </li>
							<li class="nav-item">
								<a href="/backend/user_create.php" class="nav-link <?php isRoute(['user_create.php'], 'active') ?>">
									<i class="far fa-circle nav-icon"></i>
									<p>Create User</p>
								</a>
							</li>
            </ul>
          </li>

          <!-- Logout -->
          <li class="nav-item p-3 text-center border-top">
            <a href="../../auth/logout.php">Log Out</a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>