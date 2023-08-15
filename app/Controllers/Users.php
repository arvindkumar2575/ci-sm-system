<?php

namespace App\Controllers;

use App\Libraries\Utilslib;
use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class Users extends BaseController
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


    public function user()
    {
        if (checkSession() && $this->common->checkUriPermission()) {
            $data = array();
            $data['title'] = 'Users';
            $data['heading_title'] = 'Users';
            $data['menu_active'] = 'users';
            $data['users'] = $this->userModel->getUsers();
            return view('manage/users/view-users', $data);
        } else {
            return redirect()->to('manage/login');
        }
    }

    public function addUser()
    {
        if (checkSession() && $this->common->checkUriPermission()) {
            $data = array();
            $data['title'] = 'Add Users';
            $data['heading_title'] = 'Add Users';
            $data['menu_active'] = 'add_user';
            $data['form_btn'] = 'add';
            $data['form'] = view('manage/users/add-edit-user-form',$data);
            return view('manage/users/add-edit-user', $data);
        } else {
            return redirect()->to('manage/login');
        }
    }

    public function editUser()
    {
        $id = $this->request->getVar('uid');
        // echo "<pre>";print_r($id);die;
        if (checkSession() && $this->common->checkUriPermission()) {
            $data = array();
            $data['title'] = 'Edit Users';
            $data['heading_title'] = 'Edit Users';
            $data['menu_active'] = 'edit_user';
            $data['form_btn'] = 'edit';
            if($id){
                $data['id'] = $id;
                $data['user'] = $this->userModel->getUserDetails($id);
                if($data['user']){
                    $data['form'] = view('manage/users/add-edit-user-form',$data);
                }else{
                    return redirect()->to('manage/users');
                }
            }else{
                $data['form'] = '';
            }
            // echo '<pre>';print_r($data);die;
            return view('manage/users/add-edit-user', $data);
        } else {
            // echo "<pre>";print_r($id);die;
            return redirect()->to('manage/login');
        }
    }

    public function editUserPermissions()
    {
        $id = $this->request->getVar('uid');
        if (checkSession() && $this->common->checkUriPermission()) {
            $data = array();
            $data['title'] = 'Edit User Permissions';
            $data['heading_title'] = 'Edit User Permissions';
            $data['menu_active'] = 'edit_user_permissions';
            $data['form_btn'] = 'edit';
            $data['form_type'] = 'user';
            $data['user_permissions'] = array();
            if($id){
                $data['id'] = $id;
                $data['user'] = $this->userModel->getUserDetails($id);
                // get user permission array 
                $data['user_permissions'] =  $this->common->getUserPermissionsIds($id);
                // get all permission in menu list 
                $permissions = $this->common->getAllPermissions();
                $data['all_permissions'] = $this->utilslib->menuList($permissions);
                if($data['user']){
                    $data['form'] = view('manage/users/add-edit-permission-form',$data);
                }else{
                    return redirect()->to('manage/user-permissions');
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
