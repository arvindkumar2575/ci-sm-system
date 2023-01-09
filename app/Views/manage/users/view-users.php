<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<div class="row">
    <div class="col-md-12">
        <div>Filters</div>
    </div>
    <div class="table-responsive col-md-12 ">
        <table class="table">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Email Id</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $key => $value) {
                ?>
                    <tr>
                        <td><?=($key+1)?></td>
                        <td><?=$value['email']?></td>
                        <td><?=$value['first_name'].' '.$value['last_name']?></td>
                        <td>
                            <?php
                            $status='';
                            if($value['status']==1){
                                $status='Active';
                            }else{
                                $status='InActive';
                            }
                            ?>
                            <?=$status?>
                        </td>
                        <td>
                            <button class="btn btn-success user-table-btn-permissions" type="button" data-id="<?=$value['id']?>"><i class="fas fa-solid fa-universal-access"></i></button>
                            <button class="btn btn-success user-table-btn-edit" type="button" data-id="<?=$value['id']?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger user-table-btn-delete" type="button" data-id="<?=$value['id']?>"><i class="fas fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>