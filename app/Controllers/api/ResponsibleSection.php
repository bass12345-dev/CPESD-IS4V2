<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class ResponsibleSection extends BaseController
{
    public    $responsible_table = 'responsible_section';
    public $order_by_desc = 'desc';
     public     $transactions_table          = 'transactions';
    protected $request;
    protected $CustomModel;

    public function __construct()
    {
       $db = db_connect();
       $this->CustomModel = new CustomModel($db); 
       $this->request = \Config\Services::request();  
    }
    public function add_responsible()
    {

        if ($this->request->isAJAX()) {

            $now = new \DateTime();
            $now->setTimezone(new \DateTimezone('Asia/Manila'));

           $data = array(

                        'responsible_section_name' => $this->request->getPost('responsible_section'),
                        'responsible_section_created' =>  $now->format('Y-m-d H:i:s')
            );

            $result  = $this->CustomModel->addData($this->responsible_table,$data);

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

    public function get_responsible(){

        $data = [];
        $item = $this->CustomModel->get_all_desc($this->responsible_table,'responsible_section_created',$this->order_by_desc); 
        foreach ($item as $row) {
            
                $data[] = array(

                        'responsible_section_id' => $row->responsible_section_id,
                        'responsible_section_name' => $row->responsible_section_name,
                       
                );
        }

        echo json_encode($data);
    }




        public function delete_responsible(){

        $where = array('responsible_section_id' => $this->request->getPost('id'));
        $check = $this->CustomModel->countwhere($this->transactions_table,$where);


        if ($check > 0) {

             $data = array(
                    'message' => 'This item is used in other operations',
                    'response' => false
                    );
            
        }else {

             $result = $this->CustomModel->deleteData($this->responsible_table,$where);


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


        public function update_responsible(){


                $data = array('responsible_section_name' => $this->request->getPost('update_responsible_name') );

                  $where = array(
                        'responsible_section_id' => $this->request->getPost('responsible_id')
                    );

                 $update = $this->CustomModel->updatewhere($where,$data,$this->responsible_table);

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
