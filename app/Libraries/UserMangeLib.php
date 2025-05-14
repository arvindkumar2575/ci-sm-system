<?php

namespace App\Libraries;

use App\Models\Common;

class UserManage
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


    public function user() {
        
    }
}
