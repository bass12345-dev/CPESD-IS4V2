<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\TransactionModel;

class DashboardController extends BaseController
{
    public $transactions_table          = 'transactions';
    public $cso_table                   = 'cso';
    protected $request;
    protected $CustomModel;
    protected $TransactionModel;
    protected $db;
    public $config;


    public function __construct()
    {
        

    $this->db                       = db_connect();
    $this->CustomModel              = new CustomModel($this->db); 
    $this->TransactionModel         = new TransactionModel($this->db); 
    $this->request                  = \Config\Services::request();  
    $this->config                   = new Custom_config;
       
       
    }
    public function index()
    {   

        if (session()->get('user_type') == 'admin') {
            $data['title']                              = 'Dashboard';
            $data['count_complete_transactions']        = $this->CustomModel->countwhere($this->transactions_table,array('transaction_status' => 'completed'));
            $data['count_pending_transactions']         = $this->CustomModel->countwhere($this->transactions_table,array('transaction_status' => 'pending'));
            // $data['count_po']         = $this->CustomModel->countwhere($this->cso_table,array('type_of_cso' => $this->config->));
            
            return view('admin/dashboard/index',$data);
        }else {
           throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
      
    }
}
