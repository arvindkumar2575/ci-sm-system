<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<?php
if($form_type=='user'){
?>
<div class="filter-form">
    <div class="row">
        <div class="col-md-6">
            <label for="name_email">Search here</label>
            <input type="text" class="form-control" data-action_in="permission_user" id="name_email" name="q" placeholder="Search name/email here..." value="<?=$user['email']??''?>">
            <div class="search-list">
            </div>
        </div>
        <div class="col-md-6 form-search-btn">
            <button type="submit" class="btn btn-primary user-search-btn" data-btn="search">
                Search
            </button>
        </div>
    </div>
</div>
<?php
}
?>


<div id="add-edit-permission-form" class="add-edit-permission-form">
    <?=$form?>
</div>


<?= $this->endSection() ?>