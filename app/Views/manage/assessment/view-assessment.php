<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
    <div>
        <?php
        if (isset($assessment_identifier) && !empty($assessment_identifier)) {
        ?>
        <?php
        } else {
        ?>
            <a href="<?= base_url("manage/add-assessment") ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white"></i> New Assessment</a>
        <?php
        }
        ?>
    </div>
</div>

<?php
if (isset($assessment_identifier) && !empty($assessment_identifier)) {
?>
    <div class="row">
        <div class="col-xl-12">
            <div class="assessments px-3">
                <?php
                echo $assessments["html"];

                ?>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="row">
        <div class="table-responsive col-md-12 ">
            <table class="table">
                <thead>
                    <tr>
                        <th>Assessment Names</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($assessments as $key => $value) {
                    ?>
                        <tr>
                            <td><a href="<?= base_url("manage/assessments/" . $value['identifier']) ?>"><?=$value['display_name']?></a></td>
                            <td>
                            <button class="btn btn-success assessment-table-btn-edit" type="button" data-assessment-id="<?=$value['identifier']?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger assessment-table-btn-delete" type="button" data-assessment-id="<?=$value['identifier']?>"><i class="fas fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
}
?>


<?= $this->endSection() ?>