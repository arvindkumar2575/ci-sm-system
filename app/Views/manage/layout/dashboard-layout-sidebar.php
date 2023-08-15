<?php

use App\Libraries\Utilslib;
use App\Models\Common;

$c = new Common;
$u = new Utilslib;
$userId = $_SESSION['usersession']['id'];
$userpermissions = $c->getMenuList($userId);
// echo '<pre>';print_r($userpermissions);die;
$all_permissions = $u->menuList($userpermissions);
// echo '<pre>';print_r($all_permissions);die;

?>

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
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider my-0">
            <!-- Divider -->

            
            <?php
            foreach ($all_permissions as $key => $value) {
                ?>
                <div class="sidebar-module">
                    <div class="sidebar-heading px-2 mt-2 nav-item-head listpm" data-pm="<?=$value["id"]?>">
                        <?=$value["display_name"]?> 
                    </div>
                    <ul>
                    <?php
                    foreach ($value["list"] as $key1 => $value1) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link listpm" href="<?=manageURL($value1["routing_url"])?>" data-pm="<?=$value1["id"]?>">
                                <i class="fas fa-fw fa-chart-area"></i>
                                <span><?=$value1["display_name"]?></span>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    </ul>
                    
                </div>
                <?php
                # code...
            }
            ?>

<?php /*
            <div class="sidebar-module">
                <div class="sidebar-heading px-2 mt-2 nav-item-head">
                    Users 
                </div>
                <ul>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=manageURL('users')?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>View</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=manageURL('add-user')?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Add</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=manageURL('edit-user')?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Edit</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=manageURL('user-permissions')?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Permissions</span>
                        </a>
                    </li>
                </ul>
            </div>



            <div class="sidebar-module">
                <div class="sidebar-heading px-2 mt-2 nav-item-head">
                    Roles 
                </div>
                <ul>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=manageURL('roles')?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>View</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=manageURL('add-role')?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Add</span>
                        </a>
                    </li>
                </ul>
            </div>



            <div class="sidebar-module">
                <div class="sidebar-heading px-2 mt-2 nav-item-head">
                    Permissions 
                </div>
                <ul>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=manageURL('permissions')?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>View</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=manageURL('add-permission')?>">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Add</span>
                        </a>
                    </li>
                </ul>
            </div>


*/ ?>


        </div>
    </div>

</ul>
<!-- End of Sidebar -->