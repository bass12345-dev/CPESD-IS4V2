<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\RFAModel;

class PendingRFATransactions extends BaseController
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
  
    public function add_rfa(){
          if ($this->request->isAJAX()) {

            $data = array(
                'number'                    => $this->request->getPost('reference_number'),
                'rfa_date_filed'       =>  date('Y-m-d H:i:s', time()),
                'type_of_transaction'    =>$this->request->getPost('type_of_transaction'),
                'tor_id'       => $this->request->getPost('type_of_request'),
                'client_id'                    => $this->request->getPost('client_id'),
                'rfa_created_by' => session()->get('user_id'),
                'rfa_status'        => 'pending'        
            );

            
             $array_where = array(

                    'rfa_date_filed'   => date('Y-m', time()),
                    'number'                => $data['number']
            );

        
            $verify =  $this->RFAModel->verify_ref_number($array_where)->countAllResults();

           if(!$verify){

            $result  = $this->CustomModel->addData($this->rfa_transactions_table,$data);

             if ($result) {

                    $resp = array(
                    'message' => 'Data Saved Successfully',
                    'response' => true
                    );

                }else {

                    $resp = array(
                    'message' => 'Error',
                    'response' => false
                    );
                }

           }else {


                 $resp = array(
                    'message' => 'Error Duplicate PMAS NO',
                    'response' => false
                );
           }

           echo json_encode($resp);

          }
    }
}
