<?php

namespace App\Models;

use CodeIgniter\Model;

use CodeIgniter\Database\ConnectionInterface;

class TransactionModel extends Model
{

    protected $db;

    public function __construct(ConnectionInterface &$db){
       parent::__construct();
       $this->db =& $db;
    }


    public function get_last_pmas_number_where($where){
         
        $builder = $this->db->table('transactions');
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y') = '".$where."' ");
        $builder->orderBy('date_and_time_filed','desc');
        $query = $builder->get();
        return $query;
        
    }

    public function verify_pmas_number($where){

        $builder = $this->db->table('transactions');
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m') = '".$where['date_and_time_filed']."' ");
        $builder->where('number',$where['number']);
        $query = $builder;
        return $query;
    }
    
    
    public function getAllTransactions($order_key,$order_by){
         
        $builder = $this->db->table('transactions');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->orderBy($order_key, $order_by);
        $query = $builder->get()->getResult();
        return $query;
        
    }



    ///ADMIN

    public function getAdminPendingTransactions(){

         $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where('transactions.transaction_status','pending');
        $builder->orderBy('transactions.number','desc');
        $query = $builder->get()->getResult();
        return $query;
    }


    public function getPendingTransactionDateFilter($filter_data) {

        $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') >= '".$filter_data['start_date']."' ");
        $builder->where("DATE_FORMAT(traactions.date_and_time_filed,'%Y-%m-%d') <= '".$filter_data['end_date']."'");
        $builder->where('transactions.transaction_status','pending');
        $builder->orderBy('transactions.number','desc');
        $query = $builder->get()->getResult();
        return $query;

    }


    public function getCompletedTransactionDateFilterWhere($filter_data){

        $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') >= '".$filter_data['start_date']."' ");
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') <= '".$filter_data['end_date']."'");
         $builder->where('transactions.type_of_activity_id',$filter_data['type_of_activity']);
        $builder->where('transactions.transaction_status','completed');
        $builder->orderBy('transactions.number','desc');
        $query = $builder->get()->getResult();
        return $query;

    }


    public function getCompletedTransactionDateFilter($filter_data){

        $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') >= '".$filter_data['start_date']."' ");
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') <= '".$filter_data['end_date']."'");
        $builder->where('transactions.transaction_status','completed');
        $builder->orderBy('transactions.number','desc');
        $query = $builder->get()->getResult();
        return $query;

    }
}
