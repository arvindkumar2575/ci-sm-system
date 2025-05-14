<?php

namespace App\Libraries;

use App\Models\Common;

class AssessmentLib
{


    protected $session;
    protected $uri_segment;
    protected $common;
    public function __construct()
    {
        $this->session = session();
        $this->uri_segment = service('uri');
        $this->common = new Common();
    }


    public function getSpecificAssessment(string $from, array $data)
    {
        if($from=="webapp"){

        }
    }
    public function getParentAssessment(string $from, array $data)
    {
        if($from=="webapp"){
            $parent_list = $this->common->get_data("tbl_assessments",array(""));

        }
    }

    public function getAssessmentStructure(string $from, string $identifier)
    {
        $data = array();
        if($from=="webapp"){
            $assessment = $this->common->get_data("tbl_assessments",array("identifier"=>$identifier),array("details"));
            $assessment = json_decode($assessment['details']);
            $data["html"] = $this->getAssessmentTree($assessment);
        }
        return $data;
    }

    private function getAssessmentTree($assessment) {
        $html = "";
        // echo '<pre>';print_r($assessment);die;
        // echo gettype($assessment);
        if(gettype($assessment)=='object'){
            if($assessment->field_type=="MAIN"){
                $html.='<div class="main-div" identifier="'.$assessment->identifier.'">'.$assessment->display_name.'</div>';
            }
            if($assessment->field_type=="TEXT"){
                $html.='<div class="text-div" identifier="'.$assessment->identifier.'"><span>&#10551;</span>'.$assessment->display_name.'</div>';
            }
            if($assessment->field_type=="ASSESSMENT"){
                $html.='<div class="assessment-div" identifier="'.$assessment->identifier.'"><span>&#10551;</span>'.$assessment->display_name.' <span class="low-font">(Min:'.$assessment->detail->min.' | Max:'.$assessment->detail->max.')</span></div>';
            }
            if(isset($assessment->children) && gettype($assessment->children)=='array' && count($assessment->children)>0){
                $html .= $this->getAssessmentTree($assessment->children);
            }
        } else if(gettype($assessment)=='array'){
            foreach ($assessment as $key => $value) {
                if(gettype($value)=='object'){
                    $html .= $this->getAssessmentTree($value);
                }
            }
        }
        return $html;
    }

    private function getAssessmentCalculation($assessment) {
        $html = "";
        // echo '<pre>';print_r($assessment);die;
        // echo gettype($assessment);
        if(gettype($assessment)=='object'){
            if($assessment->field_type=="MAIN"){
                $html.='<div class="main-div" identifier="'.$assessment->identifier.'">'.$assessment->display_name.'</div>';
            }
            if($assessment->field_type=="TEXT"){
                $html.='<div class="text-div" identifier="'.$assessment->identifier.'"><span>&#10551;</span>'.$assessment->display_name.'</div>';
            }
            if($assessment->field_type=="ASSESSMENT"){
                $html.='<div class="assessment-div" identifier="'.$assessment->identifier.'"><span>&#10551;</span>'.$assessment->display_name.' (Min:'.$assessment->detail->min.' | Max:'.$assessment->detail->max.')</div>';
            }
            if(isset($assessment->children) && gettype($assessment->children)=='array' && count($assessment->children)>0){
                $html .= $this->getAssessmentCalculation($assessment->children);
            }
        } else if(gettype($assessment)=='array'){
            foreach ($assessment as $key => $value) {
                if(gettype($value)=='object'){
                    $html .= $this->getAssessmentCalculation($value);
                }
            }
        }
        return $html;
    }
    


}
