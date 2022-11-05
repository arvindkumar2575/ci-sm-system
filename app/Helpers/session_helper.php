<?php

if (!function_exists("checkSession")) {
    function checkSession()
    {
        $session = session();
        $usersession = $session->get('usersession')??array();
        $isLoggedIn = isset($usersession['isLoggedIn'])?$usersession['isLoggedIn']:0;
        if($isLoggedIn){
            return true;
        }else{
            return false;
        }
    }
}

if (!function_exists("checkSessionUserId")) {
    function checkSessionUserId()
    {
        $session = session();
        $usersession = $session->get('usersession')??array();
        $userId = isset($usersession['id'])?$usersession['id']:0;
        if($userId){
            return $userId;
        }else{
            return 0;
        }
    }
}