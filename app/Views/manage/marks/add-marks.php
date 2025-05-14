<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
</div>

<form name="<?= $form_btn ?>-marks-form" id="<?= $form_btn ?>-marks-form" class="<?= $form_btn ?>-marks-form">
    <div class="row">
        
        <?php
        $selected = 'selected';
        $selected_val = 0;
        if (isset($user['user_type']) && !empty($user['user_type']) && is_numeric($user['user_type'])) {
            $selected_val = $user['user_type'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="user_type">User Type</label>
            <select id="user_type" class="form-control" name="user_type" <?= ($selected_val == 0) ? '' : 'disabled' ?>>
                <option value="" <?= ($selected_val == 0) ? $selected : '' ?>>Select User Type</option>
                <?php
                foreach ($user_types as $key => $value) {
                ?>
                    <option value="<?= $value['id'] ?>" <?= ($selected_val == $value['id']) ? $selected : '' ?>><?= $value['display_name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        
    
        <?php
        $btn_class = '';
        $form_name = '';
        if ($form_btn == 'add') {
            $btn_class = 'success';
            $form_name = 'ADD_ASSESSMENT';

        } else if ($form_btn == 'edit') {
            $btn_class = 'primary';
            $form_name = 'EDIT_ASSESSMENT';
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
<a href="<?=base_url("manage/marks")?>"><button type="button" class="btn btn-primary">Back</button></a>

<?= $this->endSection() ?>