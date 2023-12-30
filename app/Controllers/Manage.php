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



    public function prioritySet()
    {
        if(checkSession()){
            $data = array();
            $data['title'] = 'Priority Set';
            $data['heading_title'] = 'Priority Set';
            $data['menu_active'] = 'dashboard';
            return view('manage/priority-set/priority-set',$data);
        }else{
           return redirect()->to('manage');
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
            $data['students'] = $this->common->getAllStudents();
            // echo '<pre>';print_r($data);die;
            return view('manage/students/view-student',$data);
        }else{
            return redirect()->to('manage/login');
        }
    }

    public function addStudent()
    {
        if(checkSession()){
            $data = array();
            $data['title'] = 'Add Student';
            $data['heading_title'] = 'Add Student';
            $data['menu_active'] = 'add_students';
            $data['form_btn'] = 'add';
            return view('manage/students/add-student',$data);
        }else{
            return redirect()->to('manage/roles');
        }
    }

    public function editStudent()
    {
        $id = $this->request->getVar('id');
        if(checkSession()){
            if(isset($id) && !empty($id) && is_numeric($id)){
                $data = array();
                $data['id'] = $id;
                $data['title'] = 'Edit Students';
                $data['heading_title'] = 'Edit Students';
                $data['menu_active'] = 'edit_students';
                $data['form_btn'] = 'edit';
                $data['student'] = $this->common->getStudent($id);
                if(isset($data['student'])){
                    // echo '<pre>';print_r($data);die;
                    return view('manage/students/add-student',$data);
                }else{
                    return redirect()->to('manage/students');
                }
            }else{
                return redirect()->to('manage/students');
            }
        }else{
            return redirect()->to('manage/students');
        }
    }


}
