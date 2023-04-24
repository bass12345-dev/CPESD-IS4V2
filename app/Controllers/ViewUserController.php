<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class ViewUserController extends BaseController
{
    public $users_table                       = 'users';
   public function __construct()
    {
       $db = db_connect();
       $this->CustomModel                    = new CustomModel($db); 
       $this->request                        = \Config\Services::request();  
    }
    public function index()
    {
      $row                 = $this->CustomModel->getwhere($this->users_table,array('user_id' => $_GET['id']))[0];

      $data['title']       =  $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension;
      return view('global/view_user/index',$data);
    }
}
