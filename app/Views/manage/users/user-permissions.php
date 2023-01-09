<?= $this->extend("manage/layout/dashboard-layout") ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $heading_title ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<div class="filter-form">
    <form class="row">
        <div class="col-md-6">
            <label for="name_email">Search here</label>
            <input type="text" class="form-control" id="name_email" name="name_email" placeholder="Search name/email here...">
        </div>
        <div class="col-md-6 form-search-btn">
            <button type="submit" class="btn btn-primary" data-btn="search">
                Search
            </button>
        </div>
    </form>
</div>
<form name="<?= $form_btn ?>-user-permissions-form" id="<?= $form_btn ?>-user-permissions-form" class="<?= $form_btn ?>-user-permissions-form">
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
        $selected = 'selected';
        $selected_val = 0;
        if (isset($user['gender_id']) && !empty($user['gender_id']) && is_numeric($user['gender_id'])) {
            $selected_val = $user['gender_id'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="gender_id">Gender</label>
            <select id="gender_id" class="form-control" name="gender_id">
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




        <?php
        $selected_val = '';
        if (isset($user['email']) && !empty($user['email']) && is_string($user['email'])) {
            $selected_val = $user['email'];
        }
        ?>
        <div class="form-group col-md-<?= $selected_val == '' ? '6' : '12' ?>">
            <label for="email">Email Id</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Email Id" <?= ($selected_val == '') ? '' : 'disabled' ?>>
        </div>




        <?php
        if ($selected_val == '') {
        ?>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" name="password" placeholder="Password">
            </div>
        <?php
        }
        ?>



        <?php
        $selected_val = '';
        if (isset($user['first_name']) && !empty($user['first_name']) && is_string($user['first_name'])) {
            $selected_val = $user['first_name'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="First Name">
        </div>




        <?php
        $selected_val = '';
        if (isset($user['last_name']) && !empty($user['last_name']) && is_string($user['last_name'])) {
            $selected_val = $user['last_name'];
        }
        ?>
        <div class="form-group col-md-6">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $selected_val == '' ? '' : $selected_val ?>" placeholder="Last Name">
        </div>



        <?php
        $selected = 'selected';
        $selected_val = 0;
        if (isset($user['verified']) && !empty($user['verified']) && is_numeric($user['verified'])) {
            $selected_val = $user['verified'];
        }
        ?>
        <div class="form-group col-md-3">
            <label for="verified">Verification</label>
            <select id="verified" class="form-control" name="verified">
                <option value="0" <?= $selected_val == '0' ? $selected : '' ?>>Not-Verified</option>
                <option value="1" <?= $selected_val == '1' ? $selected : '' ?>>Verified</option>
            </select>
        </div>



        <?php
        $selected = 'selected';
        $selected_val = 0;
        if (isset($user['status']) && !empty($user['status']) && is_numeric($user['status'])) {
            $selected_val = $user['status'];
        }
        ?>
        <div class="form-group col-md-3">
            <label for="status">Status</label>
            <select id="status" class="form-control" name="status">
                <option value="1" <?= $selected_val == '1' ? $selected : '' ?>>Active</option>
                <option value="0" <?= $selected_val == '0' ? $selected : '' ?>>InActive</option>
            </select>
        </div>



        
        <?php
        $btn_class = '';
        $form_name = '';
        if ($form_btn == 'add') {
            $btn_class = 'success';
            $form_name = 'ADD_USER';

        } else if ($form_btn == 'edit') {
            $btn_class = 'primary';
            $form_name = 'EDIT_USER';
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