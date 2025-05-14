<?php

namespace App\Controllers\AssessmentManagement;

use App\Controllers\BaseController;
use App\Libraries\AssessmentLib;
use App\Libraries\Utilslib;
use App\Models\Common;
use App\Models\UserModel;
use DateTime;

class Assessment extends BaseController
{
    protected $session;
    protected $uri_segment;
    protected $common;
    protected $userModel;
    protected $utilslib;
    protected $assessmentLib;
    public function __construct()
    {
        $this->session = session();
        $this->uri_segment = service('uri');
        $this->common = new Common();
        $this->userModel = new UserModel();
        $this->utilslib = new Utilslib();
        $this->assessmentLib = new AssessmentLib();
    }


    // assessment methods
    public function assessments()
    {
        if(checkSession()){
            $data = array();
            $data['title'] = 'Assessments';
            $data['heading_title'] = 'Assessments';
            $data['menu_active'] = 'assessments';
            $data['assessment_identifier'] = $this->uri_segment->getSegment(3);
            if(!empty($data['assessment_identifier'])){
                $data['assessments'] = $this->assessmentLib->getAssessmentStructure("webapp",$data['assessment_identifier']);
            }else{
                $data['assessments'] = $this->common->get_data("tbl_assessments",array(),array("id","identifier","display_name","priority"),"multiple");
            }
            // echo '<pre>';print_r($data);die;
            return view('manage/assessment/view-assessment',$data);
        }else{
            return redirect()->to('manage/login');
        }
    }

    public function addAssessment()
    {
        if(checkSession()){
            $data = array();
            $data['title'] = 'Add Assessment';
            $data['heading_title'] = 'Add Assessment';
            $data['menu_active'] = 'add_assessments';
            $data['assessment_list'] = $this->assessmentLib->getSpecificAssessment("website",array());
            $data['form_btn'] = 'add';
            // echo '<pre>';print_r($data);die;
            return view('manage/assessment/add-assessment',$data);
        }else{
            return redirect()->to('manage/assessment');
        }
    }

    public function editAssessment()
    {
        $id = $this->request->getVar('id'); //assessment_identifier
        if(checkSession()){
            $data = array();
            $data['assessment_id'] = $id;
            $data['title'] = 'Assessments';
            $data['heading_title'] = 'Assessments';
            $data['menu_active'] = 'edit_assessment';
            $data['form_btn'] = 'edit';
            $data['assessment'] = $this->common->get_data("tbl_assessments",array("identifier"=>$id),array("id","identifier","display_name","priority","details"));
            // echo '<pre>';print_r($data);die;
            if(isset($data['assessment'])){
                return view('manage/assessment/add-assessment',$data);
            }else{
                return redirect()->to('manage/assessments');
            }
        }else{
            return redirect()->to('manage/assessments');
        }
    }



}
