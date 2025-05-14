<?php

namespace App\Controllers\StudentManagement;

use App\Controllers\BaseController;
use App\Libraries\Utilslib;
use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class Students extends BaseController
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
