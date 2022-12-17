<?= view('manage/common/head') ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?= view('manage/layout/dashboard-layout-sidebar') ?>
    <?= view('manage/layout/dashboard-layout-content') ?> <!-- this contain 'content' renderSection-->
</div>

<?= view('manage/common/logout-model') ?>
<?= view('manage/common/footer') ?>