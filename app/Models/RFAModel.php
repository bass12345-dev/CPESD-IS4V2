<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class RFAModel extends Model
{
  protected $db;
     
     public function __construct(ConnectionInterface &$db){
       parent::__construct();
       $this->db =& $db;
    }
  
    public function get_last_ref_number_where($where){
         
        $builder = $this->db->table('rfa_transactions');
        $builder->where("DATE_FORMAT(rfa_transactions.rfa_date_filed,'%Y') = '".$where."' ");
        $builder->orderBy('rfa_date_filed','desc');
        $query = $builder->get();
        return $query;
        
    }

    public function verify_ref_number($where){

        $builder = $this->db->table('rfa_transactions');
        $builder->where("DATE_FORMAT(rfa_transactions.rfa_date_filed,'%Y-%m') = '".$where['rfa_date_filed']."' ");
        $builder->where('number',$where['number']);
        $query = $builder;
        return $query;
    }


    public function getAllRFATransactions($order_key,$order_by){

        $builder = $this->db->table('rfa_transactions');
        $builder->join('users','users.user_id = rfa_transactions.rfa_created_by');
        $builder->orderBy($order_key, $order_by);
        $query = $builder->get()->getResult();
        return $query;
    }



      public function getAdminPendingRFA(){

        $builder = $this->db->table('rfa_transactions');
        // $builder->join('rfa_clients','rfa_clients.rfa_client_id = rfa_transactions.client_id');

        $builder->join('users','users.user_id = rfa_transactions.rfa_created_by');
        $builder->join('type_of_request','type_of_request.type_of_request_id = rfa_transactions.tor_id');
        $builder->where('rfa_transactions.rfa_status','pending');
     
        $builder->orderBy('rfa_transactions.rfa_date_filed','desc');
        $query = $builder->get()->getResult();
        return $query;
    }



        public function getAdminPendingRFALimit(){

        $builder = $this->db->table('rfa_transactions');
        // $builder->join('rfa_clients','rfa_clients.rfa_client_id = rfa_transactions.client_id');

        $builder->join('users','users.user_id = rfa_transactions.rfa_created_by');
        $builder->join('type_of_request','type_of_request.type_of_request_id = rfa_transactions.tor_id');
        $builder->where('rfa_transactions.rfa_status','pending');
     
        $builder->orderBy('rfa_transactions.rfa_date_filed','desc');
        $builder->limit(10);
        $query = $builder->get()->getResult();
        return $query;
    }


        public function getUserPendingRFA($where){

        $builder = $this->db->table('rfa_transactions');
        // $builder->join('rfa_clients','rfa_clients.rfa_client_id = rfa_transactions.client_id');

        $builder->join('users','users.user_id = rfa_transactions.rfa_created_by');
        $builder->join('type_of_request','type_of_request.type_of_request_id = rfa_transactions.tor_id');
        $builder->where('rfa_transactions.rfa_status','pending');
        $builder->where('rfa_transactions.rfa_created_by',$where['created_by']);
        $builder->orderBy('rfa_transactions.rfa_date_filed','desc');
        $query = $builder->get()->getResult();
        return $query;
    }



    public function getUserRefferedRFA($where){

        $builder = $this->db->table('rfa_transactions');
        // $builder->join('rfa_clients','rfa_clients.rfa_client_id = rfa_transactions.client_id');

        $builder->join('users','users.user_id = rfa_transactions.rfa_created_by');
        $builder->join('type_of_request','type_of_request.type_of_request_id = rfa_transactions.tor_id');
        $builder->where('rfa_transactions.rfa_status','pending');
        $builder->where('rfa_transactions.reffered_to',$where['reffered_to']);
        $builder->orderBy('rfa_transactions.reffered_date_and_time','desc');
        $query = $builder->get()->getResult();
        return $query;
    }


     public  function getRFAData($table,$where){

        $builder = $this->db->table('rfa_transactions');
        $builder->join('rfa_clients','rfa_clients.rfa_client_id = rfa_transactions.client_id');

        $builder->join('type_of_request','type_of_request.type_of_request_id = rfa_transactions.tor_id');
        $builder->where('rfa_transactions.rfa_status','pending');
        $builder->where('rfa_transactions.rfa_created_by',$where['created_by']);
        $builder->where('rfa_transactions.rfa_id',$where['rfa_id']);
        $query = $builder->get()->getResult();
        return $query;


    }



         public  function ViewRFADATA($table,$where){

        $builder = $this->db->table('rfa_transactions');

        $builder->join('users','users.user_id = rfa_transactions.rfa_created_by');
        $builder->join('type_of_request','type_of_request.type_of_request_id = rfa_transactions.tor_id');
        $builder->where('rfa_transactions.rfa_id',$where['rfa_id']);
        $query = $builder->get()->getResult();
        return $query;


    }








    public function getUserReceivedRFA(){

         $builder = $this->db->table('rfa_transaction_history');
         $builder->join('users','users.user_id = rfa_transaction_history.received_by');
         $builder->join('rfa_transactions','rfa_transactions.rfa_tracking_code = rfa_transaction_history.track_code');
         // $builder->join('rfa_transactions','rfa_transactions.rfa_created_by = rfa_transaction_history.received_by');
         $builder->where('rfa_transaction_history.rfa_tracking_status','received');
         $builder->where('rfa_transaction_history.release_status',0);
        $builder->orderBy('rfa_transaction_history.history_id','desc');
        $query = $builder->get()->getResult();
        return $query;

    }


   

    public function addRFA($data){

        $builder = $this->db->table('rfa_transactions');
        $builder->insert($data);
        return $this->db->insertID();
    }




    public function count_rfa_transaction_chart($table,$m,$y,$status){

        $builder = $this->db->table('rfa_transactions');
        $builder->where('MONTH(rfa_date_filed)',$m);
        $builder->where('YEAR(rfa_date_filed)',$y);
        $builder->where('rfa_transactions.rfa_status',$status);
        $query = $builder->countAllResults();
        return $query; 

    }



        public function count_user_rfa_transaction_chart($table,$m,$y,$status,$where){

        $builder = $this->db->table('rfa_transactions');
        $builder->where('MONTH(rfa_date_filed)',$m);
        $builder->where('YEAR(rfa_date_filed)',$y);
        $builder->where('rfa_transactions.rfa_status',$status);
         $builder->where($where);
        $query = $builder->countAllResults();
        return $query; 

    }


    public function getUserCompletedRFA($where){


          $builder = $this->db->table('rfa_transactions');
        // $builder->join('rfa_clients','rfa_clients.rfa_client_id = rfa_transactions.client_id');

        $builder->join('users','users.user_id = rfa_transactions.rfa_created_by');
        $builder->join('type_of_request','type_of_request.type_of_request_id = rfa_transactions.tor_id');
        $builder->where('rfa_transactions.rfa_status','completed');
        $builder->where('rfa_transactions.reffered_to',$where['user_id']);
        $builder->orderBy('rfa_transactions.approved_date','desc');
        $query = $builder->get()->getResult();
        return $query;

    }





    public function getRFATransactionDateFilter($filter_data) {

         $builder = $this->db->table('rfa_transactions');

        $builder->join('users','users.user_id = rfa_transactions.rfa_created_by');
        $builder->join('type_of_request','type_of_request.type_of_request_id = rfa_transactions.tor_id');

        $builder->where("DATE_FORMAT(rfa_transactions.rfa_date_filed,'%Y-%m-%d') >= '".$filter_data['start_date']."' ");
        $builder->where("DATE_FORMAT(rfa_transactions.rfa_date_filed,'%Y-%m-%d') <= '".$filter_data['end_date']."'");

        $builder->where('rfa_transactions.rfa_status','completed');
     
        $builder->orderBy('rfa_transactions.rfa_date_filed','desc');
        $builder->limit(10);
        $query = $builder->get()->getResult();
        return $query;

    }

}
