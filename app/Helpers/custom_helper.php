<?php

if (!function_exists("manageURL")) {
    function manageURL($uri=null)
    {
        if(isset($uri)){
            return base_url("manage").'/'.$uri;
        }else{
            return base_url("manage");
        }
    }
}

if (!function_exists("issetnotempty")) {
    function issetnotempty($str=null)
    {
        if(isset($str) && !empty($str)){
            return true;
        }else{
            return false;
        }
    }
}

if(!function_exists("uuid")){
    function uuid($data = null) {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
    
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}