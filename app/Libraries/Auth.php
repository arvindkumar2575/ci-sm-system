<?php

namespace App\Libraries;

class Auth{
    
    public function login($data)
    {
        # code...
    }


    public function menuList(array $arr)
    {
        $menu=array();
        foreach ($arr as $key => $value) {
            if($value['parent']==0){
                array_push($menu,$value);
            }else{
                if(isset($menu[$value['parent']-1]['list'])){
                    array_push($menu[$value['parent']-1]['list'],$value);
                }else{
                    $menu[$value['parent']-1]['list']=array();
                    array_push($menu[$value['parent']-1]['list'],$value);
                }
            }
        }

        return $menu;
    }
}