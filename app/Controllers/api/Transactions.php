<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\TransactionModel;
use Config\Custom_config;


class Transactions extends BaseController
{
    public $transactions_table = 'transactions';
    public $type_of_activity_table = 'type_of_activities';
    public $training_table = 'trainings';
    public $project_monitoring_table = 'project_monitoring';
    public $order_by_desc = 'desc';
    public $order_by_asc = 'asc';
    protected $request;
    protected $CustomModel;
    protected $TransactionModel;
    protected $db;
    public $config;
    public function __construct()
    {
       $this->db = db_connect();
       $this->CustomModel = new CustomModel($this->db); 
       $this->TransactionModel = new TransactionModel($this->db); 
       $this->request = \Config\Services::request();  
        $this->config = new Custom_config;
    }
    public function get_all_transactions()
    {

        $data = [];

		$items = $this->TransactionModel->getAllTransactions('date_and_time_filed',$this->order_by_desc); 
        foreach ($items as $row ) {

            $data[] = array(
                        'transaction_id' => $row->transaction_id,
                        'pmas_no' => date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number,
                        'date_and_time_filed' => date('M,d Y', strtotime($row->date_and_time_filed)).' '.date('h:i a', strtotime($row->date_and_time_filed)),

                        'date_time' => date('M,d Y', strtotime($row->date_and_time)).' '.date('h:i a', strtotime($row->date_and_time)),
                        'is_training' => $row->is_training == 1 ? true : false,
                        'is_project_monitoring' =>  $row->is_project_monitoring == 1 ? true : false,
                        'name' => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension

            );
        # code...
    }

    echo json_encode($data);

        
    }



    public function generate_pmas_report(){

        $date_filter = $this->request->getPost('date_filter');
        $type_of_activity = $this->request->getPost('filter_type_of_activity');

        $start = explode(" - ",$date_filter)[0];
        $end = explode(" - ",$date_filter)[1];

        $data = [];

        if ($type_of_activity != null) {

            $filter_data = array(

                    'start_date' => date('Y-m-d', strtotime($start)),
                    'end_date' => date('Y-m-d', strtotime($end)),
                    'type_of_activity' => $type_of_activity
            );

          $items =   $this->TransactionModel->getCompletedTransactionDateFilterWhere($filter_data);

          foreach ($items as $row ) {


            
            $data[] = array(
                            'transaction_id' => $row->transaction_id,
                            'pmas_no' => date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number,
                            'date_and_time_filed' => date('F d Y', strtotime($row->date_and_time_filed)).' '.date('h:i a', strtotime($row->date_and_time_filed)),
                           'type_of_activity_name' => strtolower($row->type_of_activity_name) == strtolower($this->config->type_of_activity['rmpm']) ? '<a href="javascript:;"    data-id="'.$row->transaction_id.'"  style="color: #000;"  >'.$row->type_of_activity_name.'</a>' : $row->type_of_activity_name,
                            'cso_name' => strtolower($row->type_of_activity_name) == strtolower($this->config->type_of_activity['rmpm']) ? '<a href="javascript:;" data-title="'.$row->cso_name.'" id="view_project_monitoring"    data-id="'.$row->transaction_id.'" style="color: #000; font-weight: bold;"  >'.$row->cso_name.'</a>' : $row->cso_name,
                           
                            'name' => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                            
                );

          }


           
        }else {


            $filter_data = array(

                    'start_date' => date('Y-m-d', strtotime($start)),
                    'end_date' => date('Y-m-d', strtotime($end)),
            );

          $items =   $this->TransactionModel->getCompletedTransactionDateFilter($filter_data);


           foreach ($items as $row ) {


            $data[] = array(
                            'transaction_id' => $row->transaction_id,
                            'pmas_no' => date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number,
                            'date_and_time_filed' => date('F d Y', strtotime($row->date_and_time_filed)).' '.date('h:i a', strtotime($row->date_and_time_filed)),
                            'type_of_activity_name' => strtolower($row->type_of_activity_name) == strtolower($this->config->type_of_activity['rmpm']) ? '<a href="javascript:;"    data-id="'.$row->transaction_id.'"  style="color: #000; "  >'.$row->type_of_activity_name.'</a>' : $row->type_of_activity_name,
                            'cso_name' => strtolower($row->type_of_activity_name) == strtolower($this->config->type_of_activity['rmpm']) ? '<a href="javascript:;" data-title="'.$row->cso_name.'" id="view_project_monitoring"    data-id="'.$row->transaction_id.'"  style="color: #000; font-weight: bold;"  >'.$row->cso_name.'</a>' : $row->cso_name,
                            
                            'name' => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                            
                );

          }
         
            
        }

        echo json_encode($data);


    }



public function get_transaction_data(){

    
        $where = array('project_transact_id'=>$this->request->getPost('id'));
        $item = $this->CustomModel->getwhere($this->project_monitoring_table,$where)[0];

        $data = array(

                    'delinquent'                => $item->nom_borrowers_delinquent,
                    'overdue'                   => $item->nom_borrowers_overdue,
                    'total_production'          => $item->total_production,
                    'total_collection_sales'    => $item->total_collection_sales,
                    'total_released_purchases'  => $item->total_released_purchases,
                    'total_delinquent_account'  => $item->total_delinquent_account,
                    'total_over_due_account'    => $item->total_over_due_account,
                    'cash_in_bank'              => $item->cash_in_bank,
                    'cash_on_hand'              => $item->cash_on_hand,
                    'inventories'               => $item->inventories,
                    'total'                     => number_format(array_sum(array(

                                                    $item->nom_borrowers_delinquent,
                                                    $item->nom_borrowers_overdue,
                                                    $item->total_production,
                                                    $item->total_collection_sales,
                                                    $item->total_released_purchases,
                                                    $item->total_delinquent_account,
                                                    $item->total_over_due_account,
                                                    $item->cash_in_bank,
                                                    $item->cash_on_hand,
                                                    $item->inventories

                                                        )), 2, '.', ',')
        );
        echo json_encode($data);
        

}


}
