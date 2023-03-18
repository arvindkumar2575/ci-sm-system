<?php

namespace App\Controllers;

use App\Libraries\Utilslib;
use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class APIUsers extends BaseController
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


    public function addEditUser()
    {
        $form_type = $this->request->getVar('form_type');
        if($form_type=="ADD_USER"){
            // echo '<pre>';print_r($this->request);die;
            $first_name = $this->request->getVar('first_name');
            $last_name = $this->request->getVar('last_name');
            $gender_id = $this->request->getVar('gender_id');
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $user_type = $this->request->getVar('user_type');
            $verified = $this->request->getVar('verified');
            $status = $this->request->getVar('status');
            
            $isEmailExit=0;
            if(!empty($user_type)){
                $isEmailExit = $this->userModel->isEmailExit($email);
            }else{
                $result = array('status'=>false,'message'=>'Select User Type!');
                return json_encode($result);
            }
            // echo 'isEmailExit';die();
            if(!$isEmailExit){
                $user_id = $this->addUserData($email,$password,$user_type,$first_name,$last_name,$gender_id,$verified,$status);
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
        }else if($form_type=="EDIT_USER"){
            // echo '<pre>';print_r($this->request->getVar());die;
            $id = $this->request->getVar('id');
            $user_type = $this->request->getVar('user_type');
            $email = $this->request->getVar('email');
            $first_name = $this->request->getVar('first_name');
            $last_name = $this->request->getVar('last_name');
            $gender_id = $this->request->getVar('gender_id');
            $verified = $this->request->getVar('verified');
            $status = $this->request->getVar('status');
            
            $isEmailExit=0;
            if(!empty($user_type)){
                $isEmailExit = $this->userModel->isEmailExit($email);
            }else{
                $result = array('status'=>false,'message'=>'Select User Type!');
                return json_encode($result);
            }
            if($isEmailExit){
                // echo 'isEmailExit';die();
                $user_id = $this->saveUserData($id,$first_name,$last_name,$gender_id,$verified,$status);
                if($user_id){
                    $result = array('status'=>true,'message'=>'Successfully Saved!','id'=>$user_id);
                    return json_encode($result);
                }else{
                    $result = array('status'=>false,'message'=>'Please try again!');
                    return json_encode($result);
                }
            }else{
                $result = array('status'=>false,'message'=>'Email Id not registered!');
                return json_encode($result);
            }
        }else{
            $result = array('status'=>false,'message'=>'Invalid request!');
            return json_encode($result);
        }
    }

    public function deleteUser()
    {
        // echo '<pre>';print_r($this->request->getVar());die;
        $id = $this->request->getVar('id');
        if(!empty($id)){
            $isDelete = $this->userModel->deleteUser($id);
            if($isDelete){
                $result = array('status'=>true,'message'=>'User successfully deleted!');
                return json_encode($result);
            }else{
                $result = array('status'=>false,'message'=>'Uid not registered!');
                return json_encode($result);
            }
        }else{
            $result = array('status'=>false,'message'=>'Invalid request!');
            return json_encode($result);
        }
    }

    // add new user 
    private function addUserData($email,$password,$user_type,$first_name,$last_name,$gender_id,$verified,$status)
    {
        $currentDate = new DateTime();
        $user_data=array(
            'user_type'=>$user_type,
            'email'=>$email,
            'password'=>password_hash($password,PASSWORD_BCRYPT),
            'verified'=>$verified??'0',
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'gender_id'=>$gender_id,
            // 'details'=>isset($details)?json_encode($details):'',
            'verification_code'=>md5($email),
            'status'=>$status,
            'created_at'=>$currentDate->format('Y-m-d H:i:s'),
            'modified_at'=>$currentDate->format('Y-m-d H:i:s'),
        );
        // echo '<pre>';print_r($user_data);die;
        $user_id = $this->common->data_insert('tbl_user',$user_data);
        if($user_id){
            return $user_id;
        }else{
            return false;
        }
    }

    // edit user 
    private function saveUserData($id,$first_name,$last_name,$gender_id,$verified,$status)
    {
        $currentDate = new DateTime();
        $where = array(
            'id'=>$id
        );
        $user_data=array(
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'gender_id'=>$gender_id,
            'verified'=>$verified??'0',
            'status'=>$status,
            'modified_at'=>$currentDate->format('Y-m-d H:i:s'),
        );
        // echo '<pre>';print_r($user_data);die;
        $user_id = $this->common->data_single_update('tbl_user', $where, $user_data);
        if($user_id){
            return $id;
        }else{
            return false;
        }
    }


    public function fetchUserEditForm($form_btn=null,$id=null,$action=null)
    {
        $data['form_btn'] = $this->request->getVar('form_btn')??$form_btn;
        $data['id'] = $this->request->getVar('id')??$id;
        $action = $this->request->getVar('action')??$action;
        $form='';
        $data['user_permissions'] =  $this->common->getUserPermissionsIds($data['id']);
        // echo '<pre>';print_r($data);die;
        if($action=='edit_user'){
            $data['user'] = $this->userModel->getUserDetails($data['id']);
            $form = view('manage/users/add-edit-user-form', $data);
        }elseif($action=='permission_user'){
            $permissions = $this->common->getAllPermissions();
            $data['all_permissions'] = $this->utilslib->menuList($permissions);
            $form = view('manage/users/add-edit-permission-form', $data);
        }
        $result = array('status'=>true,'data'=>$form);
        return json_encode($result);
    }
}
