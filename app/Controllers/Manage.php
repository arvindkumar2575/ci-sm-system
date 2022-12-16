<?php

namespace App\Controllers;

use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class Manage extends BaseController
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
    
    
    public function login()
    {
        $userId = checkSessionUserId();
        if(checkSession()){
            return redirect()->to('manage/'.$userId.'/dashboard');
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
        $userId = checkSessionUserId();
        if(checkSession()){
            return redirect()->to('manage/'.$userId.'/dashboard');
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
        $userId = checkSessionUserId();
        if(checkSession()){
            return redirect()->to('manage/'.$userId.'/dashboard');
        }else{
            $data = array();
            $data['title'] = 'Forget Password';
            $data["form_type"] = "forget_password";
            return view('manage/login/forget-password',$data);
        }
    }

    public function dashboard()
    {
        if(checkSession()){
            $data = array();
            $data['title'] = 'Dashboard';
            return view('manage/dashboard/dashboard',$data);
        }else{
           return redirect()->to('manage');
        }
    }

    public function authenticate()
    {
        $form_type = $this->request->getVar('form_type');
        if($form_type=="login"){
            $email = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $data = $this->common->get_single_row("tbl_user","email",$email);
            // echo '<pre>';print_r($data);die;
            if($data){
                $pass = $data['password'];
                $authenticatePass = password_verify($password,$pass);
                if($authenticatePass){
                    $usersession = array(
                        'id'=>$data['id'],
                        'isLoggedIn'=>true
                    );
                    $this->session->set('usersession',$usersession);
                    $result = array('status'=>true,'message'=>'Successfully Logged In!','id'=>$data['id']);
                    return json_encode($result);
                }else{
                    $result = array('status'=>false,'message'=>'Username/Password is not matched!');
                    return json_encode($result);
                }
            }else{
                $result = array('status'=>false,'message'=>'Username/Password not exit!');
                return json_encode($result);
            }
        }else if($form_type=="register"){
            // echo '<pre>';print_r($this->request);die;
            $first_name = $this->request->getVar('first_name');
            $last_name = $this->request->getVar('last_name');
            $gender_id = $this->request->getVar('gender_id');
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $user_type = $this->request->getVar('user_type');
            $details = $this->request->getVar('details');
            $hashPass = password_hash($password,PASSWORD_BCRYPT);
            
            $isEmailExit=0;
            if(!empty($user_type)){
                $isEmailExit = $this->userModel->isEmailExit($email);
            }else{
                $result = array('status'=>false,'message'=>'Select User Type!');
                return json_encode($result);
            }
            // echo $isEmailExit;die();
            // echo '<pre>';print_r($isEmailExit);die;
            if(!$isEmailExit){
                $user_id = $this->signUpData($email,$hashPass,$user_type,$first_name,$last_name,$gender_id,$details);
                if($user_id){
                    $result = array('status'=>true,'message'=>'Successfully Register!','id'=>$user_id);
                    return json_encode($result);
                }else{
                    $result = array('status'=>false,'message'=>'Please try again!');
                    return json_encode($result);
                }
            }else{
                $result = array('status'=>false,'message'=>'Email Id already registered!');
                return json_encode($result);
            }
        }else{
            $result = array('status'=>false,'message'=>'Invalid request!');
            return json_encode($result);
        }
    }

    private function signUpData($email,$password,$user_type,$first_name,$last_name,$gender_id,$details)
    {
        $currentDate = new DateTime();
        $user_data=array(
            'user_type'=>$user_type,
            'email'=>$email,
            'password'=>password_hash($password,PASSWORD_BCRYPT),
            'verified'=>'0',
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'gender_id'=>$gender_id,
            'details'=>json_encode($details),
            'verification_code'=>md5($email),
            'created_at'=>$currentDate->format('Y-m-d H:i:s'),
            'modified_at'=>$currentDate->format('Y-m-d H:i:s'),
        );
        $user_id = $this->common->data_insert('tbl_user',$user_data);
        if($user_id){
            return $user_id;
        }else{
            return false;
        }
    }
}
