<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<form name="add-user-form" id="add-user-form" class="add-user-form">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="user_type">User Type</label>
            <select id="user_type" class="form-control" name="user_type">
                <?php
                $selected = 'selected';
                $selected_val = 0;
                if (isset($user['user_type']) && !empty($user['user_type']) && is_numeric($user['user_type'])) {
                    $selected_val = $user['user_type'];
                }
                ?>
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
        <div class="form-group col-md-6">
            <label for="gender_id">Gender</label>
            <select id="gender_id" class="form-control" name="gender_id">
                <?php
                $selected = 'selected';
                $selected_val = 0;
                if (isset($user['gender_id']) && !empty($user['gender_id']) && is_numeric($user['gender_id'])) {
                    $selected_val = $user['gender_id'];
                }
                ?>
                <option value="" <?= ($selected_val == 0) ? $selected : '' ?>>Select Gender</option>
                <?php
                foreach ($gender_details as $key => $value) {
                ?>
                    <option value="<?= $value['id'] ?>" <?= ($selected_val == $value['id']) ? $selected : '' ?>><?= $value['display_name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email Id</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email Id">
        </div>
        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group col-md-6">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
        </div>
        <div class="form-group col-md-6">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
        </div>
        <div class="form-group col-md-3">
            <label for="verified">Verification</label>
            <select id="verified" class="form-control" name="verified">
                <?php
                $selected = 'selected';
                $selected_val = 0;
                if (isset($user['verified']) && !empty($user['verified']) && is_numeric($user['verified'])) {
                    $selected_val = $user['verified'];
                }
                ?>
                <option value="0" <?= $selected_val == '0' ? $selected : '' ?>>Not-Verified</option>
                <option value="1" <?= $selected_val == '1' ? $selected : '' ?>>Verified</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="status">Status</label>
            <select id="status" class="form-control" name="status">
                <?php
                $selected = 'selected';
                $selected_val = 0;
                if (isset($user['status']) && !empty($user['status']) && is_numeric($user['status'])) {
                    $selected_val = $user['status'];
                }
                ?>
                <option value="1" <?= $selected_val == '1' ? $selected : '' ?>>Active</option>
                <option value="0" <?= $selected_val == '0' ? $selected : '' ?>>InActive</option>
            </select>
        </div>
        <input type="hidden" name="form_type" value="ADD_USER" />
        <div class="col-md-12 submit-btns">
            <?php
            $btn_class = '';
            if ($form_btn == 'add') {
                $btn_class = 'success';
            } else if ($form_btn == 'edit') {
                $btn_class = 'primary';
            }
            ?>
            <button type="submit" class="btn btn-<?= $btn_class ?>" data-btn="<?= $form_btn ?>">
                <?= ucwords($form_btn) ?>
            </button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>
</form>

<?= $this->endSection() ?>