<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($assessments as $key => $value) {
                    ?>
                        <tr>
                            <td><a href="<?= base_url("manage/marks-upload/" . $value['identifier']) ?>"><?=$value['display_name']?></a></td>
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