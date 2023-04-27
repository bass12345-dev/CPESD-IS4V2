<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use Config\Custom_config;

class ViewUserController extends BaseController
{
    public $users_table                       = 'users';
    public $config;
   public function __construct()
    {
       $db = db_connect();
       $this->CustomModel                    = new CustomModel($db); 
       $this->request                        = \Config\Services::request();  
       $this->config = new Custom_config;
    }
    public function index()
    {
      $row                 = $this->CustomModel->getwhere($this->users_table,array('user_id' => $_GET['id']))[0];

      $data['title']       =  $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension;
       $data['barangay'] = $this->config->barangay;
      return view('global/view_user/index',$data);
    }
}
