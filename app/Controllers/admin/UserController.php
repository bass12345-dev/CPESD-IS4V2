<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Custom_config;

class UserController extends BaseController
{

    public $config;

    public function __construct()
    {
      
       $this->config = new Custom_config;
       
    }
    public function index()
    {
        
         if (session()->get('user_type') == 'admin') {
            $data['title'] = 'Users';
            $data['barangay'] = $this->config->barangay;
            return view('admin/users/index',$data);
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
