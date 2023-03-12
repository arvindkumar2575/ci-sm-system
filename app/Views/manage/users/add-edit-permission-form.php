<form name="<?= $form_btn ?>-user-permissions-form" id="<?= $form_btn ?>-user-permissions-form" class="<?= $form_btn ?>-user-permissions-form">
    <div class="row">
        <?php
        foreach ($all_permissions as $key => $value) {
            if (isset($value['list']) && count($value['list']) > 0 && $value['status']=='1') {
        ?>
                <div class="form-group col-md-12 permission-head">
                    <div class="form-check form-switch">
                        <input class="form-check-input head-title" type="checkbox" value="<?= $value['id'] ?>" id="<?= $value['name'] ?>" <?= $value['status'] == '1' ? '' : 'disabled' ?>>
                        <label class="form-check-label" for="<?= $value['name'] ?>">
                            <h5><?= $value['display_name'] ?></h5>
                        </label>
                    </div>
                    <div class="form-group row">
                        <?php
                        $sort_value = array_column($value['list'], 'priority');
                        array_multisort($sort_value, SORT_ASC, $value['list']);
                        foreach ($value['list'] as $key1 => $value1) {
                            if($value1['status']=='1'){
                        ?>
                            <div class="form-check col-md-2 each-permission">
                                <input class="form-check-input" type="checkbox" value="<?= $value1['id'] ?>" id="<?= $value1['name'] ?>" <?= $value1['status'] == '1' ? '' : 'disabled' ?>>
                                <label class="form-check-label" for="<?= $value1['name'] ?>">
                                    <?= $value1['display_name'] ?>
                                </label>
                            </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                <?php
            }
                ?>
                </div>
            <?php
        }
            ?>

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
            <input type="hidden" name="form_type" value="<?= $form_name ?>" />
            <div class="col-md-12 submit-btns">
                <button type="submit" class="btn btn-<?= $btn_class ?>" data-btn="<?= $form_btn ?>">
                    Save
                </button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>


    </div>
</form>