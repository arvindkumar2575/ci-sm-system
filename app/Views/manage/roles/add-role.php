<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<form name="<?= $form_btn ?>-role-form" id="<?= $form_btn ?>-role-form" class="<?= $form_btn ?>-role-form">
    <div class="row">

        <?php
        $selected_val = '';
        if (isset($role['name']) && !empty($role['name']) && is_string($role['name'])) {
            $selected_val = $role['name'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Name" <?= ($selected_val == '') ? '' : 'disabled' ?>>
        </div>


        <?php
        $selected_val = '';
        if (isset($role['display_name']) && !empty($role['display_name']) && is_string($role['display_name'])) {
            $selected_val = $role['display_name'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="display_name">Display Name</label>
            <input type="text" class="form-control" id="display_name" name="display_name" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Display Name">
        </div>


        <?php
        $selected_val = '';
        if (isset($role['remarks']) && !empty($role['remarks']) && is_numeric($role['remarks'])) {
            $selected_val = $role['remarks'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="remarks">Remarks</label>
            <textarea type="text" class="form-control" id="remarks" name="remarks" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Remarks"></textarea>
        </div>



        
        <?php
        $btn_class = '';
        $form_name = '';
        if ($form_btn == 'add') {
            $btn_class = 'success';
            $form_name = 'ADD_ROLE';

        } else if ($form_btn == 'edit') {
            $btn_class = 'primary';
            $form_name = 'EDIT_ROLE';
        }
        ?>
        <input type="hidden" name="form_type" value="<?=$form_name?>" />
        <div class="col-md-12 submit-btns">
            <button type="submit" class="btn btn-<?= $btn_class ?>" data-btn="<?= $form_btn ?>">
                Save
            </button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>

        
    </div>
</form>

<?= $this->endSection() ?>