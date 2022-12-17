<?php

namespace App\Controllers;

use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class Users extends BaseController
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
    
    
    public function index()
    {
        // $userId = checkSessionUserId();
        if(checkSession()){
            $data = array();
            $data['title'] = 'Users';
            $data['heading_title'] = 'Users';
            $data['menu_active'] = 'users';
            return view('manage/users/view-users',$data);
        }else{
            return redirect()->to('manage/login');
        }
    }

    public function addUser()
    {
        // $userId = checkSessionUserId();
        if(checkSession()){
            $data = array();
            $data['title'] = 'Add Users';
            $data['heading_title'] = 'Add Users';
            $data['menu_active'] = 'add_user';
            $data['gender_details'] = $this->userModel->getGenderDetails();
            $data['user_types'] = $this->userModel->getUserTypes();
            $data['form_btn'] = 'add';
            return view('manage/users/add-user',$data);
        }else{
            return redirect()->to('manage/login');
        }
    }

    public function editUser()
    {
        // $userId = checkSessionUserId();
        if(checkSession()){
            $data = array();
            $data['title'] = 'Edit Users';
            $data['heading_title'] = 'Edit Users';
            $data['menu_active'] = 'edit_user';
            $data['gender_details'] = $this->userModel->getGenderDetails();
            $data['user_types'] = $this->userModel->getUserTypes();
            $data['form_btn'] = 'add';
            return view('manage/users/add-user',$data);
        }else{
            return redirect()->to('manage/login');
        }
    }

}
