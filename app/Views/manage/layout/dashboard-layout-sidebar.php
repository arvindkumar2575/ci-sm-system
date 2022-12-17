<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= manageURL() ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?= SMSYSTEMNAME ?></div>
    </a>

    <div class="sidebar-menu">
        <div>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= manageURL('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">
            <!-- Divider -->




            <div class="sidebar-module">
                <div class="sidebar-heading">
                    Users
                </div>
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
            </div>

            <div class="sidebar-module">
                <div class="sidebar-heading">
                    Students
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="<?= manageURL('students') ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Students</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= manageURL('add-student') ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Add Student</span></a>
                </li>
            </div>

            <div class="sidebar-module">
                <div class="sidebar-heading">
                    Teachers
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="<?= manageURL('teachers') ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Teachers</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= manageURL('add-teacher') ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Add Teacher</span></a>
                </li>
            </div>

            <div class="sidebar-module">
                <div class="sidebar-heading">
                    Staffs
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="<?= manageURL('staffs') ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Staffs</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= manageURL('add-staff') ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Add Staff</span></a>
                </li>
            </div>

        </div>
    </div>

</ul>
<!-- End of Sidebar -->