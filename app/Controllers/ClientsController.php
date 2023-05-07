<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Custom_config;

class ClientsController extends BaseController
{

    public $config;

    public function __construct()
    {
       $this->config                   = new Custom_config;

    }
    public function index()
    {
   
        $data['title'] = 'Clients';
        $data['barangay']                   = $this->config->barangay;
        $data['employment_status']          = $this->config->employment_status;
        return view('global/clients/index',$data);
       
    }
}
