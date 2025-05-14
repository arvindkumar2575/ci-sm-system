<!DOCTYPE html>
<html lang="en">

<head>
    <?= view('manage/common/head') ?>
</head>

<body>
    <?php
    // echo "<pre>";print_r($_SESSION['usersession']);
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?= view('manage/layout/dashboard-layout-sidebar') ?>
        <?= view('manage/layout/dashboard-layout-content') ?> <!-- this contain 'content' renderSection-->
    </div>

    <?= view('manage/common/logout-model') ?>
    <?= view('manage/common/footer') ?>

</body>

</html>