<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<form name="<?= $form_btn ?>-student-form" id="<?= $form_btn ?>-student-form" class="<?= $form_btn ?>-student-form">
    <div class="row">

        <?php
        $selected_val = '';
        if (isset($student['email']) && !empty($student['email']) && is_string($student['email'])) {
            $selected_val = $student['email'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="email">Email Id</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Email Id" <?= ($selected_val == '') ? '' : 'disabled' ?>>
        </div>





        <?php
        $selected_val = '';
        if (isset($student['student_name']) && !empty($student['student_name']) && is_string($student['student_name'])) {
            $selected_val = $student['student_name'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="student_name">Display Name</label>
            <input type="text" class="form-control" id="student_name" name="student_name" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Student Name" <?= ($selected_val == '') ? '' : 'disabled' ?>>
        </div>






        <?php
        $selected_val = '';
        if (isset($student['first_name']) && !empty($student['first_name']) && is_string($student['first_name'])) {
            $selected_val = $student['first_name'];
        }
        ?>
        <div class="form-group col-md-3">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="First Name">
        </div>






        <?php
        $selected_val = '';
        if (isset($student['last_name']) && !empty($student['last_name']) && is_string($student['last_name'])) {
            $selected_val = $student['last_name'];
        }
        ?>
        <div class="form-group col-md-3">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Last Name">
        </div>




        

        <?php
        $selected = 'selected';
        $selected_val = 1;
        if (isset($student['status']) && $student['status']=='0') {
            $selected_val = $student['status'];
        }
        ?>
        <div class="form-group col-md-3">
            <label for="status">Status</label>
            <select id="status" class="form-control" name="status">
                <option value="1" <?= ($selected_val == 1) ? $selected : '' ?>>Active</option>
                <option value="0" <?= ($selected_val == 0) ? $selected : '' ?>>InActive</option>
            </select>
        </div>


        



        
        <?php
        $btn_class = '';
        $form_name = '';
        if ($form_btn == 'add') {
            $btn_class = 'success';
            $form_name = 'ADD_STUDENT';

        } else if ($form_btn == 'edit') {
            $btn_class = 'primary';
            $form_name = 'EDIT_STUDENT';
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