<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use Config\Custom_config;

class RFADashboardController extends BaseController
{
    public $rfa_transactions_table           = 'rfa_transactions';  

     public function __construct()
    {
        

    $this->db                       = db_connect();
    $this->CustomModel              = new CustomModel($this->db); 
   
       
       
    }           
    public function index()
    {
        if (session()->get('user_type') == 'admin') {
            $data['title']                              = 'RFA Dashboard';
            $data['count_completed_rfa_transactions']        = $this->CustomModel->countwhere($this->rfa_transactions_table,array('rfa_status' => 'completed'));
            $data['count_pending_rfa_transactions']         = $this->CustomModel->countwhere($this->rfa_transactions_table,array('rfa_status' => 'pending'));
        
            return view('admin/rfa_dashboard/index',$data);
        }else {
           throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
