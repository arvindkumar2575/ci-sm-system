<!DOCTYPE html>
<html lang="en">

<head>
    <?= view('manage/common/head') ?>
</head>

<body>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?= view('manage/layout/dashboard-layout-sidebar') ?>
        <?= view('manage/layout/dashboard-layout-content') ?> <!-- this contain 'content' renderSection-->
    </div>

    <?= view('manage/common/logout-model') ?>
    <?= view('manage/common/footer') ?>

</body>

</html>