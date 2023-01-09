<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= manageURL() ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-2"><?= SMSYSTEMNAME ?></div>
    </a>

    <div class="sidebar-menu">
        <div>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item-head px-2">
                <a class="nav-link" href="<?= manageURL('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider my-0">
            <!-- Divider -->



            <div class="sidebar-module">
                <div class="sidebar-heading px-2 pt-2 nav-item-head">
                    Menu
                </div>
                <ul>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= manageURL('menu') ?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Menu</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= manageURL('add-menu') ?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Add Menu</span></a>
                    </li>
                </ul>
            </div>


            <div class="sidebar-module">
                <div class="sidebar-heading px-2 pt-2 nav-item-head">
                    Users
                </div>
                <ul>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= manageURL('users') ?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Users</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= manageURL('add-user') ?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Add User</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= manageURL('user-permissions') ?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Permissions</span></a>
                    </li>
                </ul>
            </div>

            <div class="sidebar-module">
                <div class="sidebar-heading px-2 pt-2 nav-item-head">
                    Roles
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="<?= manageURL('roles') ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Roles</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= manageURL('add-role') ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Add Role</span></a>
                </li>
            </div>

            <div class="sidebar-module">
                <div class="sidebar-heading px-2 pt-2 nav-item-head">
                    Permissions
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="<?= manageURL('permissions') ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Permissions</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= manageURL('add-permission') ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Add Permission</span></a>
                </li>
            </div>

            

        </div>
    </div>

</ul>
<!-- End of Sidebar -->