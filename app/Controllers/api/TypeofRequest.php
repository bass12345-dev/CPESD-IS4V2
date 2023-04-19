<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\RFAModel;


class TypeofRequest extends BaseController
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

    public function get_last_ref_number(){

         if ($this->request->isAJAX()) {

            $l = '';
            $verify = $this->CustomModel->count_all_order_by($this->rfa_transactions_table,'rfa_date_filed',$this->order_by_desc);
            if($verify) {
                if(date('Y', time()) > date('Y', strtotime($this->CustomModel->get_all_order_by($this->rfa_transactions_table,'rfa_date_filed',$this->order_by_desc)[0]->rfa_date_filed)))
                {
                    $l = 1;
                }else if(date('Y', time()) < date('Y', strtotime($this->CustomModel->get_all_order_by($this->rfa_transactions_table,'rfa_date_filed',$this->order_by_desc)[0]->rfa_date_filed))){

                    $l = $this->RFAModel->get_last_ref_number_where(date('Y-m-d', time()))->getResult()[0]->number + 1;

                }else if (date('Y', time()) === date('Y', strtotime($this->CustomModel->get_all_order_by($this->rfa_transactions_table,'rfa_date_filed',$this->order_by_desc)[0]->rfa_date_filed))) 
    
                {
                    $l = $this->RFAModel->get_last_ref_number_where(date('Y', time()))->getResult()[0]->number + 1;
                }
            }else {
                $l =  1;
            }
            
            echo $l;

        }
    }

    public function add_type_of_request()
    {
        if ($this->request->isAJAX()) {

            $data = array(

                        'type_of_request_name' => $this->request->getPost('request_name'),
                        'type_of_request_created' =>  date('Y-m-d H:i:s', time())
            );

            $result  = $this->CustomModel->addData($this->type_of_request_table,$data);

                if ($result) {

                    $data = array(
                    'message' => 'Data Saved Successfully',
                    'response' => true
                    );

                }else {

                    $data = array(
                    'message' => 'Error',
                    'response' => false
                    );
                }

             echo json_encode($data);
        }
    }

    public function get_request(){

        $data = [];
        $item = $this->CustomModel->get_all_desc($this->type_of_request_table,'type_of_request_name',$this->order_by_desc); 
        foreach ($item as $row) {
            
                $data[] = array(

                        'type_of_request_id' => $row->type_of_request_id ,
                        'type_of_request_name' => $row->type_of_request_name,
                       
                );
        }

        echo json_encode($data);
    }




}
