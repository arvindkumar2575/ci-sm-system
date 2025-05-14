<?php

namespace App\Controllers;

use App\Models\Common;
use App\Models\UserModel;

class APIAssessment extends BaseController
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

    // add edit role 
    public function addEditAssessment()
    {
        $form_type = $this->request->getVar('form_type');
        if ($form_type == "ADD_ASSESSMENT") {
            $id = $this->request->getVar('id');
            $identifier = $this->request->getVar('identifier');
            $display_name = $this->request->getVar('display_name');
            $priority = $this->request->getVar('priority');
            $details = $this->request->getVar('details');

            $exits = $this->common->get_data("tbl_assessments",array("identifier" => $identifier),array("id"));
            if ($exits) {
                $assessment_id = $this->addeditAssessmentData($form_type, $id, $identifier, $display_name, $priority, $details);
                if ($assessment_id) {
                    $result = array('status' => true, 'message' => 'Successfully assessment added!', 'id' => $assessment_id);
                    return json_encode($result);
                } else {
                    $result = array('status' => false, 'message' => 'Please try again!');
                    return json_encode($result);
                }
            } else {
                $result = array('status' => false, 'message' => 'Assessment already exited!');
                return json_encode($result);
            }
        } else if ($form_type == "EDIT_ASSESSMENT") {
            $id = $this->request->getVar('id');
            $identifier = $this->request->getVar('identifier');
            $display_name = $this->request->getVar('display_name');
            $priority = $this->request->getVar('priority');
            $details = $this->request->getVar('details');

            $exits = $this->common->get_data("tbl_assessments",array("id" => $id, "identifier" => $identifier),array("id"));
            if ($exits) {
                $assessment_id = $this->addeditAssessmentData($form_type, $id, $identifier, $display_name, $priority, $details);
                if ($assessment_id) {
                    $result = array('status' => true, 'message' => 'Successfully assessment added!', 'id' => $id);
                    return json_encode($result);
                } else {
                    $result = array('status' => false, 'message' => 'Please try again!');
                    return json_encode($result);
                }
            } else {
                $result = array('status' => false, 'message' => 'Assessment already exited!');
                return json_encode($result);
            }
        } else {
            $result = array('status' => false, 'message' => 'Invalid request!');
            return json_encode($result);
        }
    }

    private function addeditAssessmentData($form_type, $id, $identifier, $display_name, $priority, $details)
    {
        if ($form_type == 'ADD_ASSESSMENT') {
            $data = array(
                "identifier" => $identifier,
                "display_name" => $display_name,
                "priority" => $priority,
                "details" => $details
            );
            // echo '<pre>';print_r($data);die;
            $assessment_id = $this->common->data_insert('tbl_assessments', $data);
            if ($assessment_id) {
                return $assessment_id;
            } else {
                return false;
            }
        } else if ($form_type == 'EDIT_ASSESSMENT') {
            $data = array(
                "display_name" => $display_name,
                "priority" => $priority,
                "details" => $details
            );
            $where = array(
                "id" => $id,
                "identifier" => $identifier
            );
            // echo '<pre>';print_r($data);die;
            $assessment_id = $this->common->data_single_update('tbl_assessments', $where, $data);
            if ($assessment_id) {
                return $assessment_id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteAssessment()
    {
        $result = array('status' => false, 'message' => 'Permission not allowed!');
        return json_encode($result);


        $id = $this->request->getVar('id');
        if (!empty($id)) {
            $isDelete = $this->common->deleteRole($id);
            if ($isDelete) {
                $result = array('status' => true, 'message' => 'Role successfully deleted!');
                return json_encode($result);
            } else {
                $result = array('status' => false, 'message' => 'Id not exit!');
                return json_encode($result);
            }
        } else {
            $result = array('status' => false, 'message' => 'Invalid request!');
            return json_encode($result);
        }
    }
}
