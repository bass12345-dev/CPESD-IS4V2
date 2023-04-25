<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\RFAModel;
use Config\Custom_config;

class PendingRFATransactions extends BaseController
{
    public    $type_of_request_table            = 'type_of_request';
    public    $rfa_transactions_table           = 'rfa_transactions';
    public    $rfa_transactions_history_table   = 'rfa_transaction_history';
    public    $users_table                      = 'users';
    public    $client_table                     = 'rfa_clients';
    public    $order_by_desc                    = 'desc';
    public    $order_by_asc                     = 'asc';
    protected $request;
    protected $CustomModel;
    protected $RFAModel;
    public $config;


     public function __construct()
    {
       $db = db_connect();
       $this->CustomModel = new CustomModel($db); 
       $this->RFAModel = new RFAModel($db); 
       $this->request = \Config\Services::request();  
       $this->config = new Custom_config;
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

            $result  = $this->RFAModel->addRFA($data);

            $item = $this->CustomModel->getwhere($this->rfa_transactions_table,array('rfa_id' => $result))[0]; 

            // $history_logs = array(

            //                 'track_code' => $data['rfa_tracking_code'],
            //                 'received_by' => $data['rfa_created_by'],
            //                 'received_date_and_time' => $data['rfa_date_filed'],
            //                 'rfa_tracking_status'   => 'received'

            // );

             if ($result) {


                // $this->CustomModel->addData($this->rfa_transactions_history_table,$history_logs);


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


        public function get_admin_pending_rfa_transactions(){


        $data = [];
        $items = $this->RFAModel->getAdminPendingRFA();

        foreach ($items as $row) {

                $client = $this->CustomModel->getwhere($this->client_table,array('rfa_client_id' => $row->client_id))[0];



                $status1 = '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-2 pr-2">needs to be refer</a>';
                $action1 = '<div class="btn-group dropleft">
                                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <i class="ti-settings" style="font-size : 15px;"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->rfa_id.'"   >Refer to</a>
                                               
                                              </di>';
            
                $data[] = array(

                        'rfa_id'               => $row->rfa_id ,
                        'name'                  => $client->first_name.' '.$client->middle_name.' '.$client->last_name.' '.$client->extension,
                        'type_of_request_name'  => $row->type_of_request_name,
                        'type_of_transaction'   => $row->type_of_transaction,
                        'address'               => $client->purok == 0 ? $client->barangay : 'Purok '.$client->purok.' '.$client->barangay,
                        'status1'               => $status1,
                        'action1'               => $action1



                       
                );
        }

        echo json_encode($data);
    }


    public function get_user_pending_rfa_transactions(){


        $data = [];
        $where = array('created_by' => session()->get('user_id'));
        $items = $this->RFAModel->getUserPendingRFA($where);

        foreach ($items as $row) {


              $status1 = 'For Refferal';
              $action1 = '<div class="btn-group dropleft">
                                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <i class="ti-settings" style="font-size : 15px;"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->rfa_id.'" data-status=""  id="view_rfa">View Update/Information</a>
                                               
                                              </di>';

                 $client = $this->CustomModel->getwhere($this->client_table,array('rfa_client_id' => $row->client_id))[0];
            
                $data[] = array(

                        'rfa_id'               => $row->rfa_id ,
                        'name'                  => $client->first_name.' '.$client->middle_name.' '.$client->last_name.' '.$client->extension,
                        'type_of_request_name'  => $row->type_of_request_name,
                        'type_of_transaction'   => $row->type_of_transaction,
                        'address'               => 'Purok '.$client->purok == 0 ? $client->barangay : 'Purok '.$client->purok.' '.$client->barangay,
                        'status1'               => $status1,
                        'action1'               => $action1

                       
                );
        }

        echo json_encode($data);
    }


public function received_rfa(){

    $id = $this->request->getPost('id');


    $data = array('remarks' => $this->request->getPost('content'));
    $where = array('rfa_id'=>$this->request->getPost('id'));
        $update = $this->CustomModel->updatewhere($where,$data,$this->transactions_table);

        if($update){

        $resp = array(
            'message' => 'Remarks Added Successfully',
            'response' => true
        );

        }else {

            $resp = array(
                'message' => 'Error',
                'response' => false
            );

        }

        echo json_encode($resp);
    
}


public function get_user_received_rfa_transactions(){


        $data = [];
        $where = array('created_by' => session()->get('user_id'));
        $items = $this->RFAModel->getUserReceivedRFA($where);

        foreach ($items as $row) {

                $client = $this->CustomModel->getwhere($this->client_table,array('rfa_client_id' => $row->client_id))[0];
            
                $data[] = array(

                        'rfa_id '               => $row->rfa_id ,
                        'name'                  => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                        'type_of_request_name'  => $this->CustomModel->getwhere($this->type_of_request_table,array('type_of_request_id' => $row->tor_id))[0]->type_of_request_name,
                        'type_of_transaction'   => $row->type_of_transaction,
                        'address'               => $client->purok == 0 ? $client->barangay : $client->purok.' '.$client->barangay,
                        'tracking_code'         => $row->rfa_tracking_code,
                        'id'                    => $this->CustomModel->getwhere($this->users_table,array('user_type' => 'admin'))[0]->user_id

                       
                );
        }

        echo json_encode($data);
    }

    public function add_rfa_action_taken(){



        $data = array('action_taken' => $this->request->getPost('content') );
        $where = array('track_code' => $this->request->getPost('tracking_code'));

        if (strtolower($this->request->getPost('type')) == 'simple') {


            $data_update = array(

                        'action_taken' => $data['action_taken'],
                         'referred_to' => $this->CustomModel->getwhere($this->users_table,array('user_type' =>
                            'admin'))[0]->user_id,
                        'reffered_date_and_time' => date('Y-m-d H:i:s', time()),
                        'rfa_tracking_status'   => 'for-approval',

            );


               $update = $this->CustomModel->updatewhere($where,$data_update,$this->rfa_transactions_history_table);
             if($update){

                    $resp = array(
                        'message' => 'Successfully Updated',
                        'response' => true
                    );

                }else {

                    $resp = array(
                        'message' => 'Error',
                        'response' => false
                    );

                }

                


                }else {



            $data_update = array(

                        'action_taken' => $data['action_taken'],
                       
                        'referred_to' => $this->request->getPost('select_user'),
                        'reffered_date_and_time' => date('Y-m-d H:i:s', time()),
                      

            );


               $update = $this->CustomModel->updatewhere($where,$data_update,$this->rfa_transactions_history_table);
             if($update){

                    $resp = array(
                        'message' => 'Successfully Updated',
                        'response' => true
                    );

                }else {

                    $resp = array(
                        'message' => 'Error',
                        'response' => false
                    );

                }



                }

                echo json_encode($resp);
                
        }


public function count_pending_rfa(){
    $count = 0;

    if (session()->get('user_type') == $this->config->user_type[0]) {

        $where = array('rfa_status' => 'pending');
        $count = $this->CustomModel->countwhere($this->rfa_transactions_table,$where);
       
    }else if (session()->get('user_type') == $this->config->user_type[1]) {
        
        $where = array('rfa_status' => 'pending','rfa_created_by' => session()->get('user_id'));
        $count = $this->CustomModel->countwhere($this->rfa_transactions_table,$where);
    }

    echo $count;

}

public function get_rfa_data(){


        

        $row = $this->RFAModel->getRFAData($this->rfa_transactions_table,array('rfa_id' => $this->request->getPost('id'),'created_by' => session()->get('user_id')))[0];


        $client = $this->CustomModel->getwhere($this->client_table,array('rfa_client_id' => $row->client_id))[0];

        $data = array(

                    'date_time_filed'                   => date('F d Y', strtotime($row->rfa_date_filed)),
                    'rfa_id '               => $row->rfa_id ,
                    'client_id'             => $client->rfa_client_id,
                    'client_name'                  => $client->first_name.' '.$client->middle_name.' '.$client->last_name.' '.$client->extension,
                    'type_of_request_name'  => $this->CustomModel->getwhere($this->type_of_request_table,array('type_of_request_id' => $row->tor_id))[0]->type_of_request_name,
                    'type_of_transaction'   => $row->type_of_transaction,
                    'address'               => $client->purok == 0 ? $client->barangay : $client->purok.' '.$client->barangay,
                    'ref_number' => date('Y', strtotime($row->rfa_date_filed)).' - '.date('m', strtotime($row->rfa_date_filed)).' - '.$row->number,
                    'number'                => $row->number,
                    'year'                  => date('Y', strtotime($row->rfa_date_filed)),
                    'month'                 => date('m', strtotime($row->rfa_date_filed)),

                    'tor_id'                => $row->tor_id,



                
        );
        echo json_encode($data);

}


public function update_rfa(){

        $data = array(

                    'client_id'           => $this->request->getPost('client_id'),
                    'tor_id'              => $this->request->getPost('type_of_request'),
                    'type_of_transaction' => $this->request->getPost('type_of_transaction'),

        );

        $where = array('rfa_id' => $this->request->getPost('rfa_id'));

        $update = $this->CustomModel->updatewhere($where,$data,$this->rfa_transactions_table);

        if($update){

                        $resp = array(
                            'message' => 'Successfully Updated',
                            'response' => true
                        );

        }else {

                        $resp = array(
                            'message' => 'Error',
                            'response' => false
                        );

        }

                    echo json_encode($resp);
}


     
}
