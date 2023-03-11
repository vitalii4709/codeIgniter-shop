<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url('assets/admin/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/admin/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= route_to('admin.user.edit', $_SESSION['user']['id']) ?>" class="d-block"><?= $_SESSION['user']['name'] ?></a>
                <a href="<?= route_to('admin.logout') ?>">Logout</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="<?= route_to('admin.main') ?>" class="nav-link <?= (base_url('admin') === rtrim(current_url(), '/')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= route_to('admin.category'); ?>" class="nav-link <?php echo ( base_url('admin/category') === rtrim(current_url(), '/') ) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Категории</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= route_to('admin.product'); ?>" class="nav-link <?php echo ( base_url('admin/product') === rtrim(current_url(), '/') ) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-barcode"></i>
                        <p>Товары</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= route_to('admin.user'); ?>" class="nav-link <?php echo ( base_url('admin/user') === rtrim(current_url(), '/') ) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Пользователи</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= route_to('admin.order'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Заказы</p>
                    </a>
                </li>
            
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
