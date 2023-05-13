<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use Config\Custom_config;


class Cso extends BaseController
{
    public $cso_table                    = 'cso';
    public $cso_officer_table            = 'cso_officers';
    public $transactions_table           = 'transactions';
    public $cso_project_table            = 'cso_project_implemented';
    public $order_by_desc                = 'desc';
    public $order_by_asc                 = 'asc';
    protected $request;
    protected $CustomModel;
    public $config;

    public function __construct()
    {
       $db = db_connect();
       $this->CustomModel = new CustomModel($db); 
       $this->request = \Config\Services::request();  
        $this->config = new Custom_config;
    }

    public function add_cso()
    {
    if ($this->request->isAJAX()) {

         $now = new \DateTime();
            $now->setTimezone(new \DateTimezone('Asia/Manila'));
        $data = array(
                'cso_name' => $this->request->getPost('cso_name'),
                'cso_code' => $this->request->getPost('cso_code'),
                'type_of_cso' => strtoupper($this->request->getPost('cso_type')),
                'purok_number' => $this->request->getPost('purok') ,
                'barangay' => $this->request->getPost('barangay'),
                'contact_person' => ($this->request->getPost('contact_person') == '') ?  '' : $this->request->getPost('contact_person') ,
                'contact_number' => $this->request->getPost('contact_number'),
                'telephone_number' => ($this->request->getPost('telephone_number') == '') ?  '' : $this->request->getPost('telephone_number'),
                'email_address' => ($this->request->getPost('email_address') == '') ?  '' : $this->request->getPost('email_address'),
                'cso_status' => 'active',
                'cso_created' => $now->format('Y-m-d H:i:s')
              
            );

         $verify = $this->CustomModel->countwhere($this->cso_table,array('cso_code' => $data['cso_code']));
         if ($verify > 0) {

            $data = array(
                'message' => 'Error Duplicate Code',
                'response' => false
                );

         }else {
            
             $result  = $this->CustomModel->addData($this->cso_table,$data);

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



     public function get_admin_chart_cso_data(){


       //  $csos = array();
       //  $active_cso = array();

       //  $types = array();

       //  foreach($this->config->cso_type as $row) {

       //      $cso = $this->CustomModel->countwhere($this->cso_table,array('cso_status' => 'active','type_of_cso' => $row));
       //      array_push($csos, $cso);

       //      array_push($types,$row);

       //  }


        
       //  $data['label'] = $types;
       //  $data['cso']    = $csos;
       //  $data['color'] = ['#063970','#2596be','#e28743'];

       // echo json_encode($data);


        $csos = array();
        $cso_status = ['active','inactive'];
        foreach($cso_status as $row) {

            $cso = $this->CustomModel->countwhere($this->cso_table,array('cso_status' => $row));
            array_push($csos, $cso);
        }

       $data['label'] = $cso_status;
       $data['cso']    = $csos;
       $data['color'] = ['rgb(5, 176, 133)','rgb(216, 88, 79)'];
       echo json_encode($data);

     }



       public function delete_cso(){

        $where1 = array('cso_Id' => $this->request->getPost('id'));
        $where2 = array('cso_id' => $this->request->getPost('id'));
        $check = $this->CustomModel->countwhere($this->transactions_table,$where1);


        if ($check > 0) {

             $data = array(
                    'message' => 'This CSO is used in other operations',
                    'response' => false
                    );
            
        }else {

             $result = $this->CustomModel->deleteData($this->cso_table,$where2);


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

    public function get_cso(){

        if ($this->request->isAJAX()) {

           $where = array('cso_status' => $this->request->getPost('cso_status'),'type_of_cso' => $this->request->getPost('cso_type'));


           if ($where['cso_status'] != '' &&  $where['type_of_cso'] == '' ) {

               $where_status = array('cso_status' => $where['cso_status']);
               $this->query_cso_where($where_status);

           }else if ($where['type_of_cso'] != '' && $where['cso_status'] == '' ) {
              
                $where_status = array('type_of_cso' => $where['type_of_cso']);
                $this->query_cso_where($where_status);

           }else if ($where['cso_status'] != '' &&  $where['type_of_cso'] != '') {

                $where_status = array('cso_status' => $where['cso_status'],'type_of_cso' => $where['type_of_cso']);
                $this->query_cso_where($where_status);
               
           }else if ($where['cso_status'] == '' &&  $where['type_of_cso'] == '') {

               
               $this->query_all_cso();
           }

        }

    }

    function query_all_cso(){

        $data = [];
        $item = $this->CustomModel->get_all_desc($this->cso_table,'cso_code',$this->order_by_desc);
        foreach ($item as $row) {

            $address = '';

            if ($row->barangay == '') {

                $address = '';
                // code...
            }else if ($row->purok_number == '' && $row->barangay != '') {
                
                $address = $row->barangay;
            }else if ($row->purok_number != '' && $row->barangay != '') {
                
                $address = 'Purok '.$row->purok_number.' '.$row->barangay;
            }

            $data[] = array(

                'cso_id' => $row->cso_id,
                'cso_name' => $row->cso_name,
                'cso_code' => $row->cso_code,
                'address' => $address,
                'contact_person' => $row->contact_person,
                'contact_number' => $row->contact_number,
                'telephone_number' => $row->telephone_number,    
                'email_address' => $row->email_address,
                'type_of_cso' => strtoupper($row->type_of_cso),
                'status' => $row->cso_status == 'active' ? '<span class="status-p bg-success">'.$row->cso_status.'</span>' : '<span class="status-p bg-danger">'.$row->cso_status.'</span>',
                'cso_status' => $row->cso_status


            );
        } 

        echo json_encode($data);

    }


    function query_cso_where($where){
        $data = [];
        $item = $this->CustomModel->getwhere($this->cso_table,$where);
        foreach ($item as $row) {


             $address = '';

            if ($row->barangay == '') {

                $address = '';
                // code...
            }else if ($row->purok_number == '' && $row->barangay != '') {
                
                $address = $row->barangay;
            }else if ($row->purok_number != '' && $row->barangay != '') {
                
                $address = 'Purok '.$row->purok_number.' '.$row->barangay;
            }

            $data[] = array(
                'cso_id' => $row->cso_id,
                'cso_name' => $row->cso_name,
                'cso_code' => $row->cso_code,
                'address' => $address,
                'contact_person' => $row->contact_person,
                'contact_number' => $row->contact_number,
                'telephone_number' => $row->telephone_number,    
                'email_address' => $row->email_address,
                'type_of_cso' => $row->type_of_cso,
                'status' => $row->cso_status == 'active' ? '<span class="status-p bg-success">'.$row->cso_status.'</span>' : '<span class="status-p bg-danger">'.$row->cso_status.'</span>',
                'cso_status' => $row->cso_status

            );
        } 

        echo json_encode($data);
    }



public function get_cso_information(){



    $cor_path = FCPATH ."uploads/cso_files/".$this->request->getPost('id').'/'.$this->config->folder_name['cor_folder_name'];
    $bylaws_path = FCPATH ."uploads/cso_files/".$this->request->getPost('id').'/'.$this->config->folder_name['bylaws_folder_name'];

     $aoc_path = FCPATH ."uploads/cso_files/".$this->request->getPost('id').'/'.$this->config->folder_name['aoc_folder_name'];


     $cor_file = is_dir($cor_path) ? base_url().'uploads/cso_files/'.$this->request->getPost('id').'/cor/'.scandir($cor_path)[2] : '';


	$row = $this->CustomModel->getwhere($this->cso_table,array('cso_id' =>  $this->request->getPost('id')))[0];


     $address = '';

            if ($row->barangay == '') {

                $address = '';
                // code...
            }else if ($row->purok_number == '' && $row->barangay != '') {
                
                $address = $row->barangay;

            }else if ($row->purok_number != '' && $row->barangay != '') {
                
                $address = 'Purok '.$row->purok_number.' '.$row->barangay;
            }



	$data = array(
        'cso_id' => $row->cso_id,
        'cso_name' => $row->cso_name,
        'cso_code' => $row->cso_code,
        'purok_number' => $row->purok_number,
        'barangay' => $row->barangay,
        'address' => $address,
        'contact_person' => $row->contact_person,
        'contact_number' => $row->contact_number,
        'telephone_number' => $row->telephone_number,    
        'email_address' => $row->email_address,
        'type_of_cso' => strtoupper($row->type_of_cso),
        'status' => $row->cso_status,
        'cso_status' => $row->cso_status == 'active' ?  '<span class="status-p bg-success">'.ucfirst($row->cso_status).'</span>' : '<span class="status-p bg-danger">'.ucfirst($row->cso_status).'</span>',
        'files' => array(

                    'cor' => $cor_file
        )
      
           

    );

    echo json_encode($data);


}




public function update_cso_information(){

    
    $data = array(
        'cso_name' => $this->request->getPost('cso_name'),
        'cso_code' => $this->request->getPost('cso_code'),
        'type_of_cso' => $this->request->getPost('cso_type'),
        'purok_number' => $this->request->getPost('purok') ,
        'barangay' => $this->request->getPost('barangay'),
        'contact_person' => ($this->request->getPost('contact_person') == '') ?  '' : $this->request->getPost('contact_person') ,
        'contact_number' => $this->request->getPost('contact_number'),
        'telephone_number' => ($this->request->getPost('telephone_number') == '') ?  '' : $this->request->getPost('telephone_number'),
        'email_address' => ($this->request->getPost('email_address') == '') ?  '' : $this->request->getPost('email_address'),
        'cso_created' => date('Y-m-d H:i:s', time())
      
    );
    
    $where = array(
        'cso_id' => $this->request->getPost('cso_idd')
    );

    $update = $this->CustomModel->updatewhere($where,$data,$this->cso_table);

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


public function update_cso_status(){

    $data = array(
        'cso_status' => $this->request->getPost('cso_status_update')
    );

    $where = array(
        'cso_id' => $this->request->getPost('cso_id')
    );

    $update = $this->CustomModel->updatewhere($where,$data,$this->cso_table);

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



public function get_cso_cor(){

     $path = FCPATH ."uploads/cso_files/".$this->request->getPost('id').'/'.$this->config->folder_name['cor_folder_name'];


    if (is_dir($path)) {
        
         $file = scandir($path)[2];

         $data = array(

                'file' => './../../uploads/cso_files/'.$this->request->getPost('id').'/'.$this->config->folder_name['cor_folder_name'].'/'.$file,
                'resp' => true,
                'message' => ''
         );
         
        
    }else {

          $data = array(

                'file' => '',
                'resp' => false,
                'message' => 'Please update COR file'
         );
       

    }


    echo json_encode($data);

}



public function get_cso_bylaws(){

     $path = FCPATH ."uploads/cso_files/".$this->request->getPost('id').'/'.$this->config->folder_name['bylaws_folder_name'];


    if (is_dir($path)) {
        
         $file = scandir($path)[2];

         $data = array(

                'file' => './../../uploads/cso_files/'.$this->request->getPost('id').'/'.$this->config->folder_name['bylaws_folder_name'].'/'.$file,
                'resp' => true,
                'message' => ''
         );
         
        
    }else {

          $data = array(

                'file' => '',
                'resp' => false,
                'message' => 'Please update Bylaws file'
         );
       

    }


    echo json_encode($data);

}




public function get_cso_aoc(){

     $path = FCPATH ."uploads/cso_files/".$this->request->getPost('id').'/'.$this->config->folder_name['aoc_folder_name'];


    if (is_dir($path)) {
        
         $file = scandir($path)[2];

         $data = array(

                'file' => './../../uploads/cso_files/'.$this->request->getPost('id').'/'.$this->config->folder_name['aoc_folder_name'].'/'.$file,
                'resp' => true,
                'message' => ''
         );
         
        
    }else {

          $data = array(

                'file' => '',
                'resp' => false,
                'message' => 'Please update AOC/AOI file'
         );
       

    }


    echo json_encode($data);

}




public function update_cso_cor(){

    $path = FCPATH ."uploads/cso_files/".$this->request->getPost('cso_idd').'/'.$this->config->folder_name['cor_folder_name'];

    if (!is_dir($path)) {
        mkdir($path,0777, true);
    }






    $allFiles = scandir($path);
    $files = array_diff($allFiles, array('.', '..'));


    if ($files > 0) {
        
         foreach ($files as $file) {

                unlink($path.'/'.$file);
         }
    }

    $destination = '';
    $new_name = '';

    if (is_dir($path)) {
        if (isset($_FILES['update_cor'])) {
        $new_name = $_FILES['update_cor']['name'];
        $destination = $path.'/'.$new_name;
        move_uploaded_file($_FILES['update_cor']['tmp_name'], $destination);
        

    }

     if(file_exists($destination)) {

             $data = array(
                'message' => 'Data Updated Successfully',
                'response' => true
                );
         
        } else {


             $data = array(
                'message' => 'Error',
                'response' => false
                );
          
        }


        echo  json_encode($data);
}


}



public function update_cso_bylaws(){

    $path = FCPATH ."uploads/cso_files/".$this->request->getPost('cso_idd').'/'.$this->config->folder_name['bylaws_folder_name'];

    if (!is_dir($path)) {
        mkdir($path,0777, true);
    }






    $allFiles = scandir($path);
    $files = array_diff($allFiles, array('.', '..'));


    if ($files > 0) {
        
         foreach ($files as $file) {

                unlink($path.'/'.$file);
         }
    }

    $destination = '';
    $new_name = '';

    if (is_dir($path)) {
        if (isset($_FILES['update_bylaws'])) {
        $new_name = $_FILES['update_bylaws']['name'];
        $destination = $path.'/'.$new_name;
        move_uploaded_file($_FILES['update_bylaws']['tmp_name'], $destination);
        

    }

     if(file_exists($destination)) {

             $data = array(
                'message' => 'Data Updated Successfully',
                'response' => true
                );
         
        } else {


             $data = array(
                'message' => 'Error',
                'response' => false
                );
          
        }


        echo  json_encode($data);
}


}



public function update_cso_aoc(){

    $path = FCPATH ."uploads/cso_files/".$this->request->getPost('cso_idd').'/'.$this->config->folder_name['aoc_folder_name'];

    if (!is_dir($path)) {
        mkdir($path,0777, true);
    }






    $allFiles = scandir($path);
    $files = array_diff($allFiles, array('.', '..'));


    if ($files > 0) {
        
         foreach ($files as $file) {

                unlink($path.'/'.$file);
         }
    }

    $destination = '';
    $new_name = '';

    if (is_dir($path)) {
        if (isset($_FILES['update_aoc'])) {
        $new_name = $_FILES['update_aoc']['name'];
        $destination = $path.'/'.$new_name;
        move_uploaded_file($_FILES['update_aoc']['tmp_name'], $destination);
        

    }

     if(file_exists($destination)) {

             $data = array(
                'message' => 'Data Updated Successfully',
                'response' => true
                );
         
        } else {


             $data = array(
                'message' => 'Error',
                'response' => false
                );
          
        }


        echo  json_encode($data);
}


}


//CSO Officers

public function add_cso_officer()
{
if ($this->request->isAJAX()) {
       

            $data = array(
                'officer_cso_id' => $this->request->getPost('cso_id'),
                // 'cso_position' => explode("-",$this->request->getPost('cso_position'))[0],
                'position_number' => explode("-",$this->request->getPost('cso_position'))[1],
                'first_name' => $this->request->getPost('first_name'),
                'middle_name' => ($this->request->getPost('middle_name') == '') ?  '' : $this->request->getPost('middle_name') ,
                'last_name' => $this->request->getPost('last_name'),
                'extension' => ($this->request->getPost('extension') == '') ?  '' : $this->request->getPost('extension') ,
                'cso_position' => $this->request->getPost('cso_position'),
                'contact_number' => $this->request->getPost('officer_contact_number'),
                'email_address' => $this->request->getPost('email'),
                'cso_officer_created' =>  date('Y-m-d H:i:s', time()),
                
            
            );

       

        $verify = $this->CustomModel->countwhere($this->cso_officer_table,array('cso_position' => $data['cso_position'],'position_number' => $data['position_number'],'officer_cso_id' => $data['officer_cso_id']));
        
        if ($verify > 0) {

            $data = array(
               'message' => 'Position is already taken',
               'response' => false
               );
             
          }else {

            $result  = $this->CustomModel->addData($this->cso_officer_table,$data);

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


 public function get_officers(){

    $data = [];
    $pid = 0;
    $id = 1;
    $item = $this->CustomModel->getwhere_orderby($this->cso_officer_table,array('officer_cso_id' => $this->request->getPost('cso_id')),'position_number',$this->order_by_asc); 
    foreach ($item as $row) {
        
            $data[] = array(
                    'id' => $id++,
                    'pid' => $pid++,
                    'name' => $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                    'first_name' => $row->first_name,
                    'middle_name' => $row->middle_name,
                    'last_name' => $row->last_name,
                    'extension' => $row->extension,
                    'title' => explode("-",$row->cso_position)[0], 
                    'position' => $row->cso_position,
                    'img' => "https://www.pngitem.com/pimgs/m/504-5040528_empty-profile-picture-png-transparent-png.png",
                    'contact_number' => $row->contact_number, 
                    'email_address' => $row->email_address,
                    'cso_officer_id' => $row->cso_officer_id, 
                    
                    

                   
            );
    }

    echo json_encode($data);

    


 }


 public function update_officer(){


    $where = array(
        'cso_officer_id' => $this->request->getPost('officer_id')
    );
    
   $data = array(
                'officer_cso_id' => $this->request->getPost('cso_id'),
                // 'cso_position' => explode("-",$this->request->getPost('update_cso_position'))[0],
                'position_number' => explode("-",$this->request->getPost('update_cso_position'))[1],
                'first_name' => $this->request->getPost('update_first_name'),
                'middle_name' => ($this->request->getPost('update_middle_name') == '') ?  '' : $this->request->getPost('update_middle_name') ,
                'last_name' => $this->request->getPost('update_last_name'),
                'extension' => ($this->request->getPost('update_extension') == '') ?  '' : $this->request->getPost('update_extension') ,
                'cso_position' => $this->request->getPost('update_cso_position'),
                'contact_number' => $this->request->getPost('update_contact_number'),
                'email_address' => $this->request->getPost('update_email'),
               
            
            );


 $update = $this->CustomModel->updatewhere($where,$data,$this->cso_officer_table);

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


        public function count_cso_per_barangay(){

        $barangay = $this->config->barangay;

        $data = [];

        foreach($barangay as $row) {



            $data[] = array(

                    'barangay' => $row,
                    'active' => $this->CustomModel->countwhere($this->cso_table,array('barangay' => $row , 'cso_status' => 'active')),
                    'inactive' => $this->CustomModel->countwhere($this->cso_table,array('barangay' => $row , 'cso_status' => 'inactive')),

                );

        }

        echo json_encode($data);
    }


    public function delete_cso_officer(){

        

         $where = array(
        'cso_officer_id' => $id = $this->request->getPost('id')
        );

        $delete =  $this->CustomModel->deleteData($this->cso_officer_table,$where);

        if($delete){

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


    public function add_project(){


        $now = new \DateTime();
        $now->setTimezone(new \DateTimezone('Asia/Manila'));
        $data = array(
                'title_of_project'      => $this->request->getPost('title_of_project'),
                'amount'                => $this->request->getPost('amount'),
                'year'                  => date("Y-m-d", strtotime($this->request->getPost('year'))),
                'funding_agency'        => $this->request->getPost('funding_agency') ,
                'status'                => 'active',
                'cso_project_created'   => $now->format('Y-m-d H:i:s'),
                'project_cso_id'        => $this->request->getPost('cso_idd')
            );


       
        $result  = $this->CustomModel->addData($this->cso_project_table,$data);

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


    public function get_projects(){


        $data = [];
        $item = $this->CustomModel->getwhere_orderby($this->cso_project_table,array('project_cso_id' => $this->request->getPost('cso_id') ),'cso_project_created',$this->order_by_desc); 
        foreach ($item as $row) {

              $status = $row->status == "active" ? '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-1 pr-1">Active</a> ' : '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-1 pr-1">Inactive</a> ' ;
            
                $data[] = array(

                        'project_title' => $row->title_of_project,
                        'amount'        => number_format($row->amount, 2, '.',',') ,
                        'year'          => $row->year != NULL ?  date('Y', strtotime($row->year)) : '',
                        'year1'          => $row->year != NULL ?  date('Y-m-d', strtotime($row->year)) : '',
                        'funding_agency'=> $row->funding_agency,
                        'status'        => $status,
                        'status1'        => $row->status,
                        'cso_project_id'=> $row->cso_project_implemented_id
                );
        }

        echo json_encode($data);


    }


    public function update_project(){

            $data = array(
                'title_of_project'      => $this->request->getPost('update_title_of_project'),
                'amount'                => $this->request->getPost('update_amount'),
                'year'                  => date("Y-m-d", strtotime($this->request->getPost('update_year'))),
                'funding_agency'        => $this->request->getPost('update_funding_agency') ,
            );

            $where = array(
                        'cso_project_implemented_id' => $this->request->getPost('cso_project_id')
                    );

            $update = $this->CustomModel->updatewhere($where,$data,$this->cso_project_table);

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


        public function delete_project(){

        

         $where = array(
        'cso_project_implemented_id' => $id = $this->request->getPost('id')
        );

        $delete =  $this->CustomModel->deleteData($this->cso_project_table,$where);

        if($delete){

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


    public function generate_for_print(){

    

    $search     = '';
    $cso_id     = $this->request->getPost('cso_id');
    $year       = $this->request->getPost('year');
    
    foreach ($this->request->getPost('options') as $row) {

                $search .= $row.'-';



        }





        switch ($search) {

            case 'print_cso_information-':
                
               echo $this->print_cso_information($cso_id);

            break;

            case 'print_cso_project-':
                
              echo $this->print_cso_project($cso_id,$year);

            break;

             case 'print_cso_officers-':
                
              echo $this->print_cso_officers($cso_id);

            break;

            case 'print_cso_information-print_cso_project-':
                
              echo $this->print_cso_informationANDprint_cso_project($cso_id,$year);

            break;

            case 'print_cso_information-print_cso_officers-':
                
              echo $this->print_cso_informationANDprint_cso_officers($cso_id);

            break;

            case 'print_cso_project-print_cso_officers-':
                
              echo $this->print_cso_projectANDprint_cso_officers($cso_id,$year);

            break;

            case 'print_cso_information-print_cso_project-print_cso_officers-':
                
              echo $this->print_cso_projectANDprint_cso_projectANDprint_cso_officers($cso_id,$year);

            break;


        
            
            default:
                // code...
                break;
        }


    }


    function print_cso_projectANDprint_cso_projectANDprint_cso_officers($cso_id,$year){


        $result_info             =  $this->get_cso_info($cso_id,$year);
        $result_project     =  $this->get_cso_project($cso_id,$year);
        $result_officer     = $this->get_cso_officers($cso_id);



        $data = '<table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe" data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap data-tablesaw-mode-switch id="_table">
            <tr>
                <td colspan="2"> <a href="javascript:;" class="mt-2  mb-2 btn sub-button text-center  btn-rounded btn-md btn-block"><i class = "fa fa-user" aria-hidden = "true"></i> CSO Information</a> 
               
            </tr>
            <tr>
                <td>CSO Code</td>
                <td>'.$result_info['cso_code'].'</td>
            </tr>
            <tr>
                <td>CSO</td>
                <td>'.$result_info['cso_name'].'</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>'.$result_info['address'].'</td>
            </tr>
            <tr>
                <td>Contact Person</td>
                <td>'.$result_info['contact_person'].'</td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>'.$result_info['contact_number'].'</td>
            </tr>
            <tr>
                <td>Telephone Number</td>
                <td>'.$result_info['telephone_number'].'</td>
            </tr>
            <tr>
                <td>Email Address</td>
                <td>'.$result_info['email_address'].'</td>
            </tr>
            <tr>
                <td>CSO Classification</td>
                <td>'.$result_info['type_of_cso'].'</td>
            </tr>
            <tr>
                <td>CSO Status</td>
                <td>'.$result_info['cso_status'].'</td>
            </tr>
           
        
        </table>';


           $data .= ' <table id="officers_table" style="width:100%" class="text-center mb-3">
                    <thead class="bg-light text-capitalize" >
                        <tr>
                            <th>Name</th>  
                            <th>Position</th> 
                            <th>Contact Number</th>                                                     
                            <th>Email Address</th>
                            
                        </tr>
                    </thead><tbody>';




        foreach ($result_officer as $row) {


            $data .= '

            <tr>
                         <td>'.$row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension.'</td>
                         <td>'.explode("-",$row->cso_position)[0].'</td>
                         <td>'. $row->contact_number.'</td>
                         <td>'.$row->email_address.'</td>
                        
                       </tr>

            ';

    }



     
       $data .= '</tbody>
                </table>';

        $data .= '<table id="project_table" style="width:100%" class="text-center mb-3">
                    <thead class="bg-light text-capitalize" style="width:100%"  >
                        <tr>
                            <th>Title Of Project</th>  
                            <th>Amount</th> 
                            <th>Year</th>                                                     
                            <th>Funding Agency</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';


        foreach ($result_project as $row) {

    
            $status = $row->status == "active" ? '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-1 pr-1">Active</a> ' : '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-1 pr-1">Inactive</a> ' ;

            $data .= '

            <tr>
                         <td>'.$row->title_of_project.'</td>
                         <td>'.number_format($row->amount, 2, '.',',').'</td>
                         <td>'.date('Y', strtotime($row->year)).'</td>
                         <td>'.$row->funding_agency.'</td>
                        <td >'.$status.'</td>
                       </tr>

            ';

    }

        $data .= '</tbody>
                </table>';


     

                   

        return $data;





    }



    function print_cso_projectANDprint_cso_officers($cso_id,$year){


        $result =  $this->get_cso_project($cso_id,$year);
        $result_officer  = $this->get_cso_officers($cso_id);

        $data = '<table id="project_table" style="width:100%" class="text-center mb-3">
                    <thead class="bg-light text-capitalize" style="width:100%"  >
                        <tr>
                            <th>Title Of Project</th>  
                            <th>Amount</th> 
                            <th>Year</th>                                                     
                            <th>Funding Agency</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';


        foreach ($result as $row) {

    
            $status = $row->status == "active" ? '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-1 pr-1">Active</a> ' : '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-1 pr-1">Inactive</a> ' ;

            $data .= '

            <tr>
                         <td>'.$row->title_of_project.'</td>
                         <td>'.number_format($row->amount, 2, '.',',').'</td>
                         <td>'.date('Y', strtotime($row->year)).'</td>
                         <td>'.$row->funding_agency.'</td>
                        <td >'.$status.'</td>
                       </tr>

            ';

    }

        $data .= '</tbody>
                </table>';



        $data .= ' <table id="officers_table" style="width:100%" class="text-center mb-3">
                    <thead class="bg-light text-capitalize" >
                        <tr>
                            <th>Name</th>  
                            <th>Position</th> 
                            <th>Contact Number</th>                                                     
                            <th>Email Address</th>
                            
                        </tr>
                    </thead><tbody>';




        foreach ($result_officer as $row) {


            $data .= '

            <tr>
                         <td>'.$row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension.'</td>
                         <td>'.explode("-",$row->cso_position)[0].'</td>
                         <td>'. $row->contact_number.'</td>
                         <td>'.$row->email_address.'</td>
                        
                       </tr>

            ';

    }



     
       $data .= '</tbody>
                </table>';
                   

        return $data;




    }




    function print_cso_informationANDprint_cso_officers($cso_id){

        $result_info    = $this->get_cso_info($cso_id);
        $result_officer  = $this->get_cso_officers($cso_id);


        $data = '<table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe" data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap data-tablesaw-mode-switch id="_table">
            <tr>
                <td colspan="2"> <a href="javascript:;" class="mt-2  mb-2 btn sub-button text-center  btn-rounded btn-md btn-block"><i class = "fa fa-user" aria-hidden = "true"></i> CSO Information</a> 
               
            </tr>
            <tr>
                <td>CSO Code</td>
                <td>'.$result_info['cso_code'].'</td>
            </tr>
            <tr>
                <td>CSO</td>
                <td>'.$result_info['cso_name'].'</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>'.$result_info['address'].'</td>
            </tr>
            <tr>
                <td>Contact Person</td>
                <td>'.$result_info['contact_person'].'</td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>'.$result_info['contact_number'].'</td>
            </tr>
            <tr>
                <td>Telephone Number</td>
                <td>'.$result_info['telephone_number'].'</td>
            </tr>
            <tr>
                <td>Email Address</td>
                <td>'.$result_info['email_address'].'</td>
            </tr>
            <tr>
                <td>CSO Classification</td>
                <td>'.$result_info['type_of_cso'].'</td>
            </tr>
            <tr>
                <td>CSO Status</td>
                <td>'.$result_info['cso_status'].'</td>
            </tr>
           
        
        </table>';


         $data .= ' <table id="officers_table" style="width:100%" class="text-center mb-3">
                    <thead class="bg-light text-capitalize" >
                        <tr>
                            <th>Name</th>  
                            <th>Position</th> 
                            <th>Contact Number</th>                                                     
                            <th>Email Address</th>
                            
                        </tr>
                    </thead><tbody>';




        foreach ($result_officer as $row) {


            $data .= '

            <tr>
                         <td>'.$row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension.'</td>
                         <td>'.explode("-",$row->cso_position)[0].'</td>
                         <td>'. $row->contact_number.'</td>
                         <td>'.$row->email_address.'</td>
                        
                       </tr>

            ';

    }



     
       $data .= '</tbody>
                </table>';


        return $data;



}



    function print_cso_informationANDprint_cso_project($cso_id,$year){


        $result_info = $this->get_cso_info($cso_id);
        $result_project = $this->get_cso_project($cso_id,$year);

        $data = '<table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe" data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap data-tablesaw-mode-switch id="_table">
            <tr>
                <td colspan="2"> <a href="javascript:;" class="mt-2  mb-2 btn sub-button text-center  btn-rounded btn-md btn-block"><i class = "fa fa-user" aria-hidden = "true"></i> CSO Information</a> 
               
            </tr>
            <tr>
                <td>CSO Code</td>
                <td>'.$result_info['cso_code'].'</td>
            </tr>
            <tr>
                <td>CSO</td>
                <td>'.$result_info['cso_name'].'</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>'.$result_info['address'].'</td>
            </tr>
            <tr>
                <td>Contact Person</td>
                <td>'.$result_info['contact_person'].'</td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>'.$result_info['contact_number'].'</td>
            </tr>
            <tr>
                <td>Telephone Number</td>
                <td>'.$result_info['telephone_number'].'</td>
            </tr>
            <tr>
                <td>Email Address</td>
                <td>'.$result_info['email_address'].'</td>
            </tr>
            <tr>
                <td>CSO Classification</td>
                <td>'.$result_info['type_of_cso'].'</td>
            </tr>
            <tr>
                <td>CSO Status</td>
                <td>'.$result_info['cso_status'].'</td>
            </tr>
           
        
        </table>';

        $data .= '<table id="project_table" style="width:100%" class="text-center mb-3">
                    <thead class="bg-light text-capitalize" style="width:100%"  >
                        <tr>
                            <th>Title Of Project</th>  
                            <th>Amount</th> 
                            <th>Year</th>                                                     
                            <th>Funding Agency</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';


        foreach ($result_project as $row) {

    
            $status = $row->status == "active" ? '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-1 pr-1">Active</a> ' : '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-1 pr-1">Inactive</a> ' ;

            $data .= '

            <tr>
                         <td>'.$row->title_of_project.'</td>
                         <td>'.number_format($row->amount, 2, '.',',').'</td>
                         <td>'.date('Y', strtotime($row->year)).'</td>
                         <td>'.$row->funding_agency.'</td>
                        <td >'.$status.'</td>
                       </tr>

            ';

    }

        $data .= '</tbody>
                </table>';
                   

        return $data;


        

      
    }


     function print_cso_officers($cso_id){


        $result = $this->get_cso_officers($cso_id);

        
        $data = ' <table id="officers_table" style="width:100%" class="text-center mb-3">
                    <thead class="bg-light text-capitalize" >
                        <tr>
                            <th>Name</th>  
                            <th>Position</th> 
                            <th>Contact Number</th>                                                     
                            <th>Email Address</th>
                            
                        </tr>
                    </thead><tbody>';




        foreach ($result as $row) {


            $data .= '

            <tr>
                         <td>'.$row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension.'</td>
                         <td>'.explode("-",$row->cso_position)[0].'</td>
                         <td>'. $row->contact_number.'</td>
                         <td>'.$row->email_address.'</td>
                        
                       </tr>

            ';

    }



     
       $data .= '</tbody>
                </table>';


        return $data;
     }


     function print_cso_project($cso_id,$year){




       $result =  $this->get_cso_project($cso_id,$year);

        $data = '<table id="project_table" style="width:100%" class="text-center mb-3">
                    <thead class="bg-light text-capitalize" style="width:100%"  >
                        <tr>
                            <th>Title Of Project</th>  
                            <th>Amount</th> 
                            <th>Year</th>                                                     
                            <th>Funding Agency</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';


        foreach ($result as $row) {

    
            $status = $row->status == "active" ? '<a href="javascript:;" class="btn btn-success btn-rounded p-1 pl-1 pr-1">Active</a> ' : '<a href="javascript:;" class="btn btn-danger btn-rounded p-1 pl-1 pr-1">Inactive</a> ' ;

            $data .= '

            <tr>
                         <td>'.$row->title_of_project.'</td>
                         <td>'.number_format($row->amount, 2, '.',',').'</td>
                         <td>'.date('Y', strtotime($row->year)).'</td>
                         <td>'.$row->funding_agency.'</td>
                        <td >'.$status.'</td>
                       </tr>

            ';

    }

        $data .= '</tbody>
                </table>';
                   

        return $data;


     }

    function print_cso_information($cso_id){


        $result = $this->get_cso_info($cso_id);

        $data = '<table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe" data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap data-tablesaw-mode-switch id="_table">
            <tr>
                <td colspan="2"> <a href="javascript:;" class="mt-2  mb-2 btn sub-button text-center  btn-rounded btn-md btn-block"><i class = "fa fa-user" aria-hidden = "true"></i> CSO Information</a> 
               
            </tr>
            <tr>
                <td>CSO Code</td>
                <td>'.$result['cso_code'].'</td>
            </tr>
            <tr>
                <td>CSO</td>
                <td>'.$result['cso_name'].'</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>'.$result['address'].'</td>
            </tr>
            <tr>
                <td>Contact Person</td>
                <td>'.$result['contact_person'].'</td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>'.$result['contact_number'].'</td>
            </tr>
            <tr>
                <td>Telephone Number</td>
                <td>'.$result['telephone_number'].'</td>
            </tr>
            <tr>
                <td>Email Address</td>
                <td>'.$result['email_address'].'</td>
            </tr>
            <tr>
                <td>CSO Classification</td>
                <td>'.$result['type_of_cso'].'</td>
            </tr>
            <tr>
                <td>CSO Status</td>
                <td>'.$result['cso_status'].'</td>
            </tr>
           
        
        </table>';

        return $data;
    }

    function get_cso_officers($cso_id){


    $item = $this->CustomModel->getwhere_orderby($this->cso_officer_table,array('officer_cso_id' => $cso_id),'position_number',$this->order_by_asc); 

    return $item;


    }

    function get_cso_project($cso_id,$year){

        $result = '';

        if ($year == 0) {

        $item = $this->CustomModel->getwhere_orderby($this->cso_project_table,array('project_cso_id' => $cso_id ),'cso_project_created',$this->order_by_desc);

        $result = $item;
                    
        }else {

        $item = $this->CustomModel->get_cso_project_by_year(array('project_cso_id' => $cso_id ),$year,'cso_project_created',$this->order_by_desc); 

        $result = $item;

        }


        return $result;
        
    }


    function get_cso_info($cso_id){

            $row = $this->CustomModel->getwhere($this->cso_table,array('cso_id' =>  $cso_id))[0];


    $address = '';

            if ($row->barangay == '') {

                $address = '';
                // code...
            }else if ($row->purok_number == '' && $row->barangay != '') {
                
                $address = $row->barangay;

            }else if ($row->purok_number != '' && $row->barangay != '') {
                
                $address = 'Purok '.$row->purok_number.' '.$row->barangay;
            }



    $result = array(
        'cso_id' => $row->cso_id,
        'cso_name' => $row->cso_name,
        'cso_code' => $row->cso_code,
        'purok_number' => $row->purok_number,
        'barangay' => $row->barangay,
        'address' => $address,
        'contact_person' => $row->contact_person,
        'contact_number' => $row->contact_number,
        'telephone_number' => $row->telephone_number,    
        'email_address' => $row->email_address,
        'type_of_cso' => strtoupper($row->type_of_cso),
        'status' => $row->cso_status,
        'cso_status' => $row->cso_status == 'active' ?  '<span class="status-p bg-success">'.ucfirst($row->cso_status).'</span>' : '<span class="status-p bg-danger">'.ucfirst($row->cso_status).'</span>',
        
      
           

    );


    return $result;
    }
}

    