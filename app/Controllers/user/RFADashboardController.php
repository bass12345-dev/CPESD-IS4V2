<?php

namespace App\Controllers\User;

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
        
        if (session()->get('user_type') == 'user') {
        
        $data['title']                              = 'RFA Dashboard';
        $data['count_completed_rfa_transactions']        = $this->CustomModel->countwhere($this->rfa_transactions_table,array('rfa_status' => 'completed','reffered_to' => session()->get('user_id')));
        $data['count_pending_rfa_transactions']         = $this->CustomModel->countwhere($this->rfa_transactions_table,array('rfa_status' => 'pending','reffered_to' => session()->get('user_id')));
      
       
        return view('user/rfa_dashboard/index',$data);
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
