<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<form name="<?= $form_btn ?>-permission-form" id="<?= $form_btn ?>-permission-form" class="<?= $form_btn ?>-permission-form">
    <div class="row">

        <?php
        $selected_val = '';
        if (isset($permission['name']) && !empty($permission['name']) && is_string($permission['name'])) {
            $selected_val = $permission['name'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Name" <?= ($selected_val == '') ? '' : 'disabled' ?>>
        </div>


        <?php
        $selected_val = '';
        if (isset($permission['display_name']) && !empty($permission['display_name']) && is_string($permission['display_name'])) {
            $selected_val = $permission['display_name'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="display_name">Display Name</label>
            <input type="text" class="form-control" id="display_name" name="display_name" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Display Name">
        </div>


        
        <?php
        $selected = 'selected';
        $selected_val = 0;
        if (isset($permission['parent']) && !empty($permission['parent']) && is_numeric($permission['parent'])) {
            $selected_val = $permission['parent'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="parent">Parent</label>
            <select id="parent" class="form-control" name="parent">
                <option value="0" <?= ($selected_val == 0) ? $selected : '' ?>>Default</option>
                <?php
                foreach ($permission_list as $key => $value) {
                ?>
                    <option value="<?= $value['id'] ?>" <?= ($selected_val == $value['id']) ? $selected : '' ?>><?= $value['display_name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>


        <?php
        $selected_val = '';
        if (isset($permission['remarks']) && !empty($permission['remarks']) && is_numeric($permission['remarks'])) {
            $selected_val = $permission['remarks'];
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
            $form_name = 'ADD_PERMISSION';

        } else if ($form_btn == 'edit') {
            $btn_class = 'primary';
            $form_name = 'EDIT_PERMISSION';
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