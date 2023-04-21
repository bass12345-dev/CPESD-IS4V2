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
                'rfa_tracking_code'         => mt_rand().date('Ymd', time()).$this->request->getPost('reference_number'),
                'number'                    => $this->request->getPost('reference_number'),
                'rfa_date_filed'            =>  date('Y-m-d H:i:s', time()),
                'type_of_transaction'       =>$this->request->getPost('type_of_transaction'),
                'tor_id'                    => $this->request->getPost('type_of_request'),
                'client_id'                 => $this->request->getPost('client_id'),
                'rfa_created_by'            => session()->get('user_id'),
                'rfa_status'                => 'pending'        
            );



    
             $array_where = array(

                    'rfa_date_filed'   => date('Y-m', time()),
                    'number'                => $data['number']
            );

        
            $verify =  $this->RFAModel->verify_ref_number($array_where)->countAllResults();

           if(!$verify){

            $result  = $this->RFAModel->addRFA();

             // $tracking_history = array(


             //        'track_code' => $data['rfa_tracking_code'],
             //        'received_by' => $result,
             //        'received_date_and_time'    => date('Y-m-d H:i:s', time()),
              
             //    );

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


    public function get_user_pending_rfa_transactions(){


        $data = [];
        $where = array('created_by' => session()->get('user_id'));
        $items = $this->RFAModel->getUserPendingRFA($where);

        foreach ($items as $row) {
            
                $data[] = array(

                        'rfa_id '               => $row->rfa_id ,
                        'name'                  => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                        'type_of_request_name'  => $row->type_of_request_name,
                        'type_of_transaction'   => $row->type_of_transaction,
                        'address'               => $row->purok == 0 ? $row->barangay : $row->purok.' '.$row->barangay

                       
                );
        }

        echo json_encode($data);
    }


public function get_user_received_rfa_transactions(){


        $data = [];
        $where = array('created_by' => session()->get('user_id'));
        $items = $this->RFAModel->getUserPendingRFA($where);

        foreach ($items as $row) {
            
                $data[] = array(

                        'rfa_id '               => $row->rfa_id ,
                        'name'                  => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                        'type_of_request_name'  => $row->type_of_request_name,
                        'type_of_transaction'   => $row->type_of_transaction,
                        'address'               => $row->purok == 0 ? $row->barangay : $row->purok.' '.$row->barangay

                       
                );
        }

        echo json_encode($data);
    }
}
