<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use Config\Custom_config;

class RegisterController extends BaseController
{

    public $config;


    public function __construct()
    {
      
       $this->config = new Custom_config;
       
    }


    public function index()
    {

      
        
        $data['title'] = 'Register';
        $data['barangay'] = $this->config->barangay;
        $data['work_status'] = ['jo','regular'];
        return view('auth/registration',$data);
    }
}
