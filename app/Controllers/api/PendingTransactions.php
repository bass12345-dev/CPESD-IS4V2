<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use App\Models\TransactionModel;

class PendingTransactions extends BaseController
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

    public function __construct()
    {
       $this->db = db_connect();
       $this->CustomModel = new CustomModel($this->db); 
       $this->TransactionModel = new TransactionModel($this->db); 
       $this->request = \Config\Services::request();  
    }

    public function get_last_pmas_number()
    {
        if ($this->request->isAJAX()) {

            $l = '';
            $verify = $this->CustomModel->count_all_order_by($this->transactions_table,'date_and_time_filed',$this->order_by_desc);
            if($verify) {
                if(date('Y', time()) > date('Y', strtotime($this->CustomModel->get_all_order_by($this->transactions_table,'date_and_time_filed',$this->order_by_desc)[0]->date_and_time_filed)))
                {
                    $l = 1;
                }else if(date('Y', time()) < date('Y', strtotime($this->CustomModel->get_all_order_by($this->transactions_table,'date_and_time_filed',$this->order_by_desc)[0]->date_and_time_filed))){

                    $l = $this->TransactionModel->get_last_pmas_number_where(date('Y-m-d', time()))->getResult()[0]->number + 1;

                }else if (date('Y', time()) === date('Y', strtotime($this->CustomModel->get_all_order_by($this->transactions_table,'date_and_time_filed',$this->order_by_desc)[0]->date_and_time_filed))) 
	
			    {
                    $l = $this->TransactionModel->get_last_pmas_number_where(date('Y', time()))->getResult()[0]->number + 1;
                }
            }else {
                $l = 1;
            }
            
            echo $l;

        }
    }


    public function add_transaction(){
        if ($this->request->isAJAX()) {
                
            $data = array(
                'number' => $this->request->getPost('pmas_number'),
                'date_and_time_filed' =>  date('Y-m-d H:i:s', time()),
                'responsible_section_id' =>$this->request->getPost('type_of_monitoring_id'),
                'type_of_activity_id' => $this->request->getPost('type_of_activity_id'),
                'under_type_of_activity_id' => $this->request->getPost('under_type_of_activity_id'),
                'date_and_time' =>  date("Y/m/d H:i:s", strtotime($this->request->getPost('date_time'))),
                'responsibility_center_id' =>   $this->request->getPost('responsibility_center_id'),
                'cso_Id' => $this->request->getPost('cso_id'),
                'created_by' => session()->get('user_id'),
                'transactions' => 'pending'		
            );

            
            $array_where = array(

                        'date_and_time_filed' => date('Y-m', time()),
                        'number' => $data['number']
            );
            
            $verify =  $this->TransactionModel->verify_pmas_number($array_where)->countAllResults();

            if(!$verify){
                
                $result  = $this->CustomModel->addData($this->transactions_table,$data);
                $id = $this->db->insertID();
                $type_act_name =  $this->CustomModel->getwhere($this->type_of_activity_table,array('type_of_activity_id ' => $data['type_of_activity_id']))[0]->type_of_activity_name;
                
                $training_data = array(

                    'training_transact_id' => $id,
                    'title_of_training' => $this->request->getPost('title_of_training'),
                    'number_of_participants' => $this->request->getPost('number_of_participants'),
                    'female'  => $this->request->getPost('female'),
                    'overall_ratings'  => $this->request->getPost('over_all_ratings'),
                    'name_of_trainor'  => $this->request->getPost('name_of_trainor'),
                 );


                 $project_data = array(

                    'project_transact_id' => $id,
                    'project_title' => $this->request->getPost('project_title'),
                    'period' => date("Y/m/d", strtotime($this->request->getPost('period'))),
                    'attendance_present' => $this->request->getPost('present'),
                    'attendance_absent' => $this->request->getPost('absent'),
                    'nom_borrowers_delinquent' => $this->request->getPost('deliquent'),
                    'nom_borrowers_overdue' => $this->request->getPost('overdue'),
                    'total_production' => $this->request->getPost('total_production'),
                    'total_collection_sales' => $this->request->getPost('total_collection'),
                    'total_released_purchases' => $this->request->getPost('total_released'),
                    'total_delinquent_account' => $this->request->getPost('total_deliquent'),
                    'total_over_due_account' => $this->request->getPost('total_overdue'),
                    'cash_in_bank' => $this->request->getPost('cash_in_bank'),
                    'cash_on_hand' => $this->request->getPost('cash_on_hand'),
                    'inventories' => $this->request->getPost('inventories'),

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



    public function get_admin_pending_transactions(){

        $data = [];

        $items = $this->TransactionModel->getAdminPendingTransactions();

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
                                                <a class="dropdown-item" href="javascript:;" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  id="view_transaction_pending">View Information</a>
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
                $status_display = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">remarks added</a><br><a href="javascript:;" id="update-remark" >Update</a>';

            }else if ($row->remarks != '' AND $row->action_taken_date != null) {

                $action = '<a href="javascript:;" id="completed" data-id="'.$row->transaction_id.'" class="btn sub-button btn-rounded p-1 pl-2 pr-2"><i class="ti-check"></i></a>';
                $status_display = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">Action Taken</a><br><a href="javascript:;" >'.date('M, d Y', strtotime($row->action_taken_date)).'</a>';
                
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



        public function get_user_pending_transactions(){

        $data = [];

        $items = $this->TransactionModel->getAdminPendingTransactions();

        foreach ($items as $row ) {


            $action = '';
            $status_display = '';

            if ($row->remarks == '' AND $row->action_taken_date == null) {
                
                $action = '<ul class="d-flex justify-content-center">
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  id="view_transaction_pending"><i class="fa fa-eye"></i></a></li>
                                <li><a href="javascript:;" data-id=""  id="delete-activity"  class="text-danger action-icon"><i class="ti-trash"></i></a></li>
                                </ul>';
                $status_display = '<a href="javascript:;" class="btn btn-secondary btn-rounded p-1 pl-2 pr-2">Waiting for Remarks....</a>';
            }else if ($row->remarks != '' AND $row->action_taken_date == null) {
                
                $action = '<ul class="d-flex justify-content-center">
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  id="view_transaction_pending"><i class="fa fa-eye"></i></a></li>
                                </ul>';
                $status_display = '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-2 pr-2">remarks added</a><br><a href="javascript:;"  data-id="'.$row->transaction_id.'" id="view-remarks">View Remarks</a>';

            }else if ($row->remarks != '' AND $row->action_taken_date != null) {

               $action = '<ul class="d-flex justify-content-center">
                                <li class="mr-3 "><a href="javascript:;" class="text-secondary action-icon" data-id="'.$row->transaction_id.'" data-status="'.$row->transaction_status.'"  id="view_transaction_pending" ><i class="fa fa-eye"></i></a></li>
                                </ul>';
                $status_display = '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-2 pr-2">Waiting for Confirmation</a>';
                
            }


            $data[] = array(
                            'transaction_id' => $row->transaction_id,
                            'pmas_no' => date('Y', strtotime($row->date_and_time_filed)).' - '.date('m', strtotime($row->date_and_time_filed)).' - '.$row->number,
                            'date_and_time_filed' => date('M,d Y', strtotime($row->date_and_time_filed)).' '.date('h:i a', strtotime($row->date_and_time_filed)),
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


}
