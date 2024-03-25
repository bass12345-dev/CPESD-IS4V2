<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\RFAModel;

class CompletedRFATransactions extends BaseController
{
    private    $type_of_request_table        = 'type_of_request';
    private    $rfa_transactions_table       = 'rfa_transactions';
    private    $client_table                 = 'rfa_clients';
    private    $order_by_desc                = 'desc';
    private    $order_by_asc                 = 'asc';
    protected $request;
    protected $CustomModel;
    protected $RFAModel;
     public function __construct()
    {
       $db                                  = db_connect();
       $this->CustomModel                   = new CustomModel($db); 
       $this->RFAModel                      = new RFAModel($db); 
       $this->request                       = \Config\Services::request();  
    }
  
     public function get_all_rfa_transactions(){


        $data                               = [];

        $items                              = $this->RFAModel->getAllRFATransactions('rfa_date_filed',$this->order_by_desc); 
        foreach ($items as $row ) {

        $data[]                     = array(
                            'rfa_id '           => $row->rfa_id,
                            'ref_number'        => date('Y', strtotime($row->rfa_date_filed)).' - '.date('m', strtotime($row->rfa_date_filed)).' - '.$row->number,
                            'rfa_date_filed'    => date('M,d Y', strtotime($row->rfa_date_filed)).' '.date('h:i a', strtotime($row->rfa_date_filed)),
                            'name'              => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension

                );
            # code...
        }

        echo json_encode($data);


     }



    public function get_admin_chart_rfa_transaction_data(){

        $year                               = $this->request->getPost('year');
        $months                             = array();
        $completed_transactions             = array();
        $pending_transactions               = array();
        for ($m = 1; $m <= 12; $m++) {

            $completed_transaction          = $this->RFAModel->count_rfa_transaction_chart($this->rfa_transactions_table,$m,$year,'completed');
            array_push($completed_transactions, $completed_transaction);


            $pending_transaction            = $this->RFAModel->count_rfa_transaction_chart($this->rfa_transactions_table,$m,$year,'pending');
            array_push($pending_transactions, $pending_transaction);
           
            $month                          =  date('M', mktime(0, 0, 0, $m, 1));
            array_push($months, $month);
        }
        $data['label']                      = $months;
        $data['data_pending']               = $pending_transactions;
        $data['data_completed']             = $completed_transactions;
        echo json_encode($data);

    }



   public function get_user_chart_rfa_transaction_data(){


        $year                               = $this->request->getPost('year');
        $months                             = array();
        $completed_transactions             = array();
        $pending_transactions               = array();
        $where                              = array('reffered_to' => session()->get('user_id'));

        for ($m = 1; $m <= 12; $m++) {

            $completed_transaction          = $this->RFAModel->count_user_rfa_transaction_chart($this->rfa_transactions_table,$m,$year,'completed',$where);
            array_push($completed_transactions, $completed_transaction);


            $pending_transaction            = $this->RFAModel->count_user_rfa_transaction_chart($this->rfa_transactions_table,$m,$year,'pending',$where);
            array_push($pending_transactions, $pending_transaction);
           
            $month                          =  date('M', mktime(0, 0, 0, $m, 1));
            array_push($months, $month);
        }
        $data['label']                      = $months;
        $data['data_pending']               = $pending_transactions;
        $data['data_completed']             = $completed_transactions;
        echo json_encode($data);




   }







        public function generate_rfa_report(){

        $date_filter                        = $this->request->getPost('date_filter');

   


        $start                              = explode(" - ",$date_filter)[0];
        $end                                = explode(" - ",$date_filter)[1];
        $data                               = [];
        $filter_data                        = array(

                    'start_date'        => date('Y-m-d', strtotime($start)),
                    'end_date'          => date('Y-m-d', strtotime($end)),
            );

        $items                              = $this->RFAModel->getRFATransactionDateFilter($filter_data);


        foreach ($items as $row ) {

                $ref_number                 = date('Y', strtotime($row->rfa_date_filed)).' - '.date('m', strtotime($row->rfa_date_filed)).' - '.$row->number;
                $client                     = $this->CustomModel->getwhere($this->client_table,array('rfa_client_id' => $row->client_id))[0];

                $data[]                     = array(

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


    public function get_user_completed_transactions(){


        $where                              = array('user_id'=> session()->get('user_id'));
        $items                              = $this->RFAModel->getUserCompletedRFA($where);
        $data                               = [];

        foreach ($items as $row ) {

                $ref_number                 = date('Y', strtotime($row->rfa_date_filed)).' - '.date('m', strtotime($row->rfa_date_filed)).' - '.$row->number;
                $client                     = $this->CustomModel->getwhere($this->client_table,array('rfa_client_id' => $row->client_id))[0];

                $data[]                     = array(

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
}
