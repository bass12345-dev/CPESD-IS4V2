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




    public function get_admin_pending_rfa_transaction_limit(){


        $data = [];

    $items = $this->RFAModel->getAdminPendingRFALimit();

    foreach ($items as $row ) {

                $ref_number = date('Y', strtotime($row->rfa_date_filed)).' - '.date('m', strtotime($row->rfa_date_filed)).' - '.$row->number;
                $client = $this->CustomModel->getwhere($this->client_table,array('rfa_client_id' => $row->client_id))[0];

                $data[] = array(

                        'rfa_id'                => $row->rfa_id ,
                        'name'                  => $client->first_name.' '.$client->middle_name.' '.$client->last_name.' '.$client->extension,
                        'type_of_request_name'  => $row->type_of_request_name,
                        'type_of_transaction'   => $row->type_of_transaction,
                        'address'               => $client->purok == 0 ? $client->barangay : 'Purok '.$client->purok.' '.$client->barangay,
                   
                         'ref_number'           => $ref_number,
                         'created_by'           => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,



                       
                );

        


    }

     echo json_encode($data);
    }


        public function get_admin_pending_rfa_transactions(){


        $data = [];
        $items = $this->RFAModel->getAdminPendingRFA();

        foreach ($items as $row) {

                $client = $this->CustomModel->getwhere($this->client_table,array('rfa_client_id' => $row->client_id))[0];
                $action1 = '';
                $status1 = '';

               $ref_number = date('Y', strtotime($row->rfa_date_filed)).' - '.date('m', strtotime($row->rfa_date_filed)).' - '.$row->number;



                if ($row->reffered_to == NULL ) {


                     $status1 = '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-2 pr-2">needs to be refer</a>';

                      $action1 = '<div class="btn-group dropleft">
                                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <i class="ti-settings" style="font-size : 15px;"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->rfa_id.'" id="refer_to" data-toggle="modal" data-target="#refer_to_modal"  >Refer to</a>
                                               
                                              </di>';
                    
                }else if ($row->reffered_to != NULL && $row->accomplished_status == 0) {

                    $reffered = $this->CustomModel->getwhere($this->users_table,array('user_id' => $row->reffered_to))[0];
                    
                     $status1 = '<a href="javascript:;" class="btn btn-warning btn-rounded p-1 pl-2 pr-2">Reffered</a>
                     <br>'.$reffered->first_name.' '.$reffered->middle_name.' '.$reffered->last_name.' '.$reffered->extension;
                     $action1 = '<ul class="d-flex justify-content-center">
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'.$row->rfa_id.'"   id="view_rfa_" ><i class="fa fa-eye"></i></a></li>
                                </ul>';
                }else if ($row->reffered_to != NULL && $row->accomplished_status == 1) {

                    
                    $reffered = $this->CustomModel->getwhere($this->users_table,array('user_id' => $row->reffered_to))[0];

                     $status1 = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">Accomplished</a><br>
                     <a href="javascript:;" id="view_action" data-id="'.$row->rfa_id.'" >View</a><br>'.$reffered->first_name.' '.$reffered->middle_name.' '.$reffered->last_name.' '.$reffered->extension;

                      $action1 = '<ul class="d-flex justify-content-center">
                                <li class="mr-3 "><a href="javascript:;" class="text-success action-icon"  id="approved" data-id="'.$row->rfa_id.'" data-name="'.$ref_number.'"  ><i class="fa fa-check"></i></a></li>
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'.$row->rfa_id.'"   id="view_rfa_" ><i class="fa fa-eye"></i></a></li>
                                </ul>';
                   
                }



              



            
                $data[] = array(

                        'rfa_id'               => $row->rfa_id ,
                        'name'                  => $client->first_name.' '.$client->middle_name.' '.$client->last_name.' '.$client->extension,
                        'type_of_request_name'  => $row->type_of_request_name,
                        'type_of_transaction'   => $row->type_of_transaction,
                        'address'               => $client->purok == 0 ? $client->barangay : 'Purok '.$client->purok.' '.$client->barangay,
                        'status1'               => $status1,
                        'action1'               => $action1,
                         'ref_number' => $ref_number,



                       
                );
        }

        echo json_encode($data);
    }


    public function get_user_pending_rfa_transactions(){


        $data = [];
        $where = array('created_by' => session()->get('user_id'));
        $items = $this->RFAModel->getUserPendingRFA($where);

        foreach ($items as $row) {

              $status1 = '';
              $action1 = '';


                if ($row->reffered_to == NULL ) {

              $status1 = '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-2 pr-2">For Referral</a>';
              $action1 = '<div class="btn-group dropleft">
                                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <i class="ti-settings" style="font-size : 15px;"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->rfa_id.'" data-status=""  id="view_rfa">View Update/Information</a>
                                               
                                              </di>';

                }else if ($row->reffered_to != NULL) {


                    $reffered = $this->CustomModel->getwhere($this->users_table,array('user_id' => $row->reffered_to))[0];

                    $status1 = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">Reffered</a>
                     <br>'.$reffered->first_name.' '.$reffered->middle_name.' '.$reffered->last_name.' '.$reffered->extension;
                     $action1 = '<ul class="d-flex justify-content-center">
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="" data-status=""  ><i class="fa fa-eye"></i></a></li>
                                </ul>';

                }

                 $client = $this->CustomModel->getwhere($this->client_table,array('rfa_client_id' => $row->client_id))[0];
            
                $data[] = array(

                        'rfa_id'               => $row->rfa_id ,
                        'name'                  => $client->first_name.' '.$client->middle_name.' '.$client->last_name.' '.$client->extension,
                        'type_of_request_name'  => $row->type_of_request_name,
                        'type_of_transaction'   => $row->type_of_transaction,
                        'address'               => 'Purok '.$client->purok == 0 ? $client->barangay : 'Purok '.$client->purok.' '.$client->barangay,
                        'status1'               => $status1,
                        'action1'               => $action1,
                         'ref_number' => date('Y', strtotime($row->rfa_date_filed)).' - '.date('m', strtotime($row->rfa_date_filed)).' - '.$row->number,

                       
                );
        }

        echo json_encode($data);
    }


public function get_user_referred_rfa(){

    $data = [];
    $where = array('reffered_to' => session()->get('user_id'));
    $items = $this->RFAModel->getUserRefferedRFA($where);


    foreach ($items as $row) {


        $client = $this->CustomModel->getwhere($this->client_table,array('rfa_client_id' => $row->client_id))[0];

        $status1 = '';
        $action1 = '';

         $ref_number = date('Y', strtotime($row->rfa_date_filed)).' - '.date('m', strtotime($row->rfa_date_filed)).' - '.$row->number;

        if ($row->action_to_be_taken == NULL) {

            $status1 = '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-2 pr-2">No Action</a><br>
                     <a href="javascript:;" id="view_action_taken_admin" data-id="'.$row->rfa_id.'" >View Action Taken</a>';
            $action1 = '<ul class="d-flex justify-content-center">
                                <li class="mr-3 "><a href="javascript:;" class="text-success action-icon" data-id="'.$row->rfa_id.'" data-toggle="modal" data-target="#accomplished_modal" data-name="'.$ref_number.'" id="accomplished" ><i class="fa fa-check"></i></a></li>
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'.$row->rfa_id.'"   id="view_rfa_" ><i class="fa fa-eye"></i></a></li>
                                </ul>';


           
        }else if ($row->action_to_be_taken != NULL && $row->accomplished_status != 0) {
            
             $status1 = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">For Approval</a>';
             $action1 = '<ul class="d-flex justify-content-center">
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'.$row->rfa_id.'"   id="view_rfa_" ><i class="fa fa-eye"></i></a></li>
                                </ul>';
        }


        $data[] = array(

                        'rfa_id'               => $row->rfa_id ,
                        'name'                  => $client->first_name.' '.$client->middle_name.' '.$client->last_name.' '.$client->extension,
                        'type_of_request_name'  => $row->type_of_request_name,
                        'type_of_transaction'   => $row->type_of_transaction,
                        'address'               => 'Purok '.$client->purok == 0 ? $client->barangay : 'Purok '.$client->purok.' '.$client->barangay,
                        'ref_number' => date('Y', strtotime($row->rfa_date_filed)).' - '.date('m', strtotime($row->rfa_date_filed)).' - '.$row->number,
                        'status1' => $status1,
                        'action1' => $action1
                        

                       
                );

    }


     echo json_encode($data);
}

public function count_reffered_rfa(){

    $where = array('rfa_status' => 'pending','reffered_to' => session()->get('user_id'));
    $count = $this->CustomModel->countwhere($this->rfa_transactions_table,$where);

    echo $count;

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

public function view_rfa_data(){



        $row = $this->RFAModel->ViewRFADATA($this->rfa_transactions_table,array('rfa_id' => $this->request->getPost('id')))[0];


        $client = $this->CustomModel->getwhere($this->client_table,array('rfa_client_id' => $row->client_id))[0];
        $referred_to = $this->CustomModel->getwhere($this->users_table,array('user_id' => $row->reffered_to))[0];

        $data = array(

                    'date_time_filed'                   => date('F d Y h:i:A', strtotime($row->rfa_date_filed)),
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
                    'encoded_by'            => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                    'approved_date'         => date('F d Y h:i:A', strtotime($row->approved_date)),
                    'referred_name'         => $referred_to->first_name.' '.$referred_to->middle_name.' '.$referred_to->last_name.' '.$referred_to->extension,
                    'status'                => $row->rfa_status == 'completed' ? '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">Completed</a>'.'<br>'.'<span>Approved Date  : </span> <b>'.date('F d Y h:i:A', strtotime($row->approved_date)).'</b>' : '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-2 pr-2">Pending</a>'



                
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


public function refer_to(){


            $where = array('rfa_id' => $this->request->getPost('rfa_id'));
            $data = array(
                'reffered_to'              => $this->request->getPost('reffered_to'),
                'action_taken'             => $this->request->getPost('action_taken'),
                'reffered_date_and_time'   => date('Y-m-d H:i:s', time()),
            );


            $update = $this->CustomModel->updatewhere($where,$data,$this->rfa_transactions_table);

                if($update){

                                $resp = array(
                                    'message' => 'Reffered Successfully',
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



public function accomplished(){


            $where = array('rfa_id' => $this->request->getPost('rfa_id'));
            $data = array(
                'accomplished_status'            => 1,
                'action_to_be_taken'             => $this->request->getPost('action_to_be_taken'),
                'action_to_be_taken_date_time'   => date('Y-m-d H:i:s', time()),
            );


    


            $update = $this->CustomModel->updatewhere($where,$data,$this->rfa_transactions_table);

                if($update){

                                $resp = array(
                                    'message' => 'Accomplished Successfully',
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



public function approved_rfa(){


            $where = array('rfa_id' => $this->request->getPost('id'));
            $data = array(
                'rfa_status'            => 'completed',
                'approved_date'   => date('Y-m-d H:i:s', time()),
            );


    


            $update = $this->CustomModel->updatewhere($where,$data,$this->rfa_transactions_table);

                if($update){

                                $resp = array(
                                    'message' => 'Approved Successfully',
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



public function view_action(){

        $data = [];
        $where = array('rfa_id'=>$this->request->getPost('id'));
        $data['action_to_be_taken'] = $this->CustomModel->getwhere($this->rfa_transactions_table,$where)[0]->action_to_be_taken;
        $data['rfa_id'] = $where['rfa_id']; 
        echo json_encode($data);
}



public function view_action_taken(){

        $data = [];
        $where = array('rfa_id'=>$this->request->getPost('id'));
        $data['action_taken'] = $this->CustomModel->getwhere($this->rfa_transactions_table,$where)[0]->action_taken;
        $data['rfa_id'] = $where['rfa_id']; 
        echo json_encode($data);
}




     
}
