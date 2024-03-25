<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use Config\Custom_config;
use App\Models\RFAModel;

class Clients extends BaseController
{

    private      $client_table           = 'rfa_clients';
    private      $rfa_transactions_table = 'rfa_transactions';
    private      $order_by_desc          = 'desc';
    protected    $request;
    protected    $CustomModel;
    protected $RFAModel;
    private      $config;

    public function __construct()
    {
       $db                              = db_connect();
       $this->CustomModel               = new CustomModel($db); 
       $this->RFAModel                      = new RFAModel($db); 
       $this->request                   = \Config\Services::request();  
    }

    public function search_name(){
        $data                           = [];
        $search_data                    = array(
                            'first_name'    => $this->request->getPost('first_name'),
                            'last_name'     => $this->request->getPost('last_name'),
                            );
        $items                          = $this->CustomModel->search($this->client_table,$search_data);

        foreach ($items as $row) {
            
                $data[]                 = array(

                        'rfa_client_id'     => $row->rfa_client_id,
                        'first_name'        => $row->first_name,
                        'middle_name'       => $row->middle_name,
                        'last_name'         => $row->last_name,
                        'extension'         => $row->extension,
                        'address'           => $row->purok == 0 ? $row->barangay : 'Purok '.$row->purok.' '.$row->barangay,
                        'contact_number'    => $row->contact_number,
                        'age'               => $row->age,
                        'employment_status' => $row->employment_status,
                       
                );
        }

        echo json_encode($data);
   }

   public function add_client(){

         if ($this->request->isAJAX()) {


             $now = new \DateTime();
            $now->setTimezone(new \DateTimezone('Asia/Manila'));

          $data = array(
                'rfa_client_added_by'       =>  session()->get('user_id'),
                'first_name'                => $this->request->getPost('first_name'),
                'middle_name'               => ($this->request->getPost('middle_name') == '') ?  '' : $this->request->getPost('middle_name') ,
                'last_name'                 => $this->request->getPost('last_name'),
                'extension'                 => ($this->request->getPost('extension') == '') ?  '' : $this->request->getPost('extension') ,
                'purok'                     => $this->request->getPost('purok') ,
                'barangay'                  => $this->request->getPost('barangay'),
                'contact_number'            => $this->request->getPost('contact_number'),
                'age'                       => $this->request->getPost('age'),
                'gender'                    => $this->request->getPost('gender'),
                'employment_status'         => $this->request->getPost('employment_status'),
                'rfa_client_created'        => $now->format('Y-m-d H:i:s'),
                
              
            );


        $verify = $this->CustomModel->count_search($this->client_table,array(
                            'first_name'    => $data['first_name'],
                            'middle_name'   => $data['middle_name'],
                            'last_name'     => $data['last_name']));
        if ($verify > 0) {
           
            $data                   = array(
                            'message'       => 'Duplicate Name',
                            'response'      => false);

        }else {

             $result                = $this->CustomModel->addData($this->client_table,$data);

                if ($result) {

                    $data           = array(
                            'message'       => 'Data Saved Successfully',
                            'response'      => true);
                }else {

                    $data           = array(
                            'message'       => 'Error',
                            'response'      => false);
                }    

        }

         echo json_encode($data);

      }
   }


    public  function get_clients(){

         $data = [];

        if (session()->get('user_type') == 'admin') {


        $item = $this->CustomModel->get_all_order_by($this->client_table,'first_name',$this->order_by_desc); 
        foreach ($item as $row) {
            
                $data[] = array(

                        'rfa_client_id'     => $row->rfa_client_id,
                        'first_name'        => $row->first_name,
                        'middle_name'       => $row->middle_name,
                        'last_name'         => $row->last_name,
                        'extension'         => $row->extension,
                        'address'           => $row->purok == 0 ? $row->barangay : 'Purok '.$row->purok.' '.$row->barangay,
                        'contact_number'    => $row->contact_number,
                        'age'               => $row->age,
                        'employment_status' => $row->employment_status,
                        'purok'             => $row->purok,
                        'barangay'          => $row->barangay,
                        'full_name'         => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                        'gender'            => $row->gender == null ? '' : $row->gender
                        
                );
        }

           
         
        }else {
       
        $item = $this->CustomModel->getwhere_orderby($this->client_table,array('rfa_client_added_by' => session()->get('user_id')),'first_name',$this->order_by_desc); 
        foreach ($item as $row) {
            
                $data[] = array(

                        'rfa_client_id'     => $row->rfa_client_id,
                        'first_name'        => $row->first_name,
                        'middle_name'       => $row->middle_name,
                        'last_name'         => $row->last_name,
                        'extension'         => $row->extension,
                        'address'           => $row->purok == 0 ? $row->barangay : 'Purok '.$row->purok.' '.$row->barangay,
                        'contact_number'    => $row->contact_number,
                        'age'               => $row->age,
                        'employment_status' => $row->employment_status,
                        'purok'             => $row->purok,
                        'barangay'          => $row->barangay,
                        'full_name'         => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                        'gender'            => $row->gender == null ? '' : $row->gender
                        
                );
        }

    }

        echo json_encode($data);

    }

    public function update_client(){


        if ($this->request->isAJAX()) {


          $data = array(
            
                'first_name'            => $this->request->getPost('update_first_name'),
                'middle_name'           => ($this->request->getPost('update_middle_name') == '') ?  '' : $this->request->getPost('update_middle_name') ,
                'last_name'             => $this->request->getPost('update_last_name'),
                'extension'             => ($this->request->getPost('update_extension') == '') ?  '' : $this->request->getPost('update_extension') ,
                'purok'                 => $this->request->getPost('update_purok') ,
                'barangay'              => $this->request->getPost('update_barangay'),
                'contact_number'        => $this->request->getPost('update_contact_number'),
                'age'                   => $this->request->getPost('update_age'),
                'employment_status'     => $this->request->getPost('update_employment_status'),
                'gender'                => $this->request->getPost('gender'),
                
                
              
            );


        $where = array('rfa_client_id' => $this->request->getPost('client_id_'));

        $update = $this->CustomModel->updatewhere($where,$data,$this->client_table);

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

    


    public function delete_client(){



        $where1 = array('rfa_client_id' => $this->request->getPost('id'));
        $where2 = array('client_id' => $this->request->getPost('id'));
        $check = $this->CustomModel->countwhere($this->rfa_transactions_table,$where2);


        if ($check > 0) {

             $data = array(
                    'message' => 'This data is used in other operations',
                    'response' => false
                    );
            
        }else {

             $result = $this->CustomModel->deleteData($this->client_table,$where1);


            if ($result) {

                    $data = array(
                    'message' => 'Deleted Successfully',
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


    public function get_by_gender_total(){
        $total = array();
        $gender = ['male','female'];
        foreach($gender as $row) {

            $res = $this->CustomModel->countwhere($this->client_table,array('gender' => $row));
            array_push($total, $res);
        }

       $data['label'] = $gender;
       $data['total']    = $total;
       $data['color'] = ['rgb(41,134,204)','rgb(201,0,118)'];
       return $this->response->setJSON($data);
    }

    public function load_gender_client_by_month(){

        $year                               = $this->request->getPost('year1');
        $months                             = array();
        $male                               = array();
        $female                             = array();

        for ($m = 1; $m <= 12; $m++) {

            $total_male          = $this->RFAModel->count_gender_by_month($this->rfa_transactions_table,$m,$year,'male');
            array_push($male, $total_male);


            $total_female            = $this->RFAModel->count_gender_by_month($this->rfa_transactions_table,$m,$year,'female');
            array_push($female, $total_female);
           
            $month                          =  date('M', mktime(0, 0, 0, $m, 1));
            array_push($months, $month);
        }
        $data['label']                      = $months;
        $data['male']                       = $male;
        $data['female']                     = $female;
        echo json_encode($data);

    }




}
