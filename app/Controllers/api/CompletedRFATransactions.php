<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\RFAModel;

class CompletedRFATransactions extends BaseController
{
    public    $type_of_request_table        = 'type_of_request';
    public    $rfa_transactions_table       = 'rfa_transactions';
    public    $order_by_desc                = 'desc';
    public    $order_by_asc                 = 'asc';
    protected $request;
    protected $CustomModel;
    protected $RFAModel;
     public function __construct()
    {
       $db = db_connect();
       $this->CustomModel = new CustomModel($db); 
       $this->RFAModel = new RFAModel($db); 
       $this->request = \Config\Services::request();  
    }
  
     public function get_all_rfa_transactions(){


            $data = [];

            $items = $this->RFAModel->getAllRFATransactions('rfa_date_filed',$this->order_by_desc); 
            foreach ($items as $row ) {

                $data[] = array(
                            'rfa_id ' => $row->rfa_id,
                            'ref_number' => date('Y', strtotime($row->rfa_date_filed)).' - '.date('m', strtotime($row->rfa_date_filed)).' - '.$row->number,
                            'rfa_date_filed' => date('M,d Y', strtotime($row->rfa_date_filed)).' '.date('h:i a', strtotime($row->rfa_date_filed)),
                            'name' => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension

                );
            # code...
        }

        echo json_encode($data);


     }
}
