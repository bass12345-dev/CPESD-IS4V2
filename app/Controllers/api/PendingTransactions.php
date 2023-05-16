<?php



namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\TransactionModel;
use Config\Custom_config;
use CodeIgniter\I18n\Time;

class PendingTransactions extends BaseController
{
    public $transactions_table          = 'transactions';
    public $responsible_section_table   = 'responsible_section';
    public $type_of_activity_table      = 'type_of_activities';
    public $training_table              = 'trainings';
    public $project_monitoring_table    = 'project_monitoring';
    public $project_meeting_table       = 'project_meeting';
    public $cso_table                   = 'cso';
    public $order_by_desc               = 'desc';
    public $order_by_asc                = 'asc';
    protected $request;
    protected $CustomModel;
    protected $TransactionModel;
    protected $db;
    public $config;
   

    public function __construct()
    {
       $this->db                        = db_connect();
       $this->CustomModel               = new CustomModel($this->db); 
       $this->TransactionModel          = new TransactionModel($this->db); 
       $this->request                   = \Config\Services::request();  
        $this->config = new Custom_config;
        
       
    }

    public function get_last_pmas_number()
    {
        if ($this->request->isAJAX()) {

            $l = '';

            $verify = $this->CustomModel->count_all_order_by($this->transactions_table,'date_and_time_filed',$this->order_by_desc);
            if($verify) {
                if(date('Y', time()) > date('Y', strtotime($this->CustomModel->get_all_order_by($this->transactions_table,'date_and_time_filed',$this->order_by_desc)[0]->date_and_time_filed)))
                {
                    
                     $l = '001';


                }else if(date('Y', time()) < date('Y', strtotime($this->CustomModel->get_all_order_by($this->transactions_table,'date_and_time_filed',$this->order_by_desc)[0]->date_and_time_filed))){



                $x = $this->TransactionModel->get_last_pmas_number_where(date('Y-m-d', time()))->getResult()[0]->number + 1;

                 $l = $this->put_zeros($x);

                }else if (date('Y', time()) === date('Y', strtotime($this->CustomModel->get_all_order_by($this->transactions_table,'date_and_time_filed',$this->order_by_desc)[0]->date_and_time_filed))) 
	
			    {
                    $x = $this->TransactionModel->get_last_pmas_number_where(date('Y', time()))->getResult()[0]->number + 1;

                    $l = $this->put_zeros($x);
                 
                }
            }else {
                    

                $l = '001';



            }
            
            echo $l;

        }
    }


    function put_zeros($x){

        $l = '';
           if ($x  < 10) {

                        $l = '00'.$x;
                      
                    }else if($x < 100 ) {

                        $l = '0'.$x;
                       

                    }else {


                         $l = $x;
                        
                    }

                    return $l;

    }









    public function add_transaction(){

         // date_default_timezone_set('Asia/Manila');
        if ($this->request->isAJAX()) {


              $now = new \DateTime();
            $now->setTimezone(new \DateTimezone('Asia/Manila'));
                
            $data = array(
                'number'                    => $this->request->getPost('pmas_number'),
                'date_and_time_filed'       => $now->format('Y-m-d H:i:s'),
                'responsible_section_id'    =>$this->request->getPost('type_of_monitoring_id'),
                'type_of_activity_id'       => $this->request->getPost('type_of_activity_id'),
                'under_type_of_activity_id' => $this->request->getPost('select_under_type_id'),
                'date_and_time'             =>  date("Y/m/d H:i:s", strtotime($this->request->getPost('date_time'))),
                'responsibility_center_id'  =>   $this->request->getPost('responsibility_center_id'),
                'cso_Id'                    => $this->request->getPost('cso_id'),
                'created_by'                => session()->get('user_id'),
                'transaction_status'        => 'pending',
                'update_status'             => 'to-update' 		
            );


            


            
            $array_where = array(

                    'date_and_time_filed'   => date('Y-m', time()),
                    'number'                => $data['number']
            );
            
            $verify =  $this->TransactionModel->verify_pmas_number($array_where)->countAllResults();

            if(!$verify){
                
                $result         = $this->CustomModel->addData($this->transactions_table,$data);
                $id             = $this->db->insertID();
                $type_act_name  =  $this->CustomModel->getwhere($this->type_of_activity_table,array('type_of_activity_id ' => $data['type_of_activity_id']))[0]->type_of_activity_name;
                
                $training_data  = array(

                    'training_transact_id'      => $id,
                    'title_of_training'         => $this->request->getPost('title_of_training'),
                    'number_of_participants'    => $this->request->getPost('number_of_participants'),
                    'female'                    => $this->request->getPost('female'),
                    'overall_ratings'           => $this->request->getPost('over_all_ratings'),
                    'name_of_trainor'           => $this->request->getPost('name_of_trainor'),
                 );


                 $project_data = array(

                    'project_transact_id'       => $id,
                    'project_title'             => $this->request->getPost('project_title'),
                    'period'                    => date("Y/m/d", strtotime($this->request->getPost('period'))),
                    'attendance_present'        => $this->request->getPost('present'),
                    'attendance_absent'         => $this->request->getPost('absent'),
                    'nom_borrowers_delinquent'  => $this->request->getPost('deliquent'),
                    'nom_borrowers_overdue'     => $this->request->getPost('overdue'),
                    'total_production'          => $this->request->getPost('total_production'),
                    'total_collection_sales'    => $this->request->getPost('total_collection'),
                    'total_released_purchases'  => $this->request->getPost('total_released'),
                    'total_delinquent_account'  => $this->request->getPost('total_deliquent'),
                    'total_over_due_account'    => $this->request->getPost('total_overdue'),
                    'cash_in_bank'              => $this->request->getPost('cash_in_bank'),
                    'cash_on_hand'              => $this->request->getPost('cash_on_hand'),
                    'inventories'               => $this->request->getPost('inventories'),

            );

                 $project_meeting = array(
                     'meeting_transaction_id'   => $id,
                     'meeting_present'          => $this->request->getPost('meeting_present'),
                     'meeting_absent'           => $this->request->getPost('meeting_absent'),
                 );

            if (strtolower($type_act_name) == 'training' ) {

                    $where = array('transaction_id'=>$id);
					$data = array('is_training' => 1);
                    $update_training = $this->CustomModel->updatewhere($where,$data,$this->transactions_table);
                    if ($update_training) {
                            $add_training = $this->CustomModel->addData($this->training_table,$training_data);
								if ($add_training) {

									$resp = array(
											'message' => 'Success',
											'response' => true
										);


									// code...
								}else {

									$resp = array(
											'message' => 'error add training',
											'response' => false
										);

								}

                    }else {

                        $resp = array(
                                    'message' => 'Error Update',
                                    'response' => false
                                );
                }

            }else if (strtolower($type_act_name) == 'regular monthly project monitoring') {

                $where = array('transaction_id'=>$id);
				$data = array('is_project_monitoring' => 1);
                $update_project = $this->CustomModel->updatewhere($where,$data,$this->transactions_table);
                if ($update_project) {

                    $add_project = $this->CustomModel->addData($this->project_monitoring_table,$project_data);
								if ($add_project) {

									$resp = array(
											'message' => 'Success',
											'response' => true
										);


									// code...
								}else {

									$resp = array(
											'message' => 'error add project',
											'response' => false
										);

								}

                }else {

                    $resp = array(
                                'message' => 'Error Update',
                                'response' => false
                            );
            }

            }else if(strtolower($type_act_name) == 'regular monthly meeting'){


                $where = array('transaction_id'=>$id);
                $data = array('is_project_meeting' => 1);
                $update_project_meeting = $this->CustomModel->updatewhere($where,$data,$this->transactions_table);

                if ($update_project_meeting) {

                    $add_project_meeting = $this->CustomModel->addData($this->project_meeting_table,$project_meeting);
                                if ($add_project_meeting) {

                                    $resp = array(
                                            'message' => 'Success',
                                            'response' => true
                                        );


                                    // code...
                                }else {

                                    $resp = array(
                                            'message' => 'error add project',
                                            'response' => false
                                        );

                                }

                }else {

                    $resp = array(
                                'message' => 'Error Update',
                                'response' => false
                            );
            }





            }
            $resp = array(
				'message' => 'Successfully Added',
				'response' => true
			);

            }else {

                $resp = array(
                    'message' => 'Error Duplicate PMAS NO',
                    'response' => false
                );

                

            }
            
            echo json_encode($resp);

            
        }
    }





public function update_transaction(){
        
    if ($this->request->isAJAX()) {


        $now = new \DateTime();
        $now->setTimezone(new \DateTimezone('Asia/Manila'));


        $where = array('transaction_id' => $this->request->getPost('transaction_id'));

        $data = array(
                
                'responsible_section_id'    =>$this->request->getPost('update_responsible_section_id'),
                'type_of_activity_id'       => $this->request->getPost('update_type_of_activity_id'),
                'under_type_of_activity_id' => $this->request->getPost('update_select_under_type_id'),
                'date_and_time'             =>  date("Y/m/d H:i:s", strtotime($this->request->getPost('update_date_and_time'))),
                'responsibility_center_id'  =>   $this->request->getPost('update_responsibility_center_id'),
                'cso_Id'                    => $this->request->getPost('update_cso_id'),      
                'annotations'                => $this->request->getPost('annotation'),
                'updated_on'                => $now->format('Y-m-d H:i:s'),
                'update_status'             => 'updated' 
        );
    

        $result         = $this->CustomModel->updatewhere($where,$data,$this->transactions_table);

        if ($result) {

            $type_act_name  =  $this->CustomModel->getwhere($this->type_of_activity_table,array('type_of_activity_id ' => $data['type_of_activity_id']))[0]->type_of_activity_name;
            
            $training_data  = array(

                    'title_of_training'         => $this->request->getPost('update_title_of_training'),
                    'number_of_participants'    => $this->request->getPost('update_number_of_participants'),
                    'female'                    => $this->request->getPost('update_female'),
                    'overall_ratings'           => $this->request->getPost('update_over_all_ratings'),
                    'name_of_trainor'           => $this->request->getPost('update_name_of_trainor'),
                 );

 

            $project_data = array(

                    
                    'project_title'             => $this->request->getPost('update_project_title'),
                    'period'                    => date("Y/m/d", strtotime($this->request->getPost('update_period'))),
                    'attendance_present'        => $this->request->getPost('update_present'),
                    'attendance_absent'         => $this->request->getPost('update_absent'),
                    'nom_borrowers_delinquent'  => $this->request->getPost('update_deliquent'),
                    'nom_borrowers_overdue'     => $this->request->getPost('update_overdue'),
                    'total_production'          => $this->request->getPost('update_total_production'),
                    'total_collection_sales'    => $this->request->getPost('update_total_collection'),
                    'total_released_purchases'  => $this->request->getPost('update_total_released'),
                    'total_delinquent_account'  => $this->request->getPost('update_total_deliquent'),
                    'total_over_due_account'    => $this->request->getPost('update_total_overdue'),
                    'cash_in_bank'              => $this->request->getPost('update_cash_in_bank'),
                    'cash_on_hand'              => $this->request->getPost('update_cash_on_hand'),
                    'inventories'               => $this->request->getPost('update_inventories'),

            );


            $where2 = array('training_transact_id'      => $where['transaction_id']);
            $where3 = array('project_transact_id'       => $where['transaction_id'] );


           


   

            if (strtolower($type_act_name) == 'training' ) {


             $add_training_data  = array(

                    'training_transact_id'      => $where['transaction_id'],
                    'title_of_training'         => $this->request->getPost('update_title_of_training'),
                    'number_of_participants'    => $this->request->getPost('update_number_of_participants'),
                    'female'                    => $this->request->getPost('update_female'),
                    'overall_ratings'           => $this->request->getPost('update_over_all_ratings'),
                    'name_of_trainor'           => $this->request->getPost('update_name_of_trainor'),
                 );

            $is_training_data = array('is_training' => 1,'is_project_monitoring' => 0);
            $update_is_training = $this->CustomModel->updatewhere($where,$is_training_data,$this->transactions_table);


            if ($update_is_training) {

                $count_training =  $this->CustomModel->countwhere($this->training_table,$where2);
                if ($count_training > 0) {
                    
                    $update_training = $this->CustomModel->updatewhere($where2,$training_data,$this->training_table);


                    if ($update_training) {

                         $resp = array(
                                            'message' => 'Success Updated',
                                            'response' => true
                                        );
                       
                    }else {

                          $resp = array(
                                            'message' => 'error Update training',
                                            'response' => false
                                        );
                    }
                    

                }else {


                    

                      $add_training = $this->CustomModel->addData($this->training_table,$add_training_data);
                                if ($add_training) {

                                    $resp = array(
                                            'message' => 'Success',
                                            'response' => true
                                        );


                                    // code...
                                }else {

                                    $resp = array(
                                            'message' => 'error add training',
                                            'response' => false
                                        );

                                }




                    
                }

            }else {

                $resp = array(
                                    'message' => 'Error Update',
                                    'response' => false
                                );


            }




            }else if (strtolower($type_act_name) == 'regular monthly project monitoring') {


                $add_project_data = array(

                    'project_transact_id'       => $where['transaction_id'],
                    'project_title'             => $this->request->getPost('update_project_title'),
                    'period'                    => date("Y/m/d", strtotime($this->request->getPost('update_period'))),
                    'attendance_present'        => $this->request->getPost('update_present'),
                    'attendance_absent'         => $this->request->getPost('update_absent'),
                    'nom_borrowers_delinquent'  => $this->request->getPost('update_deliquent'),
                    'nom_borrowers_overdue'     => $this->request->getPost('update_overdue'),
                    'total_production'          => $this->request->getPost('update_total_production'),
                    'total_collection_sales'    => $this->request->getPost('update_total_collection'),
                    'total_released_purchases'  => $this->request->getPost('update_total_released'),
                    'total_delinquent_account'  => $this->request->getPost('update_total_deliquent'),
                    'total_over_due_account'    => $this->request->getPost('update_total_overdue'),
                    'cash_in_bank'              => $this->request->getPost('update_cash_in_bank'),
                    'cash_on_hand'              => $this->request->getPost('update_cash_on_hand'),
                    'inventories'               => $this->request->getPost('update_inventories'),

            );




               
                $is_project_data = array('is_project_monitoring' => 1, 'is_training' => 0);
                $update_project = $this->CustomModel->updatewhere($where,$is_project_data,$this->transactions_table);

                if ($update_project) {


                    $count_project =  $this->CustomModel->countwhere($this->project_monitoring_table,$where3);


                    if ($count_project > 0) {
                    
                    $update_project = $this->CustomModel->updatewhere($where3,$project_data,$this->project_monitoring_table);


                     if ($update_project) {

                         $resp = array(
                                            'message' => 'Success Updated',
                                            'response' => true
                                        );
                       
                    }else {

                          $resp = array(
                                            'message' => 'error Update training',
                                            'response' => false
                                        );
                    }


                }else {




                      $add_project = $this->CustomModel->addData($this->project_monitoring_table,$add_project_data);
                                if ($add_project) {

                                    $resp = array(
                                            'message' => 'Success',
                                            'response' => true
                                        );


                                    // code...
                                }else {

                                    $resp = array(
                                            'message' => 'error add training',
                                            'response' => false
                                        );

                                }

                 




                }




                    //end
                    
                }else {

                    $resp = array(
                                    'message' => 'Error Update',
                                    'response' => false
                                );

                }



            }else {


                $this->CustomModel->deleteData($this->training_table,$where2);
                $this->CustomModel->deleteData($this->project_monitoring_table,$where3);
                $data_update_2 = array('is_training' => 0, 'is_project_monitoring' => 0 );

                $this->CustomModel->updatewhere($where,$data_update_2,$this->transactions_table);



            }

             $resp = array(
                'message' => 'Successfully Updated',
                'response' => true
            );



        }else {



                    $resp = array(
                                    'message' => 'Error Update',
                                    'response' => false
                                );

        }

                    
        echo json_encode($resp);;
       


            
        }
    }



public function get_admin_pending_transaction_limit(){

    $data = [];

    $items = $this->TransactionModel->getAdminPendingTransactionsLimit();

    foreach ($items as $row ) {



        $data[] = array(
                            'transaction_id'        => $row->transaction_id,
                            'pmas_no'               => date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number,
                            'date_and_time_filed'   => date('F d Y', strtotime($row->date_and_time_filed)).' '.date('h:i a', strtotime($row->date_and_time_filed)),
                            'responsible_section'   => $row->responsible_section_name,
                            'type_of_activity_name' => $row->type_of_activity_name,
                            'responsibility_center' => $row->responsibility_center_code.' - '.$row->responsibility_center_name,
                            'date_and_time'         => date('F d Y', strtotime($row->date_and_time)).' '.date('h:i a', strtotime($row->date_and_time)),
                            'is_training'           => $row->is_training == 1 ? true : false,
                            'is_project_monitoring' =>  $row->is_project_monitoring == 1 ? true : false,
                            'name'                  => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                            'cso_name'              => $row->cso_name,
                           
                );


    }

     echo json_encode($data);
}


    public function get_admin_pending_transactions(){

        $data = [];


        if ($this->request->getPost('filter') == 'false') {

        $items = $this->TransactionModel->getAdminPendingTransactions();

        foreach ($items as $row ) {


            $action = '';
            $status_display = '';
            $update_status = '';

            

            if ($row->remarks == '' AND $row->action_taken_date == null) {


                if ($row->update_status == 'updated') {

                $update_status  = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">Updated</a>';
                // code...
            }else {
                $update_status = '';
            }
                
                $action = '<div class="btn-group dropleft">
                                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <i class="ti-settings" style="font-size : 15px;"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->transaction_id.'" id="add-remarks">Add Remarks</a>
                                                <hr>
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  id="view_transaction">View Information</a>
                                                 <hr>
                                                <a class="dropdown-item completed" href="javascript:;" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  >Approve</a>
                                              </di>';
                $status_display = '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-2 pr-2">no remarks</a> '.$update_status;
            }else if ($row->remarks != '' AND $row->action_taken_date == null) {
                
                $action = '<div class="btn-group dropleft">
                                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <i class="ti-settings" style="font-size : 15px;"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                               
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  id="view_transaction">View Information</a>
                                              </di>';
                $status_display = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">remarks added</a><br>
                ';
                // <a href="javascript:;" data-id="'.$row->transaction_id.'"  id="update-remark" >Update</a>
            }else if ($row->remarks != '' AND $row->action_taken_date != null) {

                $action = '<a href="javascript:;"  data-id="'.$row->transaction_id.'" class="btn sub-button btn-rounded p-1 pl-2 pr-2 completed"><i class="ti-check"></i></a>';
                $status_display = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">Accomplished </a><br><a href="javascript:;" >'.date('F d Y', strtotime($row->action_taken_date)).'</a>';
                
            }


            $data[] = array(
                            'transaction_id'        => $row->transaction_id,
                            'pmas_no'               => date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number,
                            'date_and_time_filed'   => date('F d Y', strtotime($row->date_and_time_filed)).' '.date('h:i a', strtotime($row->date_and_time_filed)),
                            'responsible_section'   => $row->responsible_section_name,
                            'type_of_activity_name' => $row->type_of_activity_name,
                            'responsibility_center' => $row->responsibility_center_code.' - '.$row->responsibility_center_name,
                            'date_and_time'         => date('F d Y', strtotime($row->date_and_time)).' '.date('h:i a', strtotime($row->date_and_time)),
                            'is_training'           => $row->is_training == 1 ? true : false,
                            'is_project_monitoring' =>  $row->is_project_monitoring == 1 ? true : false,
                            'name'                  => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                            'cso_name'              => $row->cso_id == 0 ? ' - ' : $row->cso_name,
                            's'                     => $status_display,
                            'action'                => $action,
                );

        }

    }else if($this->request->getPost('filter') == 'true'){


            $filter_data = array('start_date' => $this->request->getPost('start_date') , 'end_date' => $this->request->getPost('end_date') );

            $items = $this->TransactionModel->getPendingTransactionDateFilter($filter_data);

              foreach ($items as $row ) {


            $action = '';
            $status_display = '';

            if ($row->remarks == '' AND $row->action_taken_date == null) {
                
                $action = '<div class="btn-group dropleft">
                                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <i class="ti-settings" style="font-size : 15px;"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->transaction_id.'" id="add-remarks">Add Remarks</a>
                                                <hr>
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  id="view_transaction">View Information</a>
                                                 <hr>
                                                <a class="dropdown-item completed" href="javascript:;" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  >Approve</a>
                                              </di>';
                $status_display = '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-2 pr-2">no remarks</a>';
            }else if ($row->remarks != '' AND $row->action_taken_date == null) {
                
                $action = '<div class="btn-group dropleft">
                                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <i class="ti-settings" style="font-size : 15px;"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                               
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  id="view_transaction_pending">View Information</a>
                                              </di>';
                $status_display = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">remarks added</a><br><a href="javascript:;" data-id="'.$row->transaction_id.'"  id="update-remark" >Update</a>';

            }else if ($row->remarks != '' AND $row->action_taken_date != null) {

                $action = '<a href="javascript:;"  data-id="'.$row->transaction_id.'" class="btn sub-button btn-rounded p-1 pl-2 pr-2 completed"><i class="ti-check"></i></a>';
                $status_display = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">Accomplished</a><br><a href="javascript:;" >'.date('F d Y', strtotime($row->action_taken_date)).'</a>';
                
            }


            $data[] = array(
                            'transaction_id'        => $row->transaction_id,
                            'pmas_no'               => date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number,
                            'date_and_time_filed'   => date('F d Y', strtotime($row->date_and_time_filed)).' '.date('h:i a', strtotime($row->date_and_time_filed)),
                            'responsible_section'   => $row->responsible_section_name,
                            'type_of_activity_name' => $row->type_of_activity_name,
                            'responsibility_center' => $row->responsibility_center_code.' - '.$row->responsibility_center_name,
                            'date_and_time'         => date('F d Y', strtotime($row->date_and_time)).' '.date('h:i a', strtotime($row->date_and_time)),
                            'is_training'           => $row->is_training == 1 ? true : false,
                            'is_project_monitoring' =>  $row->is_project_monitoring == 1 ? true : false,
                            'name'                  => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                            'cso_name'              => $row->cso_id == 0 ? ' - ' : $row->cso_name,
                            's'                     => $status_display,
                            'action'                => $action,
                );

        }
        
    }

        echo json_encode($data);
    }



    public function get_user_pending_transactions(){

        $data = [];

        $where = array('created_by' => session()->get('user_id'));

        $items = $this->TransactionModel->getUserPendingTransactions($where);

        foreach ($items as $row ) {


            $action = '';
            $status_display = '';
            $update_status_display = '';
            $updated_status = '';

            if ($row->remarks == '' AND $row->action_taken_date == null) {


                if ($row->update_status == 'updated') {

                    $update_status_display = '<a class="dropdown-item text-success" href="javascript:;"> <i class="ti-check"></i> Last Updated </br>'.date('F d, Y', strtotime($row->updated_on)).' '.date('h:i a', strtotime($row->updated_on)).'</a>';


                    // code...
                }else {

                    $update_status_display = '<a class="dropdown-item text-danger" href="javascript:;">Not Updated</a>';
                }
               

                $action = '<div class="btn-group dropleft">
                                              <button type="button" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <i class="ti-settings" style="font-size : 15px;"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->transaction_id.'"  data-name="'.date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number.'"  id="update-transaction" > <i class="ti-eye"></i> View/Update Information</a>

                                                 <a class="dropdown-item" href="javascript:;" id="pass_to" data-id="'.$row->transaction_id.'"  data-name="'.date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number.'"  data-toggle="modal" data-target="#pass_to_modal"> <i class="ti-arrow-right"></i> Pass to</a>
                                        
                                     
                                              </di>';
                $status_display = '<a href="javascript:;" class="btn btn-secondary btn-rounded p-1 pl-2 pr-2">Wait for Remarks....</a>'.' '. $update_status_display;
            }else if ($row->remarks != '' AND $row->action_taken_date == null) {
                
                $action = '<ul class="d-flex justify-content-center">
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  id="view_transaction"><i class="fa fa-eye"></i></a></li>
                                </ul>';
                $status_display = '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-2 pr-2">remarks added</a><br><a href="javascript:;"  data-id="'.$row->transaction_id.'" id="view-remarks">View Remarks</a>';

            }else if ($row->remarks != '' AND $row->action_taken_date != null) {

               $action = '<ul class="d-flex justify-content-center">
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  id="view_transaction" ><i class="fa fa-eye"></i></a></li>
                                </ul>';
                $status_display = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">Accomplished || For Approval</a>';
                
            }


            $data[] = array(
                            'transaction_id' => $row->transaction_id,
                            'pmas_no' => date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number,
                            'date_and_time_filed' => date('F d Y', strtotime($row->date_and_time_filed)).' '.date('h:i a', strtotime($row->date_and_time_filed)),
                            'responsible_section' => $row->responsible_section_name,
                            'type_of_activity_name' => $row->type_of_activity_name,
                            'responsibility_center' => $row->responsibility_center_code.' - '.$row->responsibility_center_name,
                            'date_and_time' => date('M,d Y', strtotime($row->date_and_time)).' '.date('h:i a', strtotime($row->date_and_time)),
                            'is_training' => $row->is_training == 1 ? true : false,
                            'is_project_monitoring' =>  $row->is_project_monitoring == 1 ? true : false,
                            'name' => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                            's' => $status_display,
                            'action' => $action,
                );

        }

        echo json_encode($data);
    }    


    public function user_delete_transaction(){


         $where = array('transaction_id' => $this->request->getPost('id'));

        $result = $this->CustomModel->deleteData($this->transactions_table,$where);


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

                 echo json_encode($data);

    }

    public function add_remark(){

        $data = array(
                    'remarks' => $this->request->getPost('content'),
                    
        );
        $where = array('transaction_id'=>$this->request->getPost('id'));
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


public function view_remark(){

        $data = [];
        $where = array('transaction_id'=>$this->request->getPost('id'));
        $data['remarks'] = $this->CustomModel->getwhere($this->transactions_table,$where)[0]->remarks;
        $data['transaction_id'] = $where['transaction_id']; 
        echo json_encode($data);
        

}


public function accomplished(){


    $data = array(
                'action_taken_date' =>date('Y-m-d H:i:s', time())
        );

    $where = array('transaction_id'=>$this->request->getPost('id'));
    $update = $this->CustomModel->updatewhere($where,$data,$this->transactions_table);


    if($update){

        $resp = array(
            'message' => 'Updated Successfully',
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


public function update_completed(){

    $data = array(
                'transaction_status' => 'completed'
        );
    $where = array('transaction_id'=>$this->request->getPost('id'));
    $update = $this->CustomModel->updatewhere($where,$data,$this->transactions_table);

    if($update){

        $resp = array(
            'message' => 'Updated Successfully',
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


public function count_pending_transactions(){
    $count = 0;

    if (session()->get('user_type') == $this->config->user_type[0]) {

        $where = array('transaction_status' => 'pending');
        $count = $this->CustomModel->countwhere($this->transactions_table,$where);
       
    }else if (session()->get('user_type') == $this->config->user_type[1]) {
        
        $where = array('transaction_status' => 'pending','created_by' => session()->get('user_id'));
        $count = $this->CustomModel->countwhere($this->transactions_table,$where);
    }

    echo $count;

}


public function get_transaction_data(){


        $row = $this->TransactionModel->getTransactionData($this->transactions_table,array('transaction_id' => $this->request->getPost('id')))[0];

        $training_data = [];
        $project_data = [];

        if ($row->is_training == 1) {

            $row_training = $this->CustomModel->getwhere($this->training_table,array('training_transact_id' => $row->transaction_id))[0];
            
            $training_data[] = array(

                    'title_of_training'         => $row_training->title_of_training,
                    'number_of_participants'    => $row_training->number_of_participants,
                    'female'                    => $row_training->female,
                    'male'                      => $row_training->number_of_participants - $row_training->female,
                    'overall_ratings'           => $row_training->overall_ratings,
                    'name_of_trainor'           => $row_training->name_of_trainor


            );
        }

        if ($row->is_project_monitoring == 1) {

             $row_project = $this->CustomModel->getwhere($this->project_monitoring_table,array('project_transact_id' => $row->transaction_id))[0];


            $project_data[] = array(

                    'project_title'             => $row_project->project_title,
                    'period'                    => date("m/d/Y", strtotime($row_project->period)),
                    'present'                   => $row_project->attendance_present,
                    'absent'                    => $row_project->attendance_absent,

                    'delinquent'                => $row_project->nom_borrowers_delinquent,
                    'overdue'                   => $row_project->nom_borrowers_overdue,
                    'total_production'          => $row_project->total_production,
                    'total_collection_sales'    => number_format($row_project->total_collection_sales, 2, '.', ',') ,
                    'total_released_purchases'  => number_format($row_project->total_released_purchases, 2, '.', ','),
                    'total_delinquent_account'  => number_format($row_project->total_delinquent_account, 2, '.', ','),
                    'total_over_due_account'    => number_format($row_project->total_over_due_account, 2, '.', ','),
                    'cash_in_bank'              => number_format($row_project->cash_in_bank, 2, '.', ','),
                    'cash_on_hand'              => number_format($row_project->cash_on_hand, 2, '.', ','),
                    'inventories'               => number_format($row_project->inventories, 2, '.', ','),
                     'total_volume_of_business'  => number_format(array_sum(array(

                                                    $row_project->total_collection_sales,
                                                    $row_project->total_released_purchases,
                                                    
                                                        )), 2, '.', ','),
                    'total_cash_position'       => number_format(array_sum(array(

                                                    $row_project->cash_in_bank,
                                                    $row_project->cash_on_hand,
                                                    $row_project->inventories
                                                    
                                                        )), 2, '.', ','),
                    
            );
        }

        $data = array(

                    'transaction_id'             => $row->transaction_id,
                    'number'                     => $row->number,
                    'month'                      =>  date('m', strtotime($row->date_and_time_filed)),
                    'year'                       =>  date('Y', strtotime($row->date_and_time_filed)),
                    'responsible_section_id'     => $row->responsible_section_id,
                    'type_of_activity_id'        => $row->type_of_activity_id,
                    'under_type_activity'        => $row->under_type_of_activity_id == 0 ? '' : $this->CustomModel->getwhere('under_type_of_activity',array('under_type_act_id' => $row->under_type_of_activity_id))[0]->under_type_act_name,   
                    'responsibility_center_id'   => $row->responsibility_center_id,
                    'cso_id'                     => $row->cso_id,
                    'cso_name'                   => $row->cso_Id == 0 ? ' - ' : $row->cso_name,
                    'date_and_time'              => date("m/d/Y h:i:s A", strtotime($row->date_and_time)),
                    'under_type_of_activity'     => $row->under_type_of_activity_id == 0 ? '' : $row->under_type_of_activity_id,


                    'training_data'              => $training_data,
                    'project_monitoring_data'    => $project_data,


                    //View Information
                    'pmas_no'                    => date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number,
                    'date_and_time_filed'        => date('F d Y', strtotime($row->date_and_time_filed)).' '.date('h:i a', strtotime($row->date_and_time_filed)),
                    'responsible_section_name'    => $row->responsible_section_name,
                    'type_of_activity_name'       => $row->type_of_activity_name,
                    'responsibility_center_name'  => $row->responsibility_center_name,
                    'date_time'                   => date('F d Y', strtotime($row->date_and_time)),
                    'annotations'                 => $row->annotations == NULL ? ' ' : $row->annotations,
                    'annotation_text'             => $row->annotations,
                    'last_updated'                => $row->updated_on ==  '0000-00-00 00:00:00' ? '<span class="text-danger">Not Updated</span>' : date('F d Y', strtotime($row->updated_on)).' '.date('h:i a', strtotime($row->updated_on)) ,
        );
        echo json_encode($data);
}



public function get_pmas_activities(){

    $items = $this->CustomModel->getwhere($this->transactions_table,array('created_by' => session()->get('user_id')));

   $data = [];

   foreach ($items as $row) {


        $status = $row->transaction_status == 'completed' ? '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">Completed</a>' : '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-2 pr-2">Pending</a>';
        $type = $row->transaction_status == 'completed' ? 'birthday' : 'event';
        $type_of_activity = 'Type of Activity :  <a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">'.$this->CustomModel->getwhere($this->type_of_activity_table,array('type_of_activity_id' => $row->type_of_activity_id))[0]->type_of_activity_name.'</a>';
        $responsible_section_name = ' <a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">'.$this->CustomModel->getwhere($this->responsible_section_table,array('responsible_section_id' => $row->responsible_section_id))[0]->responsible_section_name.'</a>';

        // $cso1 = $row->cso_Id == 0 ? '' :  '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">'.$this->CustomModel->getwhere($this->cso_table,array('cso_id' => $row->cso_Id))[0]->cso_name.'</a>';
        $time = 'Time : '.date('h:i:s', strtotime($row->date_and_time)); 


        $description = $status.'<br><br>'.$responsible_section_name.'<br><br>'.$type_of_activity.'<br><br>'.$time;


       
       $data[] = array(


                'id'            => $row->transaction_id,
                'name'          => 'PMAS NO '. date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number,
                'description'   => $description,
                'date'          => date('M d Y h:i:s', strtotime($row->date_and_time)),  
                'type'          => $type

       );
   }


   return json_encode($data);

}


}
