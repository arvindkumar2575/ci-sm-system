<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
</div>

<form name="<?= $form_btn ?>-assessment-form" id="<?= $form_btn ?>-assessment-form" class="<?= $form_btn ?>-assessment-form">
    <div class="row">

        <?php
        $selected_val = '';
        if (isset($assessment['id']) && !empty($assessment['id']) && is_string($assessment['id'])) {
            $selected_val = $assessment['id'];
        }
        ?>
        <input type="hidden" class="form-control" id="id" name="id" value="<?= $selected_val == '' ? '' : $selected_val ?>">


        <?php
        $selected_val = '';
        if (isset($assessment['identifier']) && !empty($assessment['identifier']) && is_string($assessment['identifier'])) {
            $selected_val = $assessment['identifier'];
        }else{
            $selected_val = uuid();
        }
        ?>
        <input type="text" class="form-control" id="identifier" name="identifier" value="<?= $selected_val == '' ? '' : $selected_val ?>" disabled>


        <?php
        $selected_val = '';
        if (isset($assessment['display_name']) && !empty($assessment['display_name']) && is_string($assessment['display_name'])) {
            $selected_val = $assessment['display_name'];
        }
        ?>
        <div class="form-group col-md-12">
            <label for="display_name">Display Name</label>
            <input type="text" class="form-control" id="display_name" name="display_name" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Display Name">
        </div>

        
        <?php
        $selected_val = '';
        if (isset($assessment['priority']) && !empty($assessment['priority']) && is_string($assessment['priority'])) {
            $selected_val = $assessment['priority'];
        }
        ?>
        <div class="form-group col-md-12">
            <label for="priority">Priority</label>
            <input type="text" class="form-control" id="priority" name="priority" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Priority">
        </div>

        
        <?php
        $selected_val = '';
        if (isset($assessment['details']) && !empty($assessment['details']) && is_string($assessment['details'])) {
            $selected_val = $assessment['details'];
            // echo json_encode($selected_val);
        }
        ?>
        <div class="form-group col-md-12">
            <label for="details">Details</label>
            <textarea class="form-control" id="details" name="details" rows="4"><?= $selected_val == '' ? '' : $selected_val ?></textarea>
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
<a href="<?=base_url("manage/assessments")?>"><button type="button" class="btn btn-primary">Back</button></a>

<?= $this->endSection() ?>