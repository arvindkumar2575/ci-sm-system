<?php

namespace App\Controllers;

use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class APIPermissions extends BaseController
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
    // add edit permission 
    public function addEditPermission()
    {
        $form_type = $this->request->getVar('form_type');
        if ($form_type == "ADD_PERMISSION") {
            // echo '<pre>';print_r($this->request);die;
            $name = $this->request->getVar('name');
            $display_name = $this->request->getVar('display_name');
            $parent = $this->request->getVar('parent');
            $priority = $this->request->getVar('priority') ?? 0;
            $remarks = $this->request->getVar('remarks');
            $routing_url = $this->request->getVar('routing_url');
            $status = $this->request->getVar('status');

            $isPermissionExit = 0;
            if (!empty($name)) {
                $isPermissionExit = $this->common->get_single_row('tbl_permissions', array('name' => $name), array('id'));
            } else {
                $result = array('status' => false, 'message' => 'Add Permission Name!');
                return json_encode($result);
            }
            // var_dump(!$isPermissionExit);die();
            if (!$isPermissionExit) {
                $permission_id = $this->addeditPermissionData($form_type, '', $name, $display_name, $parent, $priority, $remarks, $routing_url, $status);
                if ($permission_id) {
                    $result = array('status' => true, 'message' => 'Successfully role added!', 'id' => $permission_id);
                    return json_encode($result);
                } else {
                    $result = array('status' => false, 'message' => 'Please try again!');
                    return json_encode($result);
                }
            } else {
                $result = array('status' => false, 'message' => 'Permission Name already exited!');
                return json_encode($result);
            }
        } else if ($form_type == "EDIT_PERMISSION") {
            // echo '<pre>';print_r($this->request->getVar());die;
            $id = $this->request->getVar('id');
            $name = $this->request->getVar('name');
            $display_name = $this->request->getVar('display_name');
            $parent = $this->request->getVar('parent');
            $priority = $this->request->getVar('priority');
            $remarks = $this->request->getVar('remarks');
            $routing_url = $this->request->getVar('routing_url');
            $status = $this->request->getVar('status');

            $isPermissionExit = 0;
            if (!empty($name)) {
                $isPermissionExit = $this->common->get_single_row('tbl_permissions', array('id' => $id, 'name' => $name), array('id'));
            } else {
                $result = array('status' => false, 'message' => 'Add Permission Name!');
                return json_encode($result);
            }
            if ($isPermissionExit) {
                $permission_id = $this->addeditPermissionData($form_type, $id, $name, $display_name, $parent, $priority, $remarks, $routing_url, $status);
                if ($permission_id) {
                    $result = array('status' => true, 'message' => 'Successfully permission saved!', 'id' => $permission_id);
                    return json_encode($result);
                } else {
                    $result = array('status' => false, 'message' => 'Please try again!');
                    return json_encode($result);
                }
            } else {
                $result = array('status' => false, 'message' => 'Permission Name not exited!');
                return json_encode($result);
            }
        } else {
            $result = array('status' => false, 'message' => 'Invalid request!');
            return json_encode($result);
        }
    }

    private function addeditPermissionData($form_type, $id, $name, $display_name, $parent, $priority, $remarks, $routing_url, $status)
    {
        if ($form_type == 'ADD_PERMISSION') {
            $permission_data = array(
                'name' => $name,
                'display_name' => $display_name,
                'parent' => $parent,
                'priority' => $priority,
                'remarks' => $remarks,
                'routing_url' => $routing_url,
                'status' => $status
            );
            // echo '<pre>';print_r($permission_data);die;
            $permission_id = $this->common->data_insert('tbl_permissions', $permission_data);
            if ($permission_id) {
                return $permission_id;
            } else {
                return false;
            }
        } else if ($form_type == 'EDIT_PERMISSION') {
            $where = array(
                'id' => $id
            );
            $permission_data = array(
                'display_name' => $display_name,
                'parent' => $parent,
                'priority' => $priority,
                'remarks' => $remarks,
                'routing_url' => $routing_url,
                'status' => $status
            );
            $permission_id = $this->common->data_single_update('tbl_permissions', $where, $permission_data);
            if ($permission_id) {
                return $id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deletePermission()
    {
        $result = array('status' => false, 'message' => 'Permission not allowed!');
        return json_encode($result);


        $id = $this->request->getVar('id');
        if (!empty($id)) {
            $isDelete = $this->common->deletePermission($id);
            if ($isDelete) {
                $result = array('status' => true, 'message' => 'Permission successfully deleted!');
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

    public function saveUserPermission()
    {
        $result=array();
        $id = $this->request->getVar('id');
        $ids = $this->request->getVar('ids');
        if (!empty($id) && !empty($ids)) {
            $permission_ids = $this->common->getUserPermissionsIds($id);
            $delete_ids = array_diff($permission_ids,$ids);
            $add_ids = array_diff($ids,$permission_ids);
            if(!empty($delete_ids)){
                $result = $this->common->deleteUserPermissions($id,$delete_ids);
            }
            if(!empty($add_ids)){
                $result = $this->common->addUserPermissions($id,$add_ids);
            }
            if($result){
                $result = array('status' => true, 'message' => 'User Permissions are updated!');
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
