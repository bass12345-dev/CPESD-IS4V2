<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\TransactionModel;

class CompletedTransactionsController extends BaseController
{

    public $transactions_table         = 'transactions';
    public $type_of_activity_table     = 'type_of_activities';
    public $training_table             = 'trainings';
    public $project_monitoring_table   = 'project_monitoring';
    public $activity_table             = 'type_of_activities';
    public $order_by_desc              = 'desc';
    public $order_by_asc               = 'asc';
    protected $request;
    protected $CustomModel;
    protected $TransactionModel;
    protected $db;

       public function __construct()
    {
       $this->db                       = db_connect();
       $this->CustomModel              = new CustomModel($this->db); 
       $this->TransactionModel         = new TransactionModel($this->db); 
       $this->request                  = \Config\Services::request();  
    }

    public function index()
    {
         if (session()->get('user_type') == 'admin') {

            $data['title']             = 'Completed Transaction';
            $data['activities']        = $this->CustomModel->get_all_order_by($this->activity_table,'type_of_activity_name',$this->order_by_desc);
            
            return view('admin/transactions/completed/index',$data);
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
