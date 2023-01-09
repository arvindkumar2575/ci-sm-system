<?php

namespace App\Controllers;

use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class APIController extends BaseController
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



    // add edit role 
    public function addEditRole()
    {
        $form_type = $this->request->getVar('form_type');
        if($form_type=="ADD_ROLE"){
            // echo '<pre>';print_r($this->request);die;
            $name = $this->request->getVar('name');
            $display_name = $this->request->getVar('display_name');
            $parent = $this->request->getVar('parent');
            $remarks = $this->request->getVar('remarks');
            
            $isRoleExit=0;
            if(!empty($name)){
                $isRoleExit = $this->common->get_single_row('tbl_roles',array('name'=>$name),array('id'));
            }else{
                $result = array('status'=>false,'message'=>'Add Role Name!');
                return json_encode($result);
            }
            // var_dump(!$isRoleExit);die();
            if(!$isRoleExit){
                $role_id = $this->addeditRoleData($form_type,'',$name,$display_name,$parent,$remarks);
                if($role_id){
                    $result = array('status'=>true,'message'=>'Successfully role added!','id'=>$role_id);
                    return json_encode($result);
                }else{
                    $result = array('status'=>false,'message'=>'Please try again!');
                    return json_encode($result);
                }
            }else{
                $result = array('status'=>false,'message'=>'Role Name already exited!');
                return json_encode($result);
            }
        }else if($form_type=="EDIT_ROLE"){
            // echo '<pre>';print_r($this->request->getVar());die;
            $id = $this->request->getVar('id');
            $name = $this->request->getVar('name');
            $display_name = $this->request->getVar('display_name');
            $parent = $this->request->getVar('parent');
            $remarks = $this->request->getVar('remarks');
            
            $isRoleExit=0;
            if(!empty($name)){
                $isRoleExit = $this->common->get_single_row('tbl_roles',array('id'=>$id,'name'=>$name),array('id'));
            }else{
                $result = array('status'=>false,'message'=>'Add Role Name!');
                return json_encode($result);
            }
            if($isRoleExit){
                $role_id = $this->addeditRoleData($form_type,$id,$name,$display_name,$parent,$remarks);
                if($role_id){
                    $result = array('status'=>true,'message'=>'Successfully role saved!','id'=>$role_id);
                    return json_encode($result);
                }else{
                    $result = array('status'=>false,'message'=>'Please try again!');
                    return json_encode($result);
                }
            }else{
                $result = array('status'=>false,'message'=>'Role Name not exited!');
                return json_encode($result);
            }
        }else{
            $result = array('status'=>false,'message'=>'Invalid request!');
            return json_encode($result);
        }
    }

    private function addeditRoleData($form_type,$id,$name,$display_name,$parent,$remarks)
    {
        if($form_type=='ADD_ROLE'){
            $role_data=array(
                'name'=>$name,
                'display_name'=>$display_name,
                'parent'=>$parent,
                'remarks'=>$remarks
            );
            // echo '<pre>';print_r($role_data);die;
            $role_id = $this->common->data_insert('tbl_roles',$role_data);
            if($role_id){
                return $role_id;
            }else{
                return false;
            }
        }else if($form_type=='EDIT_ROLE'){
            $where = array(
                'id'=>$id
            );
            $role_data=array(
                'display_name'=>$display_name,
                'parent'=>$parent,
                'remarks'=>$remarks
            );
            $role_id = $this->common->data_single_update('tbl_roles', $where, $role_data);
            if($role_id){
                return $id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function deleteRole()
    {
        $result = array('status'=>false,'message'=>'Permission not allowed!');
        return json_encode($result);


        $id = $this->request->getVar('id');
        if(!empty($id)){
            $isDelete = $this->common->deleteRole($id);
            if($isDelete){
                $result = array('status'=>true,'message'=>'Role successfully deleted!');
                return json_encode($result);
            }else{
                $result = array('status'=>false,'message'=>'Id not exit!');
                return json_encode($result);
            }
        }else{
            $result = array('status'=>false,'message'=>'Invalid request!');
            return json_encode($result);
        }
    }



    // add edit permission 
    public function addEditPermission()
    {
        $form_type = $this->request->getVar('form_type');
        if($form_type=="ADD_PERMISSION"){
            // echo '<pre>';print_r($this->request);die;
            $name = $this->request->getVar('name');
            $display_name = $this->request->getVar('display_name');
            $parent = $this->request->getVar('parent');
            $remarks = $this->request->getVar('remarks');
            
            $isPermissionExit=0;
            if(!empty($name)){
                $isPermissionExit = $this->common->get_single_row('tbl_permissions',array('name'=>$name),array('id'));
            }else{
                $result = array('status'=>false,'message'=>'Add Permission Name!');
                return json_encode($result);
            }
            // var_dump(!$isPermissionExit);die();
            if(!$isPermissionExit){
                $permission_id = $this->addeditPermissionData($form_type,'',$name,$display_name,$parent,$remarks);
                if($permission_id){
                    $result = array('status'=>true,'message'=>'Successfully role added!','id'=>$permission_id);
                    return json_encode($result);
                }else{
                    $result = array('status'=>false,'message'=>'Please try again!');
                    return json_encode($result);
                }
            }else{
                $result = array('status'=>false,'message'=>'Permission Name already exited!');
                return json_encode($result);
            }
        }else if($form_type=="EDIT_PERMISSION"){
            // echo '<pre>';print_r($this->request->getVar());die;
            $id = $this->request->getVar('id');
            $name = $this->request->getVar('name');
            $display_name = $this->request->getVar('display_name');
            $parent = $this->request->getVar('parent');
            $remarks = $this->request->getVar('remarks');
            
            $isPermissionExit=0;
            if(!empty($name)){
                $isPermissionExit = $this->common->get_single_row('tbl_permissions',array('id'=>$id,'name'=>$name),array('id'));
            }else{
                $result = array('status'=>false,'message'=>'Add Permission Name!');
                return json_encode($result);
            }
            if($isPermissionExit){
                $permission_id = $this->addeditPermissionData($form_type,$id,$name,$display_name,$parent,$remarks);
                if($permission_id){
                    $result = array('status'=>true,'message'=>'Successfully permission saved!','id'=>$permission_id);
                    return json_encode($result);
                }else{
                    $result = array('status'=>false,'message'=>'Please try again!');
                    return json_encode($result);
                }
            }else{
                $result = array('status'=>false,'message'=>'Permission Name not exited!');
                return json_encode($result);
            }
        }else{
            $result = array('status'=>false,'message'=>'Invalid request!');
            return json_encode($result);
        }
    }

    private function addeditPermissionData($form_type,$id,$name,$display_name,$parent,$remarks)
    {
        if($form_type=='ADD_PERMISSION'){
            $permission_data=array(
                'name'=>$name,
                'display_name'=>$display_name,
                'parent'=>$parent,
                'remarks'=>$remarks
            );
            // echo '<pre>';print_r($permission_data);die;
            $permission_id = $this->common->data_insert('tbl_permissions',$permission_data);
            if($permission_id){
                return $permission_id;
            }else{
                return false;
            }
        }else if($form_type=='EDIT_PERMISSION'){
            $where = array(
                'id'=>$id
            );
            $permission_data=array(
                'display_name'=>$display_name,
                'parent'=>$parent,
                'remarks'=>$remarks
            );
            $permission_id = $this->common->data_single_update('tbl_permissions', $where, $permission_data);
            if($permission_id){
                return $id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function deletePermission()
    {
        $result = array('status'=>false,'message'=>'Permission not allowed!');
        return json_encode($result);


        $id = $this->request->getVar('id');
        if(!empty($id)){
            $isDelete = $this->common->deletePermission($id);
            if($isDelete){
                $result = array('status'=>true,'message'=>'Permission successfully deleted!');
                return json_encode($result);
            }else{
                $result = array('status'=>false,'message'=>'Id not exit!');
                return json_encode($result);
            }
        }else{
            $result = array('status'=>false,'message'=>'Invalid request!');
            return json_encode($result);
        }
    }



    
    // add edit menu 
    public function addEditMenu()
    {
        $form_type = $this->request->getVar('form_type');
        if($form_type=="ADD_MENU"){
            // echo '<pre>';print_r($this->request);die;
            $name = $this->request->getVar('name');
            $display_name = $this->request->getVar('display_name');
            $parent = $this->request->getVar('parent');
            $priority = $this->request->getVar('priority');
            $remarks = $this->request->getVar('remarks');
            
            $isMenuExit=0;
            if(!empty($name)){
                $isPermissionExit = $this->common->get_single_row('tbl_menu',array('name'=>$name),array('id'));
            }else{
                $result = array('status'=>false,'message'=>'Add Menu Name!');
                return json_encode($result);
            }
            // var_dump(!$isMenuExit);die();
            if(!$isMenuExit){
                $menu_id = $this->addeditMenuData($form_type,'',$name,$display_name,$parent,$priority,$remarks);
                if($menu_id){
                    $result = array('status'=>true,'message'=>'Successfully menu added!','id'=>$menu_id);
                    return json_encode($result);
                }else{
                    $result = array('status'=>false,'message'=>'Please try again!');
                    return json_encode($result);
                }
            }else{
                $result = array('status'=>false,'message'=>'Menu Name already exited!');
                return json_encode($result);
            }
        }else if($form_type=="EDIT_MENU"){
            // echo '<pre>';print_r($this->request->getVar());die;
            $id = $this->request->getVar('id');
            $name = $this->request->getVar('name');
            $display_name = $this->request->getVar('display_name');
            $parent = $this->request->getVar('parent');
            $priority = $this->request->getVar('priority');
            $remarks = $this->request->getVar('remarks');
            
            $isMenuExit=0;
            if(!empty($name)){
                $isMenuExit = $this->common->get_single_row('tbl_menu',array('id'=>$id,'name'=>$name),array('id'));
            }else{
                $result = array('status'=>false,'message'=>'Add Menu Name!');
                return json_encode($result);
            }
            if($isMenuExit){
                $menu_id = $this->addeditMenuData($form_type,$id,$name,$display_name,$parent,$priority,$remarks);
                if($menu_id){
                    $result = array('status'=>true,'message'=>'Successfully menu saved!','id'=>$menu_id);
                    return json_encode($result);
                }else{
                    $result = array('status'=>false,'message'=>'Please try again!');
                    return json_encode($result);
                }
            }else{
                $result = array('status'=>false,'message'=>'Menu Name not exited!');
                return json_encode($result);
            }
        }else{
            $result = array('status'=>false,'message'=>'Invalid request!');
            return json_encode($result);
        }
    }

    private function addeditMenuData($form_type,$id,$name,$display_name,$parent,$priority,$remarks)
    {
        if($form_type=='ADD_MENU'){
            $menu_data=array(
                'name'=>$name,
                'display_name'=>$display_name,
                'parent'=>$parent,
                'priority'=>$priority,
                'remarks'=>$remarks
            );
            // echo '<pre>';print_r($menu_data);die;
            $menu_id = $this->common->data_insert('tbl_menu',$menu_data);
            if($menu_id){
                return $menu_id;
            }else{
                return false;
            }
        }else if($form_type=='EDIT_MENU'){
            $where = array(
                'id'=>$id
            );
            $menu_data=array(
                'display_name'=>$display_name,
                'parent'=>$parent,
                'priority'=>$priority,
                'remarks'=>$remarks
            );
            $menu_id = $this->common->data_single_update('tbl_menu', $where, $menu_data);
            if($menu_id){
                return $id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function deleteMenu()
    {
        $result = array('status'=>false,'message'=>'Permission not allowed!');
        return json_encode($result);


        $id = $this->request->getVar('id');
        if(!empty($id)){
            $isDelete = $this->common->deleteMenu($id);
            if($isDelete){
                $result = array('status'=>true,'message'=>'Menu successfully deleted!');
                return json_encode($result);
            }else{
                $result = array('status'=>false,'message'=>'Id not exit!');
                return json_encode($result);
            }
        }else{
            $result = array('status'=>false,'message'=>'Invalid request!');
            return json_encode($result);
        }
    }


}



