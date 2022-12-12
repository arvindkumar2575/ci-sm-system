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