<?php

namespace App\Controllers;

use App\Libraries\Utilslib;
use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class Permissions extends BaseController
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


    // permissions methods
    public function permissions()
    {
        if(checkSession()){
            $data = array();
            $data['title'] = 'Permissions';
            $data['heading_title'] = 'Permissions';
            $data['menu_active'] = 'permissions';
            $data['permissions'] = $this->common->getAllPermissions();
            return view('manage/permissions/view-permissions',$data);
        }else{
            return redirect()->to('manage/login');
        }
    }

    public function addPermission()
    {
        if(checkSession()){
            $data = array();
            $data['title'] = 'Add permission';
            $data['heading_title'] = 'Add permission';
            $data['menu_active'] = 'add_permissions';
            $data['permission_list'] = $this->common->getPermissionList();
            $data['form_btn'] = 'add';
            // echo '<pre>';print_r($data);die;
            return view('manage/permissions/add-permission',$data);
        }else{
            return redirect()->to('manage/roles');
        }
    }

    public function editPermission()
    {
        $id = $this->request->getVar('id');
        if(checkSession()){
            if(isset($id) && !empty($id) && is_numeric($id)){
                $data = array();
                $data['permission_id'] = $id;
                $data['title'] = 'Permissions';
                $data['heading_title'] = 'Permissions';
                $data['menu_active'] = 'add_permissions';
                $data['form_btn'] = 'edit';
                $data['permission_list'] = $this->common->getPermissionList();
                $data['permission'] = $this->common->getPermission($id);
                if(isset($data['permission'])){
                    // echo '<pre>';print_r($data);die;
                    return view('manage/permissions/add-permission',$data);
                }else{
                    return redirect()->to('manage/permissions');
                }
            }else{
                return redirect()->to('manage/permissions');
            }
        }else{
            return redirect()->to('manage/permissions');
        }
    }



}
