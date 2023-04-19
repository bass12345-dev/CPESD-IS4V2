<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use Config\Custom_config;

class Clients extends BaseController
{

    public      $client_table       = 'rfa_clients';
    public      $order_by_desc      = 'desc';
    protected   $request;
    protected   $CustomModel;
    public $config;

    public function __construct()
    {
       $db = db_connect();
       $this->CustomModel = new CustomModel($db); 
       $this->request = \Config\Services::request();  
    }

    public function search_name(){
        $data = [];
        $search_data = array(

                    'first_name' => $this->request->getPost('first_name'),
                    'last_name' => $this->request->getPost('last_name'),
                    );

        $items = $this->CustomModel->search($this->client_table,$search_data);

        foreach ($items as $row) {
            
                $data[] = array(

                        'rfa_client_id'     => $row->rfa_client_id,
                        'first_name'        => $row->first_name,
                        'middle_name'       => $row->middle_name,
                        'last_name'         => $row->last_name,
                        'extension'         => $row->extension,
                        'address'           => $row->purok == 0 ? $row->barangay : $row->purok.' '.$row->barangay,
                        'contact_number'    => $row->contact_number,
                        'age'               => $row->age,
                        'employment_status'=> $row->employment_status,
                       
                );
        }

        echo json_encode($data);



   }

   public function add_client(){

         if ($this->request->isAJAX()) {
          $data = array(

                'first_name'            => $this->request->getPost('first_name'),
                'middle_name'           => ($this->request->getPost('middle_name') == '') ?  '' : $this->request->getPost('middle_name') ,
                'last_name'             => $this->request->getPost('last_name'),
                'extension'             => ($this->request->getPost('extension') == '') ?  '' : $this->request->getPost('extension') ,
                'purok'                 => $this->request->getPost('purok') ,
                'barangay'              => $this->request->getPost('barangay'),
                'contact_number'        => $this->request->getPost('contact_number'),
                'age'                   => $this->request->getPost('age'),
                'employment_status'    => $this->request->getPost('employment_status'),
                'rfa_client_created'          =>  date('Y-m-d H:i:s', time()),
                
              
            );


        $verify = $this->CustomModel->count_search($this->client_table,array(

                                                                    'first_name'    => $data['first_name'],
                                                                    'middle_name'   => $data['middle_name'],
                                                                    'last_name'     => $data['last_name']
                                                              ));
        if ($verify > 0) {
           
            $data = array(
                'message' => 'Duplicate Name',
                'response' => false
                );

        }else {

             $result  = $this->CustomModel->addData($this->client_table,$data);

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

        }

         echo json_encode($data);

      }
   }


    public  function get_clients(){


        $data = [];
        $item = $this->CustomModel->get_all_desc($this->client_table,'first_name',$this->order_by_desc); 
        foreach ($item as $row) {
            
                $data[] = array(

                        'rfa_client_id'     => $row->rfa_client_id,
                        'first_name'        => $row->first_name,
                        'middle_name'       => $row->middle_name,
                        'last_name'         => $row->last_name,
                        'extension'         => $row->extension,
                        'address'           => $row->purok == 0 ? $row->barangay : $row->purok.' '.$row->barangay,
                        'contact_number'    => $row->contact_number,
                        'age'               => $row->age,
                        'employment_status' => $row->employment_status,
                        'purok'             => $row->purok,
                        'barangay'          => $row->barangay,
                        'full_name'         => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension
                        
                );
        }

        echo json_encode($data);

    }
}
