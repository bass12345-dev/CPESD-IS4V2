<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class TypeOfActivity extends BaseController
{
    public      $activities_table           = 'type_of_activities';
    public      $transactions_table         = 'transactions';
    public      $under_activity_table       = 'under_type_of_activity';
    public      $order_by_desc              = 'desc';
    public      $order_by_asc               = 'asc';
    protected   $request;
    protected   $CustomModel;

    public function __construct()
    {
       $db = db_connect();
       $this->CustomModel = new CustomModel($db); 
       $this->request = \Config\Services::request();  
    }
   public function add_type_of_activity()
    {

        if ($this->request->isAJAX()) {


              $now = new \DateTime();
            $now->setTimezone(new \DateTimezone('Asia/Manila'));

            $data = array(

                        'type_of_activity_name' => $this->request->getPost('activity'),
                        'type_act_created' =>   $now->format('Y-m-d H:i:s')
            );

            $result  = $this->CustomModel->addData($this->activities_table,$data);

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


     public function get_activities(){

        $data = [];
        $item = $this->CustomModel->get_all_desc($this->activities_table,'type_act_created',$this->order_by_desc); 
        foreach ($item as $row) {
            
                $data[] = array(

                        'type_of_activity_id' => $row->type_of_activity_id,
                        'type_of_activity_name' => $row->type_of_activity_name,
                        'action' => strtolower($row->type_of_activity_name) != 'training' ? 

                        '<ul class="d-flex justify-content-center">
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'.$row->type_of_activity_id.'" data-name="'.$row->type_of_activity_name.'" data-toggle="modal" data-target="#update_type_of_activity_modal" id="update-activity"><i class="fa fa-edit"></i></a></li>
                                
                                <li><a href="javascript:;" data-id="'.$row->type_of_activity_id.'" data-name="'.$row->type_of_activity_name.'"  id="delete-activity"  class="text-danger action-icon"><i class="ti-trash"></i></a></li>
                                </ul>' : '<ul class="d-flex justify-content-center">
                               
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'.$row->type_of_activity_id.'" data-name="'.$row->type_of_activity_name.'" id="add-under-activity"><i class="fa fa-arrow-down"></i></a></li>
                                <li><a href="javascript:;" data-id="'.$row->type_of_activity_id.'"  id="delete-activity"  class="text-danger action-icon"><i class="ti-trash"></i></a></li>
                                </ul>'
                       
                );
        }

        echo json_encode($data);
    }


    public function delete_activity(){

        $where = array('type_of_activity_id' => $this->request->getPost('id'));
        $check = $this->CustomModel->countwhere($this->transactions_table,$where);


        if ($check > 0) {

             $data = array(
                    'message' => 'This type of activity is used in other operations',
                    'response' => false
                    );
            
        }else {

             $result = $this->CustomModel->deleteData($this->activities_table,$where);


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

    public function update_activity(){


$data = array('type_of_activity_name' => $this->request->getPost('update_type_of_activity') );

  $where = array(
        'type_of_activity_id' => $this->request->getPost('activity_id')
    );

 $update = $this->CustomModel->updatewhere($where,$data,$this->activities_table);

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



    public function add_under_type_of_activity(){
        if ($this->request->isAJAX()) {

            $data = array(

                            'under_type_act_name' =>$this->request->getPost('under_type_activity'),
                            'typ_ac_id' => $this->request->getPost('act_id'),
                            'under_type_act_created ' =>  date('Y-m-d H:i:s', time())
            );

            $result  = $this->CustomModel->addData($this->under_activity_table,$data);

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




    public function get_under_type_of_activity(){

        if ($this->request->isAJAX()) {
            $data = [];
            $count = $this->CustomModel->countwhere($this->under_activity_table,array('typ_ac_id' => $this->request->getPost('id')));

            if($count > 0){

            

                $items = $this->CustomModel->getwhere_orderby($this->under_activity_table,array('typ_ac_id' => $this->request->getPost('id')),'under_type_act_name',$this->order_by_asc);
                foreach ($items as $row) {
            
                    $data[] = array(
    
                            'under_type_act_name' => $row->under_type_act_name,
                            'typ_ac_id' => $row->typ_ac_id,
                            'under_type_act_id' => $row->under_type_act_id 
                    );
            }
    
           
        }else {
            $data = [];
        }
         echo json_encode($data);
        }

    }


        public function delete_under_activity(){

        $where1 = array('under_type_of_activity_id' => $this->request->getPost('id'));
        $where2 = array('under_type_act_id' => $this->request->getPost('id'));
        $check = $this->CustomModel->countwhere($this->transactions_table,$where1);


        if ($check > 0) {

             $data = array(
                    'message' => 'This data is used in other operations',
                    'response' => false
                    );
            
        }else {

             $result = $this->CustomModel->deleteData($this->under_activity_table,$where2);


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




        public function update_under_activity(){


$data = array('under_type_act_name' => $this->request->getPost('under_update_type_of_activity') );

  $where = array(
        'under_type_act_id' => $this->request->getPost('under_activity_id')
    );

 $update = $this->CustomModel->updatewhere($where,$data,$this->under_activity_table);

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
