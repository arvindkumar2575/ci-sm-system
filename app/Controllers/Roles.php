<?php

namespace App\Controllers;

use App\Libraries\Utilslib;
use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class Roles extends BaseController
{
    protected $session;
    protected $uri_segment;
    protected $common;
    protected $userModel;
    protected $utilslib;
    protected $apiUsers;
    public function __construct()
    {
        $this->session = session();
        $this->uri_segment = service('uri');
        $this->common = new Common();
        $this->userModel = new UserModel();
        $this->utilslib = new Utilslib();
        $this->apiUsers = new APIUsers();
    }


    // roles methods 
    public function roles()
    {
        if(checkSession() && $this->common->checkUriPermission()){
            $data = array();
            $data['title'] = 'Roles';
            $data['heading_title'] = 'Roles';
            $data['menu_active'] = 'roles';
            $data['roles'] = $this->common->getAllRoles();
            return view('manage/roles/view-roles',$data);
        }else{
            return redirect()->to('manage/login');
        }
    }

    public function addRole()
    {
        if(checkSession() && $this->common->checkUriPermission()){
            $data = array();
            $data['title'] = 'Add Role';
            $data['heading_title'] = 'Add Role';
            $data['menu_active'] = 'add_roles';
            $data['role_list'] = $this->common->getRoleList();
            $data['form_btn'] = 'add';
            return view('manage/roles/add-role',$data);
        }else{
            return redirect()->to('manage/roles');
        }
    }

    public function editRole()
    {
        $id = $this->request->getVar('id');
        if(checkSession() && $this->common->checkUriPermission()){
            if(isset($id) && !empty($id) && is_numeric($id)){
                $data = array();
                $data['role_id'] = $id;
                $data['title'] = 'Roles';
                $data['heading_title'] = 'Roles';
                $data['menu_active'] = 'add_roles';
                $data['form_btn'] = 'edit';
                $data['role_list'] = $this->common->getRoleList();
                $data['role'] = $this->common->getRole($id);
                if(isset($data['role'])){
                    // echo '<pre>';print_r($data);die;
                    return view('manage/roles/add-role',$data);
                }else{
                    return redirect()->to('manage/roles');
                }
            }else{
                return redirect()->to('manage/roles');
            }
        }else{
            return redirect()->to('manage/roles');
        }
    }

    public function editRolePermissions()
    {
        $id = $this->request->getVar('uid');
        if (checkSession() && $this->common->checkUriPermission()) {
            $data = array();
            $data['title'] = 'Edit Role Permissions';
            $data['heading_title'] = 'Edit Role Permissions';
            $data['menu_active'] = 'edit_role_permissions';
            $data['form_btn'] = 'edit';
            $data['form_type'] = 'role';
            $data['role_permissions'] = array();
            if($id){
                $data['id'] = $id;
                $data['role'] = $this->userModel->getRoleDetails($id);
                // get role permission array 
                $data['role_permissions'] =  $this->common->getRolePermissionsIds($id);
                // get all permission in menu list 
                $permissions = $this->common->getAllPermissions();
                $data['all_permissions'] = $this->utilslib->menuList($permissions);
                if($data['role']){
                    $data['form'] = view('manage/users/add-edit-permission-form',$data);
                }else{
                    return redirect()->to('manage/roles');
                }
            }else{
                $data['form'] = '';
            }
            // echo '<pre>';print_r($data);die;
            return view('manage/users/user-permissions', $data);
        } else {
            return redirect()->to('manage/login');
        }
    }

}
