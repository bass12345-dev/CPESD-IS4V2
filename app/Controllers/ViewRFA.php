<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class ViewRFA extends BaseController
{
     public    $rfa_transactions_table           = 'rfa_transactions';
     public function __construct()
    {
       $db = db_connect();
       $this->CustomModel                    = new CustomModel($db); 
     
    }
    public function index()
    {
        $data['transaction_data']                             = $this->CustomModel->getwhere($this->rfa_transactions_table,array('rfa_id' => $_GET['id']))[0];
        $data['title']                   = 'REFERENCE NO '.date('Y', strtotime($data['transaction_data']->rfa_date_filed)).' - '.date('m', strtotime($data['transaction_data']->rfa_date_filed)).' - '.$data['transaction_data']->number;
        return view('global/view_rfa/index',$data);
    }
}
