<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class TypeofRequestController extends BaseController
{
    public    $type_of_request_table    = 'type_of_request';
    public function index()
    {
         if (session()->get('user_type') == 'admin') {
            $data['title'] = 'Type of Request';
            $data['type_of_request'] = $this->CustomModel->get_all_desc($this->type_of_request_table,'type_of_request_name',$this->order_by_desc); 
            return view('admin/type_of_request/index',$data);
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
