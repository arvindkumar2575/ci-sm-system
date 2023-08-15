<?php

namespace App\Libraries;

use App\Models\Common;

class Utilslib
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


    public function login($data)
    {
        # code...
    }


    public function menuList(array $arr)
    {
        $menu = array();
        $sort_value = array_column($arr, 'parent');
        // echo '<pre>';print_r($arr);die;
        array_multisort($sort_value, SORT_ASC, $arr);
        foreach ($arr as $key => $value) {
            if ($value['parent'] == 0) {
                $menu[$value['id']] = $value;
            } else {
                if (isset($menu[$value['parent']]['list'])) {
                    array_push($menu[$value['parent']]['list'], $value);
                } else {
                    $menu[$value['parent']]['list'] = array();
                    array_push($menu[$value['parent']]['list'], $value);
                }
            }
        }
        return $menu;
    }


    public function menuFlowHTML($parent=null)
    {
        $menu = array();
        $arr = $this->common->getAllMenu();
        $menuFlow = $this->menuList($arr);
        $tr = '';
        foreach ($menuFlow as $key => $value) {
            $tr .= '<option class="parentNodeL1" value="' . $value['id'] . '" '.($parent == $value['id'] ? 'selected' : '').'>' . $value['display_name'] . '</option>';
            if (isset($value['list'])) {
                foreach ($value['list'] as $key1 => $value1) {
                    $tr .= '<option class="parentNodeL2" value="' . $value1['id'] . '" '.($parent == $value1['id'] ? 'selected' :"").'>|----' . $value1['display_name'] . '</option>';
                    if (isset($value1['list'])) {
                        foreach ($value1['list'] as $key2 => $value2) {
                            $tr .= '<option class="parentNodeL3" value="' . $value2['id'] . '" '.($parent == $value2['id'] ? "selected" :""). '>|----' . $value2['display_name'] . '</option>';
                        }
                    }
                }
            }
        }
        // echo $tr;die;
        return $tr;
    }

    public function getPermissionFromPermissionList(array $list,$id){
        $permission = array();
        return $permission;
    }

    /*
    * $permissions is an array()
    *
    */
    public function permissionOptionFlow(array $permissions){
        return $permissions;
    }
}
