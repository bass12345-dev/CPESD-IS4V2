<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use Config\Custom_config;

class PendingRFAController extends BaseController
{   
     protected $CustomModel;
    public    $rfa_transactions_table = 'rfa_transactions';
     public    $type_of_request_table    = 'type_of_request';
    public    $order_by_desc                = 'desc';
    public    $order_by_asc                 = 'asc';

     public function __construct()
    {
       $db = db_connect();
       $this->CustomModel              = new CustomModel($db); 
       $this->config                   = new Custom_config;
        
    }
    public function index()
    {
        
         if (session()->get('user_type') == 'admin') {
            $data['title'] = 'Pending RFA';
            $data['refer_to']           = $this->CustomModel->getReferto();
            return view('admin/rfa/pending/index',$data);
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    
}
