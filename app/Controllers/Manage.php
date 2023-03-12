<?php

namespace App\Controllers;

use App\Libraries\Utilslib;
use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class Manage extends BaseController
{
    protected $session;
    protected $uri_segment;
    protected $common;
    protected $userModel;
    protected $utilslib;
    public function __construct()
    {
        $this->session = session();
        $this->uri_segment = service('uri');
        $this->common = new Common();
        $this->userModel = new UserModel();
        $this->utilslib = new Utilslib();
    }
    
    
    public function login()
    {
        // $userId = checkSessionUserId();
        if(checkSession()){
            return redirect()->to('manage/dashboard');
        }else{
            $data = array();
            $data['title'] = 'Log In';
            $data["form_type"] = "login";
            return view('manage/login/login',$data);
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('manage');
    }

    public function register()
    {
        // $userId = checkSessionUserId();
        if(checkSession()){
            return redirect()->to('manage/dashboard');
        }else{
            $data = array();
            $data['title'] = 'Register';
            $data["form_type"] = "register";
            $data['gender_details'] = $this->userModel->getGenderDetails();
            $data['user_types'] = $this->userModel->getUserTypes();
            return view('manage/login/register',$data);
        }
    }

    public function forgetPassword()
    {
        // $userId = checkSessionUserId();
        if(checkSession()){
            return redirect()->to('manage/dashboard');
        }else{
            $data = array();
            $data['title'] = 'Forget Password';
            $data["form_type"] = "forget_password";
            return view('manage/login/forget-password',$data);
        }
    }

    public function verification()
    {
        $email = $this->request->getVar('email');
        $verification_code = $this->request->getVar('verification_code');
        if (isset($email) && !empty($email) && isset($verification_code) && !empty($verification_code)) {
            $user_data = $this->common->get_single_row('tbl_user', array('email'=>$email,'verification_code'=>$verification_code), array('id','email','verification_code','verified'));
            // echo '<pre>';print_r($user_data);die;
            if (isset($user_data) && !empty($user_data)) {
                if ($user_data['verified']=='1') {
                    $result = array('status' => true, 'message' => 'You are already verified!');
                    return json_encode($result);
                }else if($user_data['verification_code'] == $verification_code){
                    // echo '<pre>';print_r($this->request->getVar());die;
                    $data = $this->common->data_single_update('tbl_user', array('email'=>$email), array('verified'=>1));
                    if ($data) {
                        $result = array('status' => true, 'message' => 'User successfully verified!');
                        return json_encode($result);
                    }else{
                        $result = array('status' => false, 'message' => 'Verification failed!');
                        return json_encode($result);
                    }
                }else{
                    $result = array('status' => false, 'message' => 'Verification failed!');
                    return json_encode($result);
                }
            } else {
                $result = array('status' => false, 'message' => 'Invalid User!');
                return json_encode($result);
            }
        }
        $result = array('status' => false, 'message' => 'Invalid request!');
        return json_encode($result);
    }

    public function dashboard()
    {
        if(checkSession()){
            $data = array();
            $data['title'] = 'Dashboard';
            $data['heading_title'] = 'Dashboard';
            $data['menu_active'] = 'dashboard';
            return view('manage/dashboard/dashboard',$data);
        }else{
           return redirect()->to('manage');
        }
    }






    
    // roles methods 
    public function roles()
    {
        if(checkSession()){
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
        if(checkSession()){
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
        if(checkSession()){
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







    // student methods 
    public function students()
    {
        if(checkSession()){
            $data = array();
            $data['title'] = 'Students';
            $data['heading_title'] = 'Students';
            $data['menu_active'] = 'students';
            $data['roles'] = $this->common->getAllRoles();
            return view('manage/roles/view-roles',$data);
        }else{
            return redirect()->to('manage/login');
        }
    }


}
