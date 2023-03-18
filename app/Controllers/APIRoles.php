<?php

namespace App\Controllers;

use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class APIRoles extends BaseController
{
    protected $session;
    protected $uri_segment;
    protected $common;
    protected $userModel;
    public function __construct()
    {
        $this->session = session();
        $this->uri_segment = service('uri');
        $this->common = new Common();
        $this->userModel = new UserModel();
    }

    // add edit role 
    public function addEditRole()
    {
        $form_type = $this->request->getVar('form_type');
        if ($form_type == "ADD_ROLE") {
            // echo '<pre>';print_r($this->request);die;
            $name = $this->request->getVar('name');
            $display_name = $this->request->getVar('display_name');
            $remarks = $this->request->getVar('remarks');

            $isRoleExit = 0;
            if (!empty($name)) {
                $isRoleExit = $this->common->get_single_row('tbl_roles', array('name' => $name), array('id'));
            } else {
                $result = array('status' => false, 'message' => 'Add Role Name!');
                return json_encode($result);
            }
            // var_dump(!$isRoleExit);die();
            if (!$isRoleExit) {
                $role_id = $this->addeditRoleData($form_type, '', $name, $display_name, $remarks);
                if ($role_id) {
                    $result = array('status' => true, 'message' => 'Successfully role added!', 'id' => $role_id);
                    return json_encode($result);
                } else {
                    $result = array('status' => false, 'message' => 'Please try again!');
                    return json_encode($result);
                }
            } else {
                $result = array('status' => false, 'message' => 'Role Name already exited!');
                return json_encode($result);
            }
        } else if ($form_type == "EDIT_ROLE") {
            // echo '<pre>';print_r($this->request->getVar());die;
            $id = $this->request->getVar('id');
            $name = $this->request->getVar('name');
            $display_name = $this->request->getVar('display_name');
            $remarks = $this->request->getVar('remarks');

            $isRoleExit = 0;
            if (!empty($name)) {
                $isRoleExit = $this->common->get_single_row('tbl_roles', array('id' => $id, 'name' => $name), array('id'));
            } else {
                $result = array('status' => false, 'message' => 'Add Role Name!');
                return json_encode($result);
            }
            if ($isRoleExit) {
                $role_id = $this->addeditRoleData($form_type, $id, $name, $display_name, $remarks);
                if ($role_id) {
                    $result = array('status' => true, 'message' => 'Successfully role saved!', 'id' => $role_id);
                    return json_encode($result);
                } else {
                    $result = array('status' => false, 'message' => 'Please try again!');
                    return json_encode($result);
                }
            } else {
                $result = array('status' => false, 'message' => 'Role Name not exited!');
                return json_encode($result);
            }
        } else {
            $result = array('status' => false, 'message' => 'Invalid request!');
            return json_encode($result);
        }
    }

    private function addeditRoleData($form_type, $id, $name, $display_name, $remarks)
    {
        if ($form_type == 'ADD_ROLE') {
            $role_data = array(
                'name' => $name,
                'display_name' => $display_name,
                'remarks' => $remarks
            );
            // echo '<pre>';print_r($role_data);die;
            $role_id = $this->common->data_insert('tbl_roles', $role_data);
            if ($role_id) {
                return $role_id;
            } else {
                return false;
            }
        } else if ($form_type == 'EDIT_ROLE') {
            $where = array(
                'id' => $id
            );
            $role_data = array(
                'display_name' => $display_name,
                'remarks' => $remarks
            );
            $role_id = $this->common->data_single_update('tbl_roles', $where, $role_data);
            if ($role_id) {
                return $id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteRole()
    {
        $result = array('status' => false, 'message' => 'Permission not allowed!');
        return json_encode($result);


        $id = $this->request->getVar('id');
        if (!empty($id)) {
            $isDelete = $this->common->deleteRole($id);
            if ($isDelete) {
                $result = array('status' => true, 'message' => 'Role successfully deleted!');
                return json_encode($result);
            } else {
                $result = array('status' => false, 'message' => 'Id not exit!');
                return json_encode($result);
            }
        } else {
            $result = array('status' => false, 'message' => 'Invalid request!');
            return json_encode($result);
        }
    }

    public function saveRolePermission()
    {
        $result=array();
        $id = $this->request->getVar('id');
        $ids = $this->request->getVar('ids');
        if (!empty($id) && !empty($ids)) {
            $permission_ids = $this->common->getRolePermissionsIds($id);
            $delete_ids = array_diff($permission_ids,$ids);
            $add_ids = array_diff($ids,$permission_ids);
            if(!empty($delete_ids)){
                $result = $this->common->deleteRolePermissions($id,$delete_ids);
            }
            if(!empty($add_ids)){
                $result = $this->common->addRolePermissions($id,$add_ids);
            }
            if($result){
                $result = array('status' => true, 'message' => 'Role Permissions are updated!');
                return json_encode($result);
            }else{
                $result = array('status' => false, 'message' => 'Please try later!');
                return json_encode($result);
            }
        } else {
            $result = array('status' => false, 'message' => 'Invalid request!');
            return json_encode($result);
        }
    }
}
