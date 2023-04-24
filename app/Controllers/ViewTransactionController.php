<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\TransactionModel;




class ViewTransactionController extends BaseController
{
    public $transactions_table               = 'transactions';

     public function __construct()
    {
       $db = db_connect();
       $this->CustomModel                    = new CustomModel($db); 
       $this->TransactionModel               = new TransactionModel($db); 
       $this->request                        = \Config\Services::request();  
    }
    public function index()
    {
        $data['transaction_data']                             = $this->TransactionModel->getTransactionData($this->transactions_table,array('transaction_id' => $_GET['id']))[0];
        $data['title']                   = 'PMAS NO '.date('Y', strtotime($data['transaction_data']->date_and_time_filed)).' - '.date('m', strtotime($data['transaction_data']->date_and_time_filed)).' - '.$data['transaction_data']->number;
        return view('global/view_transaction/index',$data);
    }
}
